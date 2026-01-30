<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once('../../../klaseak/com/leartik/daw24anar/kategoria/kategoria.php'); 
require_once('../../../klaseak/com/leartik/daw24anar/kategoria/kategoria_db.php'); 
use com\leartik\daw24anar\kategoria\KategoriaDB;

$data = [];
$kategoria_izena = 'Ezezaguna (ID: ?)';

if (!empty($_SESSION['taldea_gorde_da'])) {
    $data = $_SESSION['taldea_gorde_da'];
    unset($_SESSION['taldea_gorde_da']); 

    $kategoria_objektuak = KategoriaDB::selectKategoriak();

    if (is_array($kategoria_objektuak)) {
        foreach ($kategoria_objektuak as $kat) {
            if (!empty($data['id_kategoria']) && $kat->getId() == $data['id_kategoria']) {
                $kategoria_izena = $kat->getIzenburua();
                break;
            }
        }
    }
} else {
    $data = [
        'talde_izena' => '---',
        'prezioa' => 0.0,
        'deskontua' => 0,
        'urteak_lehen_mailan' => 0
    ];
}

$talde_izena = $data['talde_izena'] ?? '---';
$prezioa = $data['prezioa'] ?? 0.00;
$deskontua = $data['deskontua'] ?? 0;
$urteak_lehen_mailan = $data['urteak_lehen_mailan'] ?? 0;
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Taldeak</title>
</head>
<body>
    <h1>Administrazio gunea</h1>
    <p><a href="../../index.php">Hasiera</a> &gt;</p>
    <h2>Taldea berria</h2>
    <p>Taldea ondo gorde da ondorengo datuekin:</p>
    
    <table cellspacing="5" cellpadding="5" border="1">
        <tr>
            <td align="right">Talde Izena:</td>
            <td><?php echo htmlspecialchars($talde_izena) ?></td>
        </tr>
        <tr>
            <td align="right">Kategoria:</td>
            <td><?php echo htmlspecialchars($kategoria_izena) ?></td>
        </tr>
        <tr>
            <td align="right">Prezioa:</td>
            <td><?php echo number_format($prezioa, 2, ',', '.') ?> €</td>
        </tr>
        <tr>
            <td align="right">Deskontua:</td>
            <td><?php echo htmlspecialchars($deskontua) ?>%</td>
        </tr>
        <tr>
            <td align="right">Urteak Lehen Mailan:</td>
            <td><?php echo htmlspecialchars($urteak_lehen_mailan) ?> urte</td>
        </tr>
    </table>
    
    <p><a href="../../index.php">Administrazio hasiera</a></p>
</body>
</html>