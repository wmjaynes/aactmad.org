<?php

date_default_timezone_set('America/Detroit');

$payload = json_decode(file_get_contents('php://input'));

$testing = "";
$serverName = $_SERVER['SERVER_NAME'];
if ($serverName != "aactmad.org") {
    $testing = " *TEST* ";
}

$ts = date("Y-m-d H:i:s");
$item_number = $payload->ItemNumber;



$message = <<<EOD
$testing $testing
Timestamp: $ts
This membership is item number: $item_number

Payment for this membership has not yet been confirmed.
If the individual completes a payment through Paypal you will receive notification
identified by the same item number as above.


EOD;

$to = "registration@aactmad.org";
$fromemail = "registration@aactmad.org";
$fromname = "AACTMAD Membership";
$subject = $testing."AACTMAD Membership: Item#: ";
$subject .= $item_number;

$headers = "From: ".$fromname." <".$fromemail.">\r\n";
$headers .= "Reply-To: ".$fromname." <".$fromemail.">\r\n";
//$headers .= "To: ".$to."\r\n";
$headers .= "X-Mailer: PHP/".phpversion();

$message .= print_r($payload, true);

$mailed = false;
try {
    $mailed = mail($to,$subject,$message,$headers);
} catch (Exception $e) {
    $mailed = false;
}

try {
    $regfile = 'memberships.txt';
    $file = fopen($regfile, 'a');
    fwrite($file, "\n\n$testing---------------- '.$item_number.' -------------\n");
    if (! $mailed) {
        fwrite($file, "*****************************************************\n");
        fwrite($file, "****** Mail TO MEMBERSHIP WAS NOT SUCCESSFULL ********\n");
        fwrite($file, "*****************************************************\n");
    }
    fwrite($file, $message);
    //	fwrite($file, print_r($_POST, true));
    fclose($file);
} catch (Exception $e) {
}



$category = $payload->Category->Description;
$value = $payload->Category->Value;

$subject = $testing."AACTMAD Membership";
$to = $payload->Names[0]->email;

$message = <<<EOD
$testing $testing

On behalf of AACTMAD, thank you for becoming a member or renewing your membership.

You have chosen a membership category of $category at \$$value. We appreciate your support.

Please note that membership registration is not complete until payment is received.
If, for any reason, you were unable to complete your payment via PayPal (which sometimes happens),
please return to our membership form and try again. If you decide not to use PayPal, please send
in your membership form with a check payable to AACTMAD to:

AACTMAD Membership
4531 Concourse Dr.
Ann Arbor, MI 48108

Again, thank you for your membership.

AACTMAD Membership Committee


EOD;

mail($to, $subject, $message, $headers);



?>

