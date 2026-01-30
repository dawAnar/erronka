<?php
namespace com\leartik\daw24anar\taldea;
use PDO;
use Exception;

require_once(__DIR__ . '/taldea.php');

class TaldeaDB
{
    private const DB_PATH = "sqlite:C:\\Users\\PC-8\\xampp\\htdocs\\Erronka_01\\denda.db";

    private static function connect() {
        $db = new PDO(self::DB_PATH);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
        return $db;
    }

    public static function selectTaldeak()
    {
        try {
            $db = self::connect();
            $erregistroak = $db->query("SELECT id, id_kategoria, talde_izena, prezioa, deskontua, urteak_lehen_mailan, nobedadeak, eskaintzak FROM taldeak");
            $taldeak = array();

            while ($erregistroa = $erregistroak->fetch(PDO::FETCH_ASSOC)) {
                $taldea = new Taldea(); 
                $taldea->setId($erregistroa['id']);
                $taldea->setIdKategoria($erregistroa['id_kategoria']);
                $taldea->setTaldeIzena($erregistroa['talde_izena']);
                $taldea->setPrezioa($erregistroa['prezioa']);
                $taldea->setDeskontua($erregistroa['deskontua']);
                $taldea->setUrteakLehenMailan($erregistroa['urteak_lehen_mailan']);
                if (isset($erregistroa['nobedadeak'])) {
                    $taldea->setNobedadeak($erregistroa['nobedadeak']);
                }
                if (isset($erregistroa['eskaintzak'])) {
                    $taldea->setEskaintzak($erregistroa['eskaintzak']);
                }
                $taldeak[] = $taldea;
            }

            return $taldeak;
        } catch (Exception $e) { 
            echo "<p style='color: red;'>!!! Salbuespena selectTaldeak !!! Mezua: " . $e->getMessage() . "</p>\n";
            return null;
        }
    }

    public static function selectTaldea($id)
    {
        try {
            $db = new PDO("sqlite:C:\\Users\\PC-8\\xampp\\htdocs\\Erronka_01\\denda.db");
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT * FROM taldeak WHERE id = ?";
            $kontsulta = $db->prepare($sql);
            $kontsulta->execute([(int)$id]);

            $emaitza = $kontsulta->fetch(PDO::FETCH_ASSOC);

            if ($emaitza) {
                $taldea = new Taldea();
                $taldea->setId($emaitza['id']);
                $taldea->setIdKategoria($emaitza['id_kategoria']);
                $taldea->setTaldeIzena($emaitza['talde_izena']);
                $taldea->setPrezioa($emaitza['prezioa']);
                $taldea->setDeskontua($emaitza['deskontua']);
                $taldea->setUrteakLehenMailan($emaitza['urteak_lehen_mailan']);
                if (isset($emaitza['nobedadeak'])) {
                    $taldea->setNobedadeak($emaitza['nobedadeak']);
                }
                if (isset($emaitza['eskaintzak'])) {
                    $taldea->setEskaintzak($emaitza['eskaintzak']);
                }
                return $taldea;
            }

            return null;

        } catch (Exception $e) {
            echo "<p style='color: red;'>!!! Salbuespena selectTaldea !!! Mezua: " . $e->getMessage() . "</p>\n";
            return null;
        }
    }

    public static function insertTaldea($taldea)
    {
        try {
            $db = new PDO("sqlite:C:\\Users\\PC-8\\xampp\\htdocs\\Erronka_01\\denda.db");
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

            $id_kategoria = (int)$taldea->getIdKategoria();
            $talde_izena = str_replace("'", "''", $taldea->getTaldeIzena()); 
            $prezioa = (float)$taldea->getPrezioa();
            $deskontua = (int)$taldea->getDeskontua();
            $urteak_lehen_mailan = (int)$taldea->getUrteakLehenMailan();
            $nobedadeak = (int)$taldea->getNobedadeak();
            $eskaintzak = (int)$taldea->getEskaintzak();

            $sql = "INSERT INTO taldeak (id_kategoria, talde_izena, prezioa, deskontua, urteak_lehen_mailan, nobedadeak, eskaintzak)
                    VALUES ($id_kategoria, '$talde_izena', $prezioa, $deskontua, $urteak_lehen_mailan, $nobedadeak, $eskaintzak)";

            return $db->exec($sql);

        } catch (Exception $e) {
            echo "<p style='color: red;'>!!! Salbuespena insertTaldea !!! Mezua: " . $e->getMessage() . "</p>\n";
            return 0;
        }
    }

    public static function updateTaldea($taldea) {
        try {
            $db = new PDO("sqlite:C:\\Users\\PC-8\\xampp\\htdocs\\Erronka_01\\denda.db");

            $id = (int)$taldea->getId();
            $id_kategoria = (int)$taldea->getIdKategoria();
            $talde_izena = str_replace("'", "''", $taldea->getTaldeIzena());
            $prezioa = (float)$taldea->getPrezioa();
            $deskontua = (int)$taldea->getDeskontua();
            $urteak_lehen_mailan = (int)$taldea->getUrteakLehenMailan();
            $nobedadeak = (int)$taldea->getNobedadeak();
            $eskaintzak = (int)$taldea->getEskaintzak();

            $sql = "UPDATE taldeak SET 
                        id_kategoria = $id_kategoria,
                        talde_izena = '$talde_izena',
                        prezioa = $prezioa,
                        deskontua = $deskontua,
                        urteak_lehen_mailan = $urteak_lehen_mailan,
                        nobedadeak = $nobedadeak,
                        eskaintzak = $eskaintzak
                    WHERE id = $id";

            return $db->exec($sql);

        } catch (Exception $e) {
            echo "<p style='color: red;'>!!! Salbuespena updateTaldea !!! Mezua: " . $e->getMessage() . "</p>\n";
            return 0;
        }
    }

    public static function deleteTaldea($id) {
        try {
            $db = new PDO("sqlite:C:\\Users\\PC-8\\xampp\\htdocs\\Erronka_01\\denda.db");
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $db->exec('PRAGMA foreign_keys = ON;');

            $kontsulta = $db->prepare("DELETE FROM taldeak WHERE id = ?");
            return $kontsulta->execute([$id]);

        } catch (Exception $e) {
            error_log("Errorea taldea ezabatzen: " . $e->getMessage());
        }

        return false;
    }
}
?>
