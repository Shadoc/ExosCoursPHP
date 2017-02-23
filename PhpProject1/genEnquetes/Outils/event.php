<?php

$handle = fopen(EVENT, "a+");       // Méthode d'ouverture du fichier en lecture et écriture à la fin du fichier.
// construction de l'événement à loger: date;heure;script_appelant;code_erreur;message_erreur
$msg  ="";
$msg .= date("Y:m:j");


fputcsv($handle, $msg);         // Ecriture de la ligne.
fclose($handle);                // fermeture du fichier
?>
