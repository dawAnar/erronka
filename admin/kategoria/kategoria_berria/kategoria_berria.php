<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Kategoriak</title>
</head>
<body>
    <h1>Kategoriak administrazio gunea</h1>
    <p><a href="../../index.php">Hasiera</a> &gt; Kategoria berria</p>
    <h2>Kategoria berria</h2>
    <p><?php echo $mezua ?></p>
    
    <form action="index.php" method="post">
        <p>
            <label for="izenburua">Izenburua</label>
            <input type="text" id="izenburua" name="izenburua" size="50" maxlength="255" value="<?php echo $izenburua ?>">
        </p>
        <p>
            <label for="deskribapena">Deskribapena</label>
            <textarea id="deskribapena" name="deskribapena"><?php echo $deskribapena ?></textarea>
        </p>
        <p>
            <input type="submit" name="gorde" value="Gorde">
        </p>
    </form>
</body>
</html>