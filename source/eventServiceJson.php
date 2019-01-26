<?php
date_default_timezone_set ( "America/Detroit" );

header("Access-Control-Allow-Origin: *");

/*
 * Uncomment this for debugging with FirePHP
 *
 * require_once('FirePHPCore/FirePHP.class.php');
 * require_once('FirePHPCore/fb.php');
 * ob_start();
 *
 * $firephp = FirePHP::getInstance(true);
 */
/*
 * example debug output statement
 * fb($data, 'Label for data: ');
 */

$testDataUrl = 'event.test.xml';

$orgId = 135;
$outputFormat = 'json';
$aggType = 's';
$options = null;
$orgData = "&OrgData=1";
$startCalendar = null;
$endCalendar = null;
$startDate = $endDate = null;
if (array_key_exists ( 'startCalendar', $_GET )) {
    $startCalendar = $_GET ['startCalendar'];
}
if (array_key_exists ( 'endCalendar', $_GET )) {
    $endCalendar = $_GET ['endCalendar'];
}
if (array_key_exists ( 'orgId', $_GET )) {
    $orgId = $_GET ['orgId'];
    $aggType = 'o';
}
if (array_key_exists ( 'outputFormat', $_GET )) {
    $outputFormat = $_GET ['outputFormat'];
}
if (array_key_exists ( 'aggType', $_GET )) {
    $aggType = $_GET ['aggType'];
}
if (array_key_exists ( 'options', $_GET )) {
    $options = $_GET ['options'];
}

/*
 * If eventId is specified, ignore options or specified dates.
 * If options are specified, ignore any specified dates.
 */
$eventIds = array ();
if (array_key_exists ( 'eventId', $_GET )) {
    $eventId = $_GET ['eventId'];
    $orgId = 0;
    $outputFormat = 'json';
    $aggType = 'e';
    $options = "";
    $eventIds = explode ( ',', $_GET ['eventId'] );
} else if (is_null ( $options )) {

    if ($startCalendar == null) {
        $startDate = new DateTime ( 'today midnight' );
    } else {
        $startDate = new DateTime ( $startCalendar );
    }

    /*
     * Default endDate is add 6 months from today and use end of that month.
     */
    if ($endCalendar == null) {
        $endDate = new DateTime ( 'today midnight' );
        $endDate->add ( new DateInterval ( 'P6M' ) );
        $month = $endDate->format ( 'n' );
        $year = $endDate->format ( 'Y' );
        $daysInMonth = cal_days_in_month ( CAL_GREGORIAN, $month, $year );
        $endDate = new DateTime ( $year . '-' . $month . '-' . $daysInMonth );
    } else {
        $endDate = new DateTime ( $endCalendar );
    }

    $today = new DateTime ( 'today midnight' );

    $dayToStart = round ( ($startDate->getTimeStamp () - $today->getTimeStamp ()) / (60 * 60 * 24) );
    $numberOfDays = round ( ($endDate->getTimeStamp () - $startDate->getTimeStamp ()) / (60 * 60 * 24) ) + 1;

    $options = 'p=d' . (($dayToStart < 0) ? $dayToStart : ('+' . $dayToStart)) . ':' . $numberOfDays;
}

// $publicDrumUrl = 'http://suapi2.org/api/' . $orgId . '/' . $aggType . '/' . $outputFormat . '/options:' . $options;
$publicDrumUrl = 'http://publicdrum.aactmad.org/api/' . $orgId . '/' . $aggType . '/' . $outputFormat . '/options:' . $options;
$publicDrumAactmadUrl = 'http://publicdrum.aactmad.org/api/' . $orgId . '/' . $aggType . '/' . $outputFormat . '/options:' . $options;

if (! empty ( $eventIds )) {
    $outputXmlDoc = new DOMDocument ();
    $outputXmlDoc->formatOutput = true;
    $outputXmlDoc->preserveWhiteSpace = false;
    $outputRoot = $outputXmlDoc->createElement ( 'suEvents' );
    $outputRoot = $outputXmlDoc->appendChild ( $outputRoot );

    foreach ( $eventIds as $eventId ) {
        $inputXmlDoc = new DOMDocument ();
        $inputXmlDoc->formatOutput = true;
        $inputXmlDoc->preserveWhiteSpace = false;
        $queryStr = $publicDrumUrl . 'eventid=' . $eventId . $orgData;
        $inputXmlDoc->load ( $queryStr );
        // $inputEvents = $inputXmlDoc->getElementsByTagName("Event");
        foreach ( $inputXmlDoc->documentElement->childNodes as $node ) {
            $node = $outputXmlDoc->importNode ( $node, true );
            $outputXmlDoc->documentElement->appendChild ( $node );
        }
    }

    header ( "Content-Type:text/xml" );
    print $outputXmlDoc->saveXML ();
} else {
    header ( "Content-Type:application/json" );
    $fromAactmad = "";
    $fromPD = file_get_contents ( $publicDrumUrl . $orgData );
//	die($publicDrumUrl . $orgData);
//	$fromAactmad = file_get_contents ( $publicDrumAactmadUrl . $orgData );

    // Fix problems with publicdrum's json
    $fromPD = fixJson ( $fromPD );
//	$fromAactmad = fixJson ( $fromAactmad );

//	print stitch($fromPD, $fromAactmad);
    print $fromPD;
}

// print $outputXmlDoc->saveXML();
function fixJson($theJson) {
    // Fix problems with publicdrum's json
    $theJson = chop ( $theJson, "};" );
    $theJson = ltrim ( $theJson, "var embedEvents = {\"suEvents\":" );
    $count = 1;
    while ( $count > 0 ) {
        $theJson = str_replace ( ", ,", ",", $theJson, $count );
    }
    return $theJson;
}
function stitch($json1, $json2) {
    $json1 = chop ( $json1, "]" );
    $json2 = ltrim ( $json2, "[" );
    $newJson = $json1 . ", " . $json2;

    return $newJson;
}

?>

