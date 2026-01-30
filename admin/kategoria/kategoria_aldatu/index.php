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
    $mezua = "";
    if (isset($_POST['aldatu'])) { 
        $id = $_POST['id'];
        $izenburua = $_POST['izenburua'];
        $deskribapena = $_POST['deskribapena'];
        if (strlen($izenburua) > 0 && strlen($deskribapena) > 0) {
            $kategoria = new Kategoria();
            $kategoria->setId($id);
            $kategoria->setIzenburua($izenburua);
            $kategoria->setDeskribapena($deskribapena);
            if (KategoriaDB::updateKategoria($kategoria) > 0) {
                include('kategoria_gorde_da.php');
            } else {
                include('kategoria_ez_da_gorde.php');
            }
        } else {
            $mezua = "Eremu guztiak bete behar dira";
            $kategoria = KategoriaDB::selectKategoria($id);
            include('kategoria_aldatu.php');
        }
    } elseif (isset($_GET['id'])) {
        $id = $_GET['id'];
        $kategoria = KategoriaDB::selectKategoria($id);
        if ($kategoria != null) {
            include('kategoria_aldatu.php');
        } else {
            include('kategoria_ez_da_gorde.php');
        }
    } else {
        include('kategoria_id_baliogabea.php');
    }
} else {
    
    include('../index.php');
}
?>