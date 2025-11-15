<?php
    SESSION_START();
    include("_config.php");
    include("Routeur.class.php");

    if(empty($_GET['r']))
    {
        $requette="cefodbusinessschool";
        $runderControlller = new Routeur($requette);
        $runderControlller->runderController();
    }
    else
    {
        $requette = $_GET['r']; // ici on se retrouve avec index.php?r=MonContenuPasserSur_l'URL
        $runderControlller = new Routeur($requette);
        $runderControlller->runderController();
    }

?>