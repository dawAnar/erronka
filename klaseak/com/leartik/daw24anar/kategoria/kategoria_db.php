<?php
namespace com\leartik\daw24anar\kategoria;
use PDO;
use Exception;

require_once(__DIR__ . '/kategoria.php');

class KategoriaDB
{
    public static function selectKategoriak()
    {
        try {
            $db = new PDO('sqlite:' . __DIR__ . '/../../../../../denda.db');
            
            $erregistroak = $db->query("select * from kategoriak");
            $kategoriak = array();

            while ($erregistroa = $erregistroak->fetch()) {
                $kategoria = new Kategoria(); 
                
                $kategoria->setId($erregistroa['id']);
                $kategoria->setIzenburua($erregistroa['izenburua']);
                
                $kategoriak[] = $kategoria;
            }

            return $kategoriak;

        } catch (Exception $e) {
            return array(); 
        }
    }

    public static function selectKategoria($id)
    {
        try {
            $db = new PDO('sqlite:' . __DIR__ . '/../../../../../denda.db');
            $erregistroak = $db->query("select * from kategoriak where id=" . $id);
            $kategoria = null;

            if ($erregistroa = $erregistroak->fetch(PDO::FETCH_ASSOC)) {
                $kategoria = new Kategoria();
                $kategoria->setId($erregistroa['id']);
                $kategoria->setIzenburua($erregistroa['izenburua']);
                $kategoria->setDeskribapena($erregistroa['deskribapena']);
            }

            return $kategoria;
        } catch (Exception $e) {
            echo "<p>Salbuespena: " . $e->getMessage() . "</p>\n";
            return null;
        }
    }

    public static function insertKategoria($kategoria)
    {
        try {
            $db = new PDO('sqlite:' . __DIR__ . '/../../../../../denda.db');
            $sql = "insert into kategoriak (izenburua, deskribapena) values ('" .
                $kategoria->getIzenburua() . "','" .
                $kategoria->getDeskribapena() . "')";
            return $db->exec($sql);
        } catch (Exception $e) {
            echo "<p>Salbuespena: " . $e->getMessage() . "</p>\n";
            return 0;
        }
    }

    public static function updateKategoria($kategoria) {
        try {
            $db = new PDO('sqlite:' . __DIR__ . '/../../../../../denda.db');
            $sql = "UPDATE kategoriak SET 
                        izenburua = '" . $kategoria->getIzenburua() . "',
                        deskribapena = '" . $kategoria->getDeskribapena() . "'
                    WHERE id = " . $kategoria->getId();
            return $db->exec($sql);
        } catch (Exception $e) {
            echo "<p>Salbuespena: " . $e->getMessage() . "</p>\n";
            return 0;
        }
    }

    public static function deleteKategoria($id) {
        try {
            $db = new PDO('sqlite:' . __DIR__ . '/../../../../../denda.db');
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $db->exec('PRAGMA foreign_keys = ON;');

            $kontsulta = $db->prepare("DELETE FROM kategoriak WHERE id = ?");
            return $kontsulta->execute([(int)$id]);
        } catch (Exception $e) {
            echo "<p>Salbuespena: " . $e->getMessage() . "</p>\n";
            return 0;
        }
    }
}
?>
