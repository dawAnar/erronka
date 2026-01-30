<?php
require('../../../klaseak/com/leartik/daw24anar/kategoria/kategoria.php');
require('../../../klaseak/com/leartik/daw24anar/kategoria/kategoria_db.php');
use com\leartik\daw24anar\kategoria\Kategoria;
use com\leartik\daw24anar\kategoria\KategoriaDB;

if (isset($_COOKIE['erabiltzailea']) && $_COOKIE['erabiltzailea'] == "admin") {
    $admin = true;
} else {
    $admin = false;
}

if ($admin == true) {
    if (isset($_POST['gorde'])) {
        $izenburua = $_POST['izenburua'];
        $deskribapena = $_POST['deskribapena'];
        if (strlen($izenburua) > 0 && strlen($deskribapena) > 0) {
            $kategoria = new Kategoria();
            $kategoria->setIzenburua($izenburua);
            $kategoria->setDeskribapena($deskribapena);

            if (KategoriaDB::insertKategoria($kategoria) > 0) {
                include('kategoria_gorde_da.php');
            } else {
                include('kategoria_ez_da_gorde.php');
            }

        } else {
            $mezua = "Eremu guztiak bete behar dira";
            include('kategoria_berria.php');
        }

    } else {
        $izenburua = "";
        $deskribapena = "";
        $mezua = "";
        include('kategoria_berria.php');
    }
    
} else {
    header("location: ../index.php");
}
?>