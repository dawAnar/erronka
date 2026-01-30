<?php

try {
    $db = new PDO('sqlite:../../denda.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // ------------------------------------------------------
    // ========================= GET =========================
    // ------------------------------------------------------
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {

        // === GET ONE ===
        if (isset($_GET['id'])) {

            $id = $_GET['id'];

            if (!is_numeric($id)) {
                http_response_code(400);
                echo json_encode(['error' => 'IDa baliogabea da. Zenbakia izan behar du.']);
                exit;
            }

            $sql = "SELECT * FROM kategoriak WHERE id = " . (int)$id;
            $erregistroa = $db->query($sql)->fetch(PDO::FETCH_ASSOC);

            if ($erregistroa) {
                echo json_encode($erregistroa, JSON_UNESCAPED_UNICODE);
            } else {
                http_response_code(404);
                echo json_encode(['error' => 'Ez da aurkitu ' . $id . ' IDa duen kategoriarik.']);
            }

        }

        // === GET ALL ===
        else {
            $sql = "SELECT * FROM kategoriak ORDER BY id DESC";
            $stmt = $db->query($sql);

            $kategoriak = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $kategoriak[] = $row;
            }

            echo json_encode($kategoriak, JSON_UNESCAPED_UNICODE);
        }
    }

    // ------------------------------------------------------
    // ======================== POST =========================
    // ------------------------------------------------------
    elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $body = json_decode(file_get_contents("php://input"), true);

        if (!$body || empty($body['izenburua']) || empty($body['deskribapena'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Izenburua eta deskribapena derrigorrezkoak dira.']);
            exit;
        }

        $sql = $db->prepare("
            INSERT INTO kategoriak (izenburua, deskribapena)
            VALUES (:izena, :desk)
        ");

        $ok = $sql->execute([
            ":izena" => $body['izenburua'],
            ":desk"  => $body['deskribapena']
        ]);

        if ($ok) {
            echo json_encode(['mezua' => 'Kategoria sortu da'], JSON_UNESCAPED_UNICODE);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Ezin izan da kategoria sortu.']);
        }
    }

    // ------------------------------------------------------
    // ========================= PUT =========================
    // ------------------------------------------------------
    elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {

        if (!isset($_GET['id'])) {
            http_response_code(400);
            echo json_encode(['error' => 'PUT egiteko IDa beharrezkoa da.']);
            exit;
        }

        $id = $_GET['id'];

        if (!is_numeric($id)) {
            http_response_code(400);
            echo json_encode(['error' => 'ID baliogabea.']);
            exit;
        }

        $body = json_decode(file_get_contents("php://input"), true);

        if (!$body || empty($body['izenburua']) || empty($body['deskribapena'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Izenburua eta deskribapena derrigorrezkoak dira.']);
            exit;
        }

        $sql = $db->prepare("
            UPDATE kategoriak 
            SET izenburua = :iz, deskribapena = :des
            WHERE id = :id
        ");

        $ok = $sql->execute([
            ":iz"  => $body['izenburua'],
            ":des" => $body['deskribapena'],
            ":id"  => (int)$id
        ]);

        if ($ok) {
            echo json_encode(['mezua' => 'Kategoria eguneratuta'], JSON_UNESCAPED_UNICODE);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Ezin izan da kategoria eguneratu.']);
        }
    }

    // ------------------------------------------------------
    // ======================= DELETE ========================
    // ------------------------------------------------------
    elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {

        if (!isset($_GET['id'])) {
            http_response_code(400);
            echo json_encode(['error' => 'DELETE egiteko IDa beharrezkoa da.']);
            exit;
        }

        $id = $_GET['id'];

        if (!is_numeric($id)) {
            http_response_code(400);
            echo json_encode(['error' => 'ID baliogabea.']);
            exit;
        }

        $sql = $db->prepare("DELETE FROM kategoriak WHERE id = :id");
        $ok = $sql->execute([":id" => (int)$id]);

        if ($ok) {
            echo json_encode(['mezua' => 'Kategoria ezabatu da'], JSON_UNESCAPED_UNICODE);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Ezin izan da kategoria ezabatu.']);
        }
    }

} catch (Exception $e) {
    echo 'Errorea: ' . $e->getMessage();
}

?>
