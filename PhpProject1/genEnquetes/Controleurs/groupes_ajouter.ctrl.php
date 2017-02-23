<?php

//echo "<pre>------------------------------------------------</br>";
//var_dump($_POST);
//var_dump($_REQUEST);
// -----------------------------------------------------------------------------
//                          Fonctions
// -----------------------------------------------------------------------------
include_once 'groupes_fonctions.php';
include_once 'groupes_formulaires.php';

// -----------------------------------------------------------------------------
//                   Initialisation des variables
// -----------------------------------------------------------------------------

$objGroupe = new Groupe();
$mgrGroupe = new groupeMgr();
$NOM_GROUPE = "";
$DESCRIPTION_GROUPE = "";

// -----------------------------------------------------------------------------
//                          Programme principal
// -----------------------------------------------------------------------------
// Affichage du formulaire
$msg = "";
$msg .= "<center><h2>Ajout groupe</h2></center>" . PHP_EOL;




//echo "</br>------------------------------------------------</br>";
//echo $_POST['btnAjouter'];
//echo "</br>------------------------------------------------</br>";
// Recupération des données du formulaire
if (isset($_POST['btnAjouter'])) {
    // S'il je récupère un nouveau nom de groupe et qu'il n'est pas vide
    if (isset($_POST['newGroupName']) && !empty($_POST['newGroupName'])) {
        $NOM_GROUPE = $_POST['newGroupName'];
        // j'affecte ce nom de groupe à la donnée membre de mon objet Group
        $objGroupe->setNOM_GROUPE($NOM_GROUPE);

        // je teste s'il y a une description, si oui
        if (isset($_POST['newGroupDescription'])) {
            $DESCRIPTION_GROUPE = $_POST['newGroupDescription'];
            // j'affecte ce nom de groupe à la donnée membre de mon objet Group
            $objGroupe->setDESCRIPTION_GROUPE($DESCRIPTION_GROUPE);
        }
        // Je teste l'homonymie
        // Si je trouve un groupe ayant le même nom
        if ($mgrGroupe->rechercherGroupe($NOM_GROUPE, "") != null) {
            // j'informe l'utilisateur qu'il y a homonymie
            $msg .= formulaireAjouterGroupe("errHomonyme", $NOM_GROUPE, $DESCRIPTION_GROUPE);
        }
        // sinon je demande l'enregistrement de mon groupe dans la table GROUPE
        else {
            $objGroupe = $mgrGroupe->addGroupe($objGroupe);
            // et je vérifie que mon objet a bien ete enregistre
            if ($mgrGroupe->getGroupe($objGroupe) != null) {
                // Si oui alors j'informe l'utilisateur de la réussite
                $msg .= formulaireAjouterGroupe($objGroupe);
            }
        }
    }
    // sinon je j'informe l'utilisateur qu'il doit remplir le champ nom
    else {
        $msg .= formulaireAjouterGroupe("errNom", "", $_POST['newGroupDescription']);
    }
}
// Si je n'ai pas de renvoie de formulaire alors j'affiche le formulaire d'ajout
else {
    $msg .= formulaireAjouterGroupe("ok");
}




// Affectation du hmtl au conteneur central 
$contenuCentral = $msg;
// Affichage de la vue
include PATH_VUES . "template.vue.php";
?>
