<?php

/*
 * Auteur Laurent Cordier
 * Date de creation : 10/04/2012
 * Date de dernière modification : 10/05/2012
 *  * 
 * Etat d'avancement : Terminee
 */


function numeroOrdre (Enquete $objEnq){
    // Initialisation du contexte de log
    $scriptAppelant = "Modeles:Managers:outils:numeroOrdre:>";
    $numFontion = "01";
    
    // Connexion à la base de données
    $connect = new SGBD();
    $connect = $connect->connecterSGBD($connect);

    // Récupération de l'ID de connexion à la base
    $db = $connect->getDB();

    // recuperation du l'ID de l'enquete
    $id_enquete = $objEnq->getID_ENQUETE();
    // Redige la requête
    $sql = "select MAX(NUM_ORD) from ORDONNANCEMENT join  ORDONNANCER on ORDONNANCEMENT.ID_ORD = ORDONNANCER.ID_ORD WHERE ORDONNANCER.ID_ENQUETE = '".$id_enquete."';";
    
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

        // Sinon je renvoie l'id max
    } else {
        $retour = mysql_fetch_assoc($result);        
        $nbrId = $retour['MAX(NUM_ORD)'];
        
        return $nbrId;
    }
    
}

/**
 * Fonction qui retourne le dernier id d'une table
 * Etat : Terminee
 * @param type $table
 * @param type $elt
 * @return type numerique
 */
function dernierElement($table, $elt) {

    // Initialisation du contexte de log
    $scriptAppelant = "Modeles:Managers:outils:dernierElement:>";
    $numFontion = "01";
    
    // Connexion à la base de données
    $connect = new SGBD();
    $connect = $connect->connecterSGBD($connect);

    // Récupération de l'ID de connexion à la base
    $db = $connect->getDB();

    // Redige la requête
    
    $sql = "SELECT ".$elt." FROM ".$table." order by ".$elt." desc limit 1;";

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

        // Sinon je renvoie l'id max
    } else {
        $retour = mysql_fetch_assoc($result);
        $nbrId = $retour[$elt];
        return $nbrId;
    }
}


?>
