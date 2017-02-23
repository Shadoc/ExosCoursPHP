<?php

include_once "Modeles/Managers/SGBD.mgr.php";
include_once "Modeles/Classes/Bouton.class.php";

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
     * Classe boutonMgr.
     * Méthode permettant de récupérer les informations de la table bouton dans l'objet bouton passé en argument
     * @global type $db
     * @param Bouton $bouton
     * @return null             Si l'id du bouton n'est pas trouvé dans la base.
     */
    function getBouton($id_bouton) {
        // Preparation du log et du debogage
        $scriptAppelant = $this->nomScript;
        debogage('------------------------<br/>');
        debogage('boutonMgr : getBouton : Appel boutonMgr<br/>');

        // Connexion à la base de données
        $connect = new SGBD();
        $connect = $connect->connecterSGBD($connect);

        // Récupération de l'ID de connexion à la base
        $db = $connect->getDB();

        // Preparation de la requete
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
            eventlog($scriptAppelant, "01", $msgErr);

            header('Location: index.php?page=erreur&err=1');

            // Sinon je renvoie le resultat sous forme de tableau associatif
        } else {
            $ligne = mysql_fetch_assoc($result);
            $bouton = new Bouton($ligne);
            // Affichage pour debogage
            debogage('boutonMgr : getBouton : ligne : <br/>');
            debogage(print_r($ligne) . '<br/>');

            return $bouton;
        }
        return null;
    }

    /**
     * Ajoute un bouton à la table bouton.
     * Renvoie le bouton ajoute avec son id sinon null
     * @param Bouton $bouton 
     */
    function addBouton(Bouton $bouton) {
        // Preparation du log et du debogage
        $scriptAppelant = $this->nomScript;
        debogage('------------------------<br/>');
        debogage('boutonMgr : getBouton : Appel boutonMgr<br/>');

        // Connexion à la base de données
        $connect = new SGBD();
        $connect = $connect->connecterSGBD($connect);

        // Récupération de l'ID de connexion à la base
        $db = $connect->getDB();

        // Preparation de la requete
        $type = $bouton->getTYPE_BOUTON();
        $value = $bouton->getVALUE_BOUTON();
        $action = $bouton->getACTION_BOUTON();
        $name = $bouton->getNAME_BOUTON();
        $sql = "insert into BOUTON (TYPE_BOUTON ,VALUE_BOUTON, ACTION_BOUTON, NAME_BOUTON ) values ('" . $type . "','" . $value . "','" . $action . "','" . $name . "')";

        $result = mysql_query($sql, $db);

        //S'il y a erreur dans la requete alors page erreur
        if ($result == 0) {
            // Preparation du message d'erreur
            $msgErr = "Erreur de la requete SQL : " . $sql;
            // Affichage pour debogage
            debogage($msgErr . "<br/>");
            //Log de l'erreur
            eventlog($scriptAppelant, "02", $msgErr);

            header('Location: index.php?page=erreur&err=1');

            // Sinon je renvoie le bouton avec son ID
        } else {
            $id_bouton = mysql_insert_id();
            $bouton->setID_BOUTON($id_bouton);
            return $bouton;
        }
        return null;
    }

    function modBouton(Bouton $bouton) {
        // Preparation du log et du debogage
        $scriptAppelant = $this->nomScript;
        debogage('------------------------<br/>');
        debogage('boutonMgr : getBouton : Appel boutonMgr<br/>');

        // Connexion à la base de données
        $connect = new SGBD();
        $connect = $connect->connecterSGBD($connect);

        // Récupération de l'ID de connexion à la base
        $db = $connect->getDB();

        // Preparation de la requete
        $type = $bouton->getTYPE_BOUTON();
        $value = $bouton->getVALUE_BOUTON();
        $action = $bouton->getACTION_BOUTON();
        $name = $bouton->getNAME_BOUTON();
        $sql = "insert into BOUTON (TYPE_BOUTON ,VALUE_BOUTON, ACTION_BOUTON, NAME_BOUTON ) values ('" . $type . "','" . $value . "','" . $action . "','" . $name . "')";

        $result = mysql_query($sql, $db);

        //S'il y a erreur dans la requete alors page erreur
        if ($result == 0) {
            // Preparation du message d'erreur
            $msgErr = "Erreur de la requete SQL : " . $sql;
            // Affichage pour debogage
            debogage($msgErr . "<br/>");
            //Log de l'erreur
            eventlog($scriptAppelant, "03", $msgErr);

            header('Location: index.php?page=erreur&err=1');

            // Sinon je renvoie le bouton avec son ID
        } else {
            $id_bouton = mysql_insert_id();
            $bouton->setID_BOUTON($id_bouton);
            return true;
        }
        return false;
    }

    function delBouton($param) {
        // Preparation du log et du debogage
        debogage('------------------------<br/>');
        debogage('boutonMgr : getBouton : Appel boutonMgr<br/>');
        $retour = false;
        $scriptAppelant = $this->nomScript;
        $numFonction = 4;

        // Si je passe un objet alors j'efface l'objet via son ID
        if (is_object($param)) {
            $id_bouton = $param->getID_BOUTON();
        }
        // Sinon c'est que param doit etre un ID
        else {
            $id_bouton = $param;
        }
        // Connexion à la base de données
        $connect = new SGBD();
        $connect = $connect->connecterSGBD($connect);
        // Récupération de l'ID de connexion à la base
        $db = $connect->getDB();
        
        // Protection de la requête
        $code = securiserSQL($id_bouton);
        
        // Prepration de la requete
        $sql = "delete from BOUTON where ID_BOUTON = '" . $code . "';";
        
        // Envoie de la requete à la base.
        $retour = injeterSQL($scriptAppelant, $numFonction, $sql, $db);

        return $retour;
    }

}
?>


