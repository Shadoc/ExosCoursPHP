<?php
/*
 * Auteur Laurent Cordier
 * Date de création : 10/04/2012
 * Date de dernière modification : 14/04/2012
 * 
 * Etat d'avancement : EN TEST
 * AddEnquete => OK
 * GetEnquete => OK
 * ModEnquete => OK
 * DelEnquete => 
 */

class enqueteMgr {

    // Entete des messages d'erreur correspondant au script :
    private $nomScript;

    // tous les enqueteMgr on besoin d'une connexion à la base de donnée.
    function enqueteMgr() {
        $this->nomScript = "Modele:Managers:enquete.mgr.php:>";
        debogage('------------------------<br/>');
        debogage('enqueteMgr : Appel Constructeur enqueteMgr<br/>');
    }



    /**
     * Ajoute un enregistrement à la table enquete 
     * retourne le enquete ajouté
     * sinon retourne false
     * @param Enquete $enquete
     * @return \Enquete 
     */
    // Enregiste la nouvelle enquete dans la base de donnee, 
    // puis je cree un ordonnancment
    // enfin je rempli la table de jonction ORDONNANCER avec les id de l'enquete
    // nouvellement creer et de l'ordonnancement nouvellement cree.
    function addEnquete(Enquete $enquete) {
        // ----------------------------------------------------------------
        // 
        //                  PREPARATION DU DEBOGAGE
        //             
        // ----------------------------------------------------------------
        debogage('------------------------<br/>');
        debogage('enqueteMgr : getEnquete : Appel enqueteMgr<br/>');
        $retour = false;
        $scriptAppelant = $this->nomScript;
        $numFonction = 1;

        // ----------------------------------------------------------------
        // 
        //                  CONNEXION A LA BASE DE DONNEES
        //             
        // ----------------------------------------------------------------
        // Connexion à la base de données
        $connect = new SGBD();
        $connect = $connect->connecterSGBD($connect);

        // Récupération de l'ID de connexion à la base
        $db = $connect->getDB();

        // ----------------------------------------------------------------
        // 
        //                 RECUPERATION DU PARAMETRE D ENTREE
        //             
        // ----------------------------------------------------------------
        // Si je passe un objet alors j'efface l'objet via son ID
        $titre_enquete = $enquete->getTITRE_ENQUETE();
        $introduction_enquete = $enquete->getINTRODUCTION_ENQUETE();
        $conclusion_enquete = $enquete->getCONCLUSION_ENQUETE();

        // Protection de la requête        
        $titre_enquete = securiserSQL($titre_enquete);
        $introduction_enquete = securiserSQL($introduction_enquete);
        $conclusion_enquete = securiserSQL($conclusion_enquete);


        // Ecriture de la requete  
        $sql = "insert into ENQUETE (TITRE_ENQUETE ,INTRODUCTION_ENQUETE, CONCLUSION_ENQUETE) ";
        $sql .= "values ('" . $titre_enquete . "','" . $introduction_enquete . "','" . $conclusion_enquete . "'); ";

        // Envoie de la requete à la base.
        $retour_inject = injecterSQL($scriptAppelant, $numFonction, $sql, $db);

        // S'il n'y a pas d'erreur alors je recupere l'id de mon enquete
        if ($retour_inject == true) {
            $id_enquete = mysql_insert_id();
            $enquete->setID_ENQUETE($id_enquete);
            $retour = $enquete;
        } else {
            $retour = false;
        }

        // --------------------- Enregistrement d'un nouvel ordonnancement
        // je cree une nouvel ordonnancement
        $ordonnancement = new Ordonnancement();

        // Ecriture de la requete  
        $sql = "insert into ORDONNANCEMENT (NOM_TABLE_ORD ,ID_TABLE_ORD, NUM_ORD) ";
        $sql .= "values ('','',''); ";

        // Envoie de la requete à la base.
        $retour_ord = injecterSQL($scriptAppelant, $numFonction, $sql, $db);

        // S'il n'y a pas d'erreur je recupere l'id de mon ordonnancement
        if ($retour_ord == true) {
            $id_ordonnancement = mysql_insert_id();
            $ordonnancement->setID_ORD($id_ordonnancement);
        } else {
            $retour = false;
        }

        // ----------------------- Enregistrement des id ordonnancement et 
        // ----------------------- enquete dans la table de liaison ORDONNANCER
        // Ecriture de la requete  
        $sql = "insert into ORDONNANCER (ID_ENQUETE ,ID_ORD) ";
        $sql .= "values ('" . $id_enquete . "','" . $id_ordonnancement . "'); ";

        // Envoie de la requete à la base.
        $retour_ord_enq = injecterSQL($scriptAppelant, $numFonction, $sql, $db);

        // S'il n'y a pas d'erreur alors je retourne un objet Enquete
        if ($retour_ord_enq != true) {
            $retour = false;
        }
        return $retour;
    }

    /**
     * Modifie un enregistrement de la table enquete 
     * retourne true si ok false si ko
     * @param Enquete $enquete
     * @return type boolean
     */
    function modEnquete(Enquete $enquete) {

        // Preparation du log et du debogage
        debogage('------------------------<br/>');
        debogage('enqueteMgr : getEnquete : Appel enqueteMgr<br/>');
        $retour = false;
        $scriptAppelant = $this->nomScript;
        $numFonction = 2;

        // Identification de l'argument d'entree $id_enquete
        // Si c'est un objet alors mon id_enquete est la donnee membre de cet objet
        if (!is_object($enquete)) {
            $msgErr = "L'argument de l'appel de la méthode n'est pas un objet.";
            eventlog($scriptAppelant, $numFonction, $msgErr);
            header('Location: index.php?page=erreur&err=1');
        }

        // Connexion à la base de données
        $connect = new SGBD();
        $connect = $connect->connecterSGBD($connect);

        // Récupération de l'ID de connexion à la base
        $db = $connect->getDB();

        // Recuperation des elements necessaires a la requete
        $id_enquete = $enquete->getID_ENQUETE();
        $titre_enquete = $enquete->getTITRE_ENQUETE();
        $introduction_enquete = $enquete->getINTRODUCTION_ENQUETE();
        $conclusion_enquete = $enquete->getCONCLUSION_ENQUETE();
        $id_ord = $enquete->getID_ENQUETE;

        // Protection de la requête
        $id_enquete = securiserSQL($id_enquete);
        $titre_enquete = securiserSQL($titre_enquete);
        $introduction_enquete = securiserSQL($introduction_enquete);
        $conclusion_enquete = securiserSQL($conclusion_enquete);
        $id_ord = securiserSQL($id_ord);

        // Ecriture de la requete
        $sql = "update ENQUETE set ";
        $sql .= "TITRE_ENQUETE ='" . $titre_enquete . "', ";
        $sql .= "INTRODUCTION_ENQUETE ='" . $introduction_enquete . "', ";
        $sql .= "CONCLUSION_ENQUETE ='" . $conclusion_enquete . "' ";
        $sql .= "WHERE ID_ENQUETE = " . $id_enquete . ";";


        // Envoie de la requete à la base.
        $retour = injecterSQL($scriptAppelant, $numFonction, $sql, $db);

        return $retour;
    }

    /**
     * Efface l enregistrement correspondant à l'objet enquete passee en parametre
     * ou l ID de l enregistrement ainsi que toutes ses dependances :
     *   - bouton
     *   - ordonnancement
     *   - rubrique
     *   - zoneTexte
     *   - redige
     *   - repond
     * 
     * @param type $param  : Objet enquete ou id d enquete
     * @return type boolean
     */
    function delEnquete($param) {
        // ----------------------------------------------------------------
        // 
        //                  PREPARATION DU DEBOGAGE
        //             
        // ----------------------------------------------------------------

        debogage('------------------------<br/>');
        debogage('enqueteMgr : getEnquete : Appel enqueteMgr<br/>');
        $retour = false;
        $scriptAppelant = $this->nomScript;
        $numFonction = 3;

        // ----------------------------------------------------------------
        // 
        //                 RECUPERATION DU PARAMETRE D ENTREE
        //             
        // ----------------------------------------------------------------
        // Si je passe un objet alors j'efface l'objet via son ID
        if (is_object($param)) {
            $id_enquete = $param->getID_ENQUETE();
        }
        // Sinon c'est que param doit etre un ID
        else {
            $id_enquete = $param;
        }

        // Protection de la requête
        $id_enquete = securiserSQL($id_enquete);


        // ----------------------------------------------------------------
        // 
        //                  CONNEXION A LA BASE DE DONNEES
        //             
        // ----------------------------------------------------------------
        // Connexion à la base de données
        $connect = new SGBD();
        $connect = $connect->connecterSGBD($connect);

        // Récupération de l'ID de connexion à la base
        $db = $connect->getDB();


        // ----------------------------------------------------------------
        // 
        //                  EFFACEMENT DU/DES BOUTON(S) LIE(S)
        //             
        // ----------------------------------------------------------------
        // Ecriture de la requete
        // Recuperation du/des id_bouton lie(s) a l enquete
        $sql = "select ID_BOUTON  
              
                from ENQUETE
                
                join ENQUETE_BOUTON on ENQUETE.ID_ENQUETE = ENQUETE_BOUTON.ID_ENQUETE
                join BOUTON on ENQUETE_BOUTON.ID_BOUTON = BOUTON.ID_BOUTON
                
                where ID_ENQUETE = " . $id_enquete . "';";

        $msgErr = 'delEnquete : SQL :<br/>' . $sql;
        debogage($scriptAppelant, $numErr, $msgErr);


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

            // Sinon je lis les elemens retournes par la requete et demande 
            // de des enregistrement correspondant dans la table de liaison
            // euquete_bouton puis l effacement des enregistrement correspondant 
            // dans la table bouton.
        } else {

            // Instanciation d'un manager pour la manipulation de la table bouton
            $mgrBouton = new boutonMgr();

            // J efface tous les boutons trouves
            while ($ligne = mysql_fetch_assoc($result)) {
                $param = $ligne['ID_BOUTON'];
                $objBouton = new Bouton($param);
                $mgrBouton->delBouton($objBouton);
            }
        }


        // ----------------------------------------------------------------
        // 
        //             EFFACEMENT DU/DES ORDONNANCEMENT(S) LIE(S)
        //             
        // ----------------------------------------------------------------
        // Ecriture de la requete
        // Recuperation du/des id_ordonnancement lie(s) a l enquete
        $sql = "select ID_ORDONNANCEMENT 
              
                from ENQUETE
                
                join ORDONNANCER on ENQUETE.ID_ENQUETE = ORDONNANCER.ID_ENQUETE
                join ORDONNANCEMENT on ORDONNANCER.ID_ORD = ORDONNANCEMENT.ID_ORD
                
                where ID_ENQUETE = " . $id_enquete . "';";
        
        $msgErr = 'delEnquete : SQL :<br/>' . $sql;
        debogage($scriptAppelant, $numErr, $msgErr);       

        // Execution de la requête
        $result = mysql_query($sql, $db);

        // Si erreur de la requete alors page erreur        
        if ($result == 0) {

            // Preparation du message d'erreur
            $msgErr = "Erreur de la requete SQL : " . $sql;

            // Affichage pour debogage
             debogage($scriptAppelant, $numErr, $msgErr);

            //Log de l'erreur
            eventlog($scriptAppelant, $numFonction, $msgErr);

            header('Location: index.php?page=erreur&err=1');

            // Sinon je lis les elemens retournes par la requete et demande 
            // de des enregistrement correspondant dans la table de liaison
            // euquete_bouton puis l effacement des enregistrement correspondant 
            // dans la table bouton.
        } else {

            // Instanciation d'un manager pour la manipulation de la table bouton
            $mgrOrdonnancement = new ordonnancementMgr();

            // J efface tous les boutons trouves
            while ($ligne = mysql_fetch_assoc($result)) {
                $param = $ligne['ID_ORDONNANCEMENT'];
                $objOrdonnancement = new Ordonnancement($param);
                $mgrOrdonnancement->delOrdonnancement($objOrdonnancement);
            }
        }

        // ----------------------------------------------------------------
        // 
        //             EFFACEMENT DE LA/DES RUBRIQUES(S) LIE(S)
        //             
        // ----------------------------------------------------------------
        // Ecriture de la requete
        // Recuperation du/des id_rubtique lie(s) a l enquete
        $sql = "select ID_RUBRIQUE 
              
                from ENQUETE
                
                join COMPOSER on ENQUETE.ID_ENQUETE = COMPOSER.ID_ENQUETE
                join RUBRIQUE on COMPOSER.RUBRIQUE = RUBRIQUE.RUBRIQUE
                
                where ID_ENQUETE = " . $id_enquete . "';";
        
        $msgErr = 'delEnquete : SQL :<br/>' . $sql;
        debogage($scriptAppelant, $numErr, $msgErr);       

        // Execution de la requête
        $result = mysql_query($sql, $db);

        // Si erreur de la requete alors page erreur        
        if ($result == 0) {

            // Preparation du message d'erreur
            $msgErr = "Erreur de la requete SQL : " . $sql;

            // Affichage pour debogage
             debogage($scriptAppelant, $numErr, $msgErr);

            //Log de l'erreur
            eventlog($scriptAppelant, $numFonction, $msgErr);

            header('Location: index.php?page=erreur&err=1');

            // Sinon je lis les elemens retournes par la requete et demande 
            // de des enregistrement correspondant dans la table de liaison
            // euquete_bouton puis l effacement des enregistrement correspondant 
            // dans la table bouton.
        } else {

            // Instanciation d'un manager pour la manipulation de la table bouton
            $mgrOrdonnancement = new ordonnancementMgr();

            // J efface tous les boutons trouves
            while ($ligne = mysql_fetch_assoc($result)) {
                $param = $ligne['ID_ORDONNANCEMENT'];
                $objOrdonnancement = new Ordonnancement($param);
                $mgrOrdonnancement->delOrdonnancement($objOrdonnancement);
            }
        }

        return $retour;
    }
    
    /**
     * Méthode permettant de récupérer les informations de la table enquete dans 
     * l'objet enquete passé en argument.
     * Sinon false
     * @param type $id_enquete
     * @return \EEnqueteboolean 
     */
    function getEnquete($param) {
        // Preparation du log et du debogage
        debogage('------------------------<br/>');
        debogage('enqueteMgr : getEnquete : Appel enqueteMgr<br/>');
        $retour = false;
        $scriptAppelant = $this->nomScript;
        $numFonction = 4;

        // Identification de l'argument d'entree $id_enquete
        // Si c'est un objet alors mon id_enquete est la donnee membre de cet objet
        if (is_object($param)) {
            $id_enquete = $param->getID_ENQUETE($param);

            // Sinon si c'est un entier alors c'est un id
        } else if (is_int($param)) {
            $id_enquete = $param;

            // Sinon c'est une erreur et je log.    
        } else {
            $msgErr = "L'argument de l'appel de la méthode n'est ni un entier, ni un objet.";
            eventlog($scriptAppelant, $numFonction, $msgErr);
            header('Location: index.php?page=erreur&err=1');
        }


        // Connexion à la base de données
        $connect = new SGBD();
        $connect = $connect->connecterSGBD($connect);

        // Récupération de l'ID de connexion à la base
        $db = $connect->getDB();

        // Protection de la requête        
        $id_enquete = securiserSQL($id_enquete);

        // Redige la requête
        $sql = "SELECT * FROM ENQUETE WHERE ID_ENQUETE = " . $id_enquete;
        debogage('enqueteMgr : getEnquete : SQL :<br/>' . $sql);

        // Execution de la requête
        $result = mysql_query($sql, $db);

        // Si erreur de la requete alors page erreur        
        if ($result == 0) {

            // Preparation du message d'erreur
            $msgErr = "Erreur de la requete SQL : " . $sql;

            // Affichage pour debogage
            debogage($msgErr . "<br/>");

            //Log de l'erreur
            $msgErr = "L'ajout de l'objet Enquete n'a pas pu être référencé dans la table Enquete";
            eventlog($scriptAppelant, $numFonction, $msgErr);
            header('Location: index.php?page=erreur&err=1');

            // Sinon je renvoie le resultat sous forme d'objet
        } else {
            $ligne = mysql_fetch_array($result);

            $enquete = new Enquete($ligne);

            // Affichage pour debogage
            debogage('enqueteMgr : getEnquete : ligne : <br/>');
            //debogage(print_r($ligne) . '<br/>');

            return $enquete;
        }
        return $retour;
    }
}
?>



