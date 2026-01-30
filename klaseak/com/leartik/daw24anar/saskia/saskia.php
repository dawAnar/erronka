<?php
namespace com\leartik\daw24anar\saskia;

class Saskia
{
    private $detaileak;

    public function __construct()
    {
        $this->detaileak = array();
    }

    public function setDetaileak($detaileak)
    {
        $this->detaileak = $detaileak;
    }

    public function getDetaileak()
    {
        return $this->detaileak;
    }

    public function detaileaGehitu($detallea)
    {
        $this->detaileak[] = $detallea;
    }

    /**
     * Eguneratu detailea by index (aldatu kopurua)
     * @param int $index
     * @param int $kopurua
     */
    public function detaileaAldatu($index, $kopurua)
    {
        if (isset($this->detaileak[$index])) {
            $this->detaileak[$index]->setKopurua((int)$kopurua);
        }
    }

    /**
     * Ezabatu detailea by index
     * @param int $index
     */
    public function detaileaEzabatu($index)
    {
        if (isset($this->detaileak[$index])) {
            array_splice($this->detaileak, $index, 1);
        }
    }
}
?>
