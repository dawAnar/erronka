<?php

if (!isset($_COOKIE['erabiltzailea']) || $_COOKIE['erabiltzailea'] != 'admin') {
    header('Location: ../../index.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="eu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taldea Ezabatu</title>
</head>

<body>
    <div class="container">
        <h1>Taldea Ezabatu</h1>

        <div class="warning-box">
            <h3>Abisua</h3>
            <p>Talde hau ezabatzen baduzu, ezin da berreskuratu. Ziur zaude jarraitu nahi duzula?</p>
        </div>

        <div class="taldea-info">
            <h3>Taldearen informazioa</h3>

            <div class="info-row">
                <span class="info-label">ID:</span>
                <span class="info-value"><?php echo $taldea->getId(); ?></span>
            </div>

            <div class="info-row">
                <span class="info-label">Talde Izena:</span>
                <span class="info-value"><?php echo htmlspecialchars($taldea->getTaldeIzena()); ?></span>
            </div>

            <div class="info-row">
                <span class="info-label">Kategoria ID:</span>
                <span class="info-value"><?php echo $taldea->getIdKategoria(); ?></span>
            </div>

            <div class="info-row">
                <span class="info-label">Prezioa:</span>
                <span class="info-value"><?php echo number_format($taldea->getPrezioa(), 2); ?>€</span>
            </div>

            <div class="info-row">
                <span class="info-label">Deskontua:</span>
                <span class="info-value"><?php echo $taldea->getDeskontua(); ?>%</span>
            </div>

            <div class="info-row">
                <span class="info-label">Urteak Lehen Mailan:</span>
                <span class="info-value"><?php echo $taldea->getUrteakLehenMailan(); ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Nobedadea:</span>
                <span class="info-value"><?php echo (method_exists($taldea, 'getNobedadea') && $taldea->getNobedadea()) ? 'Bai' : 'Ez'; ?></span>
            </div>

            <div class="info-row">
                <span class="info-label">Eskaintza:</span>
                <span class="info-value"><?php echo (method_exists($taldea, 'getEskaintza') && $taldea->getEskaintza()) ? 'Bai' : 'Ez'; ?></span>
            </div>
            
        </div>

        <form method="post"> 

            <input type="hidden" name="id" value="<?php echo htmlspecialchars($taldea->getId()); ?>">

            <div class="buttons">
                <button type="submit" name="ezabatu" class="btn btn-danger"
                    onclick="return confirm('Ziur zaude talde hau ezabatu nahi duzula? Ekintza hau ezin da desegin.')">
                    Bai, ezabatu
                </button>
                <a href="../../index.php" class="btn btn-secondary"> 
                    Utzi
                </a>
            </div>
        </form>
    </div>
</body>

</html>