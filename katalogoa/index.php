<?php
require_once __DIR__ . '/../klaseak/com/leartik/daw24anar/kategoria/kategoria_db.php';
require_once __DIR__ . '/../klaseak/com/leartik/daw24anar/taldea/taldea_db.php';

use com\leartik\daw24anar\kategoria\KategoriaDB;
use com\leartik\daw24anar\taldea\TaldeaDB;

$vista = $_GET['vista'] ?? 'hasiera';
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

function h($s) { return htmlspecialchars($s, ENT_QUOTES, 'UTF-8'); }
?>
<!DOCTYPE html>
<html lang="eu">
<head>
    <meta charset="utf-8">
    <title>Katalogoa</title>

    <link rel="stylesheet" href="estiloa.css">
</head>

<body>

<header class="header d-flex justify-content-between align-items-center">
    <div class="logo">
        <img src="../hasiera/img/logoa.png" alt="Logoa">
    </div>

    <h1 class="title">KATALOGOA</h1>

    <nav class="nav">
        <a href="index.php?vista=kategoriak">Kategoriak</a>
        <a href="index.php?vista=taldeak">Taldeak</a>
        <a href="../hasiera/index.php">Hasiera</a>
    </nav>
</header>

<main class="main-content">

<?php

switch ($vista) {

    case 'kategoriak':
        include 'kategoriak_erakutsi.php';
        break;

    case 'kategoria':
        include 'kategoria_erakutsi.php';
        break;

    case 'taldeak':
        include 'taldeak_erakutsi.php';
        break;

    case 'taldea':
        include 'taldea_erakutsi.php';
        break;

    default:
        echo "<h2>Ongi etorri katalogora</h2>
              <p>Aukeratu atal bat goiko menuan.</p>";
        break;
}

?>
</main>

<footer class="footer">
    <div class="socials">
        <a href="#">Instagram</a>
        <a href="#">WhatsApp</a>
        <a href="#">Email</a>
    </div>

    <p>© 2025 Futbol Total - Kontaktua: +34 600 000 000</p>
</footer>

</body>
</html>
