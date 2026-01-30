<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Mezuak</title>
    <script type="text/javascript" src="api.js"></script>
    <link rel="stylesheet" href="../hasiera/estiloa.css">
    <link rel="stylesheet" href="estiloa.css">
</head>
<body>

    <h1>Mezuak</h1>
    <p><a href="../hasiera/index.php">Hasiera</a> &gt;</p>
    <h2>Mezu berria</h2>

    <?php if (isset($mezua) && $mezua != ""): ?>
        <p style="color:red; font-weight:bold;"><?php echo $mezua; ?></p>
    <?php endif; ?>

    <div id="mezua" style="background-color:#ccc">
        <form>
            <p>
                <label for="izena">Izena</label>
                <input type="text" id="izena" name="izena" size="50" maxlength="50">
            </p>

            <p>
                <label for="email">Email</label>
                <input type="text" id="email" name="email" size="50" maxlength="100">
            </p>

            <p>
                <label for="mezua_testua">Mezua</label>
                <textarea id="mezua_testua" name="mezua_testua"></textarea>
            </p>

            <p>
                <input type="button" id="bidali" name="bidali" value="Bidali" onClick="mezuaBidali()">
                <input type="button" id="utzi" name="utzi" value="Utzi" onClick="location.href='../'">
            </p>
        </form>
    </div>

</body>
</html>
