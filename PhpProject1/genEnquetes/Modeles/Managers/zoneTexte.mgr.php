<?php

class zoneTexteMgr {

    // Entete des messages d'erreur correspondant au script :
    private $nomScript;

    // tous les ordonnancementMgr on besoin d'une connexion à la base de donnée.
    function zoneTexteMgr() {
        $this->nomScript = "Modele:Managers:zoneTexte.mgr.php:>";
        debogage('------------------------<br/>');
        debogage('zoneTexteMgr : Appel Constructeur zoneTexteMgr<br/>');
    }



    /**
     * Ajoute un enregistrement à la table zoneTexte 
     * retourne le zoneTexte ajouté
     * sinon retourne false
     * @param ZoneTexte $zoneTexte
     * @return \ZoneTexte 
     */
    function addBouton(ZoneTexte $zoneTexte) {

        // Preparation du log et du debogage
        debogage('------------------------<br/>');
        debogage('zoneTexteMgr : getzoneTexte : Appel zoneTexteMgr<br/>');
        $retour = false;
        $scriptAppelant = $this->nomScript;
        $numFonction = 2;

        // Connexion à la base de données
        $connect = new SGBD();
        $connect = $connect->connecterSGBD($connect);

        // Récupération de l'ID de connexion à la base
        $db = $connect->getDB();

        // Recuperation des elements necessaires a la requete
        $texte = $zoneTexte->getTEXTE_ZONETEXTE();
        $nbcol = $zoneTexte->getNBCOL_ZONETEXTE();
        $nblig = $zoneTexte->getNBLIG_ZONETEXTE();
        $libelle = $zoneTexte->getLIBELLE_ZONETEXTE();

        // Protection de la requête        
        $texte = securiserSQL($texte);
        $nbcol = securiserSQL($nbcol);
        $nblig = securiserSQL($nblig);
        $libelle = securiserSQL($libelle);

        // Ecriture de la requete  
        $sql = "insert into ZONETEXTE (TEXTE_ZONETEXTE ,NBCOL_ZONETEXTE, NBLIG_ZONETEXTE, LIBELLE_ZONETEXTE ) 
                values ('" . $texte . "','" . $nbcol . "','" . $nblig . "','" . $libelle . "')";

        // Envoie de la requete à la base.
        $retour = injecterSQL($scriptAppelant, $numFonction, $sql, $db);

        // S'il n'y a pas d'erreur 
        if ($retour == true) {
            // je récupere le dernier id créé par mysql que j'affecte à l'id de mon zoneTexte
            $id_zoneTexte = mysql_insert_id();

            // je créé mon zoneTexte avec cet id
            $zoneTexte->setID_ZONETEXTE($id_zoneTexte);

            // j'integre ce zoneTexte a l'ordonnancement
            $ordMgr = new ordonnancementMgr();
            $ord = new Ordonnancement;
            $ord->getID_ENQUETE();
            $ord->setNOM_TABLE_ORD("ZONETEXTE");
            $ord->setID_TABLE_ORD($id_zoneTexte);

            // Je recupere le dernier numero d ordre de la table d ordonnancement
            $dernierNumOrdre = dernierElement("ORDONNANCEMENT", "NUM_ORD");

            // J'affecte le nouveau numero d ordre a ma table d ordonnancement
            $dernierNumOrdre = $dernierNumOrdre + 1;
            $ord->setNUM_ORD($dernierNumOrdre);

            // L'objet ordonnancement est maintenant complet.
            // Je demande son ajout a la table ordonnancement
            $retour = $ordMgr->addOrdonnancement($ord);

            // S'il y a une erreur dans l'ajout dans la table ordonnancement
            // alors log et renvoie sur une page d'erreur
            if ($retour == false) {
                $msgErr = "L'ajout de l'objet ZoneTexte n'a pas pu être référencé dans la table Ordonnancement";
                eventlog($scriptAppelant, $numFonction, $msgErr);
                header('Location: index.php?page=erreur&err=1');
            }
            return $zoneTexte;
        }
        return $retour;
    }

    /**
     * Modifie un enregistrement de la table zoneTexte 
     * retourne true si ok false si ko
     * @param ZoneTexte $zoneTexte
     * @return type boolean
     */
    function modBouton(ZoneTexte $zoneTexte) {

        // Preparation du log et du debogage
        debogage('------------------------<br/>');
        debogage('zoneTexteMgr : getzoneTexte : Appel zoneTexteMgr<br/>');
        $retour = false;
        $scriptAppelant = $this->nomScript;
        $numFonction = 3;


        // Connexion à la base de données
        $connect = new SGBD();
        $connect = $connect->connecterSGBD($connect);

        // Récupération de l'ID de connexion à la base
        $db = $connect->getDB();

        // Recuperation des elements necessaires a la requete
        $id_zoneTexte = $zoneTexte->getID_BOUTON();
        $texte = $zoneTexte->getTYPE_BOUTON();
        $nbcol = $zoneTexte->getVALUE_BOUTON();
        $nblig = $zoneTexte->getACTION_BOUTON();
        $libelle = $zoneTexte->getNAME_BOUTON();

        // Protection de la requête        
        $id_zoneTexte = securiserSQL($id_zoneTexte);
        $texte = securiserSQL($texte);
        $nbcol = securiserSQL($nbcol);
        $nblig = securiserSQL($nblig);
        $libelle = securiserSQL($libelle);

        // Ecriture de la requete
        $sql = "update ZONETEXTE set TEXTE_ZONETEXTE ='" . $texte . "',"
                . "NBCOL_ZONETEXTE='" . $nbcol . "', "
                . "NBLIG_ZONETEXTE='" . $nblig . "', "
                . "LIBELLE_ZONETEXTE='" . $libelle . "'"
                . "WHERE ID_ZONETEXTE =" . $id_zoneTexte;

        // Envoie de la requete à la base.
        $retour = injecterSQL($scriptAppelant, $numFonction, $sql, $db);

        return $retour;
    }

    function delBouton($param) {

        // Preparation du log et du debogage
        debogage('------------------------<br/>');
        debogage('zoneTexteMgr : getzoneTexte : Appel zoneTexteMgr<br/>');
        $retour = false;
        $scriptAppelant = $this->nomScript;
        $numFonction = 4;

        // Si je passe un objet alors j'efface l'objet via son ID
        if (is_object($param)) {
            $id_zoneTexte = $param->getID_BOUTON();
        }

        // Sinon c'est que param doit etre un ID
        else {
            $id_zoneTexte = $param;
        }

        // Connexion à la base de données
        $connect = new SGBD();
        $connect = $connect->connecterSGBD($connect);

        // Récupération de l'ID de connexion à la base
        $db = $connect->getDB();

        // Protection de la requête
        $id_zoneTexte = securiserSQL($id_zoneTexte);

        // Ecriture de la requete
        $sql = "delete from ZONETEXTE where ID_ZONETEXTE = '" . $id_zoneTexte . "';";


        // Envoie de la requete à la base.
        $retour = injecterSQL($scriptAppelant, $numFonction, $sql, $db);

        return $retour;
    }
    /**
     * Méthode permettant de récupérer les informations de la table zoneTexte dans 
     * l'objet zoneTexte passé en argument.
     * Sinon false
     * @param type $id_zoneTexte
     * @return \ZoneTexte|boolean 
     */
    function getzoneTexte($id_zoneTexte) {

        // Preparation du log et du debogage
        debogage('------------------------<br/>');
        debogage('zoneTexteMgr : getzoneTexte : Appel zoneTexteMgr<br/>');
        $retour = false;
        $scriptAppelant = $this->nomScript;
        $numFonction = 1;

        // Connexion à la base de données
        $connect = new SGBD();
        $connect = $connect->connecterSGBD($connect);

        // Récupération de l'ID de connexion à la base
        $db = $connect->getDB();

        // Protection de la requête        
        $id_zoneTexte = securiserSQL($id_zoneTexte);

        // Redige la requête
        $sql = "SELECT * FROM ZONETEXTE WHERE ID_ZONETEXTE = " . $id_zoneTexte;
        debogage('zoneTexteMgr : getzoneTexte : SQL :<br/>' . $sql);

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

            $zoneTexte = new ZoneTexte($ligne);

            // Affichage pour debogage
            debogage('zoneTexteMgr : getzoneTexte : ligne : <br/>');
            debogage(print_r($ligne) . '<br/>');

            return $zoneTexte;
        }
        return $retour;
    }
}

?>
