<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Administrazioa</title>
</head>
<body>
    <h1>Administrazio gunea</h1>

    <h2>Kategoriak</h2>
    <ul>
    <?php for ($i=0; $i < count($kategoriak); $i++) { ?>
        <li>
            <?php echo $kategoriak[$i]->getIzenburua() ?>
            [<a href="kategoria/kategoria_aldatu/?id=<?php echo $kategoriak[$i]->getId() ?>">aldatu</a>]
            [<a href="kategoria/kategoria_ezabatu/?id=<?php echo $kategoriak[$i]->getId() ?>">ezabatu</a>]
        </li>
    <?php } ?>
    </ul>

    <form action="kategoria/kategoria_berria" method="post">
        <p><input type="submit" value="Kategoria berria"></p>
    </form>

    <hr>

    <h2>Taldeak</h2>
    <ul>
    <?php for ($i=0; $i < count($taldeak); $i++) { ?>
        <li>
            <?php echo $taldeak[$i]->getTaldeIzena() ?>
            [<a href="taldea/taldea_aldatu/index.php?id=<?php echo $taldeak[$i]->getId() ?>">aldatu</a>]
            [<a href="taldea/talde_ezabatu/index.php?id=<?php echo $taldeak[$i]->getId() ?>">ezabatu</a>]
        </li>
    <?php } ?>
    </ul>

    <form action="taldea/talde_berria/talde_berria.php" method="post">
        <p><input type="submit" value="Taldea berria"></p>
    </form>

    <hr>

    <!-- 🔵 MEZUAK -->
    <h2>Mezuak</h2>
    <ul>
    <?php for ($i=0; $i < count($mezuak); $i++) { ?>

        <li>
            <?php 
                // Formato de timestamp → YYYY-MM-DD, HH:mm:ss am/pm
                $data = date("Y-m-d, h:i:s a", strtotime($mezuak[$i]->getSortzeData()));
                $mezuaTestua = htmlspecialchars($mezuak[$i]->getMezua());
                $erantzunda = ($mezuak[$i]->getErantzunda() == 1) ? " - erantzunda" : "";
            ?>

            <?php echo $data ?> –
            <?php echo $mezuaTestua ?>
            <?php echo $erantzunda ?>

            [<a href="mezua/mezua_aldatu/?id=<?php echo $mezuak[$i]->getId() ?>">aldatu</a>]
            [<a href="mezua/mezua_ezabatu/?id=<?php echo $mezuak[$i]->getId() ?>">ezabatu</a>]
        </li>

    <?php } ?>
    </ul>

    <hr>

    <h2>Eskariak</h2>

    <?php if (!empty($eskariak) && is_array($eskariak)) { ?>

    <ul>
    <?php foreach ($eskariak as $i => $e) { ?>

        <li>
            <?php
                // Fecha: soporta arrays (timestamp) o objetos (getData())
                if (is_object($e) && method_exists($e, 'getData')) {
                    $rawDate = $e->getData();
                    $data = $rawDate ? date("Y-m-d, h:i:s a", strtotime($rawDate)) : '-';
                } elseif (is_array($e) && isset($e['timestamp'])) {
                    $data = date("Y-m-d, h:i:s a", (int)$e['timestamp']);
                } else {
                    $data = '-';
                }

                // Bezeroa: objeto o array
                $bezeroaTestua = '-';
                if (is_object($e) && method_exists($e, 'getBezeroa')) {
                    $b = $e->getBezeroa();
                    if ($b) {
                        $iz = '';
                        if (method_exists($b, 'getIzena')) $iz .= $b->getIzena();
                        if (method_exists($b, 'getAbizena')) $iz .= ' ' . $b->getAbizena();
                        $iz = trim($iz);
                        if ($iz !== '') $bezeroaTestua = htmlspecialchars($iz);
                    }
                } elseif (is_array($e) && isset($e['bezeroa']) && is_array($e['bezeroa'])) {
                    $b = $e['bezeroa'];
                    $name = trim(($b['izena'] ?? '') . ' ' . ($b['abizena'] ?? ''));
                    if ($name !== '') $bezeroaTestua = htmlspecialchars($name);
                }

                // Estado
                if (is_object($e) && method_exists($e, 'getBidalita')) {
                    $bstate = (int)$e->getBidalita();
                } elseif (is_array($e)) {
                    $bstate = !empty($e['bidalita']) ? (int)$e['bidalita'] : 0;
                } else {
                    $bstate = 0;
                }
                $estado = ($bstate === 1) ? ' - bidalita' : ' - bidali gabe';

                // link id: si es objeto usar getId(), si es array usar el índice
                if (is_object($e) && method_exists($e, 'getId')) {
                    $linkId = $e->getId();
                } else {
                    $linkId = $i;
                }
            ?>

            <?php echo $data ?> –
            <?php echo $bezeroaTestua ?>
            <?php echo $estado ?>

            [<a href="eskaria/eskaria_aldatu/?id=<?php echo $linkId; ?>">aldatu</a>]
            [<a href="eskaria/eskaria_ezabatu/?id=<?php echo $linkId; ?>">ezabatu</a>]
        </li>

    <?php } ?>
    </ul>

    <?php } else { ?>

    <p>Ez da eskarik gordeta.</p>

    <?php } ?>

    <p><a href="irten.php">Sesiotik irten</a></p>

</body>
</html>
