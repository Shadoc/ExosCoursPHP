<?php

class ZoneTexte {

    private $ID_ZONETEXTE;
    private $TEXTE_ZONETEXTE;
    private $NBCOL_ZONETEXTE;
    private $NBLIG_ZONETEXTE;
    private $LIBELLE_ZONETEXTE;

    function __construct($var) {
        if (is_array($var)) {
            $this->setID_ZONETEXTE($var['ID_ZONETEXTE']);
            $this->setTEXTE_ZONETEXTE($var['TEXTE_ZONETEXTE']);
            $this->setNBCOL_ZONETEXTE($var['NBCOL_ZONETEXTE']);
            $this->setNBLIG_ZONETEXTE($var['NBLIG_ZONETEXTE']);
            $this->setLIBELLE_ZONETEXTE($var['LIBELLE_ZONETEXTE']);
        } else if ($var != "") {

            $this->setID_ZONETEXTE($var);
        } else {
            $this->setID_ZONETEXTE("");
            $this->setTEXTE_ZONETEXTE("");
            $this->setNBCOL_ZONETEXTE("");
            $this->setNBLIG_ZONETEXTE("");
            $this->setLIBELLE_ZONETEXTE("");
        }
    }

    public function getID_ZONETEXTE() {
        return $this->ID_ZONETEXTE;
    }

    public function setID_ZONETEXTE($ID_ZONETEXTE) {
        $this->ID_ZONETEXTE = $ID_ZONETEXTE;
    }

    public function getTEXTE_ZONETEXTE() {
        return $this->TEXTE_ZONETEXTE;
    }

    public function setTEXTE_ZONETEXTE($TEXTE_ZONETEXTE) {
        $this->TEXTE_ZONETEXTE = $TEXTE_ZONETEXTE;
    }

    public function getNBCOL_ZONETEXTE() {
        return $this->NBCOL_ZONETEXTE;
    }

    public function setNBCOL_ZONETEXTE($NBCOL_ZONETEXTE) {
        $this->NBCOL_ZONETEXTE = $NBCOL_ZONETEXTE;
    }

    public function getNBLIG_ZONETEXTE() {
        return $this->NBLIG_ZONETEXTE;
    }

    public function setNBLIG_ZONETEXTE($NBLIG_ZONETEXTE) {
        $this->NBLIG_ZONETEXTE = $NBLIG_ZONETEXTE;
    }

    public function getLIBELLE_ZONETEXTE() {
        return $this->LIBELLE_ZONETEXTE;
    }

    public function setLIBELLE_ZONETEXTE($LIBELLE_ZONETEXTE) {
        $this->LIBELLE_ZONETEXTE = $LIBELLE_ZONETEXTE;
    }

}

?>
