<?php

/*
 * Auteur Laurent Cordier
 * Date de création : 21/05/2012
 * Date de dernière modification : 21/05/2012
 * 
 * Etat d'avancement : Termine
 */

class Utilisateur {

    private $ID_UTIL;
    private $NOM_UTIL;
    private $PRENOM_UTIL;
    private $LOGIN_UTIL;
    private $PASS_UTIL;

    function __construct($var) {
        if (is_array($var)) {
            $this->setID_UTIL($var['ID_UTIL']);
            $this->setNOM_UTIL($var['NOM_UTIL']);
            $this->setPRENOM_UTIL($var['PRENOM_UTIL']);
            $this->setLOGIN_UTIL($var['LOGIN_UTIL']);
            $this->setPASS_UTIL($var['PASS_UTIL']);
        } else if ($var != "") {
            $this->setID_UTIL($var);
        } else {
            $this->ID_UTIL = "";
            $this->NOM_UTIL = "";
            $this->PRENOM_UTIL = "";
            $this->LOGIN_UTIL = "";
            $this->PASS_UTIL = "";
        }
    }

    public function getID_UTIL() {
        return $this->ID_UTIL;
    }

    public function setID_UTIL($ID_UTIL) {
        $this->ID_UTIL = $ID_UTIL;
    }

    public function getNOM_UTIL() {
        return $this->NOM_UTIL;
    }

    public function setNOM_UTIL($NOM_UTIL) {
        $this->NOM_UTIL = $NOM_UTIL;
    }

    public function getPRENOM_UTIL() {
        return $this->PRENOM_UTIL;
    }

    public function setPRENOM_UTIL($PRENOM_UTIL) {
        $this->PRENOM_UTIL = $PRENOM_UTIL;
    }

    public function getLOGIN_UTIL() {
        return $this->LOGIN_UTIL;
    }

    public function setLOGIN_UTIL($LOGIN_UTIL) {
        $this->LOGIN_UTIL = $LOGIN_UTIL;
    }

    public function getPASS_UTIL() {
        return $this->PASS_UTIL;
    }

    public function setPASS_UTIL($PASS_UTIL) {
        $this->PASS_UTIL = $PASS_UTIL;
    }

}

?>
