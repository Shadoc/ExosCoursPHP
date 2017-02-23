<?php

echo '<pre/>';
echo '<h2>';
echo '<br/>-----------------------------------------';
echo '<br/>ENQUETE.CTRL.PHP';
echo '<br/>ENQUETE.CTRL.PHP Instanciation objSGBD';
echo '</h2>';
$objSGBD = new SGBD();
echo '<h2>';
echo '<br/>ENQUETE.CTRL.PHP Instanciation objEnquete';
echo '</h2>';
echo '<h2>';
echo '<br/>ENQUETE.CTRL.PHP Remplissage des donnees membres';
echo '</h2>';
$objEnquete = new Enquete();

echo '<h2>';
echo '<br/>ENQUETE.CTRL.PHP Remplissage des donnees membres';
echo '</h2>';
$objEnquete->setCONCLUSION_ENQUETE("Ma conclusision");
$objEnquete->setINTRODUCTION_ENQUETE("Mon introduction");
$objEnquete->setTITRE_ENQUETE("Mon titre Enquete");


echo '<br/> ';
print_r($objEnquete);


echo '<h2>';
echo '<br/>ENQUETE.CTRL.PHP Instanciation objEnqueteMgr';
echo '</h2>';
$objEnqueteMgr = new enqueteMgr();



echo '<h2>';
echo '<br/>ENQUETE.CTRL.PHP Appel de la methode addEnquete';
echo '</h2>';
$objEnquete_result_add = new Enquete;
$objEnquete_result_add = $objEnqueteMgr->addEnquete($objEnquete);
echo '<h2>';
echo '<br/> ENQUETE.CTRL.PHP Resultat de addEnquete <br/>';
echo '</h2>';
print_r($objEnquete_result_add);


echo '<h2>';
echo '<br/>ENQUETE.CTRL.PHP Appel de la methode getEnquete';
echo '</h2>';
//$objEnquete->getID_ENQUETE();
$objEnquete_result_get = new Enquete;
$id_enquete = $objEnquete_result_add->getID_ENQUETE();
$objEnquete_result_get = $objEnqueteMgr->getEnquete($id_enquete);
echo '<h2>';
echo '<br/> ENQUETE.CTRL.PHP Resultat de getEnquete <br/>';
echo '</h2>';
print_r($objEnquete_result_get);

echo '<h2>';
echo '<br/>ENQUETE.CTRL.PHP Appel de la methode modEnquete';
echo '</h2>';
$objEnquete_result_get->setCONCLUSION_ENQUETE('UNE autre conclusion');
$objEnquete_result_get->setINTRODUCTION_ENQUETE('Une autre intro');
$objEnquete_result_get->setTITRE_ENQUETE('Un autre Titre');
$retour = $objEnqueteMgr->modEnquete($objEnquete_result_get);

if ($retour) {
    echo '<h2>';
    echo '<br/>ENQUETE.CTRL.PHP Appel de la methode getEnquete apres modif';
    echo '</h2>';
    $objEnquete_result_get = $objEnqueteMgr->getEnquete($objEnquete_result_get);
    print_r($objEnquete_result_get);
}
else {
    echo '<h2>';
    echo '<br/>ENQUETE.CTRL.PHP Erreur dans lors de l appel de la methode genEnquete';
    echo '</h2>';
}
?>
