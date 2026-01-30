<?php
namespace com\leartik\daw24anar\mezua;
use PDO;
use Exception;

require_once(__DIR__ . '/mezua.php');

class MezuaDB
{
    private static function db()
    {
        $db = new PDO("sqlite:C:\\Users\\PC-8\\xampp\\htdocs\\Erronka_01\\denda.db");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    }

    public static function selectMezuak()
    {
        try {
            $db = self::db();
            $erregistroak = $db->query("SELECT * FROM mezuak ORDER BY sortze_data DESC");

            $mezuak = [];
            while ($r = $erregistroak->fetch(PDO::FETCH_ASSOC)) {
                $mezua = new Mezua();
                $mezua->setId($r['id']);
                $mezua->setIzena($r['izena']);
                $mezua->setEmail($r['email']);
                $mezua->setMezua($r['mezua']);
                $mezua->setSortzeData($r['sortze_data']);

                // ➕ erantzunda (0/1)
                $mezua->setErantzunda($r['erantzunda']);

                $mezuak[] = $mezua;
            }

            return $mezuak;

        } catch (Exception $e) {
            echo "<p>Salbuespena: " . $e->getMessage() . "</p>";
            return [];
        }
    }

    public static function selectMezua($id)
    {
        try {
            $db = self::db();
            $sql = "SELECT * FROM mezuak WHERE id = " . (int)$id;
            $erregistroak = $db->query($sql);

            if ($r = $erregistroak->fetch(PDO::FETCH_ASSOC)) {
                $mezua = new Mezua();
                $mezua->setId($r['id']);
                $mezua->setIzena($r['izena']);
                $mezua->setEmail($r['email']);
                $mezua->setMezua($r['mezua']);
                $mezua->setSortzeData($r['sortze_data']);

                // ➕ erantzunda
                $mezua->setErantzunda($r['erantzunda']);

                return $mezua;
            }

            return null;

        } catch (Exception $e) {
            echo "<p>Salbuespena: " . $e->getMessage() . "</p>";
            return null;
        }
    }

    public static function insertMezua($mezua)
    {
        try {
            $db = self::db();
            $sql = "INSERT INTO mezuak (izena, email, mezua, erantzunda)
                    VALUES (
                        '" . $mezua->getIzena() . "',
                        '" . $mezua->getEmail() . "',
                        '" . $mezua->getMezua() . "',
                        0
                    )";

            return $db->exec($sql);

        } catch (Exception $e) {
            echo "<p>Salbuespena: " . $e->getMessage() . "</p>";
            return 0;
        }
    }

    public static function updateMezua($mezua)
    {
        try {
            $db = self::db();
            $sql = "UPDATE mezuak SET 
                        izena = '" . $mezua->getIzena() . "',
                        email = '" . $mezua->getEmail() . "',
                        mezua = '" . $mezua->getMezua() . "',
                        erantzunda = " . (int)$mezua->getErantzunda() . "
                    WHERE id = " . (int)$mezua->getId();

            return $db->exec($sql);

        } catch (Exception $e) {
            echo "<p>Salbuespena: " . $e->getMessage() . "</p>";
            return 0;
        }
    }

    public static function deleteMezua($id)
    {
        try {
            $db = self::db();
            $db->exec("PRAGMA foreign_keys = ON");

            $sql = $db->prepare("DELETE FROM mezuak WHERE id = ?");
            return $sql->execute([(int)$id]);

        } catch (Exception $e) {
            echo "<p>Salbuespena: " . $e->getMessage() . "</p>";
            return 0;
        }
    }
}
?>
