<?php

function formulaireCreerEnquete($flag, $titre, $introduction, $conclusion) {
    $msgInfo = "";
    $msgBouton = "<input type='submit' name='btnEnqSuivant' value='Suivant'>";

// Si $flagErr == errNom alors je réaffiche le formulaire avec le message 
// informatif.
    if ($flag == "errTitre") {
        $msgInfo = "<center><h3>Merci de saisir un titre</h3><center>";
    }
// Si j'ai une enqête qui porte le même nom    
    elseif ($flag == "errHomonyme") {
        $msgInfo = "<center>
                    <h3>Une enquête de même titre existe déjà dans la base.</h3>
                    <h3>Merci d'en saisir un différent</h3>
                <center>";
    }
// Sinon j'affiche le formulaire d'ajout normal
    else {
        $msgInfo = "";
    }

    
    
// Composition hmtl de la page
    $temp = "";
    $temp .= $msgInfo;
    $temp .= "<br/>";
    $temp .= "<form name='creerEnquete' action='index.php?page=groupes_ajouter' method='post'>
                <center>
                <table>
                    <tr>
                        <td>Nom : </td>
                        <td><input type='text' name='newEnqTitre' size='50' value='" . $titre . "'></td>
                        <td>*</td>
                    </tr>
                    <tr>
                        <td>Description : </td>
                        <td><textarea name='newEnqIntro' cols='38' rows='10'>" . $introduction . "</textarea></td>
                    </tr>
                    <tr>
                        <td>Description : </td>
                        <td><textarea name='newEnqConcl' cols='38' rows='10'>" . $conclusion . "</textarea></td>
                    </tr>
                    <tr> 
                        <td>* : Champ obligatoire </td>
                    </tr>
                </table>
                </center>

                <p align='right'> ". $msgBouton ."</p>
                
              
                
              </form>";

    return $temp;
}

?>
