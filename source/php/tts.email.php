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

$to = "tts@aactmad.org";
//$to = "will@jaynes.org";
$fromemail = "tts@aactmad.org";
$fromname = "Tree Town Stomp Registrar";

$subject = $testing . $name . " - Tree Town Stomp $YEAR Registration";

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
    $regfile = 'tts.registration.txt';
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
    $as = " as a non-member";
    if ($reg->member)
        $as = " as a member of a dance organization";
    if ($reg->under25)
        $as = " as a 25 or under";
    $amtdue = $reg->total;
    $name = $reg->name;


    $subject = $testing . "Tree Town Stomp $YEAR registration";
    $to = $reg->email;

    $message = <<<EOD
$testing $testing
Hello {$name},

On behalf of AACTMAD, thank you for registering for Tree Town Stomp, ${DATES}, ${YEAR}.

You have registered for the weekend ${as}.

Your total for the weekend is \${$amtdue}.

This is an automatic response. You will receive a response from our esteemed registrar in the near future.

Please note that registration is not complete until payment is received.
If, for any reason, you were unable to complete your payment via PayPal (which sometimes happens),
please return to our registration form and try again. If you decide not to use PayPal, please send
in your registration form with a check payable to AACTMAD to:

Tree Town Stomp
2812 Oakdale Drive,
Ann Arbor, MI 48108-1252

Again, thank you for registering for Tree Town Stomp. We are so pleased that you will be dancing with us.

Registrar for Tree Town Stomp
tts@aactmad.org
aactmad.org/tts

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

