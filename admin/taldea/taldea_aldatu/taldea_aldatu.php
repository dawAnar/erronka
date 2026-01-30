<?php
if (!isset($mezua)) { $mezua = ''; }
if (!isset($id)) { $id = 0; }
if (!isset($talde_izena)) { $talde_izena = ''; }
if (!isset($prezioa)) { $prezioa = 0.0; }
if (!isset($deskontua)) { $deskontua = 0; }
if (!isset($urteak_lehen_mailan)) { $urteak_lehen_mailan = 0; }
if (!isset($id_kategoria)) { $id_kategoria = 0; }
if (!isset($kategoriak)) { $kategoriak = []; }
if (!isset($nobedadea)) { $nobedadea = 0; }
if (!isset($eskaintza)) { $eskaintza = 0; }
?>
<!DOCTYPE html>
<html lang="eu">
<head>
    <meta charset="UTF-8">
    <title>Taldea Aldatu - Admin</title>
</head>
<body>
    <h1>Taldeen administrazio gunea</h1>
    <p><a href="../../index.php">Hasiera</a> &gt; Taldea Aldatu</p>
    <h2>Taldea Aldatu</h2>

    <?php if (!empty($mezua)): ?>
        <p style="color: red;"><?php echo htmlspecialchars($mezua); ?></p>
    <?php endif; ?>

    <form action="" method="post">
        <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">

        <p>
            <label for="talde_izena">Talde Izena</label>
            <input type="text" id="talde_izena" name="talde_izena" required
                   value="<?= htmlspecialchars($talde_izena) ?>">
        </p>

        <p>
            <label for="prezioa">Prezioa (€)</label>
            <input type="text" step="0.01" id="prezioa" name="prezioa" min="0" required
                   value="<?= htmlspecialchars($prezioa) ?>">
        </p>

        <p>
            <label for="deskontua">Deskontua (%)</label>
            <input type="text" step="1" id="deskontua" name="deskontua" min="0" max="100"
                   value="<?= htmlspecialchars($deskontua) ?>">
        </p>

        <p>
            <label for="urteak_lehen_mailan">Urteak Lehen Mailan</label>
            <input type="text" id="urteak_lehen_mailan" name="urteak_lehen_mailan" min="0"
                   value="<?= htmlspecialchars($urteak_lehen_mailan) ?>">
        </p>

        <p>
            <label for="id_kategoria">Kategoriak</label>
            <select id="id_kategoria" name="id_kategoria" required>
                <option value="0">-- Aukeratu kategoria --</option>
                <?php foreach ($kategoriak as $kategoria_obj): ?>
                    <?php $id_k = $kategoria_obj->getId(); ?>
                    <?php $izena_k = $kategoria_obj->getIzenburua(); ?>
                    <option value="<?= htmlspecialchars($id_k) ?>" <?= ($id_k == $id_kategoria) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($izena_k) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </p>

        <p>
            <label for="nobedadea">
                <input type="checkbox" id="nobedadea" name="nobedadea" value="1"
                       <?= $nobedadea ? 'checked' : '' ?>>
                Nobedadea (novedad)
            </label>
        </p>

        <?php if ($deskontua > 0): ?>
            <p><strong>Eskaintza aktibatuta (deskontua %<?= htmlspecialchars($deskontua) ?>)</strong></p>
        <?php endif; ?>

        <p><input type="submit" name="gorde" value="Gorde"></p>
    </form>
</body>
</html>
