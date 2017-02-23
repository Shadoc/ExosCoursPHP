<?php

/*
 * Protection d'une commande SQL des caractères spéciaux (stop injection).
 * Au moment où j'ecris ce code, c'est ma seule connaissance en matiere de 
 * protection du SQL. 
 * Elle sera completee a mesure de mes connaissances
 */

function securiserSQL($sql) {
    $sql = mysql_real_escape_string($sql);
    return $sql;
}

/**
 * Fontion qui injecte le SQL a la base. 
 * retourne true si pas d'erreur sinon log du probleme dans le journal d'evenement
 * @param type $scriptAppelant
 * @param type $numFontion
 * @param type $sql
 * @return boolean S'il n'y a pas d'erreur alors true
 */
function injecterSQL($scriptAppelant, $numFontion, $sql, $db) {

    // S'il y a une requete sql alors
    if ($sql != "") {

        // J'injecte mon sql à la base
        $result = mysql_query($sql, $db);

        // Si j'ai une erreur
        if ($result == 0) {

            // Preparation du message d'erreur
            $msgErr = "Erreur de la requete SQL : " . $sql;

            // Affichage pour debogage
            debogage($msgErr . "<br/>");

            //Log de l'erreur
            eventlog($scriptAppelant, $numFontion, $msgErr);

            // Renvoie à la page erreur.
            header('Location: index.php?page=erreur&err=1');
        } else {
            return true;
        }
    } else {
        return false;
    }
}

?>
