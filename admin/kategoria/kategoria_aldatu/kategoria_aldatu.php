<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Kategoriak</title>
</head>
<body>
    <h1>Kategoriak administrazio gunea</h1>
    <p><a href="../../index.php">Hasiera</a> &gt;</p>
    <h2>Kategoria aldatu</h2>
    <p><?php echo $mezua ?></p>
    <form action="index.php" method="post">

        <input type="hidden" name="id" value="<?php echo $kategoria->getId() ?>">

        <p>
            <label for="izenburua">Izenburua</label>
            <input type="text" id="izenburua" name="izenburua" size="50" maxlength="255" value="<?php echo $kategoria->getIzenburua() ?>">
        </p>
        <p>
            <label for="deskribapena">Deskribapena</label>
            <textarea id="deskribapena" name="deskribapena"><?php echo $kategoria->getDeskribapena() ?></textarea>
        </p>
        <p>
            <input type="submit" name="aldatu" value="Aldatu">
        </p>
    </form>
</body>
</html>