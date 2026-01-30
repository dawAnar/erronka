<?php
if (!isset($_COOKIE['erabiltzailea']) || $_COOKIE['erabiltzailea'] != 'admin') {
    header("Location: ../../index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="eu">
<head>
    <meta charset="UTF-8">
    <title>Mezua Ezabatuta</title>
</head>
<body>
    <h1>Administrazio gunea</h1>
    <p><a href="../../index.php">Hasiera</a> &gt;</p>
    <h2>Mezua ezabatu</h2>

    <p>Mezua ondo ezabatu da.</p>

    <?php $ezabatu_id = $_POST['id'] ?? null; ?>

    <p><a href="../../index.php">Administrazio hasiera</a></p>
</body>
</html>
