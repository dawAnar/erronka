<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

use com\leartik\daw24anar\taldea\TaldeaDB;
use com\leartik\daw24anar\kategoria\KategoriaDB;

if (!isset($_COOKIE['erabiltzailea']) || $_COOKIE['erabiltzailea'] != 'admin') {
    header('Location: ../../index.php');
    exit;
}

require_once('../../../klaseak/com/leartik/daw24anar/taldea/taldea_db.php');
require_once('../../../klaseak/com/leartik/daw24anar/taldea/taldea.php');
require_once('../../../klaseak/com/leartik/daw24anar/kategoria/kategoria_db.php');


if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    
    if ($id <= 0) {
        header('Location: ../index.php?error=ID baliogabea');
        exit;
    }

    $taldea = TaldeaDB::selectTaldea($id);
    
    if ($taldea) {
        $kategoria = KategoriaDB::selectKategoria($taldea->getIdKategoria());
        $kategoria_izena = $kategoria ? $kategoria->getIzenburua() : 'Ezezaguna';
    } else {
        header('Location: ../index.php?error=Taldea ez da aurkitu');
        exit;
    }
} else {
    header('Location: ../index.php?error=ID falta da');
    exit;
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Taldeak</title>
</head>
<body>
    <h1>Administrazio gunea</h1>
    <p><a href="../../index.php">Hasiera</a> &gt;</p>
    <h2>Taldea aldatu</h2>
    <p>Taldea gorde da</p>
    <?php if (isset($taldea)): ?>
    <table cellspacing="5" cellpadding="5" border="1">
        <tr>
            <td align="right">Talde Izena:</td>
            <td><?php echo htmlspecialchars($taldea->getTaldeIzena()); ?></td>
        </tr>
        <tr>
            <td align="right">Kategoria:</td>
            <td><?php echo htmlspecialchars($kategoria_izena); ?></td>
        </tr>
        <tr>
            <td align="right">Prezioa:</td>
            <td><?php echo number_format($taldea->getPrezioa(), 2, ',', '.'); ?> €</td>
        </tr>
        <tr>
            <td align="right">Deskontua:</td>
            <td><?php echo htmlspecialchars($taldea->getDeskontua()); ?>%</td>
        </tr>
        <tr>
            <td align="right">Urteak Lehen Mailan:</td>
            <td><?php echo htmlspecialchars($taldea->getUrteakLehenMailan()); ?> urte</td>
        </tr>
    </table>
    <?php endif; ?>
    <p><a href="../../index.php">Administrazio hasiera</a></p>
</body>
</html>