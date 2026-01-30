<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Mezua Aldatu</title>
</head>
<body>

    <h1>Mezuak - Administrazio gunea</h1>
    <p><a href="../../index.php">Hasiera</a> &gt; Mezua aldatu</p>

    <h2>Mezua aldatu</h2>

    <?php if (!empty($mezua)): ?>

        <table cellspacing="5" cellpadding="5" border="1">
            <tr>
                <td align="right">Izena:</td>
                <td><?php echo htmlspecialchars($mezua->getIzena()); ?></td>
            </tr>

            <tr>
                <td align="right">Emaila:</td>
                <td><?php echo htmlspecialchars($mezua->getEmail()); ?></td>
            </tr>

            <tr>
                <td align="right">Mezua:</td>
                <td><?php echo nl2br(htmlspecialchars($mezua->getMezua())); ?></td>
            </tr>

            <tr>
                <td align="right">Bidaltze data:</td>
                <td><?php echo $mezua->getSortzeData(); ?></td>
            </tr>
        </table>

        <br>

        <form action="index.php" method="post">

            <input type="hidden" name="id" value="<?php echo $mezua->getId(); ?>">

            <p>
                <label>
                    <input type="checkbox" name="erantzunda"
                           <?php echo ($mezua->getErantzunda() == 1) ? "checked" : ""; ?>>
                    Mezua erantzunda dago
                </label>
            </p>

            <p>
                <input type="submit" name="aldatu" value="Aldatu">
            </p>
        </form>

    <?php else: ?>

        <p style="color:red;">Errorea: mezua ezin da kargatu.</p>

    <?php endif; ?>

</body>
</html>
