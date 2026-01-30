<?php
header("Content-Type: application/json; charset=UTF-8");

try {
    $dbPath = __DIR__ . '/../../denda.db';
    $db = new PDO('sqlite:' . $dbPath);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $method = $_SERVER['REQUEST_METHOD'];

    /* ===== GET ===== */
    if ($method === 'GET') {

        if (isset($_GET['id'])) {

            $id = $_GET['id'];

            if (!is_numeric($id)) {
                http_response_code(400);
                echo json_encode(['error' => 'ID baliogabea.']);
                exit;
            }

            $sql = "SELECT * FROM mezuak WHERE id = $id";
            $row = $db->query($sql)->fetch(PDO::FETCH_ASSOC);

            if (!$row) {
                http_response_code(404);
                echo json_encode(['error' => 'Ez da aurkitu mezurik ID horrekin.']);
                exit;
            }

            echo json_encode($row, JSON_UNESCAPED_UNICODE);
            exit;
        }

        $sql = "SELECT * FROM mezuak ORDER BY id DESC";
        $r = $db->query($sql);

        $out = [];
        while ($row = $r->fetch(PDO::FETCH_ASSOC)) {
            $out[] = $row;
        }

        echo json_encode($out, JSON_UNESCAPED_UNICODE);
        exit;
    }

    /* ===== POST ===== */
    if ($method === 'POST') {

        $json = json_decode(file_get_contents("php://input"), true);

        if (!isset($json['izena']) || !isset($json['email']) || !isset($json['mezua'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Eremu guztiak derrigorrezkoak dira.']);
            exit;
        }

        $sql = "INSERT INTO mezuak (izena, email, mezua, erantzunda)
                VALUES (:izena, :email, :mezua, 0)";
        $st = $db->prepare($sql);
        $st->execute([
            ':izena' => $json['izena'],
            ':email' => $json['email'],
            ':mezua' => $json['mezua']
        ]);

        echo json_encode(['msg' => 'Mezua sortuta', 'id' => $db->lastInsertId()]);
        exit;
    }

    /* ===== PUT ===== */
    if ($method === 'PUT') {

        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            http_response_code(400);
            echo json_encode(['error' => 'PUT egiteko ID behar da.']);
            exit;
        }

        $json = json_decode(file_get_contents("php://input"), true);
        $id = (int) $_GET['id'];

        $sql = "UPDATE mezuak SET 
                    izena = :iz, 
                    email = :em, 
                    mezua = :me, 
                    erantzunda = :er
                WHERE id = :id";

        $st = $db->prepare($sql);
        $st->execute([
            ':iz' => $json['izena'] ?? null,
            ':em' => $json['email'] ?? null,
            ':me' => $json['mezua'] ?? null,
            ':er' => $json['erantzunda'] ?? 0,
            ':id' => $id
        ]);

        echo json_encode(['msg' => 'Mezua eguneratua']);
        exit;
    }

    /* ===== DELETE ===== */
    if ($method === 'DELETE') {

        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            http_response_code(400);
            echo json_encode(['error' => 'DELETE egiteko ID behar da.']);
            exit;
        }

        $id = (int) $_GET['id'];

        $sql = "DELETE FROM mezuak WHERE id = :id";
        $st = $db->prepare($sql);
        $st->execute([':id' => $id]);

        echo json_encode(['msg' => 'Mezua ezabatua']);
        exit;
    }

} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
