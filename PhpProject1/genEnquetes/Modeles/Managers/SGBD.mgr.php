<?php

/*
 * Auteur Laurent Cordier
 * Date de creation : 27/04/2012
 * Date de dernière modification : 04/05/2012
 *  * 
 * Etat d'avancement : Terminee
 */

/*
 * Connexion à la Base de donneees
 * Entree : 
 *   - adresse du serveur
 *   - nom utilisateur
 *   - password utilisateur
 *   - nom de la base
 */

class SGBD {

    private static $hote;
    private static $utilisateur;
    private static $password;
    private static $base;
    private static $db;
    private static $connectDB;

    /**
     * Contructeur d'objet 
     */
    function SGBD() {

        $this->hote = MY_HOST;
        $this->utilisateur = MY_USER;
        $this->password = MY_PASS;
        $this->base = MY_BASE;
        $this->db = "";
        $this->connectDB = "";
    }

    /**
     * Permet la connexion à la base de donnée à partir d'un objet SGBD
     * @param type $objSGBD
     * @return type
     * @throws Exception 
     */
    function connecterSGBD($objSGBD) {
        debogage('---------------------------<br/>');
        debogage('SGBD : connecterSGBD <br/>');
        $scriptAppelant = 'SGBD : connecterSGBD :> ';

        // Connexion à la base de donnees
        $hote = $objSGBD->hote;
        $utilisateur = $objSGBD->utilisateur;
        $password = $objSGBD->password;
        $base = $objSGBD->base;

        // Connexion au serveur

        debogage('SGBD : connecterSGBD : Connexion au serveur de bdd via mysql_connect : <br/>');
        $objSGBD->db = mysql_connect($hote, $utilisateur, $password);
        if ($objSGBD->db == 0) {
            $numErr = '1';
            $msgErr = 'Connxion au serveur de base de donnée impossible.';
            eventlog($scriptAppelant, $numErr, $msgErr);
        }

        // Selection de la base de donnees
        $db = $objSGBD->db;

        debogage('SGBD : connecterSGBD : Selection à la base via mysql_select : <br/>');
        $objSGBD->connectDB = mysql_select_db($base, $db);
        if (!mysql_select_db($base, $db)) {
            $numErr = '2';
            $msgErr = 'Impossible de selectionner la base de donnees';
            eventlog($scriptAppelant, $numErr, $msgErr);
        }


        // J'informe PHP que les donnees recuperees de la base sont en utf8        
        mysql_set_charset('utf8');
        // Je retourne l'objet instance de classe SGBD avec l'id de connexion à la base (db)
        // 

        debogage('SGBD : connecterSGBD : Etat de l objet SGBD avant retour de la fonction<br/>');
        //print_r($objSGBD);

        debogage('SGBD : connecterSGBD : Fin de connecterSGBD<br/>');
        return $objSGBD;
    }

    function getDB() {
        return $this->db;
    }

}

?>
