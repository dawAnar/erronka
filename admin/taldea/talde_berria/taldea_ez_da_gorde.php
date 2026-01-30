<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Taldeak</title>
</head>
<body>
    <h1>Administrazio gunea</h1>
    <p><a href="..">Hasiera</a> &gt;</p>
    <h2>Taldea aldatu</h2>
    <p>Taldea ez da gorde</p>
    
    <table cellspacing="5" cellpadding="5" border="1">
        <tr>
            <td align="right">Talde Izena:</td>
            <td><?php echo $talde_izena ?></td>
        </tr>
        <tr>
            <td align="right">Kategoria:</td>
            <td><?php echo $id_kategoria ?></td> 
        </tr>
        <tr>
            <td align="right">Prezioa:</td>
            <td><?php echo number_format($prezioa, 2, ',', '.') ?> €</td>
        </tr>
        <tr>
            <td align="right">Deskontua:</td>
            <td><?php echo $deskontua * 100 ?>%</td> 
        </tr>
        <tr>
            <td align="right">Urteak Lehen Mailan:</td>
            <td><?php echo $urteak_lehen_mailan ?> urte</td>
        </tr>
    </table>
    
    <p style="color: red; font-weight: bold;"><?php echo $errore_mezua ?? 'Errore ezezaguna gertatu da.' ?></p>

</body>
</html>