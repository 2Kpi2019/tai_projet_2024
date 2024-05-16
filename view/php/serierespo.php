<?php
    include_once 'includes.php'; // Assurez-vous que include.php est inclus dans chaque fichier PHP
    require_once("../../model/php/SerieModel.php");
    $userModel = new UserModel();
    

    // Récupérer les IDs des utilisateurs à partir du modèle
    $entries = $userModel->get_les_serie();
   
    
    ?>
    

<?php foreach ($entries as $serie): ?>
    <!-- Créer une zone cliquable autour de chaque utilisateur -->
    <div class="serie-zone" data-serie-id="<?php echo $serie['id']; ?>">
        <!-- Div pour les informations -->
        <div class="info">
            <!-- Afficher les informations de l'utilisateur -->
            Référence: <?php echo $serie['reference']; ?><br>
            Nom: <?php echo $serie['name']; ?><br>
            Matière: <?php echo $serie['matter']; ?><br>
            Deadline: <?php echo $serie['deadline']; ?><br>
        </div>
        <div class="milieu">
        <?php $prenom = $userModel->get_prenom($serie['id_workers(ingenieur)']); ?>
        <?php $nom = $userModel->get_nom($serie['id_workers(ingenieur)']); ?>
        <?php $states = $userModel->get_states($serie['id']); ?>
        Ingénieur :<br>
            <?php echo $prenom[0]['first_name'].' '.$nom[0]['name']; ?><br>
            Nb Pièce: <?php echo $serie['nb_piece']; ?><br>
            Status: <?php echo $states; ?><br>

        </div>
        <!-- Div pour l'image -->
        <div class="image">
            <img src="data:image/jpeg;base64,<?php echo base64_encode($serie['picture']); ?>" alt="Image">
        </div>
    </div>
<?php endforeach; ?>

