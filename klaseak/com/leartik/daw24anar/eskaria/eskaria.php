<?php
namespace com\leartik\daw24anar\eskaria;

class Eskaria
{
    private $id;        // int
    private $data;      // Date
    private $bezeroa;   // Bezeroa
    private $detalleak; // ArrayList<Detallea> (PHP: array)
    private $bidalita;  // int (0/1)

    public function __construct()
    {
        $this->detalleak = array();
        $this->bidalita = 0;
    }

    public function setId($id) { $this->id = (int)$id; }
    public function getId() { return $this->id; }

    public function setData($data) { $this->data = $data; }
    public function getData() { return $this->data; }

    public function setBezeroa($bezeroa) { $this->bezeroa = $bezeroa; }
    public function getBezeroa() { return $this->bezeroa; }

    public function setDetalleak($detalleak) { $this->detalleak = $detalleak; }
    public function getDetalleak() { return $this->detalleak; }

    // ✅ bidalita (checkbox)
    public function setBidalita($bidalita) { $this->bidalita = (int)$bidalita; }
    public function getBidalita() { return (int)$this->bidalita; }
}
?>
