<?php

require $_SERVER['DOCUMENT_ROOT'] . '/../vendor/autoload.php';
require $_SERVER['DOCUMENT_ROOT'] . '/php/Amail.php';
$dotenv = Dotenv\Dotenv::create($_SERVER['DOCUMENT_ROOT']);
$dotenv->load();

use Aactmad\Amail;

$amail = new Amail();

date_default_timezone_set('America/Detroit');

$payload = json_decode(file_get_contents('php://input'));

$testing = "";
$serverName = $_SERVER['SERVER_NAME'];
if ($serverName != "aactmad.org") {
    $testing = " *TEST* ";
}

$ts = date("Y-m-d H:i:s");

$YEAR = $payload->Year;
$DATES = $payload->Dates;

$registrations = $payload->Registrations;
$name = $registrations[0]->name;

$message = <<<EOD
$testing $testing
Timestamp: $ts

Payment for this registration has not yet been confirmed.
If the dancer completes a payment through Paypal you will receive notification
from PayPal.

EOD;

$to = "mis@aactmad.org";
//$to = "will@jaynes.org";
$fromemail = "mis@aactmad.org";
$fromname = "Melt Into Spring Registrar";

$subject = $testing . $name . " - Melt Into Spring " . $YEAR . " Registration";

$message .= print_r($registrations, true);

$mailed = true;
try {
    $amail->send([
        'from' => "{$fromname} <{$fromemail}>",
        'to' => $to,
        'subject' => $subject,
        'text' => $message
    ]);
} catch (Exception $e) {
    $mailed = false;
}

if (!$mailed) {
    $regfile = 'mis.registration.txt';
    try {
        $file = fopen($regfile, 'a');
        fwrite($file, "\n\n$testing---------------- '.$name.' -------------\n");
        if (!$mailed) {
            fwrite($file, "*****************************************************\n");
            fwrite($file, "****** Mail TO REGISTRAR WAS NOT SUCCESSFULL ********\n");
            fwrite($file, "*****************************************************\n");
        }
        fwrite($file, $message);
        //	fwrite($file, print_r($_POST, true));
        fclose($file);
    } catch (Exception $e) {
    }
}

foreach ($registrations as $reg) {
    $as = "";
    if ($reg->student)
        $as = " as a student ";
    $dinner = "";
    if ($reg->dinner)
        $dinner = "You have also registered for the catered dinner.";
    else
        $dinner = "You have not registered for the catered dinner.";
    $for = "for ";
    if (!$reg->weekendDancing && !$reg->friday && !$reg->saturday && !$reg->practice)
        $for .= "No dancing sessions";
    elseif ($reg->weekendDancing || ($reg->friday && $reg->saturday))
        $for .= "the full weekend of dancing";
    else {
        if ($reg->friday)
            $for .= " Friday evening";
        if ($reg->saturday)
            $for .= " Saturday ball and practice";
        if ($reg->friday && $reg->practice)
            $for .= " and Saturday practice";
        elseif ($reg->practice)
            $for .= " just Saturday practice";
    }

    $amtdue = $reg->total;

    $subject = $testing . "Melt Into Spring $YEAR registration";
    $to = $reg->email;

    $message = <<<EOD
$testing $testing
Dear Dancer,

On behalf of AACTMAD, thank you for registering for Melt Into Spring, ${DATES}, ${YEAR}.

You have registered{$as} {$for}. $dinner

Your total for the weekend is \${$amtdue}. 

This is an automatic response. You will receive a response from our esteemed registrar in the near future.

Please note that registration is not complete until payment is received. If, for any reason, you were unable to complete your payment via PayPal (which sometimes happens), please return to our registration form and try again. If you decide not to use PayPal, please send in your registration form with a check.

Again, thank you for registering for Melt Into Spring. We are so pleased that you will be dancing with us.

Registrar for Melt Into Spring Weekend
mis@aactmad.org
aactmad.org/melt-into-spring

EOD;

    try {
        $amail->send([
            'from' => "{$fromname} <{$fromemail}>",
            'to' => $to,
            'subject' => $subject,
            'text' => $message
        ]);
    } catch (Exception $e) {
    }
}


?>

