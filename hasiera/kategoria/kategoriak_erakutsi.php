<?php
require_once '../../klaseak/com/leartik/daw24anar/kategoria/kategoria.php';
require_once '../../klaseak/com/leartik/daw24anar/kategoria/kategoria_db.php';
require_once '../../klaseak/com/leartik/daw24anar/taldea/taldea.php';
require_once '../../klaseak/com/leartik/daw24anar/taldea/taldea_db.php';

use com\leartik\daw24anar\kategoria\KategoriaDB;
use com\leartik\daw24anar\taldea\TaldeaDB;

$kategoriak = [];
try {
    $kategoriak = KategoriaDB::selectKategoriak();
} catch (Exception $e) {
    error_log("Errorea kategoriak lortzean: " . $e->getMessage());
}

$kategoriak = array_slice($kategoriak, 0, 3);
?>

<!DOCTYPE html>
<html lang="eu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategoriak - Futbol Denda</title>
    <link rel="stylesheet" href="kategoriak_estiloa.css">
</head>
<body>
    <header class="header">
        <div class="header-section logo">
            <img src="../img/logoa.png" alt="Dendaren logotipoa">
        </div>

        <h1 class="header-section title">KATEGORIAK</h1>

        <nav class="header-section nav">
            <a href="kategoriak_erakutsi.php">Kategoriak</a>
            <a href="../taldea/taldeak_erakutsi.php">Taldeak</a>
            <a href="#">Saskia</a>
            <a href="../../admin/index.php">Admin Gunea</a>
        </nav>
    </header>

    <main class="main-content">
        <?php if (!empty($kategoriak)): ?>
            <section class="featured">
                <?php foreach ($kategoriak as $kategoria): ?>
                    <div class="featured-item">
                        <div class="category-card">
                            <h2>ID: <?php echo $kategoria->getId(); ?></h2>
                            <p><?php echo htmlspecialchars($kategoria->getIzenburua()); ?></p>
                            <a href="kategoria_erakutsi.php?id=<?php echo $kategoria->getId(); ?>" class="view-category-btn">
                                Kategoria ikusi
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </section>
        <?php else: ?>
            <p>Ez dago kategoriarik momentuz.</p>
        <?php endif; ?>
    </main>

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
