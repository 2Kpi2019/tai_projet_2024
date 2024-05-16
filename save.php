<?php
// do all necessary includes first
require_once(__DIR__."/model/php/SerieModel.php");

// Check if the user comes from the form...
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // check if all fields have an input
    if(isset($_POST['N_Piece'], $_POST['compliance'], $_POST['Resistance'], $_POST['info'], $_POST['date'])) {
        session_start();
    // Tous les champs sont fournis, procéder à l'enregistrement des données de l'utilisateur
    $userModel = new UserModel();
    $N_Piece = $_POST['N_Piece'] !== '' ? $_POST['N_Piece'] : NULL;
    $compliance = $_POST['compliance'] !== '' ? $_POST['compliance'] : NULL;
    $Resistance = $_POST['Resistance'] !== '' ? $_POST['Resistance'] : NULL;
    $info = $_POST['info'] !== '' ? $_POST['info'] : NULL;
    $date = $_POST['date'] !== '' ? $_POST['date'] : NULL;
    $haut = $_POST['haut'] !== '' ? $_POST['haut'] : NULL;
    $long = $_POST['long'] !== '' ? $_POST['long'] : NULL;
    $userModel->savedata($N_Piece, $compliance, $Resistance, $info, $date,$_POST['idSerie'],$haut,$long);
    // Session pour stocker les données de l'utilisateur
        
        // $_SESSION['firstname'] = $_POST['prenomcomplet'];
        // $_SESSION['lastname'] = $_POST['nomdefamille'];
        $_SESSION['npiece'] = $_POST['N_Piece'];
        // $_SESSION['id'] = $_SESSION['idutilisateur'];

        $entries = $userModel->get_serie_ssph($_POST['userID']);

        $allpiece = $userModel->get_all_piece($_POST['userID']);
        $ingeW3c = 1; // pour savoir qu'el script lancé
        require_once(__DIR__."/view/php/inge.php");
        
        
        

        
       
                 
    } else {
        // Handle error: missing input fields
        
    }
} else {
    // Handle error: form not submitted
    
    require_once(__DIR__."/view/php/vide.php"); // douille w3c
}


?>



