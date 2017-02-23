<?php

function afficheRechercherGroupe($tabGroupes) {
    $temp = "";

    // prépration de l'affichage sous forme de tableau
    $temp .= "<center>
                <table>
                    <th>Numéro</th>
                    <th>Nom</th>
                    <th>Desctiption</th>
                    <th>Modifier</th>
                    <th>Supprimer</th>";
    // Pour chaque ligne de mon tableau
    foreach ($tabGroupes as $key => $valeur) {
        $objGroupe = new Groupe();
        $objGroupe = $valeur;

        // Je récupère les valeurs de mon objet
        $ID_GROUPE = $objGroupe->getID_GROUPE();
        $NOM_GROUPE = $objGroupe->getNOM_GROUPE();
        $DESCRIPTION_GROUPE = $objGroupe->getDESCRIPTION_GROUPE();

        // je crée une ligne de mon tableau d'affichage
        $temp .= "\n\t<tr>";
        $temp .= "\n\t\t<td>" . $ID_GROUPE . "</td>";
        $temp .= "\n\t\t<td>" . $NOM_GROUPE . "</td>";
        $temp .= "\n\t\t<td>" . $DESCRIPTION_GROUPE . "</td>";
        $temp .= "\n\t\t<td><input type='button' name='btnRechMod' value='Modifier'></td>" ;
        $temp .= "\n\t\t<td><input type='button' name='btnRechSupp' value='Supprimer'></td>" ;
        $temp .= "\n\t</tr>";
    }

    // fermeture des balises de mon tableau
    $temp .= "\n</table>
              </center>";

    // Je retourne mon affichage
    return $temp;
}

function rechercherGroupe($rechGroupName, $rechGroupDescription) {
    // J'initialise le tableau de retour de ma méthode de recherche
    $tabGroupes = array();

    // J'instancie un objet manager de groupe
    $mgrGroupe = new groupeMgr();
    // j'appelle ma méthode de recherche d'un objet Groupe
    // que je stocke dans mon tableau
    $tabGroupes = $mgrGroupe->rechercherGroupe($rechGroupName, $rechGroupDescription);

    // je retourne mon tableau à l'appelant
    return $tabGroupes;
}

function afficheAjoutOk() {
    $temp = "";

    return $temp;
}

function afficheAjoutKo() {
    $temp = "<center><h3>Merci de remplir le champ Nom avant de valider.</h3></center>";

    return $temp;
}

?>
