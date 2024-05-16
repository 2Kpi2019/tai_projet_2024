<?php
    
    include_once 'includes.php'; // Assurez-vous que include.php est inclus dans chaque fichier PHP
    require_once("../../model/php/SerieModel.php");
    $userModel = new UserModel();
    $userID = $_GET['userID'];
    

    // Récupérer les IDs des utilisateurs à partir du modèle
    $entries = $userModel->get_serie($userID);
    $PieceMax = $entries[0]['nb_piece'];
    //printf($PieceMax);

    if (!isset($_GET['variable'])) {
        
        // Si elle n'existe pas, initialiser à 1
        $variable = 1;
    } else {
        $variable = $_GET['variable'];
    }
    

// Récupérer les informations de la base de données en fonction de l'ID actuel

// Définir les ID pour les boutons d'augmentation et de diminution
// Assurez-vous que l'ID ne devienne jamais inférieur à 1
$piece = $userModel->get_serie_by_id($userID,$variable);
    
    ?>
<div class="flex-containerr">
    <div class="">

<?php foreach ($entries as $user): ?>
         
        
        <fieldset>
        <legend>Information</legend>
            <!-- Afficher les informations de l'utilisateur -->
            
            Nom : <?php echo $user['name']; ?><br>
            Référence : <?php echo $user['reference']; ?><br>
            Matière : <?php echo $user['matter']; ?><br>
            Poids (Kg): <?php echo $user['weight']; ?><br>
            Hauteur (cm): <?php echo $user['height']; ?><br>
            Longueur (cm): <?php echo $user['length']; ?><br>
            Résistance (Pa): <?php echo $user['resistance']; ?><br>
            Couleur : <?php echo $user['color']; ?><br>
            Nombre de Pièce : <?php echo $user['nb_piece']; ?><br>
            Deadline : <?php echo $user['deadline']; ?><br>
            Erreur (%): <?php echo $user['percentage_of_error']; ?><br>
            Description : <?php echo $user['description']; ?><br>
            <!-- Ajoutez d'autres champs ici si nécessaire -->
            <?php $lastUserPicture = $user['picture']; ?>
            
            </fieldset>
            
            
    <?php endforeach; ?>
    

</div>
<img class="photo" src="data:image/jpeg;base64,<?php echo base64_encode($lastUserPicture); ?>" alt="Image">
    <div>

<!-- Affichage des informations de la série -->


<?php foreach ($piece as $user): ?>
        
        <form id ="updateForm2" method="post" action="rien.php">
        <input type="hidden" name="idSerie" value="<?php echo $userID; ?>">
        <fieldset>
        <legend>Résultats</legend>
            <!-- Afficher les informations de l'utilisateur -->
            N° Pièce: <?php echo $user['n_piece']; ?><br>
            
            Conformité: <?php echo $user['compliance']; ?><br>
            Résistance (Pa): <?php echo $user['resistance']; ?><br>
            Info: <?php echo $user['info']; ?><br>
            Poids (Kg): <?php echo $user['weight']; ?><br>
            Hauteur (cm): <?php echo $user['height']; ?><br>
            Longueur (cm): <?php echo $user['length']; ?><br>
            <!-- Ajoutez d'autres champs ici si nécessaire -->
            <div class="button-containerr">
            <a href="#" id="" onclick="piecemoins2(<?php echo $userID; ?>, <?php echo $variable; ?>)">◄</a>
            
            <a href="#" id="" onclick="pieceplus2(<?php echo $userID; ?>, <?php echo $variable; ?>,<?php echo $PieceMax; ?>)">►</a>
            </div>
            </fieldset>
            </form>
        
    <?php endforeach; ?><br>
    

</div>
</div>
<!-- <style>
.flex-containerr {
    display: flex;
    justify-content: center; /* Espacement égal entre les éléments */
    align-items: center; /* Centrer verticalement */
    width: 100%; 
    gap: 100px; 
    font-size: 18px;
}


#updateForm2 {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
}

#updateForm2 fieldset {
    margin: 0 auto; /* Centrer le fieldset à l'intérieur du formulaire */
    width: 50%; /* Largeur du fieldset */
}

#updateForm2 input[type="text"] {
    
    width: calc(100% - 20px); /* Largeur du champ de saisie, moins les marges */
    margin: 5px 0; /* Espacement entre les champs de saisie */
}
#updateForm2 button,
#updateForm2 a {
    display: inline-block; /* Rend les éléments en ligne */
    margin: 0 10px; /* Ajoute un peu d'espace entre les éléments */
    margin-top: 15px;
    padding: 15px 30px; /* Ajoutez du rembourrage pour rendre le bouton plus grand */
    font-size: 1.2em; /* Taille de police */
    background-color: #007bff; /* Couleur de fond */
    color: #ffffff; /* Couleur du texte */
    border: none; /* Supprime la bordure */
    border-radius: 10px; /* Coins arrondis */
    cursor: pointer; /* Curseur au survol */
    text-decoration: none; /* Supprime le soulignement des liens */
}
#updateForm2 a:hover {
    background-color: #0056b3;
}
.button-containerr {
    display: flex;
    justify-content: center;
    align-items: center;
}



</style> -->




<!-- Boutons avec des flèches pour augmenter et diminuer l'ID -->




                
        