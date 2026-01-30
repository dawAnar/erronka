<?php
use com\leartik\daw24anar\saskia\Saskia;

$eskariak = $_SESSION['eskariak'] ?? [];
?>

<!doctype html>
<html lang="eu">
<head>
    <meta charset="utf-8">
    <title>Eskaria</title>
    <link rel="stylesheet" href="eskaria_erakutsi.css">
</head>
<body>

<header class="header">
    <div class="header-section logo"><img src="../hasiera/img/logoa.png"></div>
    <div class="header-section title">Eskaria</div>
</header>

<main>

<?php if (isset($_GET['guztia']) && isset($saskia) && $saskia instanceof Saskia): ?>

    <h2>Eskariaren laburpena</h2>

    <table>
        <tr><th>Produktua</th><th>Kopurua</th></tr>
        <?php foreach ($saskia->getDetaileak() as $d): ?>
        <tr>
            <td><?php echo htmlspecialchars($d->getTaldea()->getTaldeIzena()); ?></td>
            <td><?php echo $d->getKopurua(); ?></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <h2>Bezeroaren datuak</h2>

    <form method="post">
        <input type="hidden" name="confirm" value="1">

        <input name="izena" placeholder="Izena" required>
        <input name="abizena" placeholder="Abizena">
        <input name="helbidea" placeholder="Helbidea">
        <input name="herria" placeholder="Herria">
        <input name="postaKodea" placeholder="Posta kodea">
        <input name="probintzia" placeholder="Probintzia">
        <input name="emaila" type="email" placeholder="Emaila" required>

        <button type="submit">Bidali eskaria</button>
    </form>

<?php else: ?>

    <h2>Zure eskariak</h2>

    <?php if (count($eskariak) === 0): ?>
        <p>Ez dago eskariik</p>
    <?php else: ?>
        <table>
            <tr><th>#</th><th>ID</th><th>Kopurua</th><th>Bezeroa</th></tr>
            <?php foreach ($eskariak as $i => $e): ?>
            <tr>
                <td><?php echo $i+1; ?></td>
                <td><?php echo $e['id']; ?></td>
                <td><?php echo $e['kopurua']; ?></td>
                <td><?php echo $e['bezeroa']['izena'] ?? ''; ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>

<?php endif; ?>

</main>
</body>
</html>
