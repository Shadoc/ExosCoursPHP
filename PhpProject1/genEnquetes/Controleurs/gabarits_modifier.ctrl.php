<?php

// -----------------------------------------------------------------------------
//                          Fonctions
// -----------------------------------------------------------------------------
include_once 'gabarits_fonctions.php';
include_once 'gabarits_formulaires.php';



// -----------------------------------------------------------------------------
//                          Programme principal
// -----------------------------------------------------------------------------



// I. Initialisatioin des variables
$msg = "";
$msg .= "<center><h2>Modifier gabarit</h2>" . PHP_EOL;

$msg .= "<h3>-*-</h3>";
$msg .= "<h3>EN CONSTRUCTION</h3>";
$msg .= "</center>";




// Affectation du hmtl au conteneur central 
$contenuCentral = $msg;
// Affichage de la vue
include PATH_VUES . "template.vue.php";
?>
