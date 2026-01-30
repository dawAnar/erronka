<!DOCTYPE html>
<html lang="eu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Futbol Total - Hasiera</title>
    <link rel="stylesheet" href="estiloa.css">

    <!-- JAVASCRIPT para eskaintzak -->
    <script src="eskaintzak.js" defer></script>
</head>
<body>
    <header class="header">
        <div class="header-section logo">
            <img src="https://anartz.s3.eu-north-1.amazonaws.com/logoa.png" alt="Dendaren logotipoa">

        </div>

        <h1 class="header-section title">FUTBOL TOTAL</h1>

        <nav class="header-section nav">
            <a href="../katalogoa/kategoriak_erakutsi.php">Kategoriak</a>
            <a href="../katalogoa/taldeak_erakutsi.php">Taldeak</a>
            <a href="#">Saskia</a>
            <a href="../admin/index.php">Admin Gunea</a>
            <a href="../kontaktua/mezu_berria.php">Kontaktua</a>
        </nav>
    </header>

    <main class="main-content">

        <!-- 🟦 NOBEDADEAK: PHP bidez -->
        <section class="section-block">
            <h2 class="section-title">NOBEDADEAK</h2>
            <div class="featured">
                <?php if (!empty($nobedadeak)): ?>
                    <?php foreach ($nobedadeak as $t): ?>
                        <div class="featured-item">
                            <a href="../katalogoa/taldea_erakutsi.php?id=<?php echo $t['id']; ?>">
                                <img src="img/taldeak/<?php echo htmlspecialchars($t['talde_izena']); ?>.png"
                                     alt="<?php echo htmlspecialchars($t['talde_izena']); ?>">
                                <p><?php echo htmlspecialchars($t['talde_izena']); ?></p>
                            </a>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Ez dago nobedaderik momentuz.</p>
                <?php endif; ?>
            </div>
        </section>

        <!-- 🟥 ESKAINTZAK: JAVASCRIPT bidez -->
        <section class="section-block">
            <h2 class="section-title">ESKAINTZAK</h2>

            <div id="eskaintzak-container" class="featured">
                <p>Eskaintzak kargatzen...</p>
            </div>
        </section>


        <section class="about">
            <p>
                Kaixo, gu gara Futbol Total, zure futbol denda fidagarria.
                Produktu onenak eta prezio lehiakorrak eskaintzen ditugu.
            </p>
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
