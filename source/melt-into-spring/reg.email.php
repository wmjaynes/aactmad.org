<?php

date_default_timezone_set('America/Detroit');

$YEAR = '2019';
$DATES = 'March 22 - 23';

$registrations = json_decode(file_get_contents('php://input'));

$testing = "";
$serverName = $_SERVER['SERVER_NAME'];
if ($serverName != "aactmad.org") {
    $testing = " *TEST* ";
}

$name = $registrations[0]->name;

$ts = date("Y-m-d H:i:s");
$message = <<<EOD
$testing $testing
Timestamp: $ts

Payment for this registration has not yet been confirmed.
If the dancer completes a payment through Paypal you will receive notification
from PayPal.

EOD;

$to = "mis@aactmad.org";
$fromemail = "mis@aactmad.org";
$fromname = "Melt Into Spring Registrar";

$subject = $testing.$name." - Melt Into Spring ".$YEAR." Registration";

$headers = "From: ".$fromname." <".$fromemail.">\r\n";
$headers .= "Reply-To: ".$fromname." <".$fromemail.">\r\n";
//$headers .= "To: ".$to."\r\n";
$headers .= "X-Mailer: PHP/".phpversion();

$message .= print_r($registrations, true);

$mailed = true;
try {
    $mailed = mail($to,$subject,$message,$headers);
} catch (Exception $e) {
    $mailed = false;
}

$regfile = 'mis.registration.txt';
try {
    $file = fopen($regfile, 'a');
    fwrite($file, "\n\n$testing---------------- '.$name.' -------------\n");
    if (! $mailed) {
        fwrite($file, "*****************************************************\n");
        fwrite($file, "****** Mail TO REGISTRAR WAS NOT SUCCESSFULL ********\n");
        fwrite($file, "*****************************************************\n");
    }
    fwrite($file, $message);
    //	fwrite($file, print_r($_POST, true));
    fclose($file);
} catch (Exception $e) {
}

//exit("ending");

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
    if ($reg->weekendDancing)
        $for .= "the full weekend of dancing";
    else {
        if ($reg->friday)
            $for .= " Friday evening";
        if ($reg->friday && $reg->saturday)
            $for .= " and";
        if ($reg->saturday)
            $for .= " Saturday ball and workshop";
    }

    $amtdue = $reg->total;

    $subject = $testing."Melt Into Spring ".$YEAR." registration";
    $to = $reg->email;

    $message = <<<EOD
$testing $testing
Dear Dancer,

On behalf of AACTMAD, thank you for registering for Melt Into Spring, ${DATES}, ${YEAR}.

You have registered{$as} ${for}. $dinner

Your total for the weekend is \${$amtdue}. 

This is an automatic response. You will receive a response from our esteemed registrar in the near future.

Please note that registration is not complete until payment is received. If, for any reason, you were unable to complete your payment via PayPal (which sometimes happens), please return to our registration form and try again. If you decide not to use PayPal, please send in your registration form with a check.

Again, thank you for registering for Melt Into Spring. We are so pleased that you will be dancing with us.

Registrar for Melt Into Spring Weekend
mis@aactmad.org
aactmad.org/melt-into-spring

EOD;

    try {
        mail($to, $subject, $message, $headers);
    } catch (Exception $e) {
    }
}



?>

