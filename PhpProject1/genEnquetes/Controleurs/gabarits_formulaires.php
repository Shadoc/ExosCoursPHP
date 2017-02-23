<?php

/**
 * F1. Formulaire d'ajout utilisateur.
 *     Retour : 
 *          - NOM_UTIL -> newUserName
 *          - PRENOM_UTIL -> newUserFirstName
 *          - LOGIN_UTIL -> newUserLogin
 *          - PASS_UTIL -> newUserPassWord
 *     
 * @return string 
 */
function formulaireAjouterUtilisateur(){
    $temp = "";
    $temp .= "<form>
                <center>
                <table>
                    <tr>
                        <td>Nom : </td>
                        <td><input type='text' name='newUserName' size='50'></td>
                    </tr>
                    <tr>
                        <td>Prénom : </td>
                        <td><input type='text' name='newUserFirstName' size='50'></td>
                    </tr>
                    <tr>
                        <td>Login : </td>
                        <td><input type='text' name='newUserLogin' size='50'></td>
                    </tr>
                    <tr>
                        <td>Mot de passe : </td>
                        <td><input type='password' name='newUserPassWord' size='50'></td>
                    </tr>
                </table>
                <input type='submit' name='btnAjouter' value='Ajouter'>
                <input type='reset' name='btnEffacer' value='Effacer'>
                </center>
              </form>";
    return $temp;
}

// F.2 M
function formulaireModifierUtilisateur(){
        $temp = "";
    $temp .= "<form>
                <center>
                <table>
                    <tr>
                        <td>Nom : </td>
                        <td><input type='text' name='modUserName' size='50'></td>
                    </tr>
                    <tr>
                        <td>Prénom : </td>
                        <td><input type='text' name='modUserFirstName' size='50'></td>
                    </tr>
                    <tr>
                        <td>Login : </td>
                        <td><input type='text' name='modUserLogin' size='50'></td>
                    </tr>
                    <tr>
                        <td>Mot de passe : </td>
                        <td><input type='password' name='modUserPassWord' size='50'></td>
                    </tr>
                </table>
                <input type='submit' name='btnRechercher' value='Rechercher'> 
                <input type='submit' name='btnAjouter' value='Modifier'>
                <input type='reset' name='btnEffacer' value='Effacer'>
                </center>
              </form>";
    return $temp;
}


/**
 * F3. Formulaire de suppression utilisateur
 *     Retour : 
 *          - NOM_UTIL -> modUserName
 *          - PRENOM_UTIL -> modUserFirstName
 *          - LOGIN_UTIL -> modUserLogin
 *          - PASS_UTIL -> modUserPassWord
 *     
 * @return string 
 */
function formulaireSupprimerUtilisateur(){
    $temp = "";
    $temp .= "<form>
                <center>
                <table>
                    <tr>
                        <td>Nom : </td>
                        <td><input type='text' name='modUserName' size='50'></td>
                    </tr>
                    <tr>
                        <td>Prénom : </td>
                        <td><input type='text' name='modUserFirstName' size='50'></td>
                    </tr>
                    <tr>
                        <td>Login : </td>
                        <td><input type='text' name='modUserLogin' size='50'></td>
                    </tr>
                    <tr>
                        <td>Mot de passe : </td>
                        <td><input type='password' name='modUserPassWord' size='50'></td>
                    </tr>
                </table>
                <input type='submit' name='btnRechercher' value='Rechercher'> 
                <input type='submit' name='btnSupprimer' value='Supprimer'>
                <input type='reset' name='btnEffacer' value='Effacer'>
                </center>
              </form>";
    return $temp;
}


?>
