<?php
try {
    $dbPath = __DIR__ . '/../../denda.db';
    $db = new PDO('sqlite:' . $dbPath);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // ============================================================
    // ========================== GET =============================
    // ============================================================
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {

        // === GET 1 talde ===
        if (isset($_GET['id'])) {

            $id = $_GET['id'];

            if (!is_numeric($id)) {
                http_response_code(400);
                echo json_encode(['error' => 'IDa baliogabea da. Zenbakia izan behar du.']);
                exit;
            }

            $sql = "SELECT * FROM taldeak WHERE id = " . (int)$id;
            $row = $db->query($sql)->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                echo json_encode($row, JSON_UNESCAPED_UNICODE);
            } else {
                http_response_code(404);
                echo json_encode(['error' => 'Ez da aurkitu ' . $id . ' IDa duen talderik.']);
            }
            exit;
        }

        // === GET guztiak ===
        $sql = "SELECT * FROM taldeak ORDER BY id DESC";
        $stmt = $db->query($sql);

        $lista = [];
        while ($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $lista[] = $r;
        }

        echo json_encode($lista, JSON_UNESCAPED_UNICODE);
        exit;
    }

    // ============================================================
    // ========================== POST ============================
    // ============================================================
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Datuak hartu
        $data = json_decode(file_get_contents("php://input"), true);

        if (!$data ||
            !isset($data['id_kategoria']) ||
            !isset($data['talde_izena']) ||
            !isset($data['prezioa']) ||
            !isset($data['deskontua']) ||
            !isset($data['urteak_lehen_mailan'])
        ) {
            http_response_code(400);
            echo json_encode(['error' => 'Eremu guztiak bete behar dira.']);
            exit;
        }

        $sql = "INSERT INTO taldeak (id_kategoria, talde_izena, prezioa, deskontua, urteak_lehen_mailan, nobedadeak, eskaintzak)
                VALUES (:kat, :izena, :prezioa, :deskontua, :urteak, :nobedadeak, :eskaintzak)";

        $stmt = $db->prepare($sql);
        $ok = $stmt->execute([
            ':kat' => $data['id_kategoria'],
            ':izena' => $data['talde_izena'],
            ':prezioa' => $data['prezioa'],
            ':deskontua' => $data['deskontua'],
            ':urteak' => $data['urteak_lehen_mailan'],
            ':nobedadeak' => $data['nobedadeak'] ?? 0,
            ':eskaintzak' => $data['eskaintzak'] ?? 0
        ]);

        if ($ok) {
            echo json_encode(['mezua' => 'Taldea sortuta!'], JSON_UNESCAPED_UNICODE);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Ezin izan da sortu.']);
        }
        exit;
    }

    // ============================================================
    // ========================== PUT =============================
    // ============================================================
    if ($_SERVER['REQUEST_METHOD'] === 'PUT') {

        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            http_response_code(400);
            echo json_encode(['error' => 'PUT egiteko ID balioduna behar da.']);
            exit;
        }

        $id = (int)$_GET['id'];
        $data = json_decode(file_get_contents("php://input"), true);

        if (!$data) {
            http_response_code(400);
            echo json_encode(['error' => 'PUT datuak ez dira baliozkoak.']);
            exit;
        }

        $sql = "UPDATE taldeak SET 
                id_kategoria = :kat,
                talde_izena = :izena,
                prezioa = :prezioa,
                deskontua = :deskontua,
                urteak_lehen_mailan = :urteak,
                nobedadeak = :nobedadeak,
                eskaintzak = :eskaintzak
                WHERE id = :id";

        $stmt = $db->prepare($sql);
        $ok = $stmt->execute([
            ':kat' => $data['id_kategoria'] ?? null,
            ':izena' => $data['talde_izena'] ?? null,
            ':prezioa' => $data['prezioa'] ?? null,
            ':deskontua' => $data['deskontua'] ?? null,
            ':urteak' => $data['urteak_lehen_mailan'] ?? null,
            ':nobedadeak' => $data['nobedadeak'] ?? 0,
            ':eskaintzak' => $data['eskaintzak'] ?? 0,
            ':id' => $id
        ]);

        if ($ok) {
            echo json_encode(['mezua' => 'Taldea eguneratuta!'], JSON_UNESCAPED_UNICODE);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Ezin izan da eguneratu.']);
        }

        exit;
    }

    // ============================================================
    // ========================= DELETE ===========================
    // ============================================================
    if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {

        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            http_response_code(400);
            echo json_encode(['error' => 'DELETE egiteko ID balioduna behar da.']);
            exit;
        }

        $id = (int)$_GET['id'];

        $sql = $db->prepare("DELETE FROM taldeak WHERE id = ?");
        $ok = $sql->execute([$id]);

        if ($ok) {
            echo json_encode(['mezua' => 'Taldea ezabatuta!'], JSON_UNESCAPED_UNICODE);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Ezin izan da ezabatu.']);
        }

        exit;
    }

} catch (Exception $e) {
    echo 'Errorea: ' . $e->getMessage();
}
?>
