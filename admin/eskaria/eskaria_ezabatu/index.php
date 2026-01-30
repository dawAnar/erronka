<?php
// admin/eskaria/eskaria_ezabatu/index.php
// Borra un pedido de la BD (Eskaria + Detallea por ON DELETE CASCADE)

if (!isset($_COOKIE['erabiltzailea']) || $_COOKIE['erabiltzailea'] !== "admin") {
    header("Location: ../../index.php");
    exit;
}

require_once('../../../klaseak/com/leartik/daw24anar/eskaria/eskaria.php');
require_once('../../../klaseak/com/leartik/daw24anar/eskaria/eskaria_db.php');

use com\leartik\daw24anar\eskaria\EskariaDB;

$eskaria = null;

// POST: confirmar borrado
if (isset($_POST['ezabatu'])) {
    $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;

    if ($id > 0) {
        $kop = EskariaDB::deleteEskaria($id); // devuelve rowCount()

        if ($kop > 0) {
            include('eskaria_ezabatu_da.php');
            exit;
        } else {
            include('eskaria_ez_da_ezabatu.php');
            exit;
        }
    } else {
        include('eskaria_id_baliogabea.php');
        exit;
    }
}

// GET: mostrar confirmación
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    if ($id > 0) {
        $eskaria = EskariaDB::selectEskaria($id);

        if ($eskaria) {
            include('eskaria_ezabatu.php');
            exit;
        } else {
            include('eskaria_id_baliogabea.php');
            exit;
        }
    }
}

header("Location: ../../index.php");
exit;
?>
