<?php

require('../klaseak/com/leartik/daw24anar/taldea/taldea.php');
require('../klaseak/com/leartik/daw24anar/taldea/taldea_db.php');
require('../klaseak/com/leartik/daw24anar/detallea/detallea.php');
require('../klaseak/com/leartik/daw24anar/saskia/saskia.php');
require('../klaseak/com/leartik/daw24anar/bezeroa/bezeroa.php');

use com\leartik\daw24anar\taldea\TaldeaDB;
use com\leartik\daw24anar\detallea\Detallea;
use com\leartik\daw24anar\saskia\Saskia;

session_start();

if (!isset($_SESSION['saskia']) || !($_SESSION['saskia'] instanceof Saskia)) {
    $saskia = new Saskia();
    $_SESSION['saskia'] = $saskia;
} else {
    $saskia = $_SESSION['saskia'];
}

if (isset($_REQUEST['gehitu'])) {
    // Accept both POST and GET so the add-to-cart button can redirect with query params
    $id = isset($_REQUEST['id']) ? (int)$_REQUEST['id'] : 0;
    $kopurua = isset($_REQUEST['kopurua']) ? max(1, (int)$_REQUEST['kopurua']) : 1;
    // usamos TaldeaDB para obtener el producto por id
    $taldea = TaldeaDB::selectTaldea($id);
    $detailea = new Detallea();
    // Detallea está pensado para 'Diskoa', pero funciona con cualquier objeto que tenga getPrezioa()
    $detailea->setTaldea($taldea);
    $detailea->setKopurua($kopurua);
    $saskia->detaileaGehitu($detailea);
    $_SESSION['saskia'] = $saskia;
    header('Location: index.php');
    exit();
}

if (isset($_REQUEST['eguneratu'])) {
    $index = isset($_REQUEST['index']) ? (int)$_REQUEST['index'] : null;
    // Accept zero or negative values here: if <=0 we remove the detail
    $kopurua = isset($_REQUEST['kopurua']) ? (int)$_REQUEST['kopurua'] : 1;

    if ($index !== null) {
        if ($kopurua <= 0) {
            // eliminar el detalle si el usuario introduce 0 o menos
            $saskia->detaileaEzabatu($index);
        } else {
            $saskia->detaileaAldatu($index, $kopurua);
        }
        $_SESSION['saskia'] = $saskia;
    }

    header('Location: index.php');
    exit();
}

if (isset($_REQUEST['ezabatu'])) {
    $index = isset($_REQUEST['index']) ? (int)$_REQUEST['index'] : null;

    if ($index !== null) {
        $saskia->detaileaEzabatu($index);
        $_SESSION['saskia'] = $saskia;
    }

    header('Location: index.php');
    exit();
}

include('saskia_erakutsi.php');
