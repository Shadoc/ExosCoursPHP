<?php

/*
 * Auteur Laurent Cordier
 * Date de création : 21/04/2012
 * Date de dernière modification : 21/05/2012
 * 
 * Etat d'avancement : En cours de realisation
 * 1. add : a tester
 * 2. mod : a tester
 * 3. del : a tester
 * 4. get : a tester
 * 
 */

class utilisateurMgr {

    // Entete des messages d'erreur correspondant au script :
    private $nomScript;

    // tous les boutonMgr on besoin d'une connexion à la base de donnée.
    function utilisateurMgr() {
        $this->nomScript = "Modele:Managers:utilisateur.mgr.php:>";
        debogage('------------------------<br/>');
        debogage('boutonMgr : Appel Constructeur utlisateur<br/>');
    }

    /**
     * Ajoute un utilisateur à la table UTILISATEUR
     * Si s'il y a un groupe associé alors l'utilsateur est lié au groupe
     * @param type Object Utilisateur, objet Groupe ou ID de Groupe
     * @return \ID utilisateur ou chaine vide
     */
    function addUtilisateur($utilisateur, $groupe) {


        // ----------------------------------------------------------------
        // README Driven Developement
        // ==========================
        // 
        // I. Prérequis :
        //  I.1. Préparation des paramètres de débogages et initialisation des 
        //       variables
        //  I.2. Connexion à la base de données
        //  I.3. Récupération des paramètres d'entrée
        //    I.3.1. S'il 2 argugments
        //      I.3.1.1 Si le premier argument est un objet Utilisateur
        //              et si l'utilisateur possède au minum un login/password
        //        I.3.1.1.1 Alors je récupere les données membres de l'objet 
        //                  Utilisateur pour qu'elles soient traiteés dans cette 
        //                  méthode
        //      I.3.1.3 Sinon il y a une erreur
        //         I.3.1.3.1 : Préparer le message d'erreur
        //         I.3.1.3.2 : Affecter un numéro d'erreur
        //         I.3.1.3.3 : Loguer l'événement
        //         I.3.1.3.4 : Appeler la fonction de debogage
        //         I.3.1.3.5 : Renvoyer l'utilisateur sur la page d'erreur  
        //               
        //      I.3.1.4 Si le deuxième argument est un objet Groupe
        //              et que l'id de cet objet groupe n'est pas vide
        //        I.3.1.4.1 Alors je récupère l'id groupe
        //        
        //      I.3.1.5 Si le deuxième argument ne contient que des chiffres
        //        I.3.1.5.1 Alors je récupère le paramètre qui sera traité comme 
        //                  un id dans le reste de la fonction
        //      I.3.1.6 Sinon il y a une erreur
        //         I.3.1.6.1 : Préparer le message d'erreur
        //         I.3.1.6.2 : Affecter un numéro d'erreur
        //         I.3.1.6.3 : Loguer l'événement
        //         I.3.1.6.4 : Appeler la fonction de debogage
        //         I.3.1.6.5 : Renvoyer l'utilisateur sur la page d'erreur      
        //        
        //    I.3.2. S'il 1 argugment
        //      I.3.2.1 Si l'argument est un objet Utilisateur
        //              et si l'utilisateur possède au minum un login/password
        //        I.3.2.1.1 Alors je récupere les données membres de l'objet 
        //                  Utilisateur pour qu'elles soient traiteés dans cette 
        //                  méthode
        //      I.3.2.3 Sinon il y a une erreur
        //         I.3.2.3.1 : Préparer le message d'erreur
        //         I.3.2.3.2 : Affecter un numéro d'erreur
        //         I.3.2.3.3 : Loguer l'événement
        //         I.3.2.3.4 : Appeler la fonction de debogage
        //         I.3.2.3.5 : Renvoyer l'utilisateur sur la page d'erreur  
        //      I.3.3 S'il n'y a pas d'argument  ou trop d'arguments
        //      I.3.3.1 : Préparer le message d'erreur
        //      I.3.3.2 : Affecter un numéro d'erreur
        //      I.3.3.3 : Loguer l'événement
        //      I.3.3.4 : Appeler la fonction de debogage
        //      I.3.3.5 : Renvoyer l'utilisateur sur la page d'erreur  
        //  
        //  I.4. Sécuriser ce qui sera utilisé en injection SQL
        //  
        //  
        //  
        //  II. Enregistrer l'utilisateur dans la table UTILISATEUR
        //    II.1 S'il existe un ID utilisateur et pas d'id de Groupe alors 
        //      II.1.1 Construire la requete sql permettant l'ajout 
        //             de l'Utilisateur dans la table UTILISATEUR
        //      II.1.2 Injecter la requete d'ajout utilisateur via la procédure 
        //             injecterSQL
        //      II.1.3 Récupérer le dernier id créé par mysql l'affecter à 
        //             l'ID Utilisateur qui sera retourné à l'appelant.
        //
        //    II.2 S'il existe un id de Groupe alors 
        //      II.2.1 Si cet ID existe dans la table GROUPE
        //        II.2.1.1 Construire la requete sql permettant l'ajout 
        //                 de l'id Utilisateur et l'id Groupe dans la table 
        //                 de liaison CONTENIR
        //        II.2.1.2 Injecter la requete d'ajout utilisateur via la procédure 
        //                 injecterSQL;
        // ----------------------------------------------------------------
        // 
        // 
        // 
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
        debogage('UtilisateurMgr : addUtilisateur :<br/>');
        $retour = false;
        $scriptAppelant = $this->nomScript;
        $numFonction = 1;

        $objGroupe = new Groupe;
        $mgrGroupe = new groupeMgr;
        $ID_UTIL = "";
        $ID_GROUPE = "";

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
        // I.3.1. S'il 2 argugments
        if ($numArg == 2) {
            $temp_arg = func_get_arg();
            $argument01 = $temp_arg[0];
            // I.3.1.1 Si le premier argument est un objet Utilisateur
            //         et si l'utilisateur possède au minum un login/password
            if (is_a($argument01, "Utilisateur")
                    &&
                    $argument01->getLOGIN_UTIL != ""
                    &&
                    $argument01->getPASS_UTIL != ""
            ) {
                // I.3.1.1.1 Alors je récupere les données membres de l'objet 
                // utilisateur pour qu'elles soient traiteés dans cette methode
                $NOM_UTIL = $argument01->getNOM_UTIL();
                $PRENOM_UTIL = $argument01->getPRENOM_UTIL();
                $LOGIN_UTIL = $argument01->getLOGIN_UTIL();
                $PASS_UTIL = $argument01->getPASS_UTIL();
            }
            // I.3.1.2 Sinon il y a une erreur
            else {
                // I.3.1.3.1 : Préparer le message d'erreur
                $msgErr = "L'argument utilisé pour l'appel de la méthode est invalide.";
                // I.3.1.3.2 : Affecter un numéro d'erreur
                $numErr = "";
                // I.3.1.3.3 : Loguer l'événement
                eventlog($scriptAppelant, $numErr, $msgErr);
                // I.3.1.3.4 : Appeler la fonction de debogage
                debogage($scriptAppelant, $numErr, $msgErr);
                // I.3.1.3.5 : Renvoyer l'utilisateur sur la page d'erreur  
                header('Location: index.php?page=erreur&err=1');
            }

            // I.3.1.3 Si le deuxième argument est un objet Groupe
            //         et que l'id de cet objet groupe n'est pas vide
            if (is_a($argument02, "Groupe") && $argument02->getID_GROUPE() != "") {
                // I.3.1.4.1 Alors je récupère l'id groupe
                $ID_GROUPE = $argument02->getID_GROUPE();
            }
            // I.3.1.5 Si le deuxième argument ne contient que des chiffres
            else {
                if ((preg_match("#[0-9]+#", $argument02))) {
                    //  I.3.1.5.1 Alors je récupère le paramètre qui sera traité comme 
                    //            un id dans le reste de la fonction
                    $ID_GROUPE = $argument02;
                }
                // I.3.1.4 Sinon il y a une erreur
                else {
                    // I.3.1.6.1 : Préparer le message d'erreur
                    $msgErr = "L'argument utilisé pour l'appel de la méthode doit être un numérique.";
                    // I.3.1.6.2 : Affecter un numéro d'erreur
                    $numArg = "";
                    // I.3.1.6.3 : Loguer l'événement
                    eventlog($scriptAppelant, $numErr, $msgErr);
                    // I.3.1.6.4 : Appeler la fonction de debogage
                    debogage($scriptAppelant, $numErr, $msgErr);
                    // I.3.1.6.5 : Renvoyer l'utilisateur sur la page d'erreur   
                    header('Location: index.php?page=erreur&err=1');
                }
            }
        }
        // I.3.2. S'il 1 argugment
        if ($numArg == 1) {
            $temp_arg = func_get_arg();
            $argument01 = $temp_arg[0];

            // I.3.2.1 Si l'argument est un objet Utilisateur
            //         et si l'utilisateur possède au minum un login/password            
            if (is_a($argument01, "Utilisateur")
                    &&
                    $argument01->getLOGIN_UTIL != ""
                    &&
                    $argument01->getPASS_UTIL != ""
            ) {
                // I.3.2.1.1 Alors je récupere les données membres de l'objet 
                // utilisateur pour qu'elles soient traiteés dans cette methode
                $NOM_UTIL = $argument01->getNOM_UTIL();
                $PRENOM_UTIL = $argument01->getPRENOM_UTIL();
                $LOGIN_UTIL = $argument01->getLOGIN_UTIL();
                $PASS_UTIL = $argument01->getPASS_UTIL();
            }
            // I.3.2.2 Sinon il y a une erreur
            else {
                // I.3.2.2.1 : Préparer le message d'erreur
                $msgErr = "L'argument utilisé pour l'appel de la méthode est invalide.";
                // I.3.2.2.2 : Affecter un numéro d'erreur
                $numErr = "";
                // I.3.2.2.3 : Loguer l'événement
                eventlog($scriptAppelant, $numErr, $msgErr);
                // I.3.2.2.4 : Appeler la fonction de debogage
                debogage($scriptAppelant, $numErr, $msgErr);
                // I.3.2.2.5 : Renvoyer l'utilisateur sur la page d'erreur  
                header('Location: index.php?page=erreur&err=1');
            }
        }
        // I.3.3 S'il n'y a pas d'argument ou trop d'arguments
        else {
            // I.3.3.1 : Préparer le message d'erreur
            $msgErr = "La méthode attend un ou deux argument en entrée.";
            // I.3.3.2 : Affecter un numéro d'erreur
            $numErr = "";
            // I.3.3.3 : Loguer l'événement
            eventlog($scriptAppelant, $numErr, $msgErr);
            // I.3.3.4 : Appeler la fonction de debogage
            debogage($scriptAppelant, $numErr, $msgErr);
            // I.3.3.5 : Renvoyer l'utilisateur sur la page d'erreur  
            header('Location: index.php?page=erreur&err=1');
        }

        // ----------------------------------------------------------------
        //  I.4. Sécuriser ce qui sera utilisé en injection SQL
        // ----------------------------------------------------------------
        $ID_GROUPE = securiserSQL($ID_GROUPE);
        $ID_UTIL = securiserSQL($ID_UTIL);


        // ----------------------------------------------------------------
        // 
        //      II. Enregistrer l'utilisateur dans la table UTILISATEUR
        //                  
        // ----------------------------------------------------------------
        // II.1 Construire la requete sql permettant l'ajout 
        //        de l'Utilisateur dans la table UTILISATEUR
        $sql = "insert into  UTILISATEUR (NOM_UTIL, PRENOM_UTIL, LOGIN_UTIL, PASS_UTIL)
                    values ('" . $NOM_UTIL . "', '" . $PRENOM_UTIL . "', " . $LOGIN_UTIL . "' ," . $PASS_UTIL . "');";
        // II.2 Injecter la requete d'ajout utilisateur via la procédure 
        //        injecterSQL
        injecterSQL($scriptAppelant, $numFontion, $sql, $db);
        // II.3 Récupérer le dernier id créé par mysql l'affecter à 
        //        l'ID Utilisateur qui sera retourné à l'appelant.
        $ID_UTIL = mysql_insert_id();

        // II.4 S'il existe un id de Groupe alors 
        if ($ID_GROUPE != "") {
            $objGroupe->setID_GROUPE($ID_GROUPE);

            // II.2.1 Si cet ID existe dans la table GROUPE
            if ($mgrGroupe->getGroupe($objGroupe) != null) {
                // II.2.1.1 Construire la requete sql permettant l'ajout 
                //          de l'id Utilisateur et l'id Groupe dans la table 
                //          de liaison CONTENIR
                $sql = "insert into CONTENIR (ID_UTIL, ID_GROUPE) 
                values ('" . $ID_UTIL . "', '" . $ID_GROUPE . "');";
                // II.2.1.2 Injecter la requete d'ajout utilisateur via la procédure 
                //          injecterSQL;
                injecterSQL($scriptAppelant, $numFontion, $sql, $db);
            }
        }
        // II.5 Retourner l'ID à l'appelant
        return $ID_UTIL;
    }

    /**
     * Modifie les données d'un utilisateur dans la table UTILISATEUR.
     * Cette modification ne s'effectue que si l'objet Utilisateur passé en entrée
     * possède un ID, un login et un password.
     * @param UTILISATEUR $utilisateur
     * @return boolean : true si transaction ok
     */
    function modUtilisateur(UTILISATEUR $objUtilisateur) {
        // ----------------------------------------------------------------
        // README Driven Developement
        // ==========================
        // 
        // I. Prérequis :
        //  I.1. Préparation des paramètres de débogages
        //  I.2. Connexion à la base de donnée
        //  I.3. Récupération des paramètres d'entrée    
        //   I.3.1 Si le nombre d'argument est différent de un c'est une erreur
        //     I.3.1.1.1 : Préparer le message d'erreur
        //     I.3.1.1.2 : Affecter un numéro d'erreur
        //     I.3.1.1.3 : Loguer l'événement
        //     I.3.1.1.4 : Appeler la fonction de debogage
        //     I.3.1.1.5 : Renvoyer l'utilisateur sur la page d'erreur
        //   I.3.2 Sinon si l'objet possede un id, un login, un password
        //     I.3.2.1 Je récupère les données membres de l'objet Utilisateur  
        //  I.4. Sécuriser ce qui sera utilisé en injection SQL         
        //  I.5. Modifier l'utilisateur dans la table UTLISATEUR
        //    I.5.1. : Préparer la requete SQL
        //    I.5.2. : Injecter la requête dans la base via la fonction
        //             injecterSQL.
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
        debogage('UtilisateurMgr : modUtilisateur :<br/>');
        $retour = "";
        $scriptAppelant = $this->nomScript;
        $numFonction = 2;

        $ID_UTIL = "";


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
        // I.3.1 Si le nombre d'argument est différent de un c'est une erreur
        if ($numArg != 1) {
            // I.3.1.1.1 : Préparer le message d'erreur
            $msgErr = "Le nombre d'argument utilisé lors de l'appel de la méthode est invalide.";
            // I.3.1.1.2 : Affecter un numéro d'erreur
            $numErr = "";
            // I.3.1.1.3 : Loguer l'événement
            eventlog($scriptAppelant, $numErr, $msgErr);
            // I.3.1.1.4 : Appeler la fonction de debogage
            debogage($scriptAppelant, $numErr, $msgErr);
            // I.3.1.1.5 : Renvoyer l'utilisateur sur la page d'erreur  
            header('Location: index.php?page=erreur&err=1');
        }
        // I.3.2 Sinon si l'objet possede un id, un login, un password
        elseif ($objUtilisateur->getID_UTIL() != ""
                && $objUtilisateur->getLOGIN_UTIL() != ""
                && $objUtilisateur->getPASS_UTIL() != ""
        ) {
            // I.3.2.1 Je récupère les données membres de l'objet Utilisateur 
            $ID_UTIL = $objUtilisateur->getID_UTIL();
            $NOM_UTIL = $objUtilisateur->getNOM_UTIL();
            $PRENOM_UTIL = $objUtilisateur->getPRENOM_UTIL();
            $LOGIN_UTIL = $objUtilisateur->getLOGIN_UTIL();
            $PASS_UTIL = $objUtilisateur->getPASS_UTIL();
        }

        // ----------------------------------------------------------------
        //  I.4. Sécuriser ce qui sera utilisé en injection SQL
        // ----------------------------------------------------------------
        $ID_UTIL = securiserSQL($ID_UTIL);
        $NOM_UTIL = securiserSQL($NOM_UTIL);
        $PRENOM_UTIL = securiserSQL($PRENOM_UTIL);
        $LOGIN_UTIL = securiserSQL($LOGIN_UTIL);
        $PASS_UTIL = securiserSQL($PASS_UTIL);
        // ----------------------------------------------------------------
        //  I.5. Modifier l'utilisateur dans la table UTLISATEUR
        // ----------------------------------------------------------------
        // I.5.1. : Préparer la requete SQL
        $sql = "update table UTILISATEUR (ID_UTIL, NOM_UTIL, PRENOM_UTIL, LOGIN_UTIL, PASS_UTIL)
                where ID_UTIL = " . $ID_UTIL . ";";
        // I.5.2. : Injecter la requête dans la base via la fonction
        //          injecterSQL.
        injecterSQL($scriptAppelant, $numFontion, $sql, $db);

        // ----------------------------------------------------------------
        //  I.6 Retourner l'état de la transation
        // ----------------------------------------------------------------
        $retour = true;
        return $retour;
    }

    /**
     * Efface un utilisateur de la table UTILISATEUR
     * si cet utilisateur possède un id.
     * @param UTILISATEUR $utilisateur
     * @return boolean : true si transaction ok
     */
    function delUtilisateur(Utilisateur $objUtilisateur) {
        // ----------------------------------------------------------------
        // README Driven Developement
        // ==========================
        // 
        // I. Prérequis :
        //  I.1. Préparation des paramètres de débogages
        //  I.2. Connexion à la base de donnée
        //  I.3. Récupération des paramètres d'entrée    
        //   I.3.1 Si le nombre d'argument est différent de un c'est une erreur
        //     I.3.1.1.1 : Préparer le message d'erreur
        //     I.3.1.1.2 : Affecter un numéro d'erreur
        //     I.3.1.1.3 : Loguer l'événement
        //     I.3.1.1.4 : Appeler la fonction de debogage
        //     I.3.1.1.5 : Renvoyer l'utilisateur sur la page d'erreur
        //   I.3.2 Sinon si l'objet possede un id
        //     I.3.2.1 Je récupère les données membres de l'objet Utilisateur  
        //  I.4. Sécuriser ce qui sera utilisé en injection SQL         
        //  I.5. Modifier l'utilisateur dans la table UTLISATEUR
        //    I.5.1. : Préparer la requete SQL
        //    I.5.2. : Injecter la requête dans la base via la fonction
        //             injecterSQL.
        //             
        //  I.6 Je construit mon objet de retour
        //  
        //  I.7 Retourner l'état de la transaction
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
        debogage('UtilisateurMgr : delUtilisateur :<br/>');
        $retour = false;
        $scriptAppelant = $this->nomScript;
        $numFonction = 3;

        $ID_UTIL = "";
        $NOM_UTIL = "";
        $PRENOM_UTIL = "";
        $LOGIN_UTIL = "";
        $PASS_UTIL = "";

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
        // I.3.1. Si le  nombre d'argument est différent de 1
        if ($numArg != 1) {
            // I.3.1.1 
            $temp_arg = func_get_arg();
            $argument01 = $temp_arg[0];
            // I.3.1.1 Si le premier argument est un objet Utilisateur
            //         et si l'utilisateur possède au minum un login/password
            if (is_a($argument01, "Utilisateur")
                    &&
                    $argument01->getLOGIN_UTIL != ""
                    &&
                    $argument01->getPASS_UTIL != ""
            ) {
                // I.3.1.1.1 Alors je récupere les données membres de l'objet 
                // utilisateur pour qu'elles soient traiteés dans cette methode
                $ID_UTIL = $argument01->getID_UTIL();
            }
            // I.3.1.2 Sinon il y a une erreur
            else {
                // I.3.1.3.1 : Préparer le message d'erreur
                $msgErr = "L'argument utilisé pour l'appel de la méthode est invalide.";
                // I.3.1.3.2 : Affecter un numéro d'erreur
                $numErr = "";
                // I.3.1.3.3 : Loguer l'événement
                eventlog($scriptAppelant, $numErr, $msgErr);
                // I.3.1.3.4 : Appeler la fonction de debogage
                debogage($scriptAppelant, $numErr, $msgErr);
                // I.3.1.3.5 : Renvoyer l'utilisateur sur la page d'erreur  
                header('Location: index.php?page=erreur&err=1');
            }
        }


        // ----------------------------------------------------------------
        //  I.4. Sécuriser ce qui sera utilisé en injection SQL
        // ----------------------------------------------------------------
        $ID_UTIL = securiserSQL($ID_UTIL);

        // ----------------------------------------------------------------
        //  I.5. Effacer l'Utilisateur
        // ----------------------------------------------------------------
        //  I.5.1 Ecrire la requete d'effacement de la table UTILISATEUR
        $sql = "delete from UTILISATEUR where ID_UTIL = '" . $ID_UTIL . "';";
        //  I.5.2 Injecter le SQL dans la base via la foncion injecterSQL()
        injecterSQL($scriptAppelant, $numFontion, $sql, $db);


        // ----------------------------------------------------------------        
        //  I.6 Retourner l'état de la transaction
        // ----------------------------------------------------------------        
        $retour = true;
        return $retour;
    }

    /**
     * Méthode permettant de récupérer les informations concernant un 
     * utilisateur dans la table UTILISATEUR. Ceci grace à son id.
     * Cette  méthode retourne un objet Utilisateur
     * @param Utilisateur $objUtilisateur
     * @return \Utilisateur 
     */
    function getUtilisateur(Utilisateur $objUtilisateur) {
        // ----------------------------------------------------------------
        // README Driven Developement
        // ==========================
        // 
        // I. Prérequis :
        //  I.1. Préparation des paramètres de débogages
        //  I.2. Connexion à la base de donnée
        //  I.3. Récupération des paramètres d'entrée    
        //   I.3.1 Si le nombre d'argument est différent de un c'est une erreur
        //     I.3.1.1.1 : Préparer le message d'erreur
        //     I.3.1.1.2 : Affecter un numéro d'erreur
        //     I.3.1.1.3 : Loguer l'événement
        //     I.3.1.1.4 : Appeler la fonction de debogage
        //     I.3.1.1.5 : Renvoyer l'utilisateur sur la page d'erreur
        //   I.3.2 Sinon si l'objet possede un id
        //     I.3.2.1 Je récupère les données membres de l'objet Utilisateur  
        //  I.4. Sécuriser ce qui sera utilisé en injection SQL         
        //  I.5. Récupérer les données de l'utilisateur
        //    I.5.1. : Préparer la requete SQL
        //    I.5.2. : Injecter la requête dans la base.
        //  
        //  I.6 Retourner l'état de la transaction
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
        debogage('UtilisateurMgr : getUtilisateur :<br/>');
        $retour = false;
        $scriptAppelant = $this->nomScript;
        $numFonction = 4;

        $ID_UTIL = "";
        $NOM_UTIL = "";
        $PRENOM_UTIL = "";
        $LOGIN_UTIL = "";
        $PASS_UTIL = "";

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
        // I.3.1. Si le  nombre d'argument est différent de 1
        if ($numArg != 1) {
            // I.3.1.1 
            $temp_arg = func_get_arg();
            $argument01 = $temp_arg[0];
            // I.3.1.1 Si le premier argument est un objet Utilisateur
            //         et si l'utilisateur possède un ID
            if (is_a($argument01, "Utilisateur")
                    &&
                    $argument01->getID_UTIL() != ""
            ) {
                // I.3.1.1.1 Alors je récupere la donnée membre ID_UTIL de 
                // l'objet utilisateur pour qu'elles soient traiteés dans cette 
                // methode
                $ID_UTIL = $argument01->getID_UTIL();
            }
            // I.3.1.2 Sinon il y a une erreur
            else {
                // I.3.1.3.1 : Préparer le message d'erreur
                $msgErr = "L'argument utilisé pour l'appel de la méthode est invalide.";
                // I.3.1.3.2 : Affecter un numéro d'erreur
                $numErr = "";
                // I.3.1.3.3 : Loguer l'événement
                eventlog($scriptAppelant, $numErr, $msgErr);
                // I.3.1.3.4 : Appeler la fonction de debogage
                debogage($scriptAppelant, $numErr, $msgErr);
                // I.3.1.3.5 : Renvoyer l'utilisateur sur la page d'erreur  
                header('Location: index.php?page=erreur&err=1');
            }
        }


        // ----------------------------------------------------------------
        //  I.4. Sécuriser ce qui sera utilisé en injection SQL
        // ----------------------------------------------------------------
        $ID_UTIL = securiserSQL($ID_UTIL);

        // ----------------------------------------------------------------
        //  I.5. Récupérer les données de l'utilisateur
        // ----------------------------------------------------------------
        //  I.5.1 Ecrire la requete d'effacement de la table UTILISATEUR
        $sql = "select * from UTILISATEUR where ID_UTIL = '" . $ID_UTIL . "';";

        // I.5.2. : Injecter la requête dans la base.
        $result = mysql_query($sql);

        // I.5.3 : Si la requete renvoie une erreur (si result vaut 0)
        if ($result == 0) {
            // I.5.3.1 : Préparer le message d'erreur
            $msgErr = "Impossible de trouver l'ID_UTIL pour l'utilisateur" . $ID_UTIL . ". La requête SQL était : " . $sql;
            // I.5.3.2 : Affecter un numéro d'erreur
            $numErr = $numFonction . "-1.5.1-";
            // I.5.3.3 : Loguer l'événement
            eventlog($scriptAppelant, $numErr, $msgErr);
            // I.5.3.4 : Appeler la fonction de debogage
            debogage($scriptAppelant, $numErr, $msgErr);
            // I.5.3.5 : Renvoyer l'utilisateur sur la page d'erreur
            header('Location: index.php?page=erreur&err=1');
        }
        // I.5.4 : Sinon je récupère l'ensemble des données données remonté
        //         par la requête
        else {
            $enregistrement = mysql_fetch_assoc($result);
        }

        // ----------------------------------------------------------------        
        // I.6 Je construit mon objet de retour :
        // ----------------------------------------------------------------        

        $retour = new Utilisateur($enregistrement);

        // ----------------------------------------------------------------        
        //  I.7 Retourner l'état de la transaction
        // ----------------------------------------------------------------        
        return $retour;
    }

    function getAllUtilisateurs() {
        // ----------------------------------------------------------------
        // README Driven Developement
        // ==========================
        // 
        // I. Prérequis :
        // I.1. Préparation des paramètres de débogages
        //  I.2. Connexion à la base de donnée
        //  I.4. Sécuriser ce qui sera utilisé en injection SQL         
        //  I.5. Récupérer les données de l'utilisateur
        //    I.5.1. : Préparer la requete SQL
        //    I.5.2. : Injecter la requête dans la base.
        //    I.5.3 : Si la requete renvoie une erreur (si result vaut 0)
        // 	I.5.3.1 : Préparer le message d'erreur
        // 	I.5.3.2 : Affecter un numéro d'erreur
        // 	I.5.3.3 : Loguer l'événement
        // 	I.5.3.4 : Appeler la fonction de debogage
        // 	I.5.3.5 : Renvoyer l'utilisateur sur la page d'erreur
        // 	I.5.4 : Sinon je récupère l'ensemble des données données remonté
        //         	par la requête
        // 	  I.5.4.1 Si j'ai au moins un retour
        // 	    I.5.4.1.1 Je recupere chaque ligne de resultat de la requete
        // 	    I.5.4.1.2 J'instancie un objet en utilisant 
        //                    la propriété de mon constructeur capable de 
        //                    récupérer un tableau associatif.
        // 	    I.5.4.1.3 J'ajoute cet objet à la fin de mon tableau
        // 	    I.5.4.1.4 Le retour est maintenant un tableau d'objet 
        //                    Utilisateur.
        //  I.6 Retourner le tableau d'objet Utilisateur ou false
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
        debogage('UtilisateurMgr : getAllUtilisateurs :<br/>');
        $retour = false;
        $scriptAppelant = $this->nomScript;
        $numFonction = 5;

        $tabUtilisateur = array();
        $ID_UTIL = "";
        $NOM_UTIL = "";
        $PRENOM_UTIL = "";
        $LOGIN_UTIL = "";
        $PASS_UTIL = "";

        // ----------------------------------------------------------------
        //  I.2. Connexion à la base de données
        // ----------------------------------------------------------------
        $connect = new SGBD();
        $connect = $connect->connecterSGBD($connect);

        // Récupération de l'ID de connexion à la base
        $db = $connect->getDB();

        // ----------------------------------------------------------------
        //  I.3. Sécuriser ce qui sera utilisé en injection SQL
        // ----------------------------------------------------------------
        $ID_UTIL = securiserSQL($ID_UTIL);

        // ----------------------------------------------------------------
        //  I.4. Récupérer les données de l'utilisateur
        // ----------------------------------------------------------------
        //  I.5.1 Ecrire la requete d'effacement de la table UTILISATEUR
        $sql = "select * from UTILISATEUR;";

        // I.5.2. : Injecter la requête dans la base.
        $result = mysql_query($sql);

        // I.5.3 : Si la requete renvoie une erreur (si result vaut 0)
        if ($result == 0) {
            // I.5.3.1 : Préparer le message d'erreur
            $msgErr = "Impossible de trouver l'ID_ORD pour le bouton " . $id_bouton . ". La requête SQL était : " . $sql;
            // I.5.3.2 : Affecter un numéro d'erreur
            $numErr = "";
            // I.5.3.3 : Loguer l'événement
            eventlog($scriptAppelant, $numErr, $msgErr);
            // I.5.3.4 : Appeler la fonction de debogage
            debogage($scriptAppelant, $numErr, $msgErr);
            // I.5.3.5 : Renvoyer l'utilisateur sur la page d'erreur
            header('Location: index.php?page=erreur&err=1');
        }
        // I.5.4 : Sinon je récupère l'ensemble des données données remonté
        //         par la requête
        else {
            // I.5.4.1 Si j'ai au moins un retour
            if (mysql_num_rows($result) > 0) {
                // I.5.4.1.1 Je recupere chaque ligne de resultat de la requete
                while ($ligne = mysql_fetch_assoc($result)) {
                    // I.5.4.1.1 J'instancie un objet en utilisant 
                    //           la propriété de mon constructeur capable de 
                    //           récupérer un tableau associatif.
                    $objUtilisateur = new Utilisateur($ligne);
                    // I.5.4.1.2 J'ajoute cet objet à la fin de mon tableau
                    array_push($tabUtilisateur, $objUtilisateur);
                }
                // I.5.4.1.1 Le retour est maintenant un tableau d'objet 
                //           Utilisateur.
                $retour = $tab_auteurs;
            }
        }
        // ----------------------------------------------------------------        
        //  I.6 Retourner le tableau d'objet Utilisateur ou false
        // ----------------------------------------------------------------        
        return $retour;
    }

    /**
     * Méthode permettant de vérifier la correspondance entre le login et 
     * mot de passe d'un utilisateur.
     * Retour un objet Utilisateur complété si corresponsance
     * Sinn retourne null
     * @param Utilisateur $user 
     * @return \Utilisateur|null 
     */
    function verifLogPass(Utilisateur $user) {
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
        debogage('UtilisateurMgr : verifLogPass :<br/>');
        $retour = false;
        $scriptAppelant = $this->nomScript;
        $numFonction = 6;

        $tabUtilisateur = array();
        $ID_UTIL = "";
        $NOM_UTIL = "";
        $PRENOM_UTIL = "";
        $LOGIN_UTIL = "";
        $PASS_UTIL = "";

        // ----------------------------------------------------------------
        //  I.2. Connexion à la base de données
        // ----------------------------------------------------------------
        $connect = new SGBD();
        $connect = $connect->connecterSGBD($connect);

        // Récupération de l'ID de connexion à la base
        $db = $connect->getDB();

        // ----------------------------------------------------------------
        //  I.3. Sécuriser ce qui sera utilisé en injection SQL
        // ----------------------------------------------------------------
        $LOGIN_UTIL = securiserSQL($user->getLOGIN_UTIL());
        $PASS_UTIL = securiserSQL($user->getPASS_UTIL());

      
        // ----------------------------------------------------------------
        //  I.4. Récupérer les données de l'utilisateur
        // ----------------------------------------------------------------
        //  I.4.1 Ecrire la requete d'effacement de la table UTILISATEUR
        $sql = "select * from UTILISATEUR
                where LOGIN_UTIL = '" . $LOGIN_UTIL . " '
                and   PASS_UTIL = '" . $PASS_UTIL . "';";

        // I.5.2. : Injecter la requête dans la base.
        $result = mysql_query($sql);

        // I.5.3 : Si la requete renvoie une erreur (si result vaut 0)
        if ($result == 0) {
            // I.5.3.1 : Préparer le message d'erreur
            $msgErr = "Correspondance Login Password impossible. La requête SQL était : " . $sql;
            // I.5.3.2 : Affecter un numéro d'erreur
            $numErr = $numFonction . "-I.4.1-";
            // I.5.3.3 : Loguer l'événement
            eventlog($scriptAppelant, $numErr, $msgErr);
            // I.5.3.4 : Appeler la fonction de debogage
            debogage($scriptAppelant, $numErr, $msgErr);
            // I.5.3.5 : Renvoyer l'utilisateur sur la page d'erreur
            header('Location: index.php?page=erreur&err=1');
        }
        // I.5.4 : Sinon je récupère l'ensemble des données données remonté
        //         par la requête
        else {
             
            $user = new Utilisateur(mysql_fetch_array($result));
            return $user;
        }
        return null;
    }

    /**
     * Retourne le groupe d'appartenance d'un utilisateur si il existe
     * sinon null
     * @param Utilisateur $user
     * @return null/string
     */
    function utilisateurInGroupe(Utilisateur $user) {

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
        debogage('UtilisateurMgr : UtilisaterInGroupe :<br/>');
        $retour = false;
        $scriptAppelant = $this->nomScript;
        $numFonction = 7;

        $tabUtilisateur = array();
        $ID_UTIL = "";
        $NOM_UTIL = "";
        $PRENOM_UTIL = "";
        $LOGIN_UTIL = "";
        $PASS_UTIL = "";


        // ----------------------------------------------------------------
        //  I.2. Connexion à la base de données
        // ----------------------------------------------------------------
        $connect = new SGBD();
        $connect = $connect->connecterSGBD($connect);

        // Récupération de l'ID de connexion à la base
        $db = $connect->getDB();

        // ----------------------------------------------------------------
        //  I.3. Sécuriser ce qui sera utilisé en injection SQL
        // ----------------------------------------------------------------
        $ID_UTIL = securiserSQL($user->getID_UTIL());

        // ----------------------------------------------------------------
        //  I.4. Récupérer les données de l'utilisateur
        // ----------------------------------------------------------------
        //  I.4.1 Ecrire la requete d'effacement de la table UTILISATEUR
        
        
        
        $sql = "select NOM_GROUPE 
            
                from UTILISATEUR
                

                JOIN CONTENIR on UTILISATEUR.ID_UTIL = CONTENIR.ID_UTIL
                JOIN GROUPE   on CONTENIR.ID_GROUPE = GROUPE.ID_GROUPE
                
                where UTILISATEUR.ID_UTIL = '" . $ID_UTIL . "' ;";

        // I.5.2. : Injecter la requête dans la base.
        $result = mysql_query($sql);

        // I.5.3 : Si la requete renvoie une erreur (si result vaut 0)
        if ($result == 0) {
            // I.5.3.1 : Préparer le message d'erreur
            $msgErr = "Erreur dans la requête. La requête SQL était : " . $sql;
            // I.5.3.2 : Affecter un numéro d'erreur
            $numErr = $numFonction . "-I.4.1-";
            // I.5.3.3 : Loguer l'événement
            eventlog($scriptAppelant, $numErr, $msgErr);
            // I.5.3.4 : Appeler la fonction de debogage
            debogage($scriptAppelant, $numErr, $msgErr);
            // I.5.3.5 : Renvoyer l'utilisateur sur la page d'erreur
            header('Location: index.php?page=erreur&err=1');
        }
        // I.5.4 : Sinon je récupère l'ensemble des données données remonté
        //         par la requête
        else {
            $retour = mysql_fetch_array($result);
            return $retour['NOM_GROUPE'];
        }
        return null;
    }

    function getUtilisateurParLogin(Utilisateur $user) {
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
        debogage('UtilisateurMgr : getUtilisateurParLogin :<br/>');
        $retour = false;
        $scriptAppelant = $this->nomScript;
        $numFonction = 8;

        $tabUtilisateur = array();
        $ID_UTIL = "";
        $NOM_UTIL = "";
        $PRENOM_UTIL = "";
        $LOGIN_UTIL = "";
        $PASS_UTIL = "";

        // ----------------------------------------------------------------
        //  I.2. Connexion à la base de données
        // ----------------------------------------------------------------
        $connect = new SGBD();
        $connect = $connect->connecterSGBD($connect);

        // Récupération de l'ID de connexion à la base
        $db = $connect->getDB();

        // ----------------------------------------------------------------
        //  I.3. Sécuriser ce qui sera utilisé en injection SQL
        // ----------------------------------------------------------------
        $ID_UTIL = securiserSQL($user->getLOGIN_UTIL());

        // ----------------------------------------------------------------
        //  I.4. Récupérer les données de l'utilisateur
        // ----------------------------------------------------------------
        //  I.4.1 Ecrire la requete d'effacement de la table UTILISATEUR
        $sql = "select * 
                from UTILISATEUR
                where LOGIN_UTIL= '" . $LOGIN_UTIL . "' ;";

        // I.5.2. : Injecter la requête dans la base.
        $result = mysql_query($sql);

        // I.5.3 : Si la requete renvoie une erreur (si result vaut 0)
        if ($result == 0) {
            // I.5.3.1 : Préparer le message d'erreur
            $msgErr = "Erreur dans la requête. La requête SQL était : " . $sql;
            // I.5.3.2 : Affecter un numéro d'erreur
            $numErr = $numFonction . "-I.4.1-";
            // I.5.3.3 : Loguer l'événement
            eventlog($scriptAppelant, $numErr, $msgErr);
            // I.5.3.4 : Appeler la fonction de debogage
            debogage($scriptAppelant, $numErr, $msgErr);
            // I.5.3.5 : Renvoyer l'utilisateur sur la page d'erreur
            header('Location: index.php?page=erreur&err=1');
        }
        // I.5.4 : Sinon je récupère l'ensemble des données données remonté
        //         par la requête
        else {
            $enregistrement = mysql_fetch_assoc($result);

            $retour = new Utilisateur($enregistrement);

            return $retour;
        }
        return null;
    }

}

?>
