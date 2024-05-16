<?php
    
    include_once 'includes.php'; // Assurez-vous que include.php est inclus dans chaque fichier PHP
    require_once("../../model/php/SerieModel.php");
    $userModel = new UserModel();
    $userID = $_GET['userID'];
    

    // Récupérer les IDs des utilisateurs à partir du modèle
    $entries = $userModel->get_serie($userID);
    
    $allpiece = $userModel->get_all_piece($userID);
    $entriesJSON = json_encode($entries);
    $allpieceJSON = json_encode($allpiece);
    $PieceMax = $entries[0]['nb_piece'];
    //printf($PieceMax);
// pour mettre la pièce numéro un de base si il n'y a pas de pièce
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
<div class="flexattitude">
    <div class="">

<?php foreach ($entries as $serie): ?>
         
        
        <fieldset>
        <legend>Information</legend>
            <!-- Afficher les informations de l'utilisateur -->
            
            Nom : <?php echo $serie['name']; ?><br>
            Référence : <?php echo $serie['reference']; ?><br>
            Matière : <?php echo $serie['matter']; ?><br>
            Poids (kg): <?php echo $serie['weight']; ?><br>
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
<img class="photo"src="data:image/jpeg;base64,<?php echo base64_encode($lastUserPicture); ?>" alt="Image">
    <div>

<!-- Affichage des informations de la série -->


<?php foreach ($piece as $test): ?>
        
        <form id ="formsave" method="post" action="save.php">
        <input type="hidden" name="idSerie" value="<?php echo $userID; ?>">
        <fieldset>
        <legend>Résultats</legend>
            <!-- Afficher les informations de l'utilisateur -->
            N° Pièce : <?php echo $test['n_piece']; ?><input type="hidden" name="N_Piece" value="<?php echo $test['n_piece']; ?>" readonly><br>

            <div class="form-group form-gauche">
                        <label>Conformité :</label>
                        <input type="text" placeholder="Conformité" name="compliance" value="<?php echo htmlspecialchars($test['compliance']); ?>">
                    </div>
                    <div class="form-group form-gauche">
                        <label>Résistance (Pa) :</label>
                        <input type="text" oninput="this.value = this.value.replace(/[^\d.,]/g, '').replace(',', '.')" placeholder="Résistance" name="Resistance" value="<?php echo htmlspecialchars($test['resistance']); ?>">
                    </div>
                    <div class="form-group form-gauche">
                        <label>Info :</label>
                        <input type="text" placeholder="Info" name="info" value="<?php echo htmlspecialchars($test['info']); ?>">
                    </div>
                    <div class="form-group form-droite">
                        <label>Poids (kg) :</label>
                        <input type="text" oninput="this.value = this.value.replace(/[^\d.,]/g, '').replace(',', '.')" placeholder="Poids" name="date" value="<?php echo htmlspecialchars($test['weight']); ?>">
                    </div>
                    <div class="form-group form-droite">
                        <label>Hauteur (cm) :</label>
                        <input type="text" oninput="this.value = this.value.replace(/[^\d.,]/g, '').replace(',', '.')" placeholder="Hauteur" name="haut" value="<?php echo htmlspecialchars($test['height']); ?>">
                    </div>
                    <div class="form-group form-droite">
                        <label>Longueur (cm) :</label>
                        <input type="text" oninput="this.value = this.value.replace(/[^\d.,]/g, '').replace(',', '.')" placeholder="Longueur" name="long" value="<?php echo htmlspecialchars($test['length']); ?>">
                    </div>
            
        <input type="hidden" name="userID" value="<?php echo $userID; ?>">
            <div class="button-container9">
            <a href="#" id="" onclick="piecemoins(<?php echo $userID; ?>, <?php echo $variable; ?>)">◄</a>
            <button type="submit" id="val">Valider</button>
            <a href="#" id="" onclick="pieceplus(<?php echo $userID; ?>, <?php echo $variable; ?>,<?php echo $PieceMax; ?>)">►</a>
            </div>
            </fieldset>
            </form>
        
    <?php endforeach; ?><br>
    

</div>
</div>

<form id ="update" method="post" action="cloture.php">
    <input type="hidden" name="idSerie" value="<?php echo $userID; ?>">        
    <button type="submit" id="clot" onClick="">Cloturer le Test</button>
</form>
<script>
                messagebox2("")
    // Définir des variables JavaScript avec les données JSON encodées
    var entries = <?php echo $entriesJSON; ?>;
    var allpiece = <?php echo $allpieceJSON; ?>;

    // Appeler la fonction generatePDF() avec les données JSON
    
</script>




                
        