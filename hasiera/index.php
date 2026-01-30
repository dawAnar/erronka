<?php
// === API URL-ak ===
$apiNobedadeak = "http://localhost/Erronka_01/api/nobedadeak/";

// === NOBEDADEAK (PHP bidez kargatuta) ===
$nobedadeak = [];
try {
    $json = file_get_contents($apiNobedadeak);

    if ($json !== false) {
        $data = json_decode($json, true);
        if (is_array($data)) {
            $nobedadeak = $data;
        }
    }
} catch (Exception $e) {
    error_log("Errorea nobedadeak API irakurtzean: " . $e->getMessage());
}

// === HTML fitxategia kargatu ===
include('hasiera.php');
?>
