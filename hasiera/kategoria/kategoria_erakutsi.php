<?php
require_once '../../klaseak/com/leartik/daw24anar/kategoria/kategoria_db.php';
require_once '../../klaseak/com/leartik/daw24anar/taldea/taldea.php';
require_once '../../klaseak/com/leartik/daw24anar/taldea/taldea_db.php';

use com\leartik\daw24anar\kategoria\KategoriaDB;
use com\leartik\daw24anar\taldea\TaldeaDB;

$kategoriaId = 0;
if (isset($_GET['id'])) {
    $kategoriaId = (int)$_GET['id'];
} elseif (isset($_GET['kategoria_id'])) {
    $kategoriaId = (int)$_GET['kategoria_id'];
}

if ($kategoriaId <= 0) {
    die("Errorea: Kategoriaren ID baliogabea.");
}

$kategoria = KategoriaDB::selectKategoria($kategoriaId);
if (!$kategoria) {
    die("Errorea: Kategoria ez da aurkitu.");
}

$taldeakAll = TaldeaDB::selectTaldeak();
$taldeak = array();
if (is_array($taldeakAll)) {
    foreach ($taldeakAll as $t) {
        $tid = null;
        if (method_exists($t, 'getIdKategoria')) {
            $tid = $t->getIdKategoria();
        } elseif (method_exists($t, 'getId_kategoria')) {
            $tid = $t->getId_kategoria();
        }

        if ($tid == $kategoriaId) {
            $taldeak[] = $t;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="eu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($kategoria->getIzenburua()); ?> - Taldeen Denda</title>
    <link rel="stylesheet" href="kategoria_estiloa.css">
</head>

<body>
    <header class="header">
        <div class="header-section logo">
            <img src="../img/logoa.png" alt="Dendaren logotipoa">
        </div>

        <h1 class="header-section title"><?php echo htmlspecialchars($kategoria->getIzenburua()); ?></h1>

        <nav class="header-section nav">
            <a href="../kategoria/kategoriak_erakutsi.php">Kategoriak</a>
            <a href="../taldea/taldeak_erakutsi.php">Taldeak</a>
            <a href="#">Saskia</a>
            <a href="../../admin/index.php">Admin Gunea</a>
        </nav>
    </header>

    <main class="main-content">
        <section class="featured">
            <div class="category-card single">
                <h2><?php echo htmlspecialchars($kategoria->getIzenburua()); ?></h2>
                <?php if (method_exists($kategoria, 'getDeskribapena')): ?>
                    <p><?php echo nl2br(htmlspecialchars($kategoria->getDeskribapena())); ?></p>
                <?php endif; ?>
                <div class="meta">
                    <span>ID: <?php echo $kategoria->getId(); ?></span>
                    <span><?php echo count($taldeak); ?> taldea</span>
                </div>
            </div>
        </section>

        <section class="teams-section">
            <?php if (!empty($taldeak)): ?>
                <h3 class="teams-title"><?php echo htmlspecialchars($kategoria->getIzenburua()); ?> - Taldeak</h3>
                <div class="teams-grid">
                    <?php foreach ($taldeak as $taldea): ?>
                        <article class="team-card">
                            <div class="team-card-inner">
                                <div class="team-thumb">🏟️</div>
                                <h4><?php echo htmlspecialchars(method_exists($taldea,'getTaldeIzena') ? $taldea->getTaldeIzena() : 'Taldea'); ?></h4>
                                <p class="team-info">Prezioa: <?php echo number_format((float) (method_exists($taldea,'getPrezioa') ? $taldea->getPrezioa() : 0), 2, ',', '.'); ?>€</p>
                                <a class="view-btn" href="../taldea/taldea_erakutsi.php?id=<?php echo $taldea->getId(); ?>">Xehetasunak</a>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="empty-state">
                    <p>Ez dago taldeik kategoria honetan.</p>
                </div>
            <?php endif; ?>
        </section>
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