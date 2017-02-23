<?php

/*
 * Toutes les classe utilisé comme des managers doivent utilisé une connexion
 * à la base de données.
 * Ainsi je crée une classe manager qui rendra cette fonctionnalité disponible 
 * à toute les sous-classe de type manager
 * 
 */

include_once "Modeles/Managers/SGBD.mgr.php";

class Manager{
    
    private $db;
    
    function Manager(){
        // Connexion à la base de données
        $connect = new SGBD();
        $connect = $connect->connecterSGBD($connect);

        // Récupération de l'ID de connexion à la base
         $this->setDb($connect->getDB());
    }
    public function getDb() {
        return $this->db;
    }

    public function setDb($db) {
        $this->db = $db;
    }
}
?>
