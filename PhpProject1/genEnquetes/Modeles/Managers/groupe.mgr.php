<?php

/*
 * Auteur Laurent Cordier
 * Date de création : 22/04/2012
 * Date de dernière modification : 22/05/2012
 * 
 * Etat d'avancement : En cours de realisation
 * 1. add : ok
 * 2. mod : en cours
 * 3. del : en cours
 * 4. get : ok
 */

class groupeMgr {

    // Entete des messages d'erreur correspondant au script :
    private $nomScript;

    // tous les boutonMgr on besoin d'une connexion à la base de donnée.
    function groupeMgr() {
        $this->nomScript = "Modele:Managers:groupe.mgr.php:>";
        debogage('------------------------<br/>');
        debogage('groupeMgr : Appel Constructeur groupeMgr<br/>');
    }

    /**
     * Ajoute un objet Groupe à la table GROUPE
     * Retourne un objet groupe si transaction ok sinon null
     * @param Groupe $groupe
     * @return \Groupe ou null
     */
    function addGroupe(Groupe $groupe) {
        // ----------------------------------------------------------------
        // 
        //                  I. Prérequis :
        //                  
        // ----------------------------------------------------------------
        // ----------------------------------------------------------------
        //  I.1. Préparation des paramètres de débogages et initialisation 
        //       des variables
        // ----------------------------------------------------------------
        debogage('------------------------<br/>');
        debogage('GroupeMgr : getGroupe:<br/>');
        $retour = null;
        $scriptAppelant = $this->nomScript;
        $numFonction = 1;
        $objGroupe = new Groupe;

        // ----------------------------------------------------------------
        //  I.2. Connexion à la base de données
        // ----------------------------------------------------------------
        $connect = new SGBD();
        $connect = $connect->connecterSGBD($connect);

        // Récupération de l'ID de connexion à la base
        $db = $connect->getDB();


        // ----------------------------------------------------------------
        //  I.3. Récupération des paramètres d'entrée
        // ----------------------------------------------------------------
        // I.3.1 Si l'argument est un objet Groupe
        if (is_a($groupe, "Groupe")) {
            // I.3.1.2 Récupérer les donnees membre  de l'objet
            $DESCRIPTION_GROUPE = $groupe->getDESCRIPTION_GROUPE();
            $NOM_GROUPE = $groupe->getNOM_GROUPE();
        }

        // I.3.4 Sinon c'est une erreur
        else {
            // I.3.4.1 : Préparer le message d'erreur
            $msgErr = "L'argument de la méthode est invalide.";
            // I.3.4.2 : Affecter un numéro d'erreur
            $numErr = $numFonction . "-I.3.4-";
            // I.3.4.3 : Loguer l'événement
            eventlog($scriptAppelant, $numErr, $msgErr);
            // I.3.4.4 : Appeler la fonction de debogage
            debogage($scriptAppelant, $numErr, $msgErr);
            // I.3.4.5 : Renvoyer l'utilisateur sur la page d'erreur  
            header('Location: index.php?page=erreur&err=1');
        }
        // ----------------------------------------------------------------
        // I.4 Sécuriser ce qui sera utilisé en injection SQL
        // ----------------------------------------------------------------
        $NOM_GROUPE = securiserSQL($NOM_GROUPE);
        $DESCRIPTION_GROUPE = securiserSQL($DESCRIPTION_GROUPE);

        // ----------------------------------------------------------------
        // II Ajouter le groupe dans la table GROUPE
        // ----------------------------------------------------------------
        // II.1 Ecriture de la requete  d'ajout du bouton
        $sql = "insert into GROUPE (NOM_GROUPE ,DESCRIPTION_GROUPE) values ('" . $NOM_GROUPE . "','" . $DESCRIPTION_GROUPE . "');";

        // II.2 Envoie de la requete à la base.
        $retour = injecterSQL($scriptAppelant, $numFonction, $sql, $db);


        // II.3 S'il n'y a pas d'erreur
        if ($retour == true) {
            // II.3.1 je récupere le dernier id créé par mysql que j'affecte à l'id de mon bouton
            $ID_GROUPE = mysql_insert_id();

            // II.3.2 J'affecte l'ID de mon objet Groupe
            $objGroupe->setID_GROUPE($ID_GROUPE);

            // II.3.3 J'affecte cet objet Groupe à mon retour
            $retour = $objGroupe;
            // II.4 Sinon je logue l'erreur    
        } else {
            // I.3.4.1 : Préparer le message d'erreur
            $msgErr = "L'ajout de l'objet Bouton dans la table BOUTON a echoue. La requete sql était : . $sql;";
            // I.3.4.2 : Affecter un numéro d'erreur
            $numErr = $numFonction . "-I.4-";
            // I.3.4.3 : Loguer l'événement
            eventlog($scriptAppelant, $numErr, $msgErr);
            // I.3.4.4 : Appeler la fonction de debogage
            debogage($scriptAppelant, $numErr, $msgErr);
            // I.3.4.5 : Renvoyer l'utilisateur sur la page d'erreur  
            header('Location: index.php?page=erreur&err=1');
        }
        return $retour;
    }

    function modGroupe(Groupe $groupe) {
        // ----------------------------------------------------------------
        // 
        //                  I. Prérequis :
        //                  
        // ----------------------------------------------------------------
        // ----------------------------------------------------------------
        //  I.1. Préparation des paramètres de débogages et initialisation 
        //       des variables
        // ----------------------------------------------------------------
        debogage('------------------------<br/>');
        debogage('GroupeMgr : modGroupe:<br/>');
        $retour = null;
        $scriptAppelant = $this->nomScript;
        $numFonction = 2;
        $objGroupe = new Groupe;

        // ----------------------------------------------------------------
        //  I.2. Connexion à la base de données
        // ----------------------------------------------------------------
        $connect = new SGBD();
        $connect = $connect->connecterSGBD($connect);

        // Récupération de l'ID de connexion à la base
        $db = $connect->getDB();


        // ----------------------------------------------------------------
        //  I.3. Récupération des paramètres d'entrée
        // ----------------------------------------------------------------
        // I.3.1 Si l'argument est un objet Groupe et que l'ID groupe 
        //       n'est pas vide
        if (is_a($groupe, "Groupe") && $param->getID_GROUPE() != "") {
            // I.3.1.2 Récupérer les données membres de l'objet
            $ID_GROUPE = $groupe->getID_GROUPE();
            $NOM_GROUPE = $groupe->getNOM_GROUPE();
            $DESCRIPTION_GROUPE = $groupe->setDESCRIPTION_GROUPE($DESCRIPTION_GROUPE);

            // I.3.1.2 : Affecter un numéro d'erreur
            $numErr = $numFonction . "-I.3.1-";
        }
        // I.3.2 Sinon c'est une erreur
        else {
            // I.3.2.1 : Préparer le message d'erreur
            $msgErr = "L'argument de la méthode est invalide.";
            // I.3.2.2 : Loguer l'événement
            eventlog($scriptAppelant, $numErr, $msgErr);
            // I.3.2.3 : Appeler la fonction de debogage
            debogage($scriptAppelant, $numErr, $msgErr);
            // I.3.2.4 : Renvoyer l'utilisateur sur la page d'erreur  
            header('Location: index.php?page=erreur&err=1');
        }

        // ----------------------------------------------------------------
        //  I.4 Sécuriser les données
        // ----------------------------------------------------------------
        $ID_GROUPE = securiserSQL($ID_GROUPE);
        $NOM_GROUPE = securiserSQL($NOM_GROUPE);
        $DESCRIPTION_GROUPE = securiserSQL($DESCRIPTION_GROUPE);

        // ----------------------------------------------------------------
        //  II Modifier l'enregistrement correspondant à l'objet dans la base
        // ----------------------------------------------------------------        
        // II.1 Préparer la requête
        $sql = "update GROUPE set ID_GROUPE='" . $ID_GROUPE . "',
                NOM_GROUPE='" . $NOM_GROUPE . "', 
                DESCRIPTION_GROUPE='" . $DESCRIPTION_GROUPE . "' 
                where ID_GROUPE=" . $ID_GROUPE . " ;";
        // II.2 Injecter la requête via la fonction injecterSQL
        injecterSQL($scriptAppelant, $numFontion, $sql, $db);
    }

    function delGroupe() {
        
    }

    /**
     * Permet de récupérer les informations d'un groupe.
     * @param type $param Objet Groupe ou numérique
     * @return \Groupe ou null
     */
    function getGroupe($param) {
        // ----------------------------------------------------------------
        // README Driven Developement
        // ==========================
        // 
        // I. Prérequis :
        //  I.1. Préparation des paramètres de débogages et initialisation des 
        //       variables
        //  I.2. Connexion à la base de données
        //  I.3. Récupération des paramètres d'entrée
        //    I.3.1 Si l'argument est un objet Groupe et que l'ID groupe 
        //          n'est pas vide
        //      I.3.1.1 Récupérer l'ID_GROUPE de l'objet
        //      I.3.1.2 : Affecter un numéro d'erreur
        //  I.3.2 Sinon si j'ai un argument en entrée qui est un numérique
        //      I.3.2.1 : Affecter le numérique à l'ID_GROUPE
        //      I.3.2.2 : Affecter un numéro d'erreur
        //  I.3.4 Sinon c'est une erreur
        //      I.3.4.1 : Préparer le message d'erreur
        //      I.3.4.2 : Loguer l'événement
        //      I.3.4.3 : Appeler la fonction de debogage
        //      I.3.4.4 : Renvoyer l'utilisateur sur la page d'erreur  
        // 
        // I.4 Sécuriser ce qui sera utilisé en injection SQL
        // 
        // 
        // II. Récupérer les informations concernant le groupe dans la BDD
        //  II.1 Préparer la requête SQL
        //  II.2 Injecter la requête dans la base
        //  II.3 Si erreur de requete (le résulat est 0)
        //    II.3.1 : Préparer le message d'erreur
        //    II.3.2 : Affecter un numéro d'erreur
        //    II.3.3 : Loguer l'événement
        //    II.3.4 : Appeler la fonction de debogage
        //    II.3.5 : Renvoyer l'utilisateur sur la page d'erreur  
        //  II.4 Sinon s'il existe un groupe correspondant à cet ID
        //  II.4.1 Récupérer les données et les affecter aux données membre
        //  II.4.2 Renvoyer l'objet Groupe correspondant
        //  II.5 sinon renvoyer null
        //  
        // ----------------------------------------------------------------
        // 
        //                  I. Prérequis :
        //                  
        // ----------------------------------------------------------------
        // ----------------------------------------------------------------
        //  I.1. Préparation des paramètres de débogages et initialisation 
        //       des variables
        // ----------------------------------------------------------------
        debogage('------------------------<br/>');
        debogage('GroupeMgr : getGroupe:<br/>');
        $retour = null;
        $scriptAppelant = $this->nomScript;
        $numFonction = 4;
        $objGroupe = new Groupe;

        // ----------------------------------------------------------------
        //  I.2. Connexion à la base de données
        // ----------------------------------------------------------------
        $connect = new SGBD();
        $connect = $connect->connecterSGBD($connect);

        // Récupération de l'ID de connexion à la base
        $db = $connect->getDB();


        // ----------------------------------------------------------------
        //  I.3. Récupération des paramètres d'entrée
        // ----------------------------------------------------------------
        $numArg = func_num_args();
        $argument01 = $numArg[0];


        // I.3.1 Si l'argument est un objet Groupe et que l'ID groupe 
        //       n'est pas vide
        if (is_a($param, "Groupe") && $param->getID_GROUPE() != "") {
            // I.3.1.2 Récupérer l'ID_GROUPE de l'objet
            $ID_GROUPE = $param->getID_GROUPE();
            // I.3.1.2 : Affecter un numéro d'erreur
            $numErr = $numFonction . "-I.3.1-";
        }
        // I.3.2 Sinon si j'ai un argument en entrée qui est un numérique
        elseif (preg_match("#[0-9]+#", $argument01)) {
            // I.3.2.1 Affecter le numérique à l'ID_GROUPE
            $ID_GROUPE = $argument01;
            // I.3.2.2 : Affecter un numéro d'erreur
            $numErr = $numFonction . "-I.3.2-";
        }
        // I.3.4 Sinon c'est une erreur
        else {
            // I.3.4.1 : Préparer le message d'erreur
            $msgErr = "L'argument de la méthode est invalide.";
            // I.3.4.2 : Loguer l'événement
            eventlog($scriptAppelant, $numErr, $msgErr);
            // I.3.4.3 : Appeler la fonction de debogage
            debogage($scriptAppelant, $numErr, $msgErr);
            // I.3.4.4 : Renvoyer l'utilisateur sur la page d'erreur  
            header('Location: index.php?page=erreur&err=1');
        }
        // ----------------------------------------------------------------
        // I.4 Sécuriser ce qui sera utilisé en injection SQL
        // ----------------------------------------------------------------
        $ID_GROUPE = securiserSQL($ID_GROUPE);

        // ----------------------------------------------------------------
        // 
        // II. Récupérer les informations concernant le groupe dans la BDD
        // 
        // ----------------------------------------------------------------
        //  II.1 Préparer la requête SQL
        // ----------------------------------------------------------------

        $sql = "select  * from GROUPE where ID_GROUPE = " . $ID_GROUPE . ";";

        // ----------------------------------------------------------------
        //  II.2.1 Injecter la requête dans la base
        // ----------------------------------------------------------------
        $result = mysql_query($sql);

        // ----------------------------------------------------------------
        //  II.3 Si erreur de requete (le résulat est 0)
        // ----------------------------------------------------------------
        if ($result == 0) {
            //  II.3.1 : Préparer le message d'erreur
            $msgErr = "Une erreur SQL est survenue lors de la requête : " . $sql;
            // II.3.2 : Affecter un numéro d'erreur
            $numErr = $numFonction . "-II-";
            // II.3.3 : Loguer l'événement
            eventlog($scriptAppelant, $numErr, $msgErr);
            // II.3.4 : Appeler la fonction de debogage
            debogage($scriptAppelant, $numErr, $msgErr);
            // II.3.5 : Renvoyer l'utilisateur sur la page d'erreur  
            header('Location: index.php?page=erreur&err=1');
        }

        // ----------------------------------------------------------------
        //  II.4 Sinon s'il existe un groupe correspondant à cet ID
        // ----------------------------------------------------------------
        elseif (mysql_num_rows($result) != 0) {
            //  II.4.1 Récupérer les données et les affecter aux données membre
            $temp = mysql_fetch_assoc($result);
            $objGroupe->setNOM_GROUPE($temp['NOM_GROUPE']);
            $objGroupe->setDESCRIPTION_GROUPE($temp['DESCRIPTION']);
            //  II.4.2 Renvoyer l'objet Groupe correspondant
            return $objGroupe;
        }

        // ----------------------------------------------------------------
        // II.5 sinon renvoyer null
        // ----------------------------------------------------------------
        else {
            return null;
        }
    }

    /**
     * Retourne un tableau d'objet Groupe suivant les critère de recheche 
     * en entrée
     * @param type $rechGroupName String
     * @param type $rechGroupDescription String
     * @return type tableau d'objet Groupe
     */
    function rechercherGroupe($rechGroupName, $rechGroupDescription) {
        // I. Prérequis :
        //  I.1. Préparation des paramètres de débogages et initialisation des 
        //       variables
        //  I.2. Connexion à la base de données
        //  I.3. Récupération des paramètres d'entrée
        //    I.3.1 Si les deux paramètres d'entrée sont vide c'est une erreur
        //       II.3.1.1 : Préparer le message d'erreur
        //       II.3.1.2 : Affecter un numéro d'erreur
        //       II.3.1.3 : Loguer l'événement
        //       II.3.1.4 : Appeler la fonction de debogage
        //       II.3.1.5 : Renvoyer l'utilisateur sur la page d'erreur
        // I.4 Sécuriser ce qui sera utilisé en injection SQL
        // 
        // II. Récupérer les informations concernant le groupe dans la BDD
        //  II.1 Préparer la requête SQL
        //  II.2 Injecter la requête dans la base
        //  II.3 Si erreur de requete (le résulat est 0)
        //     II.3.1 : Préparer le message d'erreur
        //     II.3.2 : Affecter un numéro d'erreur
        //     II.3.3 : Loguer l'événement
        //     II.3.4 : Appeler la fonction de debogage
        //     II.3.5 : Renvoyer l'utilisateur sur la page d'erreur
        //  II.4 Sinon récupérer tous les enregistrements
        //  II.5 Fermer la connexion à la base
        //  
        // III Retour des données
        // ----------------------------------------------------------------
        // 
        //                  I. Prérequis :
        //                  
        // ----------------------------------------------------------------
        // ----------------------------------------------------------------
        //  I.1. Préparation des paramètres de débogages et initialisation 
        //       des variables
        // ----------------------------------------------------------------
        debogage('------------------------<br/>');
        debogage('GroupeMgr : rechercherGroupe:<br/>');
        $retour = null;
        $scriptAppelant = $this->nomScript;
        $numFonction = 6;

        $objGroupe = new Groupe;
        $tab_groupes = array();  // Je vais retourner un tableau d'objets Groupe
        // ----------------------------------------------------------------
        //  I.2. Connexion à la base de données
        // ----------------------------------------------------------------
        $connect = new SGBD();
        $connect = $connect->connecterSGBD($connect);

        // Récupération de l'ID de connexion à la base
        $db = $connect->getDB();


        // ----------------------------------------------------------------
        //  I.3. Récupération des paramètres d'entrée
        // ----------------------------------------------------------------
        //    I.3.1 Si les deux paramètres d'entrée sont vide c'est une erreur
        if (empty($rechGroupName) || empty($rechGroupDescription)) {
            //  II.3.1.1 : Préparer le message d'erreur
            $msgErr = "La méhtode demande au minimum un argument" . $sql;
            // II.3.1.2 : Affecter un numéro d'erreur
            $numErr = $numFonction . "-I.3-";
            // II.3.1.3 : Loguer l'événement
            eventlog($scriptAppelant, $numErr, $msgErr);
            // II.3.1.4 : Appeler la fonction de debogage
            debogage($scriptAppelant, $numErr, $msgErr);
            // II.3.1.5 : Renvoyer l'utilisateur sur la page d'erreur  
            header('Location: index.php?page=erreur&err=1');
        }

        // ----------------------------------------------------------------
        // I.4 Sécuriser ce qui sera utilisé en injection SQL
        // ----------------------------------------------------------------
        $rechGroupName = securiserSQL($rechGroupName);
        $rechGroupDescription = securiserSQL($rechGroupDescription);

        // ----------------------------------------------------------------
        // 
        // II. Récupérer les informations concernant le groupe dans la BDD
        // 
        // ----------------------------------------------------------------
        //  II.1 Préparer la requête SQL
        // ----------------------------------------------------------------

        $sql = "select  * from GROUPE ";
        $sql .= "where NOM_GROUPE like '%" . $rechGroupName . "%' ";
        $sql .= "AND   DESCRIPTION_GROUPE like '%" . $rechGroupDescription . "%' ;";

        // ----------------------------------------------------------------
        //  II.2 Injecter la requête dans la base
        // ----------------------------------------------------------------
        $result = mysql_query($sql);

        // ----------------------------------------------------------------
        //  II.3 Si erreur de requete (le résulat est 0)
        // ----------------------------------------------------------------
        if ($result == 0) {
            //  II.3.1 : Préparer le message d'erreur
            $msgErr = "Une erreur SQL est survenue lors de la requête : " . $sql;
            // II.3.2 : Affecter un numéro d'erreur
            $numErr = $numFonction . "-II.2-";
            // II.3.3 : Loguer l'événement
            eventlog($scriptAppelant, $numErr, $msgErr);
            // II.3.4 : Appeler la fonction de debogage
            debogage($scriptAppelant, $numErr, $msgErr);
            // II.3.5 : Renvoyer l'utilisateur sur la page d'erreur  
            header('Location: index.php?page=erreur&err=1');
        }

        // ----------------------------------------------------------------
        //  II.4 Sinon récupérer tous les enregistrements
        // ----------------------------------------------------------------
        if (mysql_num_rows($result) > 0) {
            while ($ligne = mysql_fetch_assoc($result)) {
                $objGroupe = new Groupe($ligne);
                array_push($tab_groupes, $objGroupe);
            }

            //  II.5 Fermer la connexion à la base
            mysql_free_result($result);
        }


        // ----------------------------------------------------------------
        // 
        // III. Retour des données
        //
        // ----------------------------------------------------------------
        
        return $tab_groupes;
    }

}

?>
