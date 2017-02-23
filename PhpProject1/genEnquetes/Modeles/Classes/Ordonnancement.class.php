<?php
/*
 * Auteur Laurent Cordier
 * Date de création : 10/04/2012
 * Date de dernière modification : 10/04/2012
 * 
 * Etat d'avancement : Termine
 */

class Ordonnancement {

    private $ID_ORD;
    private $NOM_TABLE_ORD;
    private $ID_TABLE_ORD;
    private $NUM_ORD;

    /**
     * Classe Ordonnancement : constructeur.
     * Si parametre d'entree est un tableau alors construction totale de l'objet 
     * s'il y a un 1 parametre, construction d'un objet avec son seul id
     * s'il n'y a pas de parametre alors construction d'un objet bouton vide.
     * @param type $var entree dans le constructeur. 
     */
    
    
    function Ordonnancement($var) {
        if (is_array($var)) {
            $this->setID_ORD($var['$ID_ORD']);
            $this->setNOM_TABLE_ORD($var['NOM_TABLE_ORD']);
            $this->setID_TABLE_ORD($var['ID_TABLE_ORD']);
            $this->setNUM_ORD($var['NUM_ORD']);
        } else if ($var != "") {
            $this->setID_ORD($var);
        } else {
            $this->setID_ORD("");
            $this->setNOM_TABLE_ORD("");
            $this->setID_TABLE_ORD("");
            $this->setNUM_ORD("");
        }
    }
    
    
    public function getID_ORD() {
        return $this->ID_ORD;
    }

    public function setID_ORD($ID_ORD) {
        $this->ID_ORD = $ID_ORD;
    }

    public function getNOM_TABLE_ORD() {
        return $this->NOM_TABLE_ORD;
    }

    public function setNOM_TABLE_ORD($NOM_TABLE_ORD) {
        $this->NOM_TABLE_ORD = $NOM_TABLE_ORD;
    }

    public function getID_TABLE_ORD() {
        return $this->ID_TABLE_ORD;
    }

    public function setID_TABLE_ORD($ID_TABLE_ORD) {
        $this->ID_TABLE_ORD = $ID_TABLE_ORD;
    }

    public function getNUM_ORD() {
        return $this->NUM_ORD;
    }

    public function setNUM_ORD($NUM_ORD) {
        $this->NUM_ORD = $NUM_ORD;
    }


}
?>
