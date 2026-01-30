<?php
try {
    $db = new PDO('sqlite:../../denda.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $method = $_SERVER['REQUEST_METHOD'];

    // ============================================================
    //                          GET
    // ============================================================
    if ($method === 'GET') {

        // --- ID bakarra ---
        if (isset($_GET['id'])) {

            $id = $_GET['id'];

            if (!is_numeric($id)) {
                http_response_code(400);
                echo json_encode(['error' => 'IDa baliogabea da. Zenbakia izan behar du.']);
                exit;
            }

            $sql = "SELECT * FROM taldeak WHERE id = " . (int)$id . " AND nobedadeak = 1";

            $row = $db->query($sql)->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                echo json_encode($row, JSON_UNESCAPED_UNICODE);
            } else {
                http_response_code(404);
                echo json_encode(['error' => 'ID horrek ez dau nobedadearik edo ez da existitzen.']);
            }
        }

        // --- Guztiak ---
        else {
            $sql = "SELECT * FROM taldeak WHERE nobedadeak = 1 ORDER BY id ASC";
            $result = $db->query($sql);

            $lista = [];
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $lista[] = $row;
            }

            echo json_encode($lista, JSON_UNESCAPED_UNICODE);
        }

    }


    // ============================================================
    //                          POST  (INSERT)
    // ============================================================
    elseif ($method === 'POST') {

        $input = json_decode(file_get_contents('php://input'), true);

        if (!$input || !isset($input['talde_izena']) || !isset($input['id_kategoria'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Beharrezko eremuak falta dira.']);
            exit;
        }

        $izena = $input['talde_izena'];
        $kat = (int)$input['id_kategoria'];
        $nobedadea = isset($input['nobedadeak']) ? (int)$input['nobedadeak'] : 1;

        $sql = "INSERT INTO taldeak (talde_izena, id_kategoria, nobedadeak)
                VALUES (:izena, :kat, :nobedadea)";

        $stmt = $db->prepare($sql);
        $ok = $stmt->execute([
            ':izena' => $izena,
            ':kat' => $kat,
            ':nobedadea' => $nobedadea
        ]);

        if ($ok) {
            echo json_encode(['message' => 'Nobedadea sortuta egon da.'], JSON_UNESCAPED_UNICODE);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Ezin izan da sortu.']);
        }
    }


    // ============================================================
    //                          PUT (UPDATE)
    // ============================================================
    elseif ($method === 'PUT') {

        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            http_response_code(400);
            echo json_encode(['error' => 'PUT egiteko IDa behar da.']);
            exit;
        }

        $id = (int)$_GET['id'];
        $input = json_decode(file_get_contents('php://input'), true);

        if (!$input) {
            http_response_code(400);
            echo json_encode(['error' => 'PUT datuak falta dira.']);
            exit;
        }

        $nobedadea = isset($input['nobedadeak']) ? (int)$input['nobedadeak'] : 0;

        $sql = "UPDATE taldeak SET nobedadeak = :nobedadea WHERE id = :id";

        $stmt = $db->prepare($sql);
        $ok = $stmt->execute([':nobedadea' => $nobedadea, ':id' => $id]);

        if ($ok) {
            echo json_encode(['message' => 'Nobedadea eguneratu da.']);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Ezin izan da eguneratu.']);
        }
    }


    // ============================================================
    //                          DELETE
    // ============================================================
    elseif ($method === 'DELETE') {

        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            http_response_code(400);
            echo json_encode(['error' => 'DELETE egiteko IDa behar da.']);
            exit;
        }

        $id = (int)$_GET['id'];

        $sql = "DELETE FROM taldeak WHERE id = :id AND nobedadeak = 1";
        $stmt = $db->prepare($sql);
        $ok = $stmt->execute([':id' => $id]);

        if ($ok && $stmt->rowCount() > 0) {
            echo json_encode(['message' => 'Nobedadea ezabatuta.']);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Ez da nobedadea aurkitu edo ezin da ezabatu.']);
        }
    }


} catch (Exception $e) {
    echo 'Errorea: ' . $e->getMessage();
}
?>
