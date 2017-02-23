<?php

//echo "<pre>------------------------------------------------</br>";
//var_dump($_POST);
//var_dump($_REQUEST);
// -----------------------------------------------------------------------------
//                          Fonctions
// -----------------------------------------------------------------------------
include_once 'enquetes_fonctions.php';
include_once 'enquetes_formulaires.php';

// -----------------------------------------------------------------------------
//                   Initialisation des variables
// -----------------------------------------------------------------------------



// -----------------------------------------------------------------------------
//                          Programme principal
// -----------------------------------------------------------------------------
// Affichage du formulaire
$msg = "";
$msg .= "<center><h2>Création d'enquête</h2></center>" . PHP_EOL;

// Si l'utilisateur clique sur suivant
// Alors je teste si le titre de l'enquête est rempli
// Si oui alors j'affiche je stocke l'information de des champs 
// 

$msg .= formulaireCreerEnquete("", "", "", "");

// Affectation du hmtl au conteneur central 
$contenuCentral = $msg;
// Affichage de la vue
include PATH_VUES . "template.vue.php";
?>
