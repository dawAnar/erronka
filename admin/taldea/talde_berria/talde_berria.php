<?php
require_once('../../../klaseak/com/leartik/daw24anar/taldea/taldea.php'); 
require_once('../../../klaseak/com/leartik/daw24anar/kategoria/kategoria_db.php');

use com\leartik\daw24anar\kategoria\KategoriaDB;

if (!isset($mezua)) { $mezua = ''; }
if (!isset($form_data)) { 
    $form_data = [
        'talde_izena' => '',
        'prezioa' => 0.0, 
        'deskontua' => 0, 
        'urteak_lehen_mailan' => 0,
        'nobedadea' => 0
    ];
}

$kategoriak_datuak = KategoriaDB::selectKategoriak(); 
?>
<!DOCTYPE html>
<html lang="eu">
<head>
    <meta charset="utf-8">
    <title>Produktu Berria</title>
</head>
<body>
    <h1>Produktuen administrazio gunea</h1>
    <p><a href="../../index.php">Hasiera</a> &gt; Produktu Berria</p>
    <h2>Produktu Berria</h2>

    <?php if (!empty($mezua)): ?>
        <p style="color: red;"><?php echo htmlspecialchars($mezua); ?></p>
    <?php endif; ?>
    
    <form action="index.php" method="post">
        <p>
            <label for="talde_izena">Talde Izena</label>
            <input type="text" id="talde_izena" name="talde_izena"
                   value="<?= htmlspecialchars($form_data['talde_izena']) ?>" required>
        </p>

        <p>
            <label for="prezioa">Prezioa (€)</label>
            <input type="text" step="0.01" id="prezioa" name="prezioa" min="0"
                   value="<?= htmlspecialchars($form_data['prezioa']) ?>" required>
        </p>

        <p>
            <label for="deskontua">Deskontua (%)</label>
            <input type="text" step="1" id="deskontua" name="deskontua" min="0" max="100"
                   value="<?= htmlspecialchars($form_data['deskontua']) ?>">
        </p>
        
        <p>
            <label for="urteak_lehen_mailan">Urteak Lehen Mailan</label>
            <input type="text" id="urteak_lehen_mailan" name="urteak_lehen_mailan" min="0"
                   value="<?= htmlspecialchars($form_data['urteak_lehen_mailan']) ?>">
        </p>

        <p>
            <label for="kategoria">Kategoriak</label>
            <select id="kategoria" name="kategoria" required>
                <option value="0">-- Aukeratu kategoria --</option>
                <?php 
                if (is_array($kategoriak_datuak)) {
                    foreach ($kategoriak_datuak as $kategoria_obj) { 
                        $id = $kategoria_obj->getId(); 
                        $izena = $kategoria_obj->getIzenburua(); 
                        $selected = ($id == $form_data['id_kategoria']) ? 'selected' : '';
                        echo "<option value=\"$id\" $selected>" . htmlspecialchars($izena) . "</option>";
                    }
                } 
                ?>
            </select>
            <?php if (empty($kategoriak_datuak)): ?>
                <small style="color: red;">Ez dago kategoria kargaturik.</small>
            <?php endif; ?>
        </p>

        <p>
            <label for="nobedadea">
                <input type="checkbox" id="nobedadea" name="nobedadea" value="1"
                       <?= $form_data['nobedadea'] ? 'checked' : '' ?>>
                Nobedadea (novedad)
            </label>
        </p>

        <p>
            <input type="submit" value="Gorde" name="gorde">
        </p>
    </form>
</body>
</html>
