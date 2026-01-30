<?php

session_start();

if (!isset($_SESSION['erabiltzailea']) || $_SESSION['erabiltzailea'] != "admin") {
    header("Location: ../");
    exit();
}

?>

<!DOCTYPE html>
<html lang="eu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Errore ID Baliogabea - Taldea</title>
</head>
<body>
    <div class="container">
        <div class="error-icon"></div>
        <h1>Produktu ID Baliogabea</h1>
        <p>Produktu ID ez da aurkitu edo ez da baliozkoa.</p>
        <p>Mesedez, saiatu berriro edo itzuli administratzeko panelera.</p>
        
        <a href="../" class="btn">🏠 Itzuli panelera</a>
    </div>
</body>
</html>