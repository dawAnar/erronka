<?php
require_once '../klaseak/com/leartik/daw24anar/kategoria/kategoria_db.php';
require_once '../klaseak/com/leartik/daw24anar/kategoria/kategoria.php';
require_once '../klaseak/com/leartik/daw24anar/taldea/taldea.php';
require_once '../klaseak/com/leartik/daw24anar/taldea/taldea_db.php';

use com\leartik\daw24anar\kategoria\KategoriaDB;
use com\leartik\daw24anar\taldea\TaldeaDB;

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) { die("ERROREA: Kategoriaren IDa falta da edo baliogabea da."); }

$kategoria = KategoriaDB::selectKategoria($id);
if (!$kategoria) { die("ERROREA: Kategoria ez da aurkitu (ID: {$id})."); }

$taldeak_guztiak = TaldeaDB::selectTaldeak();
$taldeak = array_filter($taldeak_guztiak, function($taldea) use ($id) {
    return $taldea->getIdKategoria() == $id;
});
?>
<!DOCTYPE html>
<html lang="eu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($kategoria->getIzenburua()); ?> - Kategoria</title>
    <link rel="stylesheet" href="kategoria_estiloa.css">
</head>
<body>
    <header class="header">
        <div class="header-section logo">
            <img src="../hasiera/img/logoa.png" alt="Logoa">
        </div>
        <h1 class="title"><?php echo htmlspecialchars($kategoria->getIzenburua()); ?></h1>
        <nav class="nav">
            <a href="kategoriak_erakutsi.php">Kategoriak</a>
            <a href="taldeak_erakutsi.php">Taldeak</a>
            <a href="../hasiera/index.php">Hasiera</a>
        </nav>
    </header>

    <main class="main-content">
        <div class="category-card single">
            <h2>ID: <?php echo $kategoria->getId(); ?></h2>
            <p><?php echo htmlspecialchars($kategoria->getDeskribapena()); ?></p>
        </div>

        <section class="teams-section">
            <h2 class="section-title">Kategoriako Taldeak</h2>

            <?php if (!empty($taldeak)): ?>
                <div class="teams-grid">
                    <?php foreach ($taldeak as $taldea): ?>
                        <div class="team-card">
                            <?php
                                $izena_original = $taldea->getTaldeIzena();

                                $izena_variants = [
                                    $izena_original,
                                    str_replace(' ', '_', $izena_original),
                                    strtolower($izena_original),
                                    strtolower(str_replace(' ', '_', $izena_original))
                                ];

                                $extensiones = ['png', 'jpg', 'jpeg', 'webp'];

                                $ruta_final = "../hasiera/img/default_team.png";

                                foreach ($izena_variants as $variant) {
                                    foreach ($extensiones as $ext) {
                                        $ruta = "../hasiera/img/taldeak/{$variant}.{$ext}";
                                        if (file_exists($ruta)) {
                                            $ruta_final = $ruta;
                                            break 2;
                                        }
                                    }
                                }
                            ?>

                            <img src="<?php echo $ruta_final; ?>" alt="<?php echo htmlspecialchars($taldea->getTaldeIzena()); ?>">
                            <h3><?php echo htmlspecialchars($taldea->getTaldeIzena()); ?></h3>
                            <p><?php echo htmlspecialchars($taldea->getUrteakLehenMailan()); ?> urte lehen mailan</p>
                            <a href="taldea_erakutsi.php?id=<?php echo $taldea->getId(); ?>" class="view-btn">Ikusi taldea</a>
                        </div>
                    <?php endforeach; ?>
                </div>

            <?php else: ?>
                <p class="no-teams">Ez dago taldearik kategoria honetan.</p>
            <?php endif; ?>
        </section>
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
