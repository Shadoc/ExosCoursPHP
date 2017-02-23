<?php

/**
 * Fonction de debogage : traite l'entrée string de la façon suivante :
 *  si DEBUG = 1 alors affichage à l'écran
 *                 2 fichier de log (non implemente pour l'isntant)
 * @global type $debogage
 * @param type $string 
 */
function debogage($scriptAppelant, $numErr, $msgErr) {

    if (DEBUG != 0) {
        if (DEBUG == 1) {
            $msgErr = func_get_arg(0);
            echo '<pre/>';
            echo $msgErr;
        } else if (DEBUG == 2) {
            $numParam = func_num_args();
            if ($numParam == 3) {
                $scriptAppelant = func_get_arg(0);
                echo 'SCRIPT APPELANT : ' . $scriptAppelant . "<br/>";
                $numErr = func_get_arg(1);
                echo "NUM ERREUR : " . $numErr . "<br/>";
                $msgErr = func_get_arg(2);
                echo "MESSAGE ERREUR" . $msgErr . "<br/>";
                eventlog($scriptAppelant, $numErr, $msgErr);
            } else if ($numParam == 1) {
                $msgErr = func_get_arg(0);
                eventlog($msgErr);
            }
        }
    }
}

?>
