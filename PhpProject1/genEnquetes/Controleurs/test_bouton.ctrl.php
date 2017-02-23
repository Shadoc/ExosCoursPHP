<?php

include_once "Modeles/Classes/Bouton.class.php";
include_once "Modeles/Managers/bouton.mgr.php";
include_once ("Parametrage/db.conf.php");

$fichierCSS = PATH_CSS . "public.css";
$MenuNavigation = PATH_NAVIGATION . "public.menu.php";
$piedPage = PATH_VUES . "piedPage.vue.php";


echo '-----------------------------------<br/>';
echo "DATE : ".date("Y:m:d")."<br/>";
echo "HEURE : ".date("H:i:s")."<br/>";

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

// ------------------------------- ADDBOUTON-----------------------------------

echo '----------------- ADDBOUTON ------------------<br/>';
echo "DATE : ".date("Y:m:d")."<br/>";
echo "HEURE : ".date("H:i:s")."<br/>";

echo "TEST : bouton : <br/>";
$nouveau_bouton = new Bouton("");
echo "TEST : bouton : Nouveau Bouton cree<br/>";
$nouveau_bouton->setNAME_BOUTON("MON");
$nouveau_bouton->setTYPE_BOUTON("TOTO");
$nouveau_bouton->setVALUE_BOUTON("TITI");
$nouveau_bouton->setACTION_BOUTON("action");

echo "TEST : bouton : Nouveau Bouton elements<br/>";
echo 'TEST : bouton : TYPE_BOUTON : ';
echo $nouveau_bouton->getTYPE_BOUTON();
echo '<br/>';

echo 'TEST : bouton : VALUE_BOUTON : ';
echo $nouveau_bouton->getVALUE_BOUTON();
echo '<br/>';

echo 'TEST : bouton : ACTION_BOUTON : ';
echo $nouveau_bouton->getACTION_BOUTON();
echo '<br/>';




$nouveau_bouton = $mgrBouton->addBouton($nouveau_bouton);

echo 'TEST : bouton : monnouveau_bouton recupere<br/>';
echo 'TEST : bouton : ID_BOUTON : ';
echo $nouveau_bouton->getID_BOUTON();
echo '<br/>';

echo 'TEST : bouton : TYPE_BOUTON : ';
echo $nouveau_bouton->getTYPE_BOUTON();
echo '<br/>';

echo 'TEST : bouton : VALUE_BOUTON : ';
echo $nouveau_bouton->getVALUE_BOUTON();
echo '<br/>';

echo 'TEST : bouton : ACTION_BOUTON : ';
echo $nouveau_bouton->getACTION_BOUTON();
echo '<br/>';



// ------------------------------- MODBOUTON-----------------------------------

echo '----------------- MODBOUTON ------------------<br/>';
echo "DATE : ".date("Y:m:d")."<br/>";
echo "HEURE : ".date("H:i:s")."<br/>";

echo "TEST : bouton : <br/>";
$nouveau_bouton->setACTION_BOUTON("MOD-ACTION_BOUTON");
$nouveau_bouton->setNAME_BOUTON("MOD-NAME_BOUTON");
$nouveau_bouton->setTYPE_BOUTON("MOD-TYPE_BOUTON");
$nouveau_bouton->setVALUE_BOUTON("MOD-VALUE_BOUTON");



echo "TEST : bouton : modBouton<br/>";
$flag = $mgrBouton->modBouton($nouveau_bouton);
if ($flag){
    echo "TEST : bouton : modBouton OK!!!!!!<br/>";
}


// Affichage des donnees de mon bouton modifie
echo "TEST : mgrBouton : <br/>";
echo '<br/>';

$bouton = $mgrBouton->getBouton($nouveau_bouton->getID_BOUTON());

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


// ------------------------------- DELBOUTON-----------------------------------

echo '----------------- DELBOUTON ------------------<br/>';
echo "DATE : ".date("Y:m:d")."<br/>";
echo "HEURE : ".date("H:i:s")."<br/>";

echo "TEST : bouton : <br/>";

$flag = $mgrBouton->delBouton($nouveau_bouton);
if ($flag){
    echo "TEST : bouton : DEL    Bouton OK!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!<br/>";
}

$flag = $mgrBouton->delBouton("14");
$flag = $mgrBouton->delBouton($nouveau_bouton);
if ($flag){
    echo "TEST : bouton : DEL  141414141414  Bouton OK!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!<br/>";
}
$contenuCentral = "test";

// Affichage de la vue
include PATH_VUES . "template.vue.php";
?>

