<?php
require('../klaseak/com/leartik/daw24anar/saskia/saskia.php');
require('../klaseak/com/leartik/daw24anar/eskaria/eskaria.php');
require('../klaseak/com/leartik/daw24anar/eskaria/eskaria_db.php');

use com\leartik\daw24anar\saskia\Saskia;
use com\leartik\daw24anar\eskaria\Eskaria;
use com\leartik\daw24anar\eskaria\EskariaDB;
use com\leartik\daw24anar\bezeroa\Bezeroa;

session_start();

$mezua = "";
$eskariaId = null;

$saskia = $_SESSION['saskia'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm'])) {

    if (!($saskia instanceof Saskia) || count($saskia->getDetaileak()) === 0) {
        $mezua = "Saskia hutsik dago.";
        include('eskaria_ez_da_gorde.php');
        exit;
    }

    $izena      = trim($_POST['izena'] ?? '');
    $abizena    = trim($_POST['abizena'] ?? '');
    $helbidea   = trim($_POST['helbidea'] ?? '');
    $herria     = trim($_POST['herria'] ?? '');
    $postaKodea = (int)($_POST['postaKodea'] ?? 0);
    $probintzia = trim($_POST['probintzia'] ?? '');
    $emaila     = trim($_POST['emaila'] ?? '');

    if ($izena === '' || $abizena === '' || $helbidea === '' || $herria === '' || $postaKodea <= 0 || $probintzia === '' || $emaila === '') {
        $mezua = "Eremu guztiak bete behar dira";
        include('eskaria_ez_da_gorde.php');
        exit;
    }

    if (!filter_var($emaila, FILTER_VALIDATE_EMAIL)) {
        $mezua = "Email baliogabea da";
        include('eskaria_ez_da_gorde.php');
        exit;
    }

    // Crear Eskaria + Bezeroa (embebido) + detalleak desde saskia
    $b = new Bezeroa();
    if (method_exists($b, 'setIzena')) $b->setIzena($izena);
    if (method_exists($b, 'setAbizena')) $b->setAbizena($abizena);
    if (method_exists($b, 'setHelbidea')) $b->setHelbidea($helbidea);
    if (method_exists($b, 'setHerria')) $b->setHerria($herria);
    if (method_exists($b, 'setPostaKodea')) $b->setPostaKodea($postaKodea);
    if (method_exists($b, 'setProbintzia')) $b->setProbintzia($probintzia);
    if (method_exists($b, 'setEmaila')) $b->setEmaila($emaila);
    if (method_exists($b, 'setEmail')) $b->setEmail($emaila);

    $e = new Eskaria();
    $e->setBezeroa($b);
    $e->setBidalita(0);

    // Copiar detalleak del carrito
    $e->setDetalleak($saskia->getDetaileak());

    $eskariaId = EskariaDB::insertEskaria($e);

    if ($eskariaId > 0) {
        unset($_SESSION['saskia']);
        include('eskaria_gorde_da.php');
    } else {
        $mezua = $mezua !== "" ? $mezua : "Eskaria ez da gorde";
        include('eskaria_ez_da_gorde.php');
    }

    exit;
}

// Si se accede por GET pero la cesta está vacía, redirigir a la página de la saskia
if (!($saskia instanceof Saskia) || count($saskia->getDetaileak()) === 0) {
    header('Location: ../saskia/index.php');
    exit;
}

// GET normal (hay items en la saskia)
include('eskaria_berria.php');
exit;
?>
