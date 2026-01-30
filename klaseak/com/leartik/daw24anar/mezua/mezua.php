<?php
namespace com\leartik\daw24anar\mezua;

class Mezua
{
    private $id;
    private $izena;
    private $email;
    private $mezua;
    private $sortze_data;

    // ➕ CAMPO NUEVO
    private $erantzunda;

    public function __construct() {}

    // === ID ===
    public function setId($id) { $this->id = $id; }
    public function getId() { return $this->id; }

    // === IZENA ===
    public function setIzena($izena) { $this->izena = $izena; }
    public function getIzena() { return $this->izena; }

    // === EMAIL ===
    public function setEmail($email) { $this->email = $email; }
    public function getEmail() { return $this->email; }

    // === MEZUA ===
    public function setMezua($mezua) { $this->mezua = $mezua; }
    public function getMezua() { return $this->mezua; }

    // === SORTZE DATA (TIMESTAMP) ===
    public function setSortzeData($sortze_data) { $this->sortze_data = $sortze_data; }
    public function getSortzeData() { return $this->sortze_data; }

    // === ➕ ERANTZUNDA (0/1) ===
    public function setErantzunda($erantzunda) { $this->erantzunda = $erantzunda; }
    public function getErantzunda() { return $this->erantzunda; }
}
?>
