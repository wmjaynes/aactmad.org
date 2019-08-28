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

$name = $payload->Name;
$email = $payload->Email;
$lists = $payload->Lists;


$adminEmail = [
    "contra" => "hellmann@umich.edu",
    "english" => "ecd@aactmad.org",
    "swing" => "aactmad.swing@gmail.com",
    "concerts" => "hellmann@umich.edu"
];

$too = "";
$plists = "";
foreach ($lists as $list) {
    $too .= $adminEmail[$list] . ', ';
    $plists .= $list . "\n";
}
$too .= "will@jaynes.org";
//$too = "will@jaynes.org";

$message = <<<EOD
$testing $testing $testing $testing $testing
Timestamp: $ts
Sent to: $too

Name: $name
Email: $email

Please subscribe the above email address to the following email list(s):
$plists

$testing $testing $testing $testing $testing

EOD;


$mailed = true;
$exception = null;

try {
    $amail->send([
        'from' => 'AACTMAD Email Lists <do.not.reply@aactmad.org>',
        'to' => $too,
        'subject' => 'AACTMAD Email List Subscription',
        'text' => $message
    ]);
} catch (Exception $e) {
    $mailed = false;
    $exception = $e;
}

if (!$mailed) {
    try {
        $regfile = 'email.lists.txt';
        $file = fopen($regfile, 'a');
        fwrite($file, "\n\n$testing-----------------------------\n");
        if (!$mailed) {
            fwrite($file, "*****************************************************\n");
            fwrite($file, "****** Mail TO Email List Admins WAS NOT SUCCESSFULL ********\n");
            fwrite($file, "*****************************************************\n");
        }
        fwrite($file, $message);
        fclose($file);
    } catch (Exception $e) {
    }
}


?>

