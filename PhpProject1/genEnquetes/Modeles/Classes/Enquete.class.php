<?php

/*
 * Auteur Laurent Cordier
 * Date de création : 10/04/2012
 * Date de dernière modification : 10/04/2012
 * 
 * Etat d'avancement : Termine
 */

class enquete {

    private $ID_ENQUETE;
    private $TITRE_ENQUETE;
    private $INTRODUCTION_ENQUETE;
    private $CONCLUSION_ENQUETE;

    function __construct($var) {
        if (is_array($var)) {
            $this->ID_ENQUETE = $ID_ENQUETE;
            $this->TITRE_ENQUETE = $TITRE_ENQUETE;
            $this->INTRODUCTION_ENQUETE = $INTRODUCTION_ENQUETE;
            $this->CONCLUSION_ENQUETE = $CONCLUSION_ENQUETE;
        } else if ($var !=""){
            $this->ID_ENQUETE = $var;
        }
        else {
            $this->ID_ENQUETE = "";
            $this->TITRE_ENQUETE = "";
            $this->INTRODUCTION_ENQUETE = "";
            $this->CONCLUSION_ENQUETE = "";
        }
    }
    public function getID_ENQUETE() {
        return $this->ID_ENQUETE;
    }

    public function setID_ENQUETE($ID_ENQUETE) {
        $this->ID_ENQUETE = $ID_ENQUETE;
    }

    public function getTITRE_ENQUETE() {
        return $this->TITRE_ENQUETE;
    }

    public function setTITRE_ENQUETE($TITRE_ENQUETE) {
        $this->TITRE_ENQUETE = $TITRE_ENQUETE;
    }

    public function getINTRODUCTION_ENQUETE() {
        return $this->INTRODUCTION_ENQUETE;
    }

    public function setINTRODUCTION_ENQUETE($INTRODUCTION_ENQUETE) {
        $this->INTRODUCTION_ENQUETE = $INTRODUCTION_ENQUETE;
    }

    public function getCONCLUSION_ENQUETE() {
        return $this->CONCLUSION_ENQUETE;
    }

    public function setCONCLUSION_ENQUETE($CONCLUSION_ENQUETE) {
        $this->CONCLUSION_ENQUETE = $CONCLUSION_ENQUETE;
    }
}

?>
