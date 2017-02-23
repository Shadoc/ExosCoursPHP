<?php
    $separateur = "-";
    $msg = "";
    const EVENT = "event.log";

    if (!file_exists(EVENT)) {
        //debogage("<br/>Le fichier n'existe pas.");
        $handle = fopen(EVENT, "w");
        fclose($handle);
    }

    $handle = fopen(EVENT, "a");       // Méthode d'ouverture du fichier en lecture et écriture à la fin du fichier.
// construction de l'événement à loger: date;heure;script_appelant;code_erreur;message_erreur

    $msg .= date("Y:m:d");
    $msg .= $separateur;
    $msg .= date("H:i:s");
    $msg .= $separateur;
    //$msg .= $scriptAppelant;
    $msg .= $separateur;
    //$msg .= $numErr;
    $msg .= $separateur;
    //$msg .= $msgErr;
    $msg .= "\r\n";
    
    fwrite($handle, $msg);         // Ecriture de la ligne.
    fclose($handle);                // fermeture du fichier
?>
