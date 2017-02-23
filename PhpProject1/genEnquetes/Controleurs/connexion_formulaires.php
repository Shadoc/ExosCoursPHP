<?php

function formulaireConnexion($flag) {

    $scriptAppelant = "connexion";
    $numErr = "-F1-";
    $msgErr = "";
    $msgInfo = "";
    
    if ($flag =="ErrPassword"){
        // J'informe l'utilisateur
        $msgInfo .= "<h3>Votre nom d'utlisateur ou votre mot de passe n'a pas été reconnu par le système.</h3>";
        $msgInfo .= "<h3>Veuillez réessayer.</h3>";
        $msgInfo .= "<h3>Si le problème persiste veuillez contacter votre correspondant informatique.</h3>";
        // je logue l'information
        $msgErr = "Mot de passe invalide";
        eventlog($scriptAppelant, $numErr, $msgErr);
    }
    // S'i j'ai une erreur sur le password 'il n'y a pas de mot de passe
    if ($flag =="NoPassword"){
        // J'informe l'utilisateur
        $msgInfo .= "<h3>Merci de saisir votre mot de passe et réessayez.</h3>";
        $msgInfo .= "<h3>Si le problème persiste veuillez contacter votre correspondant informatique.</h3>";
    }
    //Si le mot le login est invalide j'informe l'itilisateur mais je ne logue pas l'événement
    elseif ($flag == "NoLogin") {
        $msgInfo .= "<h3>Merci de saisir votre nom d'utlisateur et réessayez.</h3>";
        $msgInfo .= "<h3>Veuillez réessayer.</h3>";
        $msgInfo .= "<h3>Si le problème persiste veuillez contacter votre correspondant informatique.</h3>";
    }
    
    $temp = "";
    $temp .= $msgInfo;
    $temp .= "<div id='tableContener'>
                    <form name='connexion' method='post' action='index.php?page=connexion' method='post'>
                        <table id='tableConnection'>
                            <tr>
                                <td>Nom d'utlisateur : </td><td><input type='text' name='connLogin'/></td>
                            </tr>
                            <tr>
                                <td>Mot de passe : </td><td><input type='password' name='connPassword'/></td>
                            </tr>
                            <tr>
                                <td>
                                     <center><INPUT TYPE='reset' NAME='annuler' VALUE='Annuler'></center>
                                </td>
                                <td>
                                      <center><input type='submit' value='Valider' /></center>
                                </td>
                            </tr>
                        </table>
                       <br />
                    </form>
                </div>";
    return $temp;
}

?>
