<?php
require('../klaseak/com/leartik/daw24anar/mezua/mezua.php');
require('../klaseak/com/leartik/daw24anar/mezua/mezua_db.php');

use com\leartik\daw24anar\mezua\Mezua;
use com\leartik\daw24anar\mezua\MezuaDB;

$mezua = "";

if (isset($_POST['izena']) && isset($_POST['email']) && isset($_POST['mezua'])) {

    $izena = trim($_POST['izena']);
    $email = trim($_POST['email']);
    $testua = trim($_POST['mezua']);

    if (strlen($izena) == 0 || strlen($testua) == 0) {
        $mezua = "Eremu guztiak bete behar dira";
        include('mezu_berria.php');
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $mezua = "Email baliogabea da";
        include('mezu_berria.php');
        exit;
    }

    $mezuaObj = new Mezua();
    $mezuaObj->setIzena($izena);
    $mezuaObj->setEmail($email);
    $mezuaObj->setMezua($testua);

    if (MezuaDB::insertMezua($mezuaObj) > 0) {
        include('mezua_gorde_da.php');
    } else {
        include('mezua_ez_da_gorde.php');
    }

} else {
    include('mezu_berria.php');
}
?>
