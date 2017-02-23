<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >

    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
        <title><?php print(TITREPAGE); ?></title>
        <link href="<?php print($fichierCSS); ?>" rel="stylesheet" type="text/css" media="all"/>
        

    </head>

    <body>
        <div id="conteneurGlobal">                                <!--Debut conteneur-->
            <div id="enTete">                               
                <div id="nomBandeau">
                    <?php print(TITREBAUDEAU); ?>
                </div>
            </div><!--Fin EnTete-->

            <div id="Menu">
                <?php include $MenuNavigation; ?>
            </div><!--Fin MenuNavigation-->

            <div id="conteneurCentral">
                <div id="contenuCentral">
                    <?php print($contenuCentral); ?>
                </div><!--Fin contenuCentral-->
            </div><!--Fin conteneurCentral-->

            <div id="piedPage">
                <?php include $piedPage; ?>
            </div><!--Fin piedPage-->
        </div><!--Fin conteneurGlobal-->
    </body>
</html>
