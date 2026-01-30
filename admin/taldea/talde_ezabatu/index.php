<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

use com\leartik\daw24anar\taldea\TaldeaDB;

if (!isset($_COOKIE['erabiltzailea']) || $_COOKIE['erabiltzailea'] != 'admin') {
    header('Location: ../../index.php');
    exit;
}

require_once('../../../klaseak/com/leartik/daw24anar/taldea/taldea.php'); 
require_once('../../../klaseak/com/leartik/daw24anar/taldea/taldea_db.php'); 


if (isset($_POST['ezabatu'])) {
    
    $id = (int)$_POST['id'];
    
    if ($id <= 0) {
        include('taldea_id_baliogabea.php');
        exit();
    }

    if (TaldeaDB::deleteTaldea($id)) {
        include('taldea_ezabatu_da.php');
        exit();
    } else {
        include('taldea_ez_da_ezabatu.php'); 
        exit();
    }
}



if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    include('taldea_id_baliogabea.php');
    exit();
}

$id = (int)$_GET['id'];
$taldea = TaldeaDB::selectTaldea($id);

if (!$taldea) {
    include('taldea_id_baliogabea.php'); 
    exit();
}
include('taldea_ezabatu.php');
?>