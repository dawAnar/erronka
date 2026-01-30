<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Mezua Ezabatu</title>
</head>
<body>
    <h1>Mezuak - Administrazio gunea</h1>
    <p><a href="../../index.php">Hasiera</a> &gt; Mezua ezabatu</p> 

    <h2>Mezua ezabatu</h2>

    <p style="color: red;">
        Ziur zaude mezua ezabatu nahi duzula?
        <strong>Ekintza hau ezin da desegin.</strong>
    </p>

    <form action="index.php" method="post">
        <input type="hidden" name="id" value="<?php echo $mezua->getId() ?>">
        <p>
            <input type="submit" name="ezabatu" value="Bai, ezabatu">
        </p>
    </form>

    <h3>Ezabatuko den mezua:</h3>
    <ul>
        <li>Izena: <?php echo htmlspecialchars($mezua->getIzena()) ?></li>
        <li>Emaila: <?php echo htmlspecialchars($mezua->getEmail()) ?></li>
        <li>Mezua: <?php echo nl2br(htmlspecialchars($mezua->getMezua())) ?></li>
    </ul>

</body>
</html>
