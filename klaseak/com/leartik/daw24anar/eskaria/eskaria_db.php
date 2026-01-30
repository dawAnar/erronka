<?php
namespace com\leartik\daw24anar\eskaria;

use PDO;
use Exception;

require_once(__DIR__ . '/eskaria.php');
require_once(__DIR__ . '/../detallea/detallea.php');
require_once(__DIR__ . '/../bezeroa/bezeroa.php');
require_once(__DIR__ . '/../taldea/taldea_db.php');

use com\leartik\daw24anar\eskaria\Eskaria;
use com\leartik\daw24anar\detallea\Detallea;
use com\leartik\daw24anar\bezeroa\Bezeroa;
use com\leartik\daw24anar\taldea\TaldeaDB;

class EskariaDB
{
    private const DB_FILE = __DIR__ . '/../../../../../denda.db';

    private static function db(): PDO
    {
        $db = new PDO('sqlite:' . self::DB_FILE);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    }

    // ========== SELECT 1 ==========
    public static function selectEskaria($id)
    {
        try {
            $db = self::db();

            $sql = $db->prepare("SELECT * FROM Eskaria WHERE id = ?");
            $sql->execute([(int)$id]);
            $r = $sql->fetch(PDO::FETCH_ASSOC);
            if (!$r) return null;

            $eskaria = new Eskaria();
            $eskaria->setId((int)$r['id']);
            if (isset($r['data'])) $eskaria->setData($r['data']);
            if (isset($r['bidalita'])) $eskaria->setBidalita((int)$r['bidalita']);

            // Bezeroa (no hay tabla: se rellena desde columnas de Eskaria)
            $b = new Bezeroa();
            if (method_exists($b, 'setIzena')) $b->setIzena($r['izena'] ?? '');
            if (method_exists($b, 'setAbizena')) $b->setAbizena($r['abizena'] ?? '');
            if (method_exists($b, 'setHelbidea')) $b->setHelbidea($r['helbidea'] ?? '');
            if (method_exists($b, 'setHerria')) $b->setHerria($r['herria'] ?? '');
            if (method_exists($b, 'setPostaKodea')) $b->setPostaKodea((int)($r['postaKodea'] ?? 0));
            if (method_exists($b, 'setProbintzia')) $b->setProbintzia($r['probintzia'] ?? '');

            // En tu BD el campo es "emaila"
            if (method_exists($b, 'setEmaila')) $b->setEmaila($r['emaila'] ?? '');
            if (method_exists($b, 'setEmail')) $b->setEmail($r['emaila'] ?? '');

            $eskaria->setBezeroa($b);

            // Detalleak desde Detallea
            $sqlD = $db->prepare("SELECT * FROM Detallea WHERE id_eskaria = ? ORDER BY id ASC");
            $sqlD->execute([(int)$eskaria->getId()]);

            $detalleak = [];
            while ($rd = $sqlD->fetch(PDO::FETCH_ASSOC)) {
                $d = new Detallea();

                if (isset($rd['kopurua'])) $d->setKopurua((int)$rd['kopurua']);

                // Cargar Taldea desde DB
                $t = TaldeaDB::selectTaldea((int)$rd['id_taldea']);

                // Si Detallea guarda el precio, lo ponemos en Taldea para calcular getGuztira()
                if ($t && isset($rd['prezioa']) && method_exists($t, 'setPrezioa')) {
                    $t->setPrezioa((float)$rd['prezioa']);
                }

                $d->setTaldea($t);

                // Si tu Detallea class tiene setSortzeData, se lo metemos (opcional)
                if (isset($rd['sortze_data']) && method_exists($d, 'setSortzeData')) {
                    $d->setSortzeData($rd['sortze_data']);
                }

                $detalleak[] = $d;
            }

            $eskaria->setDetalleak($detalleak);

            return $eskaria;

        } catch (Exception $e) {
            error_log("EskariaDB::selectEskaria ERROR: " . $e->getMessage());
            return null;
        }
    }

    // ========== SELECT ALL ==========
    public static function selectEskariak()
    {
        try {
            $db = self::db();
            $res = $db->query("SELECT * FROM Eskaria ORDER BY data DESC");

            $eskariak = [];
            while ($r = $res->fetch(PDO::FETCH_ASSOC)) {
                $e = new Eskaria();
                $e->setId((int)$r['id']);
                if (isset($r['data'])) $e->setData($r['data']);
                if (isset($r['bidalita'])) $e->setBidalita((int)$r['bidalita']);

                // Bezeroa mínimo para listado
                $b = new Bezeroa();
                if (method_exists($b, 'setIzena')) $b->setIzena($r['izena'] ?? '');
                if (method_exists($b, 'setAbizena')) $b->setAbizena($r['abizena'] ?? '');
                if (method_exists($b, 'setEmaila')) $b->setEmaila($r['emaila'] ?? '');
                if (method_exists($b, 'setEmail')) $b->setEmail($r['emaila'] ?? '');

                $e->setBezeroa($b);

                // no cargamos detalleak aquí
                $e->setDetalleak([]);

                $eskariak[] = $e;
            }

            return $eskariak;

        } catch (Exception $e) {
            error_log("EskariaDB::selectEskariak ERROR: " . $e->getMessage());
            return [];
        }
    }

    // ========== INSERT ==========
    // Devuelve el id nuevo, o 0 si falla
    public static function insertEskaria($eskaria): int
    {
        $db = null;
        try {
            $db = self::db();
            $db->exec("PRAGMA foreign_keys = ON;");
            $db->beginTransaction();

            $b = $eskaria->getBezeroa();

            $izena = ($b && method_exists($b, 'getIzena')) ? trim($b->getIzena()) : '';
            $abizena = ($b && method_exists($b, 'getAbizena')) ? trim($b->getAbizena()) : '';
            $helbidea = ($b && method_exists($b, 'getHelbidea')) ? trim($b->getHelbidea()) : '';
            $herria = ($b && method_exists($b, 'getHerria')) ? trim($b->getHerria()) : '';
            $postaKodea = ($b && method_exists($b, 'getPostaKodea')) ? (int)$b->getPostaKodea() : 0;
            $probintzia = ($b && method_exists($b, 'getProbintzia')) ? trim($b->getProbintzia()) : '';

            $emaila = '';
            if ($b) {
                if (method_exists($b, 'getEmaila')) $emaila = trim($b->getEmaila());
                if ($emaila === '' && method_exists($b, 'getEmail')) $emaila = trim($b->getEmail());
            }

            $bidalita = (int)$eskaria->getBidalita();

            // Insert en Eskaria (data se rellena por DEFAULT CURRENT_TIMESTAMP)
            $sql = $db->prepare("
                INSERT INTO Eskaria (izena, abizena, helbidea, herria, postaKodea, probintzia, emaila, bidalita)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)
            ");
            $sql->execute([$izena, $abizena, $helbidea, $herria, $postaKodea, $probintzia, $emaila, $bidalita]);

            $newId = (int)$db->lastInsertId();
            $eskaria->setId($newId);

            // Insert detalleak en Detallea
            $detalleak = $eskaria->getDetalleak();
            if (is_array($detalleak)) {

                $sqlD = $db->prepare("
                    INSERT INTO Detallea (id_eskaria, id_taldea, prezioa, kopurua)
                    VALUES (?, ?, ?, ?)
                ");

                foreach ($detalleak as $d) {
                    if (!$d) continue;

                    $t = $d->getTaldea();
                    $taldeaId = ($t && method_exists($t, 'getId')) ? (int)$t->getId() : 0;
                    $kop = (int)$d->getKopurua();

                    $prezioa = 0.0;
                    if ($t && method_exists($t, 'getPrezioa')) {
                        $prezioa = (float)$t->getPrezioa();
                    }

                    $sqlD->execute([$newId, $taldeaId, $prezioa, $kop]);
                }
            }

            $db->commit();
            return $newId;

        } catch (Exception $e) {
            if ($db && $db->inTransaction()) $db->rollBack();
            error_log("EskariaDB::insertEskaria ERROR: " . $e->getMessage());
            return 0;
        }
    }

    // ========== UPDATE SOLO BIDALITA ==========
    public static function updateBidalita($id, $bidalita)
    {
        try {
            $db = self::db();
            $sql = $db->prepare("UPDATE Eskaria SET bidalita = ? WHERE id = ?");
            return $sql->execute([(int)$bidalita, (int)$id]);

        } catch (Exception $e) {
            error_log("EskariaDB::updateBidalita ERROR: " . $e->getMessage());
            return 0;
        }
    }

    public static function updateEskaria($eskaria)
    {
        return self::updateBidalita($eskaria->getId(), $eskaria->getBidalita());
    }

    // ========== DELETE ==========
    public static function deleteEskaria($id)
    {
        try {
            $db = self::db();
            $db->exec("PRAGMA foreign_keys = ON;");

            $sql = $db->prepare("DELETE FROM Eskaria WHERE id = ?");
            $sql->execute([(int)$id]);

            return $sql->rowCount();

        } catch (Exception $e) {
            error_log("EskariaDB::deleteEskaria ERROR: " . $e->getMessage());
            return 0;
        }
    }
}
?>
