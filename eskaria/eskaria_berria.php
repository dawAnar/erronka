<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Eskaria</title>
    <script type="text/javascript" src="api.js"></script>
    <link rel="stylesheet" href="../hasiera/estiloa.css">
    <link rel="stylesheet" href="estiloa.css">
</head>
<body>

<h1>Eskaria</h1>
<p><a href="../hasiera/index.php">Hasiera</a> &gt; <a href="../saskia/index.php">Saskia</a> &gt;</p>

<h2>Bezeroaren datuak</h2>

<?php if (isset($mezua) && $mezua != ""): ?>
    <p style="color:red; font-weight:bold;"><?php echo $mezua; ?></p>
<?php endif; ?>

<div id="eskaria" style="background-color:#ccc; padding:10px;">
    <form>
        <p>
            <label for="izena">Izena</label>
            <input type="text" id="izena" name="izena" size="40" maxlength="50">
        </p>

        <p>
            <label for="abizena">Abizena</label>
            <input type="text" id="abizena" name="abizena" size="40" maxlength="50">
        </p>

        <p>
            <label for="helbidea">Helbidea</label>
            <input type="text" id="helbidea" name="helbidea" size="60" maxlength="100">
        </p>

        <p>
            <label for="herria">Herria</label>
            <input type="text" id="herria" name="herria" size="40" maxlength="60">
        </p>

        <p>
            <label for="postaKodea">Posta kodea</label>
            <input type="text" id="postaKodea" name="postaKodea" size="10" maxlength="10">
        </p>

        <p>
            <label for="probintzia">Probintzia</label>
            <input type="text" id="probintzia" name="probintzia" size="30" maxlength="60">
        </p>

        <p>
            <label for="emaila">Emaila</label>
            <input type="text" id="emaila" name="emaila" size="50" maxlength="100">
        </p>

        <p>
            <input type="button" value="Bidali eskaria" onClick="eskariaBidali()">
            <input type="button" value="Utzi" onClick="location.href='../saskia/index.php'">
        </p>
    </form>
</div>

</body>
</html>
