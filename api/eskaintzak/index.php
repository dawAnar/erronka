<?php
try {
    $dbPath = __DIR__ . '/../../denda.db';
    $db = new PDO('sqlite:' . $dbPath);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $method = $_SERVER['REQUEST_METHOD'];

    // ----------------------------------------------------
    //                     GET
    // ----------------------------------------------------
    if ($method === 'GET') {

        // === ID BAKARRA ===
        if (isset($_GET['id'])) {

            $id = $_GET['id'];

            if (!is_numeric($id)) {
                http_response_code(400);
                echo json_encode(['error' => 'IDa baliogabea da. Zenbakia izan behar du.']);
                exit;
            }

            $sql = "SELECT * FROM taldeak WHERE id = " . (int)$id . " AND eskaintzak = 1";
            $row = $db->query($sql)->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                echo json_encode($row, JSON_UNESCAPED_UNICODE);
            } else {
                http_response_code(404);
                echo json_encode(['error' => 'ID horrek ez dau eskaintzarik edo ez da existitzen.']);
            }
        }

        // === DENAK ===
        else {
            $sql = "SELECT * FROM taldeak WHERE eskaintzak = 1 ORDER BY id ASC";
            $result = $db->query($sql);

            $lista = [];
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $lista[] = $row;
            }

            echo json_encode($lista, JSON_UNESCAPED_UNICODE);
        }
    }

    // ----------------------------------------------------
    //                     POST
    // ----------------------------------------------------
    else if ($method === 'POST') {

        // JSON irakurri
        $data = json_decode(file_get_contents('php://input'), true);

        if (!$data) {
            http_response_code(400);
            echo json_encode(['error' => 'JSON baliogabea']);
            exit;
        }

        // balidazio minimoa
        if (!isset($data['talde_izena'], $data['id_kategoria'], $data['prezioa'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Beharrezko datuak falta dira']);
            exit;
        }

        // eskaintzak = 1 derrigorrez
        $sql = "INSERT INTO taldeak (id_kategoria, talde_izena, prezioa, deskontua, urteak_lehen_mailan, nobedadeak, eskaintzak)
                VALUES (?, ?, ?, ?, ?, ?, 1)";

        $stmt = $db->prepare($sql);
        $ok = $stmt->execute([
            $data['id_kategoria'],
            $data['talde_izena'],
            $data['prezioa'],
            $data['deskontua'] ?? 0,
            $data['urteak_lehen_mailan'] ?? 0,
            $data['nobedadeak'] ?? 0
        ]);

        if ($ok) {
            echo json_encode(['msg' => 'Eskaintzan dagoen taldea sortu da', 'id' => $db->lastInsertId()]);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Ezin izan da taldea sortu']);
        }
    }

    // ----------------------------------------------------
    //                     PUT
    // ----------------------------------------------------
    else if ($method === 'PUT') {

        parse_str($_SERVER['QUERY_STRING'], $params);

        if (!isset($params['id']) || !is_numeric($params['id'])) {
            http_response_code(400);
            echo json_encode(['error' => 'ID baliozkoa jarri behar da']);
            exit;
        }

        $id = (int)$params['id'];

        // Egiaztatu talde hau eskaintzan dagoela
        $check = $db->query("SELECT * FROM taldeak WHERE id=$id AND eskaintzak=1")->fetch();

        if (!$check) {
            http_response_code(404);
            echo json_encode(['error' => 'Taldea ez dago eskaintzan edo ez existitzen']);
            exit;
        }

        // PUT datuak
        $data = json_decode(file_get_contents('php://input'), true);

        if (!$data) {
            http_response_code(400);
            echo json_encode(['error' => 'JSON baliogabea']);
            exit;
        }

        $sql = "UPDATE taldeak SET 
                    talde_izena = ?, 
                    prezioa = ?, 
                    deskontua = ?, 
                    urteak_lehen_mailan = ?, 
                    nobedadeak = ?
                WHERE id = ? AND eskaintzak = 1";

        $stmt = $db->prepare($sql);
        $ok = $stmt->execute([
            $data['talde_izena'] ?? $check['talde_izena'],
            $data['prezioa'] ?? $check['prezioa'],
            $data['deskontua'] ?? $check['deskontua'],
            $data['urteak_lehen_mailan'] ?? $check['urteak_lehen_mailan'],
            $data['nobedadeak'] ?? $check['nobedadeak'],
            $id
        ]);

        if ($ok) {
            echo json_encode(['msg' => 'Eskaintzako taldea eguneratu da']);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Ezin izan da eguneratu']);
        }
    }

    // ----------------------------------------------------
    //                     DELETE
    // ----------------------------------------------------
    else if ($method === 'DELETE') {

        parse_str($_SERVER['QUERY_STRING'], $params);

        if (!isset($params['id']) || !is_numeric($params['id'])) {
            http_response_code(400);
            echo json_encode(['error' => 'ID baliozkoa behar da']);
            exit;
        }

        $id = (int)$params['id'];

        // Egiaztatu eskaintzan dagoela
        $check = $db->query("SELECT * FROM taldeak WHERE id=$id AND eskaintzak=1")->fetch();

        if (!$check) {
            http_response_code(404);
            echo json_encode(['error' => 'Eskaintzan ez dagoen taldea ezin da ezabatu']);
            exit;
        }

        $ok = $db->exec("DELETE FROM taldeak WHERE id=$id AND eskaintzak=1");

        if ($ok) {
            echo json_encode(['msg' => 'Eskaintzan zegoen taldea ezabatu da']);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Ezin izan da ezabatu']);
        }
    }

    // ----------------------------------------------------

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Errorea: ' . $e->getMessage()]);
}
?>
