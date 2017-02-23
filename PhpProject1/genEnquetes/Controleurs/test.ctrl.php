<?php

include_once "Modeles/Classes/Bouton.class.php";
include_once "Modeles/Managers/bouton.mgr.php";
include_once ("Parametrage/db.conf.php");

$fichierCSS = PATH_CSS . "public.css";
$MenuNavigation = PATH_NAVIGATION . "public.menu.php";
$piedPage = PATH_VUES . "piedPage.vue.php";


echo '-----------------------------------<br/>';

echo "TEST : bouton : <br/>";
print_r($bouton);

echo "TEST : Appel mgrBouton : <br/>";

$mgrBouton = new boutonMgr();

echo "TEST : mgrBouton : <br/>";
echo '<br/>';
$bouton = $mgrBouton->getBouton(1);

//$bouton = new Bouton($tab);


echo 'TEST : bouton : mon bouton recupere<br/>';
echo 'TEST : bouton : ID_BOUTON : ';
echo $bouton->getID_BOUTON();
echo '<br/>';

echo 'TEST : bouton : TYPE_BOUTON : ';
echo $bouton->getTYPE_BOUTON();
echo '<br/>';

echo 'TEST : bouton : VALUE_BOUTON : ';
echo $bouton->getVALUE_BOUTON();
echo '<br/>';

echo 'TEST : bouton : ACTION_BOUTON : ';
echo $bouton->getACTION_BOUTON();
echo '<br/>';

echo 'TEST : bouton : NAME_BOUTON : ';
echo $bouton->getNAME_BOUTON();
echo '<br/>';




$contenuCentral = "test";

// Affichage de la vue
include PATH_VUES . "template.vue.php";
?>

