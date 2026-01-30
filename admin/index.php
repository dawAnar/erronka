<?php
require('..//klaseak/com/leartik/daw24anar/taldea/taldea.php');
require('..//klaseak/com/leartik/daw24anar/taldea/taldea_db.php');

require('..//klaseak/com/leartik/daw24anar/kategoria/kategoria.php');
require('..//klaseak/com/leartik/daw24anar/kategoria/kategoria_db.php');

require('..//klaseak/com/leartik/daw24anar/mezua/mezua.php');
require('..//klaseak/com/leartik/daw24anar/mezua/mezua_db.php');

// ✅ ESKARIA (BD)
require('..//klaseak/com/leartik/daw24anar/eskaria/eskaria.php');
require('..//klaseak/com/leartik/daw24anar/eskaria/eskaria_db.php');

use com\leartik\daw24anar\taldea\Taldea;
use com\leartik\daw24anar\taldea\TaldeaDB;

use com\leartik\daw24anar\kategoria\Kategoria;
use com\leartik\daw24anar\kategoria\KategoriaDB;

use com\leartik\daw24anar\mezua\Mezua;
use com\leartik\daw24anar\mezua\MezuaDB;

// ✅ ESKARIA (BD)
use com\leartik\daw24anar\eskaria\Eskaria;
use com\leartik\daw24anar\eskaria\EskariaDB;

$admin = false;

if (isset($_POST['sartu'])) {

    if ($_POST['erabiltzailea'] == "admin" && $_POST['pasahitza'] == "admin") {
        $admin = true;
        setcookie("erabiltzailea", "admin", time() + 86400);
    }

} else if (isset($_COOKIE['erabiltzailea']) && $_COOKIE['erabiltzailea'] == "admin") {
    $admin = true;
}

if ($admin == true) {

    $taldeak = TaldeaDB::selectTaldeak();
    $kategoriak = KategoriaDB::selectKategoriak();
    $mezuak = MezuaDB::selectMezuak();

    // ✅ ESKARIAK BD-tik
    $eskariak = EskariaDB::selectEskariak();

    include('erakutsi.php');

} else {

    if (isset($_POST['sartu'])) {
        $mezua = "Datuak ez dira zuzenak";
    } else {
        $mezua = "";
    }

    include('login.php');
}
?>
