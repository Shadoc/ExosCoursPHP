<?php

// Entete des messages d'erreur correspondant au script :
$prefixe = "<br>Log:event.php:>";
debogage($prefixe);

/**
 *Fonction permettant de loguer les erreurs, soit par le mode débug=2, soit directement par des erreurs gérés dans le code
 * @param type $scriptAppelant
 * @param type $numErr  Numéro d'erreur correspondant au numero de fonction dans le script appelant
 * @param type $msgErr  Le message d'erreur spécifique a loguer.
 */
function eventlog($scriptAppelant, $numErr, $msgErr) {
    
    debogage("<br>Log:event.php:>");
    debogage(EVENT);
    
    $separateur = "-";
    $msg = "";


    if (!file_exists(EVENT)) {
        debogage("<br/>Le fichier n'existe pas.");
        $handle = fopen(EVENT, "w");
        fclose($handle);
    }

    // Méthode d'ouverture du fichier en lecture et écriture à la fin du fichier.
    $handle = fopen(EVENT, "a");       

    // construction de l'événement à loger: date;heure;script_appelant;code_erreur;message_erreur
    $msg .= date("Y:m:d");
    $msg .= $separateur;
    $msg .= date("H:i:s");
    $msg .= $separateur;
    $msg .= $scriptAppelant;
    $msg .= $separateur;
    $msg .= $numErr;
    $msg .= $separateur;
    $msg .= $msgErr;
    $msg .= "\r\n";
    
    // Ecriture de la ligne.
    fwrite($handle, $msg);  
    
    // fermeture du fichier
    fclose($handle);                
}

?>
