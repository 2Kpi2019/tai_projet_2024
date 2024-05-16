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

<?php foreach ($entries as $serie): ?>
         
        
        <fieldset>
        <legend>Information</legend>
            <!-- Afficher les informations de l'utilisateur -->
            
            Nom : <?php echo $serie['name']; ?><br>
            Référence : <?php echo $serie['reference']; ?><br>
            Matière : <?php echo $serie['matter']; ?><br>
            Poids (Kg): <?php echo $serie['weight']; ?><br>
            Hauteur (cm): <?php echo $serie['height']; ?><br>
            Longueur (cm): <?php echo $serie['length']; ?><br>
            Résistance (Pa): <?php echo $serie['resistance']; ?><br>
            Couleur : <?php echo $serie['color']; ?><br>
            Nombre de Pièce : <?php echo $serie['nb_piece']; ?><br>
            Deadline : <?php echo $serie['deadline']; ?><br>
            Erreur (%): <?php echo $serie['percentage_of_error']; ?><br>
            Description : <?php echo $serie['description']; ?><br>
            <!-- Ajoutez d'autres champs ici si nécessaire -->
            <?php $lastUserPicture = $serie['picture']; ?>
            
            </fieldset>
            
            
    <?php endforeach; ?>
    

</div>
<img class="photo" src="data:image/jpeg;base64,<?php echo base64_encode($lastUserPicture); ?>" alt="Image">
    <div>

<!-- Affichage des informations de la série -->


<?php foreach ($piece as $test): ?>
        
        <form id ="updateForm2" method="post" action="rien.php">
        <input type="hidden" name="idSerie" value="<?php echo $userID; ?>">
        <fieldset>
        <legend>Résultats</legend>
            <!-- Afficher les informations de l'utilisateur -->
            N° Pièce: <?php echo $test['n_piece']; ?><br>
            
            Conformité: <?php echo $test['compliance']; ?><br>
            Résistance (Pa): <?php echo $test['resistance']; ?><br>
            Info: <?php echo $test['info']; ?><br>
            Poids (Kg): <?php echo $test['weight']; ?><br>
            Hauteur (cm): <?php echo $test['height']; ?><br>
            Longueur (cm): <?php echo $test['length']; ?><br>
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