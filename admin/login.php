<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Denda</title>
</head>
<body>
    <h1>Administrazio gunea</h1>
    <p><?php echo $mezua ?></p>
    <form action="" method="post">
        <p>
            <label for="erabiltzailea">erabiltzailea</label>
            <input type="text" id="erabiltzailea" name="erabiltzailea">
        </p>
        <p>
            <label for="pasahitza">pasahitza</label>
            <input type="password" id="pasahitza" name="pasahitza">
        </p>
        <p>
            <input type="submit" name="sartu" value="Sartu">
        </p>
    </form>
</body>
</html>
