<?php
session_start();

require_once('../../../klaseak/com/leartik/daw24anar/kategoria/kategoria.php'); 
require_once('../../../klaseak/com/leartik/daw24anar/kategoria/kategoria_db.php'); 
require_once('../../../klaseak/com/leartik/daw24anar/taldea/taldea.php');
require_once('../../../klaseak/com/leartik/daw24anar/taldea/taldea_db.php');

use com\leartik\daw24anar\kategoria\KategoriaDB;
use com\leartik\daw24anar\taldea\Taldea;
use com\leartik\daw24anar\taldea\TaldeaDB;

if (!isset($_COOKIE['erabiltzailea']) || $_COOKIE['erabiltzailea'] != 'admin') {
    header('Location: ../../index.php');
    exit;
}

$mezua = "";
$form_data = [
    'talde_izena' => '',
    'id_kategoria' => 0,
    'prezioa' => 0.0,
    'deskontua' => 0,
    'urteak_lehen_mailan' => 0,
    'nobedadea' => 0
];

$kategoriak_datuak = KategoriaDB::selectKategoriak();

if (isset($_POST['gorde'])) {
    $talde_izena = trim($_POST['talde_izena'] ?? '');
    $id_kategoria = (int)($_POST['kategoria'] ?? 0);
    $prezioa = (float)($_POST['prezioa'] ?? 0);
    $deskontua = (int)($_POST['deskontua'] ?? 0);
    $urteak_lehen_mailan = (int)($_POST['urteak_lehen_mailan'] ?? 0);
    $nobedadea = isset($_POST['nobedadea']) ? 1 : 0;

    $eskaintza = ($deskontua > 0) ? 1 : 0;

    $form_data = [
        'talde_izena' => $talde_izena,
        'id_kategoria' => $id_kategoria,
        'prezioa' => $prezioa,
        'deskontua' => $deskontua,
        'urteak_lehen_mailan' => $urteak_lehen_mailan,
        'nobedadea' => $nobedadea
    ];

    if (strlen($talde_izena) > 0 && $id_kategoria > 0 && is_numeric($prezioa) && $prezioa > 0) {

        $taldea = new Taldea();
        $taldea->setTaldeIzena($talde_izena);
        $taldea->setIdKategoria($id_kategoria);
        $taldea->setPrezioa($prezioa);
        $taldea->setDeskontua($deskontua);
        $taldea->setUrteakLehenMailan($urteak_lehen_mailan);
        $taldea->setNobedadeak($nobedadea);
        $taldea->setEskaintzak($eskaintza);

        if (TaldeaDB::insertTaldea($taldea) > 0) {
            $_SESSION['taldea_gorde_da'] = [
                'talde_izena' => $taldea->getTaldeIzena(),
                'id_kategoria' => $taldea->getIdKategoria(),
                'prezioa' => $taldea->getPrezioa(),
                'deskontua' => $taldea->getDeskontua(),
                'urteak_lehen_mailan' => $taldea->getUrteakLehenMailan(),
                'nobedadea' => $taldea->getNobedadeak(),
                'eskaintza' => $taldea->getEskaintzak()
            ];

            session_write_close();

            header('Location: taldea_gorde_da.php');
            exit;
        } else {
            include('taldea_ez_da_gorde.php');
            exit;
        }
    } else {
        $mezua = "Eremu guztiak bete behar dira (Prezioa eta kategoria ezin dira hutsik egon)";
        include('talde_berria.php');
        exit;
    }
} else {
    include('talde_berria.php');
}
?>
