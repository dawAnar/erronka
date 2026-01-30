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

// ======================================================
// 1) MEZUA EZABATU
// ======================================================
if (isset($_POST['ezabatu'])) {

    $id = (int)($_POST['id'] ?? 0);

    if ($id > 0 && MezuaDB::deleteMezua($id) > 0) {
        header("Location: ../../mezua/mezua_ezabatu/mezua_ezabatu_da.php");
        exit;

    } else {
        header("Location: ../../mezua/mezua_ezabatu/mezua_ez_da_ezabatu.php");
        exit;
    }
}

// ======================================================
// 2) MEZUA ALDATU (ERANTZUNDA)
// ======================================================
if (isset($_POST['aldatu'])) {

    $id = (int)$_POST['id'];
    $erantzunda = isset($_POST['erantzunda']) ? 1 : 0;

    $mezuaObj = MezuaDB::selectMezua($id);

    if ($mezuaObj !== null) {

        // mezua eguneratu → ez dugu izena/email mezua aldatzen
        $mezuaObj->setErantzunda($erantzunda);

        if (MezuaDB::updateMezua($mezuaObj) > 0) {

            // ==== PASAR VARIABLES SIMPLES AL include ====
            $izena = $mezuaObj->getIzena();
            $email = $mezuaObj->getEmail();
            $mezua = $mezuaObj->getMezua();
            $erantzunda = $mezuaObj->getErantzunda();

            include('mezua_gorde_da.php');
            exit;

        } else {
            include('mezua_ez_da_gorde.php');
            exit;
        }
    }

    include('mezua_id_baliogabea.php');
    exit;
}

// ======================================================
// 3) MEZUA KARGATU FORMULARIORA
// ======================================================
elseif (isset($_GET['id'])) {

    $id = (int)$_GET['id'];
    $mezua = MezuaDB::selectMezua($id);

    if ($mezua !== null) {
        include('mezua_aldatu.php');
        exit;
    } else {
        include('mezua_id_baliogabea.php');
        exit;
    }
}

// ======================================================
// 4) ID FALTA
// ======================================================
else {
    header("Location: ../../index.php");
    exit;
}
?>
