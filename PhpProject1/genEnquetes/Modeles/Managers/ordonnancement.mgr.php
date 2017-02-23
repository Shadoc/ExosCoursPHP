<?php

/*
 * Auteur Laurent Cordier
 * Date de création : 10/04/2012
 * Date de dernière modification : 10/04/2012
 * 
 * Etat d'avancement : A tester
 */

class ordonnancementMgr {

    // Entete des messages d'erreur correspondant au script :
    private $nomScript;

    // tous les ordonnancementMgr on besoin d'une connexion à la base de donnée.
    function ordonnancementMgr() {
        $this->nomScript = "Modele:Managers:ordonnancement.mgr.php:>";
        debogage('------------------------<br/>');
        debogage('ordonnancementMgr : Appel Constructeur ordonnancementMgr<br/>');
    }

   

    /**
     * Ajoute un enregistrement à la table ordonnancement 
     * Cree la lisaison entre l enquete et l ordonnancement s il y a lieu
     * Retourne le ordonnancement ajouté
     * sinon retourne false
     * @param type $objOrdo
     * @param type $objEnquete
     * @return type 
     */
    function addOrdonnancement($objOrdonnancement, $objEnquete) {
        // ----------------------------------------------------------------
        // 
        //                  PREPARATION DU DEBOGAGE
        //             
        // ----------------------------------------------------------------
        debogage('------------------------<br/>');
        debogage('ordonnancementMgr : getOrdonnancement : Appel ordonnancementMgr<br/>');
        $retour = false;
        $scriptAppelant = $this->nomScript;
        $numFonction = 1;


        // ----------------------------------------------------------------
        // 
        //                  CONNEXION A LA BASE DE DONNEES
        //             
        // ----------------------------------------------------------------
        $connect = new SGBD();
        $connect = $connect->connecterSGBD($connect);

        // Récupération de l'ID de connexion à la base
        $db = $connect->getDB();


        // ----------------------------------------------------------------
        // 
        //            RECUPERATION DU/DES PARAMETRE(S) D ENTREE
        //             
        // ----------------------------------------------------------------
        // Je regarde combien d'arguments sont entrees dans ma methode
        $numParam = func_num_args();

        if ($numParam == 2) {
            $temp_args = func_get_args();
            $argument_1 = $temp_args[0];
            $argument_2 = $temp_args[1];

            // Le premier argument devrait etre un objet Ordonnancement
            if (is_a($argument_1, 'Ordonnancement')) {
                $objOrdo = $argument_1;
                // Recuperation des elements necessaires a la requete
                $nom_table = $objOrdo->getNOM_TABLE_ORD();
                $id_table = $objOrdo->getID_TABLE_ORD();
                $num_ord = $objOrdo->getNUM_ORD();
            }
            // Si le premier argument n'est pas un objet Ordonnancement
            else {
                $numErr = "";
                $numErr = "Le 1er arguement passé à la méthode addOrdonnancement n'est pas un objet Ordonnancement";
                eventlog($scriptAppelant, $numErr, $msgErr);
                header('Location: index.php?page=erreur&err=1');
            }


            // Le deuxieme argument devrait etre une enquete
            if (is_a($argument_2, 'Enquete')) {
                $objEnq = $argument_2;
                $id_enquete = $objEnq->getID_ENQUETE();

                // Si l'objet Enquete n'a pas d'ID c'est une erreur 
                // car il ne pourra y avoir de creation de liaison dans 
                // la table ORDONNANCER
                if (preg_match("#[^0-9]#", $id_enquete) != 0) {
                    $numErr = "";
                    $msgErr = "Le deuxième arguement passé à la méthode addOrdonnancement, ";
                    $msgErr .= "est un objet Enquete mais dont l'ID n'est pas un entier";
                    eventlog($scriptAppelant, $numErr, $msgErr);
                    header('Location: index.php?page=erreur&err=1');
                }
            }

            // si ce n'est pas une enquete alors c'est une erreur
            else {
                $numErr = "";
                $msgErr = "Le 2eme arguement passé à la méthode addOrdonnancement n'est pas un objet Enquete";
                eventlog($scriptAppelant, $numErr, $msgErr);
                header('Location: index.php?page=erreur&err=1');
            }
        }
        // S'il n'y a pas deux arguements en entree alors c'est une erreur
        else {
            $numErr = "";
            $msgErr = "La méthode addOrdonnancement attend deux arguments, \n";
            eventlog($scriptAppelant, $numErr, $msgErr);
            header('Location: index.php?page=erreur&err=1');
        }

        // ----------------------------------------------------------------
        // 
        //                  ENREGISTREMENT DE L ORDONNANCEMENT
        //                     DANS LA TABLE ORDONNANCEMENT
        //             
        // ----------------------------------------------------------------
        // Protection de la requête        
        $nom_table = securiserSQL($nom_table);
        $id_table = securiserSQL($id_table);
        $num_ord = securiserSQL($num_ord);

        // Ecriture de la requete  
        $sql = "insert into ORDONNANCEMENT (NOM_TABLE_ORD, ID_TABLE_ORD, NUM_ORD)";
        $sql .= "values ('" . $nom_table . "','" . $id_table . "','" . $num_ord . "');";

        // Envoie de la requete à la base.     
        $retour = injecterSQL($scriptAppelant, $numFonction, $sql, $db);

        // S'il n'y a pas d'erreur alors 
        if ($retour == true) {

            // Je recupere le dernier id cree
            $id_ordonnancement = mysql_insert_id();

            // Que j'affecte a la donnee membre de mon objet Ordonnancement
            $objOrdo->setID_ORD($id_ordonnancement);
        } else {
            $msgErr = "L'ajout de l'objet Ordonnancement dans la table ORDDONNANCEMENT a echoue.\n";
            $msgErr .= "La requete sql était : " . $sql;
            eventlog($scriptAppelant, $numFonction, $msgErr);
            header('Location: index.php?page=erreur&err=1');
        }

        // ----------------------------------------------------------------
        // 
        //                  ENREGISTREMENT DE LA LIAISON
        //                    DANS LA TABLE ORDONNANCER
        //             
        // ----------------------------------------------------------------
        // je securise mes donnees variables avant de les passer a la base
        $id_enquete = securiserSQL($id_enquete);
        $id_ordonnancement = securiserSQL($id_ordonnancement);

        // je cree la requete permettant de creer la liaison dans la base 
        // table de liaison enquete_bouton
        $sql = "insert into ORDONNANCER (ID_ENQUETE, ID_ORD)";
        $sql .= "values ('" . $id_enquete . "','" . $id_ordonnancement . "')";

        // Envoie de la requete à la base.
        $retour = injecterSQL($scriptAppelant, $numFonction, $sql, $db);

        // S'il n'y a pas d'erreur alors 
        if ($retour == true) {
            // le retour de la methode sera l'objet Ordonnancement
            $retour = $objOrdo;
        } else {
            $msgErr = "L'enregistrement de la lisaison dans la table ORDONNANCER a echoué.\n";
            $msgErr .= "La requete sql était : " . $sql;
            eventlog($scriptAppelant, $numFonction, $msgErr);
            header('Location: index.php?page=erreur&err=1');
        }


        return $retour;
    }

    /**
     * Modifie un enregistrement de la table ordonnancement 
     * retourne true si ok false si ko
     * @param Ordonnancement $ordonnancement
     * @return type boolean
     */
    function modOrdonnancement(Ordonnancement $ordonnancement) {

        // Preparation du log et du debogage
        debogage('------------------------<br/>');
        debogage('ordonnancementMgr : getOrdonnancement : Appel ordonnancementMgr<br/>');
        $retour = false;
        $scriptAppelant = $this->nomScript;
        $numFonction = 2;

        // Connexion à la base de données
        $connect = new SGBD();
        $connect = $connect->connecterSGBD($connect);

        // Récupération de l'ID de connexion à la base
        $db = $connect->getDB();

        // Recuperation des elements necessaires a la requete
        $id_ord = $ordonnancement->getID_ORD();
        $id_enquete = $ordonnancement->getID_ENQUETE();
        $nom_table = $ordonnancement->getNOM_TABLE_ORD();
        $id_table = $ordonnancement->getID_TABLE_ORD();
        $num_ord = $ordonnancement->getNUM_ORD();

        // Protection de la requête        
        $id_ord = securiserSQL($id_ord);
        $id_enquete = securiserSQL($id_enquete);
        $nom_table = securiserSQL($nom_table);
        $id_table = securiserSQL($id_table);
        $num_ord = securiserSQL($num_ord);

        // Ecriture de la requete
        $sql = "update ORDONNANCEMENT set ";
        $sql .= "ID_ENQUETE ='" . $id_enquete . "', ";
        $sql .= "NOM_TABLE_ORD ='" . $nom_table . "', ";
        $sql .= "ID_TABLE_ORD ='" . $id_table . "', ";
        $sql .= "NUM_ORD ='" . $num_ord . "' ";
        $sql .= "WHERE ID_ORD = " . $id_ord . ";";


        // Envoie de la requete à la base.
        $retour = injecterSQL($scriptAppelant, $numFonction, $sql, $db);

        return $retour;
    }

    function delOrdonnancement($param) {
        // Preparation du log et du debogage
        debogage('------------------------<br/>');
        debogage('ordonnancementMgr : getOrdonnancement : Appel ordonnancementMgr<br/>');
        $retour = false;
        $scriptAppelant = $this->nomScript;
        $numFonction = 3;

        // Si je passe un objet alors j'efface l'objet via son ID
        if (is_object($param)) {
            $id_ordonnancement = $param->getID_ORD();
        }

        // Sinon c'est que param doit etre un ID
        else {
            $id_ordonnancement = $param;
        }

        // Connexion à la base de données
        $connect = new SGBD();
        $connect = $connect->connecterSGBD($connect);

        // Récupération de l'ID de connexion à la base
        $db = $connect->getDB();

        // Protection de la requête
        $id_ordonnancement = securiserSQL($id_ordonnancement);

        // Ecriture de la requete
        $sql = "delete from ORDONNANCEMENT where ID_ORD = '" . $id_ordonnancement . "';";

        // Envoie de la requete à la base.
        $retour = injecterSQL($scriptAppelant, $numFonction, $sql, $db);

        return $retour;
    }

    
    
     /**
     * Méthode permettant de récupérer les informations de la table ordonnancement dans 
     * l'objet ordonnancement passé en argument.
     * @param type $id_ordonnancement
     * @return \Ordonnancement|boolean 
     */
    function getOrdonnancement($id_ordonnancement) {
        // Preparation du log et du debogage
        debogage('------------------------<br/>');
        debogage('ordonnancementMgr : getOrdonnancement : Appel ordonnancementMgr<br/>');
        $retour = false;
        $scriptAppelant = $this->nomScript;
        $numFonction = 1;

        // Connexion à la base de données
        $connect = new SGBD();
        $connect = $connect->connecterSGBD($connect);

        // Récupération de l'ID de connexion à la base
        $db = $connect->getDB();

        // Protection de la requête        
        $id_ordonnancement = securiserSQL($id_ordonnancement);

        // Redige la requête
        $sql = "SELECT * FROM ORDONNANCEMENT WHERE ID_ORD = " . $id_ordonnancement;
        debogage('ordonnancementMgr : getOrdonnancement : SQL :<br/>' . $sql);

        // Execution de la requête
        $result = mysql_query($sql, $db);

        // Si erreur de la requete alors page erreur        
        if ($result == 0) {

            // Preparation du message d'erreur
            $msgErr = "Erreur de la requete SQL : " . $sql;

            // Affichage pour debogage
            debogage($msgErr . "<br/>");

            //Log de l'erreur
            eventlog($scriptAppelant, $numFonction, $msgErr);

            header('Location: index.php?page=erreur&err=1');

            // Sinon je renvoie le resultat sous forme d'objet
        } else {
            $ligne = mysql_fetch_assoc($result);
            $ordonnancement = new Ordonnancement($ligne);

            // Affichage pour debogage
            debogage('ordonnancementMgr : getOrdonnancement : ligne : <br/>');
            debogage(print_r($ligne) . '<br/>');

            return $ordonnancement;
        }
        return $retour;
    }
    
    
    /**
     * Methode qui retourne l'id de la table ordonnancement corresondant aux 
     * paramètres d'entrée
     * @param type $nom_table (alphabétique)
     * @param type $id (numérique)
     * @return type $id_ord (numérique)
     */
    function recuperationIdOrd($nom_table, $id) {
        // ----------------------------------------------------------------
        // README Driven Developement
        // ==========================
        // 
        // I. Prérequis :
        //  I.1. Préparation des paramètres de débogages
        //  I.2. Connexion à la base de données
        //  I.3. Récupération des paramètres d'entrée
        //    I.3.1. S'il 2 argugments
        //      I.3.1.1 Si le premier argument ne contient pas de chiffre
        //        I.3.1.2.1 Alors je recupere le nom de la table qui sera traite 
        //        dans cette methode
        //      I.3.1.2 Sinon il y a une erreur
        //         I.3.1.2.1 : Préparer le message d'erreur
        //         I.3.1.2.2 : Affecter un numéro d'erreur
        //         I.3.1.2.3 : Loguer l'événement
        //         I.3.1.2.4 : Appeler la fonction de debogage
        //         I.3.1.2.5 : Renvoyer l'utilisateur sur la page d'erreur
        //      I.3.1.2 Si le deuxième argument ne contient que des chiffres
        //        I.3.1.2.1 Alors je recupere l'id du l'objet qui sera traite dans 
        //                 cette fonction
        //      I.3.1.3 Sinon c'est une erreur
        //        I.3.1.3.1 : Préparer le message d'erreur
        //        I.3.1.3.2 : Affecter un numéro d'erreur
        //        I.3.1.3.3 : Loguer l'événement
        //        I.3.1.3.4 : Appeler la fonction de debogage
        //        I.3.1.3.5 : Renvoyer l'utilisateur sur la page d'erreur
        //    I.3.2. Sinon (si le nombre d'argument est different de 2) c'est une erreur.
        //      II.3.2.1 : Préparer le message d'erreur
        //      II.3.2.2 : Affecter un numéro d'erreur
        //      II.3.2.3 : Loguer l'événement
        //      II.3.2.4 : Appeler la fonction de debogage
        //      II.3.2.5 : Renvoyer l'utilisateur sur la page d'erreur
        //  I.4. Sécuriser ce qui sera utilisé en injection SQL
        //  
        //  II. Récupérer l'id_ord et la renvoyer a l'appelant
        //    II.1 Construire la requête SQL
        //    II.2 Envoyer la requête à la base
        //    II.3 Si erreur de requete (le resulat de la requete est 0) alors
        //      II.3.1 : Préparer le message d'erreur
        //      II.3.2 : Affecter un numéro d'erreur
        //      II.3.3 : Loguer l'événement
        //      II.3.4 : Appeler la fonction de debogage
        //      II.3.5 : Renvoyer l'utilisateur sur la page d'erreur
        // II.4 : Sinon retourner la valeur de la requête a l'appelant
        //   II.4.1 Recupération du résltat de la requête
        //   II.4.2 Retour du résultat de la requête à l'appelant
        // ----------------------------------------------------------------
        // 
        // 
        // 
        // 
        // ----------------------------------------------------------------
        //                  I. Prérequis :
        //                  
        // ----------------------------------------------------------------
        // 
        // ----------------------------------------------------------------
        //  I.1. Préparation des paramètres de débogages
        // ----------------------------------------------------------------
        debogage('------------------------<br/>');
        debogage('boutonMgr : getBouton : Appel boutonMgr<br/>');
        $retour = false;
        $scriptAppelant = $this->nomScript;
        $numFonction = 5;

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

        // I.3.1. S'il 2 argugment
        if ($numArg == 2) {
            $temp_arg = func_get_arg();
            $argument01 = $temp_arg[0];
            $argument02 = $temp_arg[1];

            // I.3.1.1 Si le premier argument ne contient pas de chiffre
            if (preg_match("#[^0-9]#", $argument01) != 0) {
                // I.3.1.2.1 Alors je recupere le nom de la table qui sera traite 
                // dans cette methode
                $nom_table = $argument01;
            }
            // I.3.1.2 Sinon cet il y a une erreur
            else {
                // I.3.1.2.1 : Préparer le message d'erreur
                $msgErr = "Le premier argument de la méthode doit etre un alpha";
                // I.3.1.2.2 : Affecter un numéro d'erreur
                $numErr = "";
                // I.3.1.2.3 : Loguer l'événement
                eventlog($scriptAppelant, $numErr, $msgErr);
                // I.3.1.2.4 : Appeler la fonction de debogage
                debogage($scriptAppelant, $numErr, $msgErr);
                // I.3.1.2.5 : Renvoyer l'utilisateur sur la page d'erreur
                header('Location: index.php?page=erreur&err=1');
            }

            // I.3.1.2 Si le deuxième argument ne contient que des chiffres
            if (preg_match("#[^0-9]#", $argument02) == 0) {
                // I.3.1.2.1 Alors je recupere l'id du l'objet qui sera traite dans 
                //           cette fonction
                $id_objet = $argument02;
            }
            // I.3.1.3 Sinon c'est une erreur
            else {
                // I.3.1.3.1 : Préparer le message d'erreur
                $msgErr = "Le deuxième argument de la méthode doit etre un numérique";
                // I.3.1.3.2 : Affecter un numéro d'erreur
                $numErr = "";
                // I.3.1.3.3 : Loguer l'événement
                eventlog($scriptAppelant, $numErr, $msgErr);
                // I.3.1.3.4 : Appeler la fonction de debogage
                debogage($scriptAppelant, $numErr, $msgErr);
                // I.3.1.3.5 : Renvoyer l'utilisateur sur la page d'erreur  
                header('Location: index.php?page=erreur&err=1');
            }

            // I.3.2. Sinon (si le nombre d'argument est different de 2) c'est une erreur.
        } else {
            // II.3.1 : Préparer le message d'erreur
            $msgErr = "La méhode accepte sctrictement que deux arguments";
            // II.3.2 : Affecter un numéro d'erreur
            $numArg = "";
            // II.3.3 : Loguer l'événement
            eventlog($scriptAppelant, $numErr, $msgErr);
            // II.3.4 : Appeler la fonction de debogage
            debogage($scriptAppelant, $numErr, $msgErr);
            // II.3.5 : Renvoyer l'utilisateur sur la page d'erreur
            header('Location: index.php?page=erreur&err=1');
        }

        // ----------------------------------------------------------------
        //  I.4. Sécuriser ce qui sera utilisé en injection SQL
        // ----------------------------------------------------------------
        $id_objet = securiserSQL($id_objet);
        $nom_table = securiserSQL($nom_table);

        // ----------------------------------------------------------------   
        //  
        //  II. Récupérer l'id_ord et la renvoyer a l'appelant
        //  
        // ----------------------------------------------------------------     
        // II.1 Construire la requête SQL
        $sql = "select ID_ORD from ORDONNANCEMENT ";
        $sql .= "where ";
        $sql .= "NOM_TABLE_ORD like '" . $nom_table . "' ";
        $sql .= "and ";
        $sql .= "ID_TABLE_ORD = " . $id_objet . " ;";

        // II.2 Envoyer la requête à la base
        $result = mysql_query($sql);

        // II.3 Si erreur de requete (le resulat de la requete est 0) alors
        if ($result == 0) {
            // II.3.1 : Préparer le message d'erreur
            $msgErr = "Une erreur SQL est detectée. La requête était : " . $sql;
            // II.3.2 : Affecter un numéro d'erreur
            $numErr = "";
            // II.3.3 : Loguer l'événement
            eventlog($scriptAppelant, $numErr, $msgErr);
            // II.3.4 : Appeler la fonction de debogage
            debogage($scriptAppelant, $numErr, $msgErr);
            // II.3.5 : Renvoyer l'utilisateur sur la page d'erreur
            header('Location: index.php?page=erreur&err=1');
        }
        // II.4 : Sinon retourner la valeur de la requête a l'appelant
        else {
            // II.4.1 Recupération du résltat de la requête
            $temp = mysql_fetch_array($result);
            $id_ord = $temp['ID_ORD'];
            // II.4.2 Retour du résultat de la requête à l'appelant
            return $id_ord;
        }
    }
}
?>


