<?php
// do all necessary includes first
require_once(__DIR__."/model/php/SerieModel.php");

// Check if the user comes from the form...

        session_start();
    // Tous les champs sont fournis, procéder à l'enregistrement des données de l'utilisateur
    $userModel = new UserModel();
    $info = $userModel->get_serie($_POST['idSerie']);
    $piece = $userModel->get_all_piece($_POST['idSerie']);

    $userModel->cloturetest($_POST['idSerie'],"");
    
        require_once(__DIR__."/view/php/inge.php");
    
        ?>