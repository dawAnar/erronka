<?php
require('../../../klaseak/com/leartik/daw24anar/mezua/mezua.php');
require('../../../klaseak/com/leartik/daw24anar/mezua/mezua_db.php');

use com\leartik\daw24anar\mezua\Mezua;
use com\leartik\daw24anar\mezua\MezuaDB;

// 🔐 Admin egiaztapena
if (!isset($_COOKIE['erabiltzailea']) || $_COOKIE['erabiltzailea'] !== "admin") {
    header("Location: ../../index.php");
    exit;
}

if (isset($_POST['ezabatu'])) {

    $id = (int)($_POST['id'] ?? 0);

    if ($id > 0 && MezuaDB::deleteMezua($id) > 0) {
        header("Location: ../../mezua/mezua_ezabatu/mezua_ezabatu_da.php");
        exit;

    } else {
        header("Location: ../../mezua/mezua_ezabatu/mezua_ez_da_ezabatu.php");
        exit;
    }

} elseif (isset($_GET['id'])) {

    $id = (int)$_GET['id'];
    $mezua = MezuaDB::selectMezua($id);

    if ($mezua !== null) {
        include('mezua_ezabatu.php');
        exit;
    } else {
        include('mezua_id_baliogabea.php');
        exit;
    }

} else {
    header("Location: ../../index.php");
    exit;
}
?>
