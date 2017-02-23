<?php

/*
 * Auteur Laurent Cordier
 * Date de création : 03/04/2012
 * Date de dernière modification : 21/05/2012
 * 
 * Etat d'avancement : Termine
 */

class boutonMgr {

    // Entete des messages d'erreur correspondant au script :
    private $nomScript;

    // tous les boutonMgr on besoin d'une connexion à la base de donnée.
    function boutonMgr() {
        $this->nomScript = "Modele:Managers:bouton.mgr.php:>";
        debogage('------------------------<br/>');
        debogage('boutonMgr : Appel Constructeur boutonMgr<br/>');
    }



    /**
     * Ajoute un enregistrement à la table bouton 
     * Retourne le bouton ajouté
     * @param Bouton $objBout
     * @return \Bouton 
     */
    function addBouton($objBouton, $objEnquete) {

        // ----------------------------------------------------------------
        //                  PREPARATION DU DEBOGAGE
        // ----------------------------------------------------------------
        debogage('------------------------<br/>');
        debogage('boutonMgr : getBouton : Appel boutonMgr<br/>');
        $retour = false;
        $scriptAppelant = $this->nomScript;
        $numFonction = 1;


        // ----------------------------------------------------------------
        //                  CONNEXION A LA BASE DE DONNEES
        // ----------------------------------------------------------------
        // Connexion à la base de données
        $connect = new SGBD();
        $connect = $connect->connecterSGBD($connect);

        // Récupération de l'ID de connexion à la base
        $db = $connect->getDB();



        // ----------------------------------------------------------------
        //            RECUPERATION DU/DES PARAMETRE(S) D ENTREE
        // ----------------------------------------------------------------
        // Je regarde combien d'arguments sont entrees dans ma methode
        $numParam = func_num_args();

        // Si j'ai 1 argugment
        if ($numParam == 1) {
            $temp_arg = func_get_args();
            $argument = $temp_arg[0];

            // et que cet argument est un Bouton 
            if (is_a($argument, 'Bouton')) {
                // Alors je recupere mon bouton qui sera traite dans cette methode
                $objBout = $argument;
                // Recuperation des elements du bouton necessaires a la requete
                $type = $objBout->getTYPE_BOUTON();
                $value = $objBout->getVALUE_BOUTON();
                $action = $objBout->getACTION_BOUTON();
                $name = $objBout->getNAME_BOUTON();
                // sinon c'est une erreur
            } else {
                $numErr = "";
                $msgErr = "Lorsqu'il n'y a qu'un seul arguement passé à la méthode addBouton,";
                $msgErr .= "le type attendu pour la fonction addBouton est Bouton";
                eventlog($scriptAppelant, $numErr, $msgErr);
                header('Location: index.php?page=erreur&err=1');
            }

            // sinon, si j'ai 2 argument 
        } else if ($numParam == 2) {
            $temp_args = func_get_args();
            $argument_1 = $temp_args[0];
            $argument_2 = $temp_args[1];
            // Le premier argument devrait etre un bouton
            if (is_a($argument_1, 'Bouton')) {
                $objBout = $argument_1;
                // Recuperation des elements necessaires a la requete
                $type = $objBout->getTYPE_BOUTON();
                $value = $objBout->getVALUE_BOUTON();
                $action = $objBout->getACTION_BOUTON();
                $name = $objBout->getNAME_BOUTON();
            }
            // sinon c'est une erreur
            else {
                $numErr = "";
                $msgErr = "Les 1er arguement passé à la méthode addBouton n'est pas un objet Bouton";
                eventlog($scriptAppelant, $numErr, $msgErr);
                header('Location: index.php?page=erreur&err=1');
            }

            // Le deuxieme argument devrait etre une enquete
            if (is_a($argument_2, 'Enquete')) {
                $objEnq = $argument_2;
                // Recuperation des elements de l'objet enquete necessaires a la requete
                $id_enquete = $objEnq->getID_ENQUETE();
                $titre_enquete = $objEnq->getTITRE_ENQUETE();
                $introduction_enquete = $objEnq->getINTRODUCTION_ENQUETE();
                $conclusion_enquete = $objEnq->getCONCLUSION_ENQUETE();

                // Si l'objet Enquete n'a pas d'ID c'est une erreur 
                // car il ne pourra y avoir de creation de liaison dans 
                // la table ENQUETE_BOUTON
                if (preg_match("#[^0-9]#", $id_enquete) != 0) {
                    $numErr = "";
                    $msgErr = "Le deuxième arguement passé à la méthode addBouton, ";
                    $msgErr .= "est un objet Enquete mais dont l'ID n'est pas un entier";
                    eventlog($scriptAppelant, $numErr, $msgErr);
                    header('Location: index.php?page=erreur&err=1');
                }
            }

            // si ce n'est pas une enquete alors c'est une erreur
            else {
                $numErr = "";
                $msgErr = "Les 2eme arguement passés à la méthode addBouton n'est pas un objet Enquete";
                eventlog($scriptAppelant, $numErr, $msgErr);
                header('Location: index.php?page=erreur&err=1');
            }
        }



        // ----------------------------------------------------------------
        //                  ENREGISTREMENT DU BOUTON
        //                    DANS LA TABLE BOUTON
        // ----------------------------------------------------------------
        // Protection de la requête        
        $type = securiserSQL($type);
        $value = securiserSQL($value);
        $action = securiserSQL($action);
        $name = securiserSQL($name);

        $id_enquete = securiserSQL($id_enquete);
        $titre_enquete = securiserSQL($titre_enquete);
        $introduction_enquete = securiserSQL($introduction_enquete);
        $conclusion_enquete = securiserSQL($conclusion_enquete);

        // Ecriture de la requete  d'ajout du bouton
        $sql = "insert into BOUTON (TYPE_BOUTON ,VALUE_BOUTON, ACTION_BOUTON, NAME_BOUTON ) values ('" . $type . "','" . $value . "','" . $action . "','" . $name . "')";

        // Envoie de la requete à la base.
        $retour = injecterSQL($scriptAppelant, $numFonction, $sql, $db);

        // S'il n'y a pas d'erreur
        if ($retour == true) {
            // je récupere le dernier id créé par mysql que j'affecte à l'id de mon bouton
            $id_bouton = mysql_insert_id();

            // je créé mon bouton avec cet id
            $objBout->setID_BOUTON($id_bouton);
        } else {
            $msgErr = "L'ajout de l'objet Bouton dans la table BOUTON a echoue.\n";
            $msgErr .= "La requete sql était : " . $sql;
            eventlog($scriptAppelant, $numFonction, $msgErr);
            header('Location: index.php?page=erreur&err=1');
        }


        // ----------------------------------------------------------------
        //                  ENREGISTREMENT DE LA LIAISON
        //                  DANS LA TABLE ENQUETE_BOUTON
        // ----------------------------------------------------------------
        // Il n'y a de liaison que s'il exite un objet Enquete
        if (isset($objEnq)) {
            // Ecriture de la requete  d'ajout du bouton
            $sql = "insert into ENQUETE_BOUTON (ID_ENQUETE, ID_BOUTON) values ('" . $id_enquete . "', '" . $id_bouton . "');";
            // Envoie de la requete à la base.
            $retour = injecterSQL($scriptAppelant, $numFonction, $sql, $db);

            if ($retour == false) {
                $msgErr = "L'enregistrement de la liaison dans la table ENQUETE_BOUTON a echoue.\n";
                $msgErr .= "La requete sql était : " . $sql;
                eventlog($scriptAppelant, $numFonction, $msgErr);
                header('Location: index.php?page=erreur&err=1');
            }
        }
        // ----------------------------------------------------------------
        //                  ENREGISTREMENT DU BOUTON
        //                DANS LA TABLE ORDONNANCEMENT
        // ----------------------------------------------------------------
        // Il y a ordonnancement que s'il y a Enquete
        if (isset($objEnq)) {
            // j'integre ce bouton a l'ordonnancement
            $ordMgr = new ordonnancementMgr();
            $objOrdonnancement = new Ordonnancement();
            //$objOrdonnancement->getID_ORD();
            $objOrdonnancement->setNOM_TABLE_ORD("BOUTON");
            $objOrdonnancement->setID_TABLE_ORD($id_bouton);

            // Je recupere le dernier numero d ordre de la table d ordonnancement
            //$dernierNumOrdre = dernierElement("ORDONNANCEMENT", "NUM_ORD");
            $dernierNumOrdre = numeroOrdre($objEnq);

            // J'affecte le nouveau numero d ordre a ma table d ordonnancement
            $dernierNumOrdre = $dernierNumOrdre + 1;
            $objOrdonnancement->setNUM_ORD($dernierNumOrdre);

            // L'objet ordonnancement est maintenant complet.
            // Je demande son ajout a la table ordonnancement
            $retour = $ordMgr->addOrdonnancement($objOrdonnancement, $objEnq);

            // S'il y a une erreur dans l'ajout dans la table ordonnancement
            // alors log et renvoie sur une page d'erreur
            if ($retour == false) {
                $msgErr = "L'ajout de l'objet Bouton n'a pas pu être référencé dans la table Ordonnancement";
                $msgErr .= "La requete sql était : " . $sql;
                eventlog($scriptAppelant, $numFonction, $msgErr);
                header('Location: index.php?page=erreur&err=1');
            }
        }
        return $objBout;
    }

    /**
     * Modifie un enregistrement de la table bouton 
     * retourne true si ok false si ko
     * @param Bouton $objBout
     * @return type boolean
     */
    function modBouton($objBout) {
        // ----------------------------------------------------------------
        //                  PREPARATION DU DEBOGAGE
        // ----------------------------------------------------------------
        debogage('------------------------<br/>');
        debogage('boutonMgr : getBouton : Appel boutonMgr<br/>');
        $retour = false;
        $scriptAppelant = $this->nomScript;
        $numFonction = 2;


        // ----------------------------------------------------------------
        //                  CONNEXION A LA BASE DE DONNEES
        // ----------------------------------------------------------------
        // Connexion à la base de données
        $connect = new SGBD();
        $connect = $connect->connecterSGBD($connect);

        // Récupération de l'ID de connexion à la base
        $db = $connect->getDB();



        // ----------------------------------------------------------------
        //            RECUPERATION DU/DES PARAMETRE(S) D ENTREE
        // ----------------------------------------------------------------
        // Je regarde combien d'arguments sont entrees dans ma methode
        $numParam = func_num_args();

        // Si j'ai 1 argugment
        if ($numParam == 1) {
            $temp_arg = func_get_args();
            $argument = $temp_arg[0];

            // et que cet argument est un Bouton 
            if (is_a($argument, 'Bouton')) {
                // Alors je recupere mon bouton qui sera traite dans cette methode
                $objBout = $argument;
                // Recuperation des elements du bouton necessaires a la requete
                $id_bouton = $objBout->getID_BOUTON();
                $type = $objBout->getTYPE_BOUTON();
                $value = $objBout->getVALUE_BOUTON();
                $action = $objBout->getACTION_BOUTON();
                $name = $objBout->getNAME_BOUTON();
                // sinon c'est une erreur
            } else {
                $numErr = "";
                $msgErr .= "Lorsqu'il n'y a qu'un seul arguement passé à la méthode modBouton,";
                $msgErr .= "le type attendu pour la fonction addBouton est Bouton";
                eventlog($scriptAppelant, $numErr, $msgErr);
                header('Location: index.php?page=erreur&err=1');
            }
        }
        // S'il y a plus d'un argument alors c'est une erreur
        else {
            $numErr = "";
            $msgErr .= "La méthode modBouton prends 1 arguement";
            eventlog($scriptAppelant, $numErr, $msgErr);
            header('Location: index.php?page=erreur&err=1');
        }


        // ----------------------------------------------------------------
        //                   MODIFICATION DU BOUTON
        //                    DANS LA TABLE BOUTON
        // ----------------------------------------------------------------
        // Protection de la requête        
        $id_bouton = securiserSQL($id_bouton);
        $type = securiserSQL($type);
        $value = securiserSQL($value);
        $action = securiserSQL($action);
        $name = securiserSQL($name);

        // Ecriture de la requete
        $sql = "update BOUTON set TYPE_BOUTON='" . $type . "',"
                . "VALUE_BOUTON='" . $value . "', "
                . "ACTION_BOUTON='" . $action . "', "
                . "NAME_BOUTON='" . $name . "'"
                . "WHERE ID_BOUTON=" . $id_bouton;

        // Envoie de la requete à la base.
        $retour = injecterSQL($scriptAppelant, $numFonction, $sql, $db);


        // s'il n'y a pas d'erreur alors la valeur de retour de la methode passe a true
        if ($retour == true) {
            $retour = true;
        }
        // S'il y a une erreur dans la requete alors je logue
        else {
            $msgErr = "La modification de l'enregistrement dans la table BOUTON a echoue.\n";
            $msgErr .= "La requete sql était : " . $sql;
            eventlog($scriptAppelant, $numFonction, $msgErr);
            header('Location: index.php?page=erreur&err=1');
        }


        return $retour;
    }

    function delBouton($argument) {

        // ----------------------------------------------------------------
        // README Driven Developement
        // ==========================
        // 
        // I. Prérequis :
        //  I.1. Préparation des paramètres de débogages
        //  I.2. Connexion à la base de donnée
        //  I.3. Récupération des paramètres d'entrée
        //        Je regarde combien d'arguments sont entrees dans ma methode
        //    I.3.1. Si j'ai 1 argugment
        //      I.3.1.1 Si cet argument est un Bouton
        //        I.3.1.2.1 Alors je recupere mon bouton qui sera traite dans 
        //                  cette methode
        //        I.3.1.2.2 et je récupère l'id de ce bouton
        //      I.3.1.2 Sinon cet arguement est concidéré comme un id 
        //        I.3.1.2.1 Si cet argument est un entier alors c'est mon id
        //        I.3.1.2.2 Sinon c'est une erreur.
        //          I.3.1.2.2.1 Préparer le message d'erreur
        //          I.3.1.2.2.2 : Affecter un numéro d'erreur
        //          I.3.1.2.2.3 : Loguer l'événement
        //          I.3.1.2.2.4 : Appeler la fonction de debogage
        //          I.3.1.2.2.5 : Renvoyer l'utilisateur sur la page d'erreur
        //    I.3.2. Sinon (Si ne n'ai pas d'argument) c'est une erreur.
        //      I.3.2.1 Préparer le message d'erreur
        //      I.3.2.2 : Affecter un numéro d'erreur
        //      I.3.2.3 : Loguer l'événement
        //      I.3.2.4 : Appeler la fonction de debogage
        //      I.3.2.5 : Renvoyer l'utilisateur sur la page d'erreur
        //  I.4. Sécuriser ce qui sera utilisé en injection SQL
        //  
        //  
        // II. Effacement du Bouton :
        //   II.1 Vérifier si le bouton est lié à une enquête
        //     II.1.1. : Preparer la requete sql (rechercher le nombre d'id_enquete lié à 
        //              l'id_bouton dans la table de liaison enquete_bouton.
        //     II.1.2. : Envoyer la requete à la base
        //     II.1.3. : Si erreur de requete (le resulat de la requete est 0) alors
        //       II.1.3.1 : Préparer le message d'erreur
        //       II.1.3.2 : Affecter un numéro d'erreur
        //       II.1.3.3 : Loguer l'événement
        //       II.1.3.4 : Appeler la fonction de debogage
        //       II.1.3.5 : Renvoyer l'utilisateur sur la page d'erreur
        //    II.1.4. : Sinon affecter la valeur de retour de la requête a la 
        //              variable nbrEnquetes      
        //              
        //   II.2. Si le bouton n'est pas lié à une enquête alors
        //      II.2.1. : Préparer la requete de suppression de l'enregistrement
        //                du bouton dans la table Bouton
        //      II.2.2. : Injecter la requête dans la base via la fonction
        //                injecterSQL.
        //                
        //   II.3. Si le bouton est lié à 1 enquête alors 
        //   
        //      II.3.1 Effacer la liaison de la table ENQUETE_BOUTON
        //         II.3.1.1 Préparer la requête de suppression de la table 
        //         ENQUETE_BOUTON.
        //         II.3.1.2 Injecter la requête dans la base via la fonction 
        //                  injecterSQL
        //                  
        //      II.3.2 Effacer le bouton dans la table BOUTON
        //         II.3.2.1 Préparer la requête de suppression de la table 
        //         BOUTON contenant.
        //         II.3.2.2 Injecter la requête dans la base via la fonction 
        //                  injecterSQL
        //      II.3.3 Récupérer l'id de l'enregistrement de la table ORDONNANCEMENT
        //             correspondant au bouton de la table BOUTON           
        //         II.3.3.1 Préparer la requête de recherche
        //         II.3.3.2 Executer la requête 
        //         II.3.3.3 S'il ny a pas d'erreur
        //            II.3.3.3.1 Récupérer l'id en retour
        //         II.3.3.4 Si erreur de requete (le resulat de la requete est 0) alors
        //            II.3.3.4.1 : Préparer le message d'erreur
        //            II.3.3.4.2 : Affecter un numéro d'erreur
        //            II.3.3.4.3 : Loguer l'événement
        //            II.3.3.4.4 : Appeler la fonction de debogage
        //            II.3.3.4.5 : Renvoyer l'utilisateur sur la page d'erreur
        //            
        //      II.3.4 Effacer la liaison ORDONNANCER
        //         II.3.4.1 Préparer la requête de suppression de la table 
        //                  ORDONNANCER liant l'ordonnancement du bouton et 
        //                  l'enquete.
        //         II.3.4.2 Injecter la requête dans la base via la fonction 
        //                  injecterSQL
        //                  
        //      II.3.5 Effacer le bouton de la table Ordonnancement
        //         II.3.5.1 Préparation de la requête SQL
        //         II.3.5.2 Injecter la requête dans la base via la fonction 
        //                  injecterSQL
        // ----------------------------------------------------------------
        // 
        // 
        // ----------------------------------------------------------------
        //                  
        //                  I. Prérequis :
        //                  
        // ----------------------------------------------------------------
        //  I.1. PREPARATION DU DEBOGAGE
        // ----------------------------------------------------------------
        debogage('------------------------<br/>');
        debogage('boutonMgr : getBouton : Appel boutonMgr<br/>');
        $retour = false;
        $scriptAppelant = $this->nomScript;
        $numFonction = 3;

        // ----------------------------------------------------------------
        //  I.2. CONNEXION A LA BASE DE DONNEES
        // ----------------------------------------------------------------
        $connect = new SGBD();
        $connect = $connect->connecterSGBD($connect);

        // Récupération de l'ID de connexion à la base
        $db = $connect->getDB();


        // ----------------------------------------------------------------
        //  I.3. RECUPERATION DU/DES PARAMETRE(S) D ENTREE
        // ----------------------------------------------------------------
        // Je regarde combien d'arguments sont entrees dans ma methode

        $numParam = func_num_args();

        // I.3.1. Si j'ai 1 argugment
        if ($numParam == 1) {
            $temp_arg = func_get_args();
            $argument = $temp_arg[0];

            // I.3.1.1 Si cet argument est un Bouton
            if (is_a($argument, 'Bouton')) {
                // I.3.1.2.1 Alors je recupere mon bouton qui sera traite 
                //           dans cette methode
                $objBout = $argument;
                // I.3.1.2.2 et je récupère l'id de ce bouton,
                $id_bouton = $objBout->getID_BOUTON();

                // I.3.1.2 Sinon cet arguement est concidéré comme un id    
            } else {
                // I.3.1.2.1 Si cet argument est un entier alors c'est mon id
                if (preg_match("#[^0-9]#", $id_enquete) == 0) {
                    $id_bouton = $argument;
                }
                // I.3.1.2.2 Sinon c'est une erreur.
                else {
                    // I.3.1.2.2.1 Préparer le message d'erreur
                    $msgErr = "L'argument passé à la méhtode delBouton n'est pas valide. ";
                    // I.3.1.2.2.2 : Affecter un numéro d'erreur
                    $numErr = "";
                    // I.3.1.2.2.3 : Loguer l'événement
                    eventlog($scriptAppelant, $numErr, $msgErr);
                    // I.3.1.2.2.4 : Appeler la fonction de debogage
                    debogage($scriptAppelant, $numErr, $msgErr);
                    // I.3.1.2.2.5 : Renvoyer l'utilisateur sur la page d'erreur
                    header('Location: index.php?page=erreur&err=1');
                }
            }
        }
        // I.3.2. Sinon (Si ne n'ai pas d'argument) c'est une erreur.
        else {
            // I.3.2.1 Préparer le message d'erreur
            $msgErr = "La méthode modBouton prends 1 arguement";
            // I.3.2.2 : Affecter un numéro d'erreur
            $numErr = "";
            // I.3.2.3 : Loguer l'événement
            eventlog($scriptAppelant, $numErr, $msgErr);
            // I.3.2.4 : Appeler la fonction de debogage
            header('Location: index.php?page=erreur&err=1');
            // I.3.2.5 : Renvoyer l'utilisateur sur la page d'erreur
        }

        // ----------------------------------------------------------------
        // I.4. Il faut sécurisé ce qui sera utilisé en injection SQL
        // ----------------------------------------------------------------
        $id_bouton = securiserSQL($id_bouton);

        // ----------------------------------------------------------------
        //                  
        //         II. Effacement du Bouton :
        //                  
        // ----------------------------------------------------------------
        // ----------------------------------------------------------------
        // II.1 Vérifier si le bouton est lié à une enquête
        // ----------------------------------------------------------------        
       
       
        //II.1.1. : Preparer la requete sql (rechercher le nombre d'id_enquete lié à 
        //          l'id_bouton dans la table de liaison enquete_bouton.
        $sql = "";
        $sql .= "select count(ID_ENQUETE) from ENQUETE_BOUTON where ID_BOUTON = " . $id_bouton . " ;";

        // II.1.2. : Envoyer la requete à la base
        $result = mysql_query($sql, $db);

        // II.1.3. : Si erreur de requete (le resulat de la requete est 0) alors
        if ($result == 0) {
            // II.1.3.1 : Préparer le message d'erreur
            $msgErr = "Erreur de la requete SQL : " . $sql;
            // II.1.3.2 : Affecter un numéro d'erreur
            $numErr = "";
            // II.1.3.3 : Loguer l'événement
            eventlog($scriptAppelant, $numFontion, $msgErr);
            // II.1.3.4 : Appeler la fonction de debogage
            debogage($msgErr . "<br/>");
            // II.1.3.5 : Renvoyer l'utilisateur sur la page d'erreur
            header('Location: index.php?page=erreur&err=1');
        }

        // II.1.4. : Sinon il n'y pas d'erreur
        else {
            $temp = mysql_fetch_assoc($result);
            $nbrEnquetes = $temp['count(ID_ENQUETE)'];
            //    II.1.4.1 : Si la valeur de retour est 0
            if ($nbrEnquetes == 0) {
                // II.1.4.1.1 alors il n'y a pas de liaison
                $lie = false;
            }
            //    II.1.4.2 : Sinon si la valeur de retour est 1 
            else if ($nbrEnquetes == 1) {
                // II.1.4.2.1 : alors il y a une liaison
                $lie = true;
            }
            // II.1.4.2.1 : alors il y a une erreur
            else {
                // II.1.4.2.1 : Préparer le message d'erreur
                $msgErr = "Problème dans l'intégrité de la base. la requete SQL etait : " . $sql;
                // II.1.4.2.2 : Affecter un numéro d'erreur
                $numErr = "";
                // II.1.4.2.3 : Loguer l'événement
                eventlog($scriptAppelant, $numErr, $msgErr);
                // II.1.4.2.4 : Appeler la fonction de debogage
                debogage($scriptAppelant, $numErr, $msgErr);
                // II.1.4.2.5 : Renvoyer l'utilisateur sur la page d'erreur
                header('Location: index.php?page=erreur&err=1');
            }
        }


        // ----------------------------------------------------------------
        // II.2  Si le bouton n'est pas lié à une enquête alors
        // ----------------------------------------------------------------
       
        if (!$lie) {
            // II.2.1. : Préparer la requete de suppression de l'enregistrement
            //           du bouton dans la table Bouton

            $sql = "delete from BOUTON where ID_BOUTON = " . $id_bouton . ";";

            //      II.2.2. : Injecter la requête dans la base via la fonction
            //                injecterSQL.
            injecterSQL($scriptAppelant, $numFontion, $sql, $db);
            $retour = true;
        }


        // ----------------------------------------------------------------
        // II.3. Si le bouton est lié à 1 enquête alors 
        // ----------------------------------------------------------------
       
        if ($lie) {
            // II.3.1 Effacer la liaison de la table enquete_bouton
            // II.3.1.1 Préparer la requête de suppression de la table 
            //          ENQUETE_BOUTON.
            $sql = "delete from ENQUETE_BOUTON where ID_BOUTON = " . $id_bouton . " and ID_ENQUETE = " . $id_enquete . " ;";

            //          injecterSQL
            injecterSQL($scriptAppelant, $numFontion, $sql, $db);

            // ---- II.3.2 Effacer le bouton
            // II.3.2.1 Préparer la requête de suppression de la table 
            //          BOUTON contenant.
            $sql = "delete from BOUTON where ID_BOUTON = " . $id_bouton . ";";

            // II.3.2.2 Injecter la requête dans la base via la fonction 
            //          injecterSQL
            injecterSQL($scriptAppelant, $numFontion, $sql, $db);

            // ---- II.3.3 Récupérer l'id de l'enregistrement de la table ORDONNANCEMENT
            //             correspondant au bouton de la table BOUTON           
            //II.3.3.1 Préparer la requête de recherche
            $sql = " select ID_ORD from ORDONNANCEMENT where NOM_TABLE_ORD like 'BOUTON' and ID_TABLE_ORD = '" . $id_bouton . "';";
            //      II.3.3.2 Executer la requête 
            $result = mysql_query($sql, $db);
            //II.3.3.3 S'il ny a pas d'erreur
            if ($result != 0) {
                // II.3.3.3.1 Récupérer l'id en retour
                $id_ord = $result['ID_ORD'];
            }
            // II.3.3.4 Si erreur de requete (le resulat de la requete est 0) alors
            else {
                // II.3.3.4.1 : Préparer le message d'erreur
                $msgErr = "Impossible de trouver l'ID_ORD pour le bouton ". $id_bouton .". La requête SQL était : ".$sql;
                // II.3.3.4.2 : Affecter un numéro d'erreur
                $numErr= "";
                // II.3.3.4.3 : Loguer l'événement
                eventlog($scriptAppelant, $numErr, $msgErr);
                // II.3.3.4.4 : Appeler la fonction de debogage
                debogage($scriptAppelant, $numErr, $msgErr);
                // II.3.3.4.5 : Renvoyer l'utilisateur sur la page d'erreur
                header('Location: index.php?page=erreur&err=1');
            }
            // ---- II.3.4 Effacer la liaison ORDONNANCER
            // II.3.4.1 Préparer la requête de suppression de la table 
            //          ORDONNANCER liant l'ordonnancement du bouton et 
            //          l'enquete.
            $sql = "delete from ORDONNANCER where ID_ENQUETE = ". $id_enquete . " and ID_ORD = ".$id_ord;
            
            // II.3.4.2 Injecter la requête dans la base via la fonction 
            //          injecterSQL
            injecterSQL($scriptAppelant, $numFontion, $sql, $db);
            
            // ---- II.3.5 Effacer le bouton de la table Ordonnancement
            // II.3.5.1 Préparation de la requête SQL
            $sql = "delete from ORDONNANCEMENT where ID_ORD = ". $id_ord. ";";
            // II.3.5.2 Injecter la requête dans la base via la fonction 
            //          injecterSQL
            injecterSQL($scriptAppelant, $numFontion, $sql, $db);
            
            $retour = true;
        }
        return $retour;
    }

        /**
     * Méthode permettant de récupérer les informations de la table bouton dans 
     * l'objet bouton passé en argument.
     * Sinon false
     * @param type $id_bouton
     * @return \Bouton
     */
    function getBouton($id_bouton) {

        // ----------------------------------------------------------------
        //                  PREPARATION DU DEBOGAGE
        // ----------------------------------------------------------------
        debogage('------------------------<br/>');
        debogage('boutonMgr : getBouton : Appel boutonMgr<br/>');
        $retour = false;
        $scriptAppelant = $this->nomScript;
        $numFonction = 4;

        // ----------------------------------------------------------------
        //                  CONNEXION A LA BASE DE DONNEES
        // ----------------------------------------------------------------
        // Connexion à la base de données
        $connect = new SGBD();
        $connect = $connect->connecterSGBD($connect);

        // Récupération de l'ID de connexion à la base
        $db = $connect->getDB();


        // ----------------------------------------------------------------
        //                      EXECUTION DE LA REQUETE
        // ----------------------------------------------------------------
        // Protection de la requête        
        $id_bouton = securiserSQL($id_bouton);

        // Redige la requête
        $sql = "SELECT * FROM BOUTON WHERE ID_BOUTON = " . $id_bouton;
        debogage('boutonMgr : getBouton : SQL :<br/>' . $sql);

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

            // Sinon je renvoie le resultat sous forme d'e tableau associatif'objet
        } else {
            $ligne = mysql_fetch_assoc($result);

            $objBout = new Bouton($ligne);

            // Affichage pour debogage
            debogage('boutonMgr : getBouton : ligne : <br/>');
            debogage(print_r($ligne) . '<br/>');

            return $objBout;
        }
        return $retour;
    }
}
?>


