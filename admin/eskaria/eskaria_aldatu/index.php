<?php
// admin/eskaria/eskaria_aldatu/index.php
// Permite ver y marcar un pedido (bidalita) EN BD

if (!isset($_COOKIE['erabiltzailea']) || $_COOKIE['erabiltzailea'] !== "admin") {
    header("Location: ../../index.php");
    exit;
}

require('../../../klaseak/com/leartik/daw24anar/eskaria/eskaria.php');
require('../../../klaseak/com/leartik/daw24anar/eskaria/eskaria_db.php');

use com\leartik\daw24anar\eskaria\EskariaDB;

// POST: actualizar estado en BD
if (isset($_POST['aldatu'])) {
    $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
    $bidalita = isset($_POST['bidalita']) ? 1 : 0;

    $ok = EskariaDB::updateBidalita($id, $bidalita);

    if ($ok) {
        include('eskaria_gorde_da.php');
        exit;
    } else {
        include('eskaria_ez_da_gorde.php');
        exit;
    }
}

// GET: mostrar formulario
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $eskaria = EskariaDB::selectEskaria($id);

    if ($eskaria) {
        include('eskaria_aldatu.php');
        exit;
    } else {
        include('eskaria_id_baliogabea.php');
        exit;
    }
}

header("Location: ../../index.php");
exit;
?>
