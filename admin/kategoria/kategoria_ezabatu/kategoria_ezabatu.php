<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Kategoriak</title>
</head>
<body>
    <h1>Kategoriak administrazio gunea</h1>
    <p><a href="../../index.php">Hasiera</a> &gt; Kategoria ezabatu</p> 
    <h2>Kategoria ezabatu</h2>

    <p style="color: red;">
        Ziur zaude hurrengo kategoria ezabatu nahi duzula?
        <strong>Ekintza hau ezin da desegin.</strong>
    </p>

    <form action="index.php" method="post">
        <input type="hidden" name="id" value="<?php echo $kategoria->getId() ?>">
        <input type="hidden" name="ezabatu_confirmado" value="true">

        <p>
            <input type="submit" name="ezabatu" value="Bai, ezabatu"> 
        </p>
    </form>

    <h3>Ezabatuko den kategoria:</h3>
    <ul>
        <li>Izenburua: <?php echo $kategoria->getIzenburua() ?></li>
        <li>Deskribapena: <?php echo $kategoria->getDeskribapena() ?></li>
    </ul>

</body>
</html>