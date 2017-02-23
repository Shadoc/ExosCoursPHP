<?php

// -----------------------------------------------------------------------------
//                          Fonctions
// -----------------------------------------------------------------------------
include_once 'groupes_fonctions.php';
include_once 'groupes_formulaires.php';

// -----------------------------------------------------------------------------
//                          Programme principal
// -----------------------------------------------------------------------------
// Affichage du formulaire
$msg = "";
$msg .= formulaireAccueilGroupe();


// Affectation du hmtl au conteneur central 
$contenuCentral = $msg;
// Affichage de la vue
include PATH_VUES . "template.vue.php";
?>
