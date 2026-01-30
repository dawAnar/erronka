<?php
require('../../../klaseak/com/leartik/daw24anar/kategoria/kategoria.php');
require('../../../klaseak/com/leartik/daw24anar/kategoria/kategoria_db.php');

use com\leartik\daw24anar\kategoria\Kategoria;
use com\leartik\daw24anar\kategoria\KategoriaDB;

// 🔐 Comprobación de administrador
if (isset($_COOKIE['erabiltzailea']) && $_COOKIE['erabiltzailea'] === "admin") {
    $admin = true;
} else {
    $admin = false;
}

if ($admin) {

    if (isset($_POST['ezabatu'])) { 
        $id = (int)($_POST['id'] ?? 0);

        if ($id > 0 && KategoriaDB::deleteKategoria($id) > 0) { 
            header("Location: ../../kategoria/kategoria_ezabatu/kategoria_ezabatu_da.php");
            exit();

        } else { 
            header("Location: ../../kategoria/kategoria_ezabatu/kategoria_ez_da_ezabatu.php");
            exit();
        }

    // 🔍 Si se recibe un ID por GET → mostrar la confirmación
    } elseif (isset($_GET['id'])) {
        $id = (int)$_GET['id'];
        $kategoria = KategoriaDB::selectKategoria($id); 
        
        if ($kategoria !== null) { 
            include('kategoria_ezabatu.php'); 
        } else {
            header("Location: ../index.php"); 
            exit();
        }

    } else {
        header("Location: ../index.php");
        exit();
    }

} else {
    header("Location: ../../index.php");
    exit();
}
?>
