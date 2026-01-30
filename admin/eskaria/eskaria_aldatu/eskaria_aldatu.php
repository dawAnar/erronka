<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Eskaria Aldatu</title>
</head>
<body>

    <h1>Eskariak - Administrazio gunea</h1>
    <p><a href="../../index.php">Hasiera</a> &gt; Eskaria aldatu</p>

    <?php if (!empty($eskaria) && is_object($eskaria)): ?>

        <?php $b = $eskaria->getBezeroa(); ?>

        <h2>Bezeroaren datuak</h2>
        <table cellspacing="5" cellpadding="5" border="1">
            <tr><td>Izena:</td><td><?php echo htmlspecialchars($b ? $b->getIzena() : ''); ?></td></tr>
            <tr><td>Abizena:</td><td><?php echo htmlspecialchars($b ? $b->getAbizena() : ''); ?></td></tr>
            <tr><td>Helbidea:</td><td><?php echo htmlspecialchars($b ? $b->getHelbidea() : ''); ?></td></tr>
            <tr><td>Herria:</td><td><?php echo htmlspecialchars($b ? $b->getHerria() : ''); ?></td></tr>
            <tr><td>Posta kodea:</td><td><?php echo htmlspecialchars($b ? $b->getPostaKodea() : ''); ?></td></tr>
            <tr><td>Probintzia:</td><td><?php echo htmlspecialchars($b ? $b->getProbintzia() : ''); ?></td></tr>
            <tr><td>Emaila:</td><td><?php echo htmlspecialchars($b ? $b->getEmaila() : ''); ?></td></tr>
        </table>

        <h2>Eskatutako taldeak</h2>
        <table cellspacing="5" cellpadding="5" border="1">
            <tr>
                <th>Taldea</th>
                <th>Prezioa</th>
                <th>Kopurua</th>
                <th>Guztira</th>
            </tr>

            <?php
                $total = 0;
                $detalleak = $eskaria->getDetalleak();
                if (!is_array($detalleak)) $detalleak = [];
            ?>

            <?php foreach ($detalleak as $d): ?>
                <?php
                    $t = $d->getTaldea();
                    $izena = $t ? $t->getTaldeIzena() : '-';
                    $prezioa = $t ? $t->getPrezioa() : 0;
                    $kop = $d->getKopurua();
                    $guztira = $d->getGuztira();
                    $total += $guztira;
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($izena); ?></td>
                    <td><?php echo htmlspecialchars($prezioa); ?></td>
                    <td><?php echo (int)$kop; ?></td>
                    <td><?php echo htmlspecialchars($guztira); ?></td>
                </tr>
            <?php endforeach; ?>

            <tr>
                <td colspan="3"><strong>TOTAL</strong></td>
                <td><strong><?php echo htmlspecialchars($total); ?></strong></td>
            </tr>
        </table>

        <br>

        <form action="index.php" method="post">
            <input type="hidden" name="id" value="<?php echo (int)$eskaria->getId(); ?>">

            <p>
                <label>
                    <input type="checkbox" name="bidalita" value="1" <?php echo ($eskaria->getBidalita() == 1) ? 'checked' : ''; ?>>
                    Bidalita
                </label>
            </p>

            <p>
                <input type="submit" name="aldatu" value="Aldatu">
            </p>
        </form>

    <?php else: ?>

        <p style="color:red;">Errorea: eskaria ezin da kargatu.</p>

    <?php endif; ?>

</body>
</html>
