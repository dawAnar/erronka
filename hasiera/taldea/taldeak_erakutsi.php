<?php
require_once '../../klaseak/com/leartik/daw24anar/taldea/taldea.php';
require_once '../../klaseak/com/leartik/daw24anar/taldea/taldea_db.php';
require_once '../../klaseak/com/leartik/daw24anar/kategoria/kategoria_db.php';

use com\leartik\daw24anar\taldea\Taldea;
use com\leartik\daw24anar\taldea\TaldeaDB;
use com\leartik\daw24anar\kategoria\KategoriaDB;

$taldeak = [];
try {
    $taldeak = TaldeaDB::selectTaldeak();
} catch (Exception $e) {
    error_log("Errorea taldeak lortzean: " . $e->getMessage());
}

$nobedadeak = $taldeak;

$kategoriak = [];
try {
    $kategoriak = KategoriaDB::selectKategoriak();
} catch (Exception $e) {
    error_log("Errorea kategoriak lortzean: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="eu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taldeak - Taldeen Denda</title>
    <link rel="stylesheet" href="taldeak_estiloa.css">
</head>

<body>
    <!-- HEADER similar a kategoriak_erakutsi.php -->
    <header class="header">
        <div class="header-section logo">
            <img src="../img/logoa.png" alt="Dendaren logotipoa">
        </div>

        <h1 class="header-section title">TALDEAK</h1>

        <nav class="header-section nav">
            <a href="../kategoria/kategoriak_erakutsi.php">Kategoriak</a>
            <a href="taldeak_erakutsi.php">Taldeak</a>
            <a href="#">Saskia</a>
            <a href="../../admin/index.php">Admin Gunea</a>
        </nav>
    </header>

    <!-- CONTENT -->
    <main class="main-content">
        <?php if (!empty($taldeak)): ?>
            <section class="featured">
                <div class="taldeak-grid">
                    <?php foreach ($taldeak as $taldea): ?>
                        <div class="talde-card">
                            <div class="talde-image">⚽</div>
                            <h3><?php echo htmlspecialchars($taldea->getTaldeIzena()); ?></h3>
                            <div class="talde-description">
                                Urteak Lehen Mailan: <?php echo $taldea->getUrteakLehenMailan(); ?><br>
                                Kategoria ID: <?php echo $taldea->getIdKategoria(); ?>
                            </div>
                            <div class="talde-price">
                                <?php if ($taldea->getDeskontua() > 0): ?>
                                    <?php 
                                        $deskontuEhunekoa = $taldea->getDeskontua() / 100; 
                                        $prezioaDeskontuarekin = $taldea->getPrezioa() * (1 - $deskontuEhunekoa);
                                        $deskontuaMostrar = $taldea->getDeskontua(); 
                                    ?>
                                    <span class="deskontu-prezioa"><?php echo number_format($prezioaDeskontuarekin, 2, ',', '.'); ?>€</span>
                                    <span class="price-crossed"><?php echo number_format($taldea->getPrezioa(), 2, ',', '.'); ?>€</span>
                                <?php else: ?>
                                    <?php echo number_format($taldea->getPrezioa(), 2, ',', '.'); ?>€
                                <?php endif; ?>
                            </div>
                            <div class="talde-stock">
                                <?php if ($taldea->getDeskontua() > 0): ?>
                                    <span class="discount-text">(-<?php echo htmlspecialchars($deskontuaMostrar); ?>% Deskontua)</span>
                                <?php else: ?>
                                    <span class="available-text">Eskuragarri</span>
                                <?php endif; ?>
                            </div>
                            <a href="../taldea/taldea_erakutsi.php?id=<?php echo $taldea->getId(); ?>" class="xehetasunak-botoia">Xehetasunak</a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>
        <?php else: ?>
            <p>Ez dago taldeik oraindik.</p>
        <?php endif; ?>
    </main>

    <!-- FOOTER -->
    <footer class="footer">
        <div class="socials">
            <a href="https://www.instagram.com/" target="_blank">Instagram</a>
            <a href="https://wa.me/34600000000" target="_blank">WhatsApp</a>
            <a href="mailto:info@futboltotal.com">Email</a>
        </div>
        <p>© 2025 Futbol Total - Kontaktua: +34 600 000 000</p>
    </footer>
</body>

</html>