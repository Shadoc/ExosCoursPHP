<?php

// -----------------------------------------------------------------------------
//                          Fonctions
// -----------------------------------------------------------------------------
include_once 'utilisateurs_fonctions.php';
include_once 'utilisateurs_formulaires.php';



// -----------------------------------------------------------------------------
//                          Programme principal
// -----------------------------------------------------------------------------



// I. Initialisatioin des variables
$msg = "";
$msg .= "<center><h2>Suppression utilisateur</h2></center>" . PHP_EOL;
$msg .= 

$msg .= formulaireModifierUtilisateur();



// Affectation du hmtl au conteneur central 
$contenuCentral = $msg;
// Affichage de la vue
include PATH_VUES . "template.vue.php";
?>
