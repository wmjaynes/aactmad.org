<?php

$message = "";


$registrations = json_decode(file_get_contents('php://input'));
$count = count($registrations);

$name = $registrations[0]->name;


foreach ($_REQUEST as $key => $value) {
    $message .= str_pad($key,20,'.') . " $value\n";
}

try {
    $regfile = 'tts.registrations.txt';
    $file = fopen($regfile, 'a');
    fwrite($file, "\n\n----------------  -------------\n");

//    foreach ($registrations as $registration) {
//        fwrite($file, print_r($registration, true));
//    }
//
//    fwrite($file, print_r(file_get_contents('php://input'), true));
    fwrite($file, print_r($registrations, true));

    fclose($file);
} catch (Exception $e) {
}


?>

