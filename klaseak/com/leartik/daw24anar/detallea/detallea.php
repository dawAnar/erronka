<?php
namespace com\leartik\daw24anar\detallea;

class Detallea
{
    private $taldea;  // Taldea
    private $kopurua; // int

    public function __construct()
    {
    }

    public function setTaldea($taldea)
    {
        $this->taldea = $taldea;
    }

    public function getTaldea()
    {
        return $this->taldea;
    }

    public function setKopurua($kopurua)
    {
        $this->kopurua = (int)$kopurua;
    }

    public function getKopurua()
    {
        return $this->kopurua;
    }

    public function getGuztira()
    {
        if ($this->taldea == null) return 0;

        return $this->taldea->getPrezioa() * $this->kopurua;
    }
}
?>
