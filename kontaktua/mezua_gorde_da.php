<p>Mezua gorde da</p>
<table cellspacing="5" cellpadding="5" border="1">
    <tr>
        <td align="right">Izena:</td>
        <td><?php echo $izena ?></td>
    </tr>
    <tr>
        <td align="right">Mezuaren testua:</td>
        <td><?php echo $mezua ?></td>
    </tr>
</table>

<form action=".." method="get">
    <p>
        <input type="submit" value="Itzuli">
        <input type="hidden" name="id" value="<?php echo $id ?>">
    </p>
</form>
