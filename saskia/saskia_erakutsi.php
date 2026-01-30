<!doctype html>
<html lang="eu">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mi Tienda - Saskia</title>

    <link rel="stylesheet" href="../hasiera/estiloa.css">
    <link rel="stylesheet" href="estiloa.css">
</head>
<body>

<header class="header">
    <div class="header-section logo">
        <img src="../img/logoa.png" alt="logoa">
    </div>
    <div class="header-section title">FUTBOL TOTAL</div>
    <nav class="header-section nav">
        <a href="../hasiera">Hasiera</a>
        <a href="../katalogoa">Katalogoa</a>
        <a href="../kontaktua">Kontaktua</a>
    </nav>
</header>

<main>
    <h2>Saskia</h2>
    <hr>

<?php
use com\leartik\daw24anar\saskia\Saskia;

if (isset($saskia) && $saskia instanceof Saskia && count($saskia->getDetaileak()) > 0) {
?>

    <table>
        <thead>
        <tr>
            <th>Produktua</th>
            <th>Prezioa</th>
            <th>Kopurua</th>
            <th>Guztira</th>
            <th>Ekintzak</th>
        </tr>
        </thead>
        <tbody>

        <?php foreach ($saskia->getDetaileak() as $i => $detailea) { ?>
            <tr valign="top">
                <td>
                    <?php
                    // ✅ ARREGLO: getTalde() -> getTaldea()
                    $taldea = $detailea->getTaldea();

                    $izena = 'Produktua';
                    if ($taldea) {
                        if (method_exists($taldea, 'getTaldeIzena')) {
                            $izena = $taldea->getTaldeIzena();
                        } elseif (method_exists($taldea, 'getIzenburua')) {
                            $izena = $taldea->getIzenburua();
                        }
                    }

                    echo htmlspecialchars($izena);
                    ?>
                </td>

                <td>
                    <?php
                    $prezioa = 0;
                    if ($taldea && method_exists($taldea, 'getPrezioa')) {
                        $prezioa = (float)$taldea->getPrezioa();
                    }
                    echo number_format($prezioa, 2, ',', '.') . " €";
                    ?>
                </td>

                <td>
                    <form action="index.php" method="get" style="display:inline-block;">
                        <input type="hidden" name="eguneratu" value="1">
                        <input type="hidden" name="index" value="<?php echo $i; ?>">
                        <input type="number" name="kopurua"
                               value="<?php echo (int)$detailea->getKopurua(); ?>"
                               min="0" style="width:70px;">
                        <button type="submit">Eguneratu</button>
                    </form>
                </td>

                <td><?php echo number_format((float)$detailea->getGuztira(), 2, ',', '.'); ?> €</td>

                <td>
                    <form action="index.php" method="get" style="display:inline-block;">
                        <input type="hidden" name="ezabatu" value="1">
                        <input type="hidden" name="index" value="<?php echo $i; ?>">
                        <button type="submit"
                                onclick="return confirm('Ziur zaude produktua ezabatu nahi duzula?');">
                            Ezabatu
                        </button>
                    </form>
                </td>
            </tr>
        <?php } ?>

        </tbody>
    </table>

    <div style="margin-top:15px;">
        <form action="../eskaria/index.php" method="get">
            <input type="hidden" name="guztia" value="1">
            <button type="submit">Eskaria gehitu (Amaitu erosketa)</button>
        </form>
    </div>

<?php } else { ?>

    <p>Saskia hutsik dago</p>

<?php } ?>

</main>

<footer class="footer">
    <div class="socials">
        <a href="#" target="_blank">Instagram</a>
        <a href="#" target="_blank">WhatsApp</a>
        <a href="#">Email</a>
    </div>
    <p>© 2025 Futbol Total - Kontaktua: +34 600 000 000</p>
</footer>

</body>
</html>
