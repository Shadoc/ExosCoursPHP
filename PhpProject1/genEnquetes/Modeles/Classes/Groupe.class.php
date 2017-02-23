<?php

/*
 * Auteur Laurent Cordier
 * Date de création : 22/05/2012
 * Date de dernière modification : 22/05/2012
 * 
 * Etat d'avancement : Termine
 */

class Groupe {

    private $ID_GROUPE;
    private $NOM_GROUPE;
    private $DESCRIPTION_GROUPE;

    function __construct($var) {
        if (is_array($var)) {
            $this->setID_GROUPE($var['ID_GROUPE']);
            $this->setNOM_GROUPE($var['NOM_GROUPE']);
            $this->setDESCRIPTION_GROUPE($var['DESCRIPTION_GROUPE']);
        } else if ($var != "") {
            $this->setID_GROUPE($var);
        } else {
            $this->ID_GROUPE = "";
            $this->NOM_GROUPE = "";
            $this->DESCRIPTION_GROUPE = "";
        }
    }
    
    public function getID_GROUPE() {
        return $this->ID_GROUPE;
    }

    public function setID_GROUPE($ID_GROUPE) {
        $this->ID_GROUPE = $ID_GROUPE;
    }

    public function getNOM_GROUPE() {
        return $this->NOM_GROUPE;
    }

    public function setNOM_GROUPE($NOM_GROUPE) {
        $this->NOM_GROUPE = $NOM_GROUPE;
    }

    public function getDESCRIPTION_GROUPE() {
        return $this->DESCRIPTION_GROUPE;
    }

    public function setDESCRIPTION_GROUPE($DESCRIPTION_GROUPE) {
        $this->DESCRIPTION_GROUPE = $DESCRIPTION_GROUPE;
    }


}
?>
