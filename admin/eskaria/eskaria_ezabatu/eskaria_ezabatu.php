<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Eskaria Ezabatu</title>
</head>
<body>

    <h1>Eskariak - Administrazio gunea</h1>
    <p><a href="../../index.php">Hasiera</a> &gt; Eskaria ezabatu</p>

    <?php if (!empty($eskaria)): ?>
        <?php $b = $eskaria->getBezeroa(); ?>

        <table cellspacing="5" cellpadding="5" border="1">
            <tr>
                <td>Bezeroa:</td>
                <td>
                    <?php
                        $iz = $b && method_exists($b,'getIzena') ? $b->getIzena() : '';
                        $ab = $b && method_exists($b,'getAbizena') ? $b->getAbizena() : '';
                        echo htmlspecialchars(trim($iz . ' ' . $ab));
                    ?>
                </td>
            </tr>
            <tr><td>Eskaria ID:</td><td><?php echo (int)$eskaria->getId(); ?></td></tr>
            <tr><td>Data:</td><td><?php echo htmlspecialchars($eskaria->getData() ?? ''); ?></td></tr>
        </table>

        <form action="index.php" method="post">
            <input type="hidden" name="id" value="<?php echo (int)$eskaria->getId(); ?>">
            <p>Ziur zaude eskaria ezabatu nahi duzula?</p>
            <p><input type="submit" name="ezabatu" value="Ezabatu"></p>
        </form>

    <?php else: ?>

        <p style="color:red;">Errorea: eskaria ezin da kargatu.</p>

    <?php endif; ?>

</body>
</html>
