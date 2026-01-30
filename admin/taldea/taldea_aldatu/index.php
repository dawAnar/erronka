<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once('../../../klaseak/com/leartik/daw24anar/taldea/taldea.php');
require_once('../../../klaseak/com/leartik/daw24anar/taldea/taldea_db.php');
require_once('../../../klaseak/com/leartik/daw24anar/kategoria/kategoria.php');
require_once('../../../klaseak/com/leartik/daw24anar/kategoria/kategoria_db.php');

use com\leartik\daw24anar\taldea\Taldea;
use com\leartik\daw24anar\taldea\TaldeaDB;
use com\leartik\daw24anar\kategoria\KategoriaDB;

if (!isset($_COOKIE['erabiltzailea']) || $_COOKIE['erabiltzailea'] != 'admin') {
    header('Location: ../../index.php');
    exit;
}

$kategoriak = KategoriaDB::selectKategoriak();
$mezua = "";
$taldea = null;


if (isset($_POST['gorde'])) {

    $id = (int)($_POST['id'] ?? 0);
    $talde_izena = trim($_POST['talde_izena'] ?? '');
    $id_kategoria = (int)($_POST['id_kategoria'] ?? 0);
    $prezioa = (float)($_POST['prezioa'] ?? 0);
    $deskontua = (int)($_POST['deskontua'] ?? 0);
    $urteak_lehen_mailan = (int)($_POST['urteak_lehen_mailan'] ?? 0);
    $nobedadea = isset($_POST['nobedadea']) ? 1 : 0;

    $eskaintza = ($deskontua > 0) ? 1 : 0;

    if (strlen($talde_izena) > 0 && $id_kategoria > 0 && is_numeric($prezioa) && $prezioa > 0) {

        $taldea = new Taldea();
        $taldea->setId($id);
        $taldea->setTaldeIzena($talde_izena);
        $taldea->setIdKategoria($id_kategoria);
        $taldea->setPrezioa($prezioa);
        $taldea->setDeskontua($deskontua);
        $taldea->setUrteakLehenMailan($urteak_lehen_mailan);
        $taldea->setNobedadeak($nobedadea);
        $taldea->setEskaintzak($eskaintza);

        if (TaldeaDB::updateTaldea($taldea) > 0) {
            include('taldea_gorde_da.php');
            exit;
        } else {
            include('taldea_ez_da_gorde.php');
            exit;
        }

    } else {
        $mezua = "Eremu guztiak bete behar dira (Prezioa eta kategoria ezin dira hutsik egon)";
        $taldea = TaldeaDB::selectTaldea($id);

        if ($taldea) {
            $id = $taldea->getId();
            $talde_izena = $taldea->getTaldeIzena();
            $prezioa = $taldea->getPrezioa();
            $deskontua = $taldea->getDeskontua();
            $urteak_lehen_mailan = $taldea->getUrteakLehenMailan();
            $id_kategoria = $taldea->getIdKategoria();
            $nobedadea = $taldea->getNobedadeak();
        }
        include('taldea_aldatu.php');
        exit;
    }

} elseif (isset($_GET['id'])) {

    $id = (int)$_GET['id'];
    if ($id <= 0) {
        header('Location: ../index.php?error=ID baliogabea');
        exit;
    }

    $taldea = TaldeaDB::selectTaldea($id);

    if ($taldea) {
        $id = $taldea->getId();
        $talde_izena = $taldea->getTaldeIzena();
        $prezioa = $taldea->getPrezioa();
        $deskontua = $taldea->getDeskontua();
        $urteak_lehen_mailan = $taldea->getUrteakLehenMailan();
        $id_kategoria = $taldea->getIdKategoria();
        $nobedadea = $taldea->getNobedadeak();
        $eskaintza = ($deskontua > 0) ? 1 : 0;

        include('taldea_aldatu.php');
        exit;
    } else {
        include('taldea_ez_da_gorde.php');
        exit;
    }

} else {
    include('../../index.php');
    exit;
}
?>
