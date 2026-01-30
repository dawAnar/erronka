<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_COOKIE['erabiltzailea']) || $_COOKIE['erabiltzailea'] != 'admin') {
    header('Location: ../../index.php');
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
    <h2>Taldea ezabatu</h2>
    <p>Taldea ondo ezabatu da.</p>

    <?php
    $ezabatu_id = $_POST['id'] ?? null;
    ?>

    <table cellspacing="5" cellpadding="5" border="1">
        <tr>
            <td align="right">Ezabatu den ID-a:</td>
            <td><?php echo htmlspecialchars($ezabatu_id ?? '---'); ?></td>
        </tr>
    </table>

    <p><a href="../../index.php">Administrazio hasiera</a></p>
</body>
</html>