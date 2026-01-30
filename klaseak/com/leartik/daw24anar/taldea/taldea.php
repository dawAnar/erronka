<?php
namespace com\leartik\daw24anar\taldea;

class Taldea
{
    private $id;
    private $id_kategoria;
    private $talde_izena;
    private $prezioa;
    private $deskontua;
    private $urteak_lehen_mailan;
    private $nobedadeak;
    private $eskaintzak;

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

    public function setIdKategoria($id_kategoria)
    {
        $this->id_kategoria = $id_kategoria;
    }

    public function getIdKategoria()
    {
        return $this->id_kategoria;
    }

    public function setTaldeIzena($talde_izena)
    {
        $this->talde_izena = $talde_izena;
    }

    public function getTaldeIzena()
    {
        return $this->talde_izena;
    }

    public function setPrezioa($prezioa)
    {
        $this->prezioa = $prezioa;
    }

    public function getPrezioa()
    {
        return $this->prezioa;
    }

    public function setDeskontua($deskontua)
    {
        $this->deskontua = $deskontua;
    }

    public function getDeskontua()
    {
        return $this->deskontua;
    }

    public function setUrteakLehenMailan($urteak_lehen_mailan)
    {
        $this->urteak_lehen_mailan = $urteak_lehen_mailan;
    }

    public function getUrteakLehenMailan()
    {
        return $this->urteak_lehen_mailan;
    }

    public function setNobedadeak($nobedadeak)
    {
        $this->nobedadeak = $nobedadeak;
    }

    public function getNobedadeak()
    {
        return $this->nobedadeak;
    }

    public function setEskaintzak($eskaintzak)
    {
        $this->eskaintzak = $eskaintzak;
    }

    public function getEskaintzak()
    {
        return $this->eskaintzak;
    }
}
?>