<?php

// -----------------------------------------------------------------------------
//                          Fonctions
// -----------------------------------------------------------------------------
include_once 'groupes_fonctions.php';
include_once 'groupes_formulaires.php';



// -----------------------------------------------------------------------------
//                          Programme principal
// -----------------------------------------------------------------------------
// I. Initialisatioin des variables
$msg = "";
$msg .= "<center><h2>Rechercher groupe</h2></center>" . PHP_EOL;

// Si le Bouton rechercher a été déclenché
if (isset($_POST['btnRechercher'])) {
// Alors je teste si au moins l'un de de ces deux contient quelque chose    
// Si le critere de recherche qui porte sur le nom du groupe n'est pas vide 
// alors je récupère la donnée
    if (!empty($_POST['rechGroupName'])) {
        $rechGroupName = $_POST['rechGroupName'];
    }
    // Sinon je j'affect une chaine vide.
    else {
        $rechGroupName = "";
    }
    // Si le critere de recherche qui porte sur la desctiption n'est pas vide 
    // alors je récupère la donnée
    if (!empty($_POST['rechGroupDescription'])) {
        $rechGroupDescription = $_POST['rechGroupDescription'];
    }
    // Sinon je j'affect une chaine vide.
    else {
        $rechGroupDescription = "";
    }
    // Si j'ai les deux critères de recherche vide
    if ($rechGroupName == "" && $rechGroupDescription == "") {
        // je demande l'affichage du formulaire avec un entete modifié
        // l'informant du problème
        $msg .= formulaireRechercherGroupe("errSaisie");
    }
    // Sinon
    else {
        // J'appelle la fonction de recherche
        $tabGroupes = rechercherGroupe($rechGroupName, $rechGroupDescription);
        // S'il y a des résultats
        if (!empty($tabGroupes)) {
            // et j'affiche le formulaire de recherche 
            $msg .= formulaireRechercherGroupe();
            // Je sépare le formulaire de recherche et les résultats 
            // par un barre horizontale
            $msg .= "\n<hr/>\n";
            // puis j'affiche les résultats
            $msg .= afficheRechercherGroupe($tabGroupes);
            // Je sépare le tableau de résultats du pied de page
            // par un barre horizontale
            $msg .= "\n<hr/>\n";
        }
        // Sinon j'informe l'utilsateur qu'il n'y na pas de résutats 
        // et je réaffiche son formulaire de recherche précédent
        else {
            // et j'affiche le formulaire de recherche 
            $msg .= formulaireRechercherGroupe("noResult", $rechGroupName, $rechGroupDescription);
        }
    }
}
// S'il n'y a pas eu d'événement utilisateur alors j'affiche la page de recherche
else {
    $msg .= formulaireRechercherGroupe();
}


// Affectation du hmtl au conteneur central 
$contenuCentral = $msg;
// Affichage de la vue
include PATH_VUES . "template.vue.php";
?>
