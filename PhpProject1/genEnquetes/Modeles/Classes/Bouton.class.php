<?php

/*
 * Auteur Laurent Cordier
 * Date de création : 03/04/2012
 * Date de dernière modification : 10/04/2012
 * 
 * Etat d'avancement : Termine
 */

class Bouton {

    private $ID_BOUTON;
    private $TYPE_BOUTON;
    private $VALUE_BOUTON;
    private $ACTION_BOUTON;
    private $NAME_BOUTON;

    /**
     * Classe Bouton : constructeur.
     * Si parametre d'entree est un tableau alors construction totale de l'objet 
     * s'il y a un 1 parametre, construction d'un objet avec son seul id
     * s'il n'y a pas de parametre alors construction d'un objet bouton vide.
     * @param type $var entree dans le constructeur. 
     */
    function __construct($var) {
        if (is_array($var)) {
            $this->setID_BOUTON($var['ID_BOUTON']);
            $this->setTYPE_BOUTON($var['TYPE_BOUTON']);
            $this->setVALUE_BOUTON($var['VALUE_BOUTON']);
            $this->setACTION_BOUTON($var['ACTION_BOUTON']);
            $this->setNAME_BOUTON($var['NAME_BOUTON']);
        } else if ($var != "") {

            $this->setID_BOUTON($var);
        } else {
            $this->setID_BOUTON("");
            $this->setTYPE_BOUTON("");
            $this->setVALUE_BOUTON("");
            $this->setACTION_BOUTON("");
            $this->setNAME_BOUTON("");
        }
    }

    /**
     *
     *              GETTERS/SETTERS
     *
     */
    public function getID_BOUTON() {
        return $this->ID_BOUTON;
    }

    public function setID_BOUTON($ID_BOUTON) {
        $this->ID_BOUTON = $ID_BOUTON;
    }

    public function getTYPE_BOUTON() {
        return $this->TYPE_BOUTON;
    }

    public function setTYPE_BOUTON($TYPE_BOUTON) {
        $this->TYPE_BOUTON = $TYPE_BOUTON;
    }

    public function getVALUE_BOUTON() {
        return $this->VALUE_BOUTON;
    }

    public function setVALUE_BOUTON($VALUE_BOUTON) {
        $this->VALUE_BOUTON = $VALUE_BOUTON;
    }

    public function getACTION_BOUTON() {
        return $this->ACTION_BOUTON;
    }

    public function setACTION_BOUTON($ACTION_BOUTON) {
        $this->ACTION_BOUTON = $ACTION_BOUTON;
    }

    public function getNAME_BOUTON() {
        return $this->NAME_BOUTON;
    }

    public function setNAME_BOUTON($NAME_BOUTON) {
        $this->NAME_BOUTON = $NAME_BOUTON;
    }

}

?>
