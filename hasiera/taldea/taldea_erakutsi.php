<?php
// NOTA: Si este archivo está en 'hasiera/taldea/taldea_erakutsi.php',
// necesita subir dos niveles (../../) para acceder a 'klaseak'.
require_once '../../klaseak/com/leartik/daw24anar/taldea/taldea_db.php';
require_once '../../klaseak/com/leartik/daw24anar/kategoria/kategoria_db.php';
require_once '../../klaseak/com/leartik/daw24anar/kategoria/kategoria.php';
require_once '../../klaseak/com/leartik/daw24anar/taldea/taldea.php'; // Incluir la clase Taldea

use com\leartik\daw24anar\taldea\TaldeaDB;
use com\leartik\daw24anar\kategoria\KategoriaDB;

// ID parametroa lortu (taldearen IDa)
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id <= 0) {
    // Usamos el mensaje de error para la validación del ID en el URL
    die("ERROREA 1: Taldearen IDa falta da edo baliogabea da URLan."); 
}

// Taldea lortu
$taldea = TaldeaDB::selectTaldea($id);

if (!$taldea) {
    // Mensaje de error si el ID existe en el URL, pero no en la base de datos
    die("ERROREA 2: Taldea ez da aurkitu datu-basean (IDa: {$id}).");
}

// Kategoria lortu (usando el ID guardado en el objeto Taldea)
$kategoria = KategoriaDB::selectKategoria($taldea->getIdKategoria());

// --- Lógica de Precios (Cálculo del Descuento) ---
$prezioa = $taldea->getPrezioa();
$deskontua = $taldea->getDeskontua(); 
// Cálculo robusto del porcentaje de descuento
$deskontuEhunekoa = ($deskontua > 1) ? $deskontua / 100 : $deskontua; 
$prezioaDeskontuarekin = $prezioa * (1 - $deskontuEhunekoa);
$aurreztutakoDirua = $prezioa - $prezioaDeskontuarekin;
?>

<!DOCTYPE html>
<html lang="eu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($taldea->getTaldeIzena()); ?> - Taldeen Denda</title>
    <link rel="stylesheet" href="taldea_estiloa.css"> 
</head>

<body>
    <!-- HEADER similar to kategoria_erakutsi.php -->
    <header class="header">
        <div class="header-section logo">
            <img src="../img/logoa.png" alt="Dendaren logotipoa">
        </div>

        <h1 class="header-section title"><?php echo htmlspecialchars($taldea->getTaldeIzena()); ?></h1>

        <nav class="header-section nav">
            <a href="../kategoria/kategoriak_erakutsi.php">Kategoriak</a>
            <a href="../taldea/taldeak_erakutsi.php">Taldeak</a>
            <a href="#">Saskia</a>
            <a href="../../admin/index.php">Admin Gunea</a>
        </nav>
    </header>

    <!-- MAIN CONTENT -->
    <main class="main-content">
        <section class="featured">
            <div class="category-card single">
                <h2><?php echo htmlspecialchars($taldea->getTaldeIzena()); ?></h2>
                <?php if ($kategoria): ?>
                    <p>📂 <?php echo htmlspecialchars($kategoria->getIzenburua()); ?></p>
                <?php endif; ?>

                <div class="product-detail">
                    <div class="product-image-large">🏆</div>
                    <div class="product-info">
                        <div class="product-specs">
                            <h3>📋 Xehetasunak</h3>
                            <div class="spec-item">
                                <span class="spec-label">🏆 Lehen Mailan Urteak:</span>
                                <span class="spec-value"><?php echo $taldea->getUrteakLehenMailan(); ?></span>
                            </div>

                            <?php if ($deskontuEhunekoa > 0): ?>
                                <div class="spec-item">
                                    <span class="spec-label">💰 Deskontua:</span>
                                    <span class="spec-value"><?php echo round($deskontuEhunekoa * 100); ?>%</span>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="price-section">
                            <?php if ($deskontuEhunekoa > 0): ?>
                                <span class="price-current"><?php echo number_format($prezioaDeskontuarekin, 2, ',', '.'); ?>€</span>
                                <span class="price-original"><?php echo number_format($prezioa, 2, ',', '.'); ?>€</span>
                                <div class="discount-info">
                                    <div class="savings">Aurreztu: <?php echo number_format($aurreztutakoDirua, 2, ',', '.'); ?>€</div>
                                </div>
                            <?php else: ?>
                                <span class="price-current"><?php echo number_format($prezioa, 2, ',', '.'); ?>€</span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="meta">
                    <span>ID: <?php echo $taldea->getId(); ?></span>
                    <span>Kategoria ID: <?php echo $taldea->getIdKategoria(); ?></span>
                </div>

                <div class="text-left">
                    <a href="../taldea/taldeak_erakutsi.php" class="back-button">🔙 Talde guztiak</a>
                    <?php if ($kategoria): ?>
                        <a href="../kategoria/kategoria_erakutsi.php?id=<?php echo $kategoria->getId(); ?>" class="category-button">📂 <?php echo htmlspecialchars($kategoria->getIzenburua()); ?></a>
                    <?php endif; ?>
                </div>
            </div>
        </section>
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