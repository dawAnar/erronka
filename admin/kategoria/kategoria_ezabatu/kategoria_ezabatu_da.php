<?php
if (!isset($_COOKIE['erabiltzailea']) || $_COOKIE['erabiltzailea'] != 'admin') {
    include('../../index.php');
    exit;
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Kategoriak</title>
</head>
<body>
    <h1>Administrazio gunea</h1>
    <p><a href="../../index.php">Hasiera</a> &gt;</p>
    <h2>Kategoria ezabatu</h2>
    <p>Kategoria ondo ezabatu da.</p>

    <?php
    $ezabatu_id = $_POST['id'] ?? null;
    ?>

    <p><a href="../../index.php">Administrazio hasiera</a></p>
</body>
</html>