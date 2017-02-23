<?php

/**
 * F1. Formulaire d'ajout utilisateur.
 *     Retour : 
 *          - NOM_UTIL -> newGroupName
 *          - PRENOM_UTIL -> newGroupFirstName
 *          - LOGIN_UTIL -> newGroupLogin
 *          - PASS_UTIL -> newGroupPassWord
 * $flagErr type string/Groupe (Prend en entrée les chaines errNom, errHomonyme ou un objet Groupe)
 * $textarea type Utilisé pour réafficher le textarea de la page précédente
 * @return string 
 */
function formulaireAjouterGroupe($flag, $nom, $description) {
    $msgTitre = "";
    $msgBouton = "<input type='submit' name='btnAjouter' value='Ajouter'>
                  <input type='reset' name='btnEffacer' value='Effacer'>
                  <input type='button' name='btnAccueil' value='Accueil Gestion des groupes' 
                        onClick=\"self.location.href='index.php?page=groupes_accueil'\">";

// Si $flagErr == errNom alors je réaffiche le formulaire avec le message 
// informatif.
    if ($flag == "errNom") {
        $msgTitre = "<center><h3>Merci de saisir un nom de groupe</h3><center>";
    }
// Si le flag est un objet Group alors c'est que j'ai un ajout reussi
// et j'informe l'utilisateur. 
    elseif (is_a($flag, "Groupe")) {
        $msgTitre = "<center><h3>L'ajout du groupe s'est correctement effectuée<h3><center>";
        $msgBouton = "<input type='submit' name='btnNewGroup' value='Nouveau Groupe' 
                       onClick=\"self.location.href='index.php?page=groupes_ajouter'\">
                      <input type='button' name='btnAccueilGestGroup' value='Accueil Gestion des groupes'
                      onClick=\"self.location.href='index.php?page=groupes_accueil'\">";
    }
    elseif ($flag == "errHomonyme") {
    $msgTitre = "<center>
                    <h3>Le nom de groupe existe déjà dans la base.</h3>
                    <h3>Merci d'en saisir un différent</h3>
                <center>";
}
// Sinon j'affiche le formulaire d'ajout normal
    else {
        $msgTitre = "";
    }

// Composition hmtl de la page
    $temp = "";
    $temp .= $msgTitre;
    $temp .= "<br/>";
    $temp .= "<form name='ajouterGroupe' action='index.php?page=groupes_ajouter' method='post'>
                <center>
                <table>
                    <tr>
                        <td>Nom : </td>
                        <td><input type='text' name='newGroupName' size='50' value='".$nom."'></td>
                    </tr>
                    <tr>
                        <td>Description : </td>
                        <td><textarea name='newGroupDescription' cols='50' rows='10'>" . $description . "</textarea></td>
                    </tr>
                </table>
                "
            . $msgBouton .
            "
                </center>
              </form>";

    return $temp;
}

// F.2 M
function formulaireModifierGroupe() {
    $temp = "";
    $temp .= "<form name='ModifierGroupe' action='index.php?page=groupes_modifier' method='post'>
                <center>
                <table>
                    <tr>
                        <td>Nom : </td>
                        <td><input type='text' name='modGroupName' size='50'></td>
                    </tr>
                    <tr>
                        <td>Description : </td>
                        <td><textarea name='modGroupDescription' cols='50' rows='10'></textarea></td>
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
 *          - NOM_UTIL -> modGroupName
 *          - PRENOM_UTIL -> modGroupFirstName
 *          - LOGIN_UTIL -> modGroupLogin
 *          - PASS_UTIL -> modGroupPassWord
 *     
 * @return string 
 */
function formulaireSupprimerGroupe() {
    $temp = "";
    $temp .= "<form name='SupprimerGroupe' action='index.php?page=groupes_supprimer' method='post'>
                <center>
                <table>
                    <tr>
                        <td>Nom : </td>
                        <td><input type='text' name='delGroupName' size='50'></td>
                    </tr>
                    <tr>
                    <tr>
                        <td>Description : </td>
                        <td><textarea name='delGroupDescription' cols='50' rows='10' readonly></textarea></td>
                    </tr>
                </table>
                <input type='submit' name='btnRechercher' value='Rechercher'> 
                <input type='submit' name='btnSupprimer' value='Supprimer'>
                <input type='reset' name='btnEffacer' value='Effacer'>
                </center>
              </form>";
    return $temp;
}

function formulaireAccueilGroupe() {
    $temp = "<center><h2>Gestion des groupes</h2></center>";
    $temp .= "BLABLA";
    $temp .= "<form  name='AccueilGroupe' action='index.php?page=groupes_accueil' method='post'>
              <center>
                <table>
                    <tr>
                        <td> Rechercher un groupe : </td>
                        <td><input type='button' name='btnRechercher' value='Rechercher' 
                        onClick=\"self.location.href='index.php?page=groupes_rechercher'\">
                        </td>
                    </tr>
                    <tr>
                        <td> Ajouter un groupe : </td>
                        <td><input type='button' name='btnAjouter' value='Ajouter' 
                        onClick=\"self.location.href='index.php?page=groupes_ajouter'\">
                        </td>
                    </tr>
                    <tr>
                        <td> Modifier un groupe : </td>
                        <td><input type='button' name='btnModifer' value='Modifer' 
                        onClick=\"self.location.href='index.php?page=groupes_modifier'\">
                        </td>
                    </tr>
                    <tr>
                        <td> Suppimer un groupe : </td>
                        <td><input type='button' name='btnSupprimer' value='Supprimer' 
                        onClick=\"self.location.href='index.php?page=groupes_supprimer'\">
                        </td>
                    </tr>
                    <tr>
                        <td> Lister les groupes : </td>
                        <td><input type='button' name='btnLister' value='Lister' 
                        onClick=\"self.location.href='index.php?page=groupes_lister'\">
                        </td>
                    </tr>
                </table>
              </center>
              </form>";
    return $temp;
}

function formulaireRechercherGroupe($flag, $rechGroupName, $rechGroupDescription) {
    
    $msgTitre = "";
    $msgBouton = "<input type='submit' name='btnAjouter' value='Ajouter'>
                  <input type='reset' name='btnEffacer' value='Effacer'>
                  <input type='button' name='btnAccueil' value='Accueil Gestion des groupes' 
                        onClick=\"self.location.href='index.php?page=groupes_accueil'\">";

// Si $flagErr == errSaisie alors je réaffiche le formulaire avec le message 
// informatif.
    if ($flag == "errSaisie") {
        $msgTitre = "<center><h3>Merci de saisir une information dans l'un des deux champs de recherche.</h3><center>";
    }
    elseif ($flag == "noResult"){
        $msgTitre = "<center><h3>La requête ne retourne aucun résultats</h3><center>";
    }
    // Sinon j'affiche le formulaire de recherche normal
    else {
        $msgTitre = "";
    }
    $temp = "";
    $temp .= $msgTitre;
    $temp .= "<form name='RechercherGroupe' action='index.php?page=groupes_rechercher' method='post'>
                <center>
                <table>
                    <tr>
                        <td>Nom : </td>
                        <td><input type='text' name='rechGroupName' size='50' value='".$rechGroupName."'></td>
                    </tr>
                    <tr>
                        <td>Description : </td>
                        <td><input type='text' name='rechGroupDescription' size='50'value='".$rechGroupDescription."'>
                    </tr>
                </table>

                <input type='submit' name='btnRechercher' value='Rechercher'> 
                <input type='reset' name='btnEffacer' value='Effacer'>
                <input type='button' name='btnAccueil' value='Accueil Gestion des groupes' 
                        onClick=\"self.location.href='index.php?page=groupes_accueil'\">
                </center>
              </form>";
    return $temp;
}

?>
