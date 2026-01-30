<?php
namespace com\leartik\daw24anar\kategoria;
class Kategoria
{
    private $id;
    private $izenburua;
    private $deskribapena;

    public function __construct()
    {
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setIzenburua($izenburua)
    {
        $this->izenburua = $izenburua;
    }

    public function getIzenburua()
    {
        return $this->izenburua;
    }

    public function setDeskribapena($deskribapena)
    {
        $this->deskribapena = $deskribapena;
    }

    public function getDeskribapena()
    {
        return $this->deskribapena;
    }
}
?>
