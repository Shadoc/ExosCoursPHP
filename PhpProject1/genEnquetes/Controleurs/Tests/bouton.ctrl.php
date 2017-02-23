<?php

include_once "Modeles/Classes/Bouton.class.php";
include_once "Modeles/Managers/bouton.mgr.php";
include_once ("Parametrage/db.conf.php");

$fichierCSS = PATH_CSS . "public.css";
$MenuNavigation = PATH_NAVIGATION . "public.menu.php";
$piedPage = PATH_VUES . "piedPage.vue.php";
$msg = "";
$msg .= "<center><h2>Gestion des boutons</h2></center>" . PHP_EOL;


echo '-----------------------------------<br/>';
echo "DATE : " . date("Y:m:d") . "<br/>";
echo "HEURE : " . date("H:i:s") . "<br/>";
$msg .= "DATE : " . date("Y:m:d") . "<br/>" . PHP_EOL;
$msg .="HEURE : " . date("H:i:s") . "<br/>" . PHP_EOL;

echo "TEST : bouton : <br/>";
//print_r($bouton);
$msg .= "TEST : bouton : <br/>" . PHP_EOL;
echo "TEST : Appel mgrBouton : <br/>";
$msg .= "TEST : Appel mgrBouton : <br/>" . PHP_EOL;
$mgrBouton = new boutonMgr();

echo "TEST : mgrBouton : <br/>";
echo '<br/>';
$msg .= "TEST : mgrBouton : <br/>" . PHP_EOL;
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
echo "DATE : " . date("Y:m:d") . "<br/>";
echo "HEURE : " . date("H:i:s") . "<br/>";

echo "TEST : bouton : <br/>";
$nouveau_bouton = new Bouton("");
echo "TEST : bouton : Nouveau Bouton cree<br/>";
$nouveau_bouton->setNAME_BOUTON("MON00");
$nouveau_bouton->setTYPE_BOUTON("TOTO00");
$nouveau_bouton->setVALUE_BOUTON("TITI00");
$nouveau_bouton->setACTION_BOUTON("action00");
//echo'<pre>';
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

print_r($nouveau_bouton);

if (is_a($nouveau_bouton, 'Bouton')) {
    echo('<h2>BBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBB</h2><br/>');
}

$nouveau_bouton = $mgrBouton->addBouton($nouveau_bouton);

echo 'TEST : bouton : monnouveau_bouton recupere<br/>';
echo 'TEST : bouton : ID_BOUTON : <br/>';
if ($nouveau_bouton == false) {
    echo 'PAS UN BOUTON!!!!!!!!!<br/>';
}
if ($nouveau_bouton == true) {
    echo 'TRUUUUEEEEE!!!!!!!!!<br/>';
}


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
echo "DATE : " . date("Y:m:d") . "<br/>";
echo "HEURE : " . date("H:i:s") . "<br/>";

echo "TEST : bouton : <br/>";
$nouveau_bouton->setACTION_BOUTON("MOD-ACTION_BOUTON");
$nouveau_bouton->setNAME_BOUTON("MOD-NAME_BOUTON");
$nouveau_bouton->setTYPE_BOUTON("MOD-TYPE_BOUTON");
$nouveau_bouton->setVALUE_BOUTON("MOD-VALUE_BOUTON");



echo "TEST : bouton : modBouton<br/>";
$flag = $mgrBouton->modBouton($nouveau_bouton);
if ($flag) {
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

/*
// ------------------------------- DELBOUTON-----------------------------------

echo '----------------- DELBOUTON ------------------<br/>';
echo "DATE : " . date("Y:m:d") . "<br/>";
echo "HEURE : " . date("H:i:s") . "<br/>";

echo "TEST : bouton : <br/>";

$flag = $mgrBouton->delBouton($nouveau_bouton);
if ($flag) {
    echo "TEST : bouton : DEL    Bouton OK!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!<br/>";
}

$flag = $mgrBouton->delBouton($nouveau_bouton);
if ($flag) {
    echo "TEST : bouton : DEL " . $nouveau_bouton->getID_BOUTON() . " Bouton OK!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!<br/>";
}
*/

// ------------------------------- ADDBOUTON (Bouton, Enquete) -----------------------------------
echo '----------------- ADDBOUTON (Bouton, Enquete) ------------------<br/>';
echo "DATE : " . date("Y:m:d") . "<br/>";
echo "HEURE : " . date("H:i:s") . "<br/>";

echo "TEST : bouton : <br/>";
$objEnq = new Enquete();
$objEnq->setID_ENQUETE("47");

$objBouton = new Bouton();

$objBoutonMgr = new boutonMgr();

echo 'Ajout bouton-enquete' . '<br/>';
$retour = $objBoutonMgr->addBouton($objBouton, $objEnq);


// ------------------------------- DELBOUTON-----------------------------------

echo '----------------- DELBOUTON ------------------<br/>';
echo "DATE : " . date("Y:m:d") . "<br/>";
echo "HEURE : " . date("H:i:s") . "<br/>";

echo "TEST : bouton : <br/>";

$flag = $mgrBouton->delBouton($nouveau_bouton);
if ($flag) {
    echo "TEST : bouton : DEL    Bouton OK!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!<br/>";
}

$flag = $mgrBouton->delBouton($nouveau_bouton);
if ($flag) {
    echo "TEST : bouton : DEL " . $nouveau_bouton->getID_BOUTON() . " Bouton OK!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!<br/>";
}







$contenuCentral = $msg;


// Affichage de la vue

include PATH_VUES . "template.vue.php";
?>

