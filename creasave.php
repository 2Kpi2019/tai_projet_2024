<?php
// Faites d'abord tous les inclusions nécessaires
require_once(__DIR__."/model/php/SerieModel.php");
session_start();
if (isset($_SESSION['form_submitted']) && $_SESSION['form_submitted'] === true) {
    // Le formulaire a déjà été soumis, ne traitez pas à nouveau
    require_once(__DIR__."/view/php/respo.php");
    exit(); // Arrêtez l'exécution du script pour éviter de traiter le formulaire à nouveau
}
// Stocker les données saisies dans une session
$_SESSION['form_data'] = $_POST;
// Vérifiez si l'utilisateur provient du formulaire...
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifiez si tous les champs ont une entrée
    if (isset($_POST['Nom'], $_POST['Reference'], $_POST['Matiere'], $_POST['Resistance'], $_POST['poids'], $_POST['idinge'], $_POST['hauteur'], $_POST['longueur'], $_POST['nbpiece'], $_POST['couleur'], $_POST['description'], $_POST['date'],$_FILES["inputFile"]["tmp_name"]) &&
        strlen($_POST['Nom']) > 0 && strlen($_POST['Reference']) > 0 && strlen($_POST['Matiere']) > 0 && strlen($_POST['Resistance']) > 0 && strlen($_POST['poids']) > 0 &&
        strlen($_POST['idinge']) > 0 &&
        strlen($_POST['hauteur']) > 0 &&
        strlen($_POST['longueur']) > 0 &&
        strlen($_POST['nbpiece']) > 0 &&
        strlen($_POST['couleur']) > 0 &&
        strlen($_POST['description']) > 0 &&
        strlen($_POST['date']) > 0 &&
        strlen($_FILES["inputFile"]["tmp_name"]) >0    ) {  
        $_SESSION['form_submitted'] = true;
        // Tous les champs sont fournis, procéder à l'enregistrement des données
        $userModel = new UserModel();
        // Récupération des données du formulaire
        // il y a un terner pour mettre nul si on a une valeur vide mais sa ne servira a rien car
        // on vérifie avant qu'elle ne sont pas nul et notre base de données gère déja les valeur qui peuvent être nul
        // merci chat
        $Nom = $_POST['Nom'] !== '' ? $_POST['Nom'] : NULL;
        $Reference = $_POST['Reference'] !== '' ? $_POST['Reference'] : NULL;
        $Matiere = $_POST['Matiere'] !== '' ? $_POST['Matiere'] : NULL;
        $Resistance = $_POST['Resistance'] !== '' ? $_POST['Resistance'] : NULL;
        $poids = $_POST['poids'] !== '' ? $_POST['poids'] : NULL;
        $idinge = $_POST['idinge'] !== '' ? $_POST['idinge'] : NULL;
        $hauteur = $_POST['hauteur'] !== '' ? $_POST['hauteur'] : NULL;
        $longueur = $_POST['longueur'] !== '' ? $_POST['longueur'] : NULL;
        $nbpiece = $_POST['nbpiece'] !== '' ? $_POST['nbpiece'] : NULL;
        $couleur = $_POST['couleur'] !== '' ? $_POST['couleur'] : NULL;
        $description = $_POST['description'] !== '' ? $_POST['description'] : NULL;
        $date = $_POST['date'] !== '' ? $_POST['date'] : NULL;
        $erreur = $_POST['erreur'] !== '' ? $_POST['erreur'] : NULL;
        $idcrea = $_SESSION['id'];
        $donnees = file_get_contents($_FILES["inputFile"]["tmp_name"]);
        $imageInfo = getimagesize($_FILES["inputFile"]["tmp_name"]);

        // Appel de la fonction savedata avec toutes les données du formulaire
        $userModel->savecreat($Nom, $Reference, $Matiere, $Resistance, $poids, $idinge, $hauteur, $longueur, $nbpiece, $couleur, $description, $date, $idcrea,$erreur,$donnees);
        $root = "http://../../" . $_SERVER['HTTP_HOST'];

        $respoW3c = 1; //pour savoir qu'el script lancé
        require_once(__DIR__."/view/php/respo.php");
       
        
        unset($_SESSION['form_data'],$_POST['Nom'], $_POST['Reference'], $_POST['Matiere'], $_POST['Resistance'], $_POST['poids'], $_POST['idinge'], $_POST['hauteur'], $_POST['longueur'], $_POST['nbpiece'], $_POST['couleur'], $_POST['description'], $_POST['date'],$_FILES["inputFile"]["tmp_name"]);
        exit();
    } else {
        $respoW3c = 2;

        require_once(__DIR__."/view/php/respo.php");         
        exit();
    }
} else {
    require_once(__DIR__."/view/php/vide.php"); // pour douiller votre système de vérification w3c
}
