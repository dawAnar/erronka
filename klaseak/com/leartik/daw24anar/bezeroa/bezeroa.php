<?php
namespace com\leartik\daw24anar\bezeroa;

class Bezeroa
{
    private $izena;
    private $abizena;
    private $helbidea;
    private $herria;
    private $postaKodea;
    private $probintzia;
    private $emaila;

    public function __construct()
    {
    }

    public function setIzena($izena) { $this->izena = $izena; }
    public function getIzena() { return $this->izena; }

    public function setAbizena($abizena) { $this->abizena = $abizena; }
    public function getAbizena() { return $this->abizena; }

    public function setHelbidea($helbidea) { $this->helbidea = $helbidea; }
    public function getHelbidea() { return $this->helbidea; }

    public function setHerria($herria) { $this->herria = $herria; }
    public function getHerria() { return $this->herria; }

    public function setPostaKodea($postaKodea) { $this->postaKodea = $postaKodea; }
    public function getPostaKodea() { return $this->postaKodea; }

    public function setProbintzia($probintzia) { $this->probintzia = $probintzia; }
    public function getProbintzia() { return $this->probintzia; }

    public function setEmaila($emaila) { $this->emaila = $emaila; }
    public function getEmaila() { return $this->emaila; }

    // alias por si en algún sitio usas Email en vez de Emaila
    public function setEmail($email) { $this->emaila = $email; }
    public function getEmail() { return $this->emaila; }
}
?>
