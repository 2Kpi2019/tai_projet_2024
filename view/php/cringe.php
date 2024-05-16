<?php
    include_once 'includes.php'; // Assurez-vous que include.php est inclus dans chaque fichier PHP
    require_once("../../model/php/SerieModel.php");
    $userModel = new UserModel();

    // Récupérer les IDs des utilisateurs à partir du modèle
    session_start();
    $entries = $userModel->get_finish($_SESSION['id']);
    
    
?>
 
<?php telecharger(); ?>
<?php foreach ($entries as $serie): ?>
    <!-- Créer une zone cliquable autour de chaque utilisateur -->
    <div class="serie-zone" data-serie-id="<?php echo $serie['id']; ?>">
    <input type="hidden" id="blob_<?php echo $serie['id']; ?>" value="<?php echo base64_encode($serie['pdf_cr']); ?>">
        <!-- Div pour les informations -->
        <div class="info">
            <!-- Afficher les informations de l'utilisateur -->
            Référence: <?php echo $serie['reference']; ?><br>
            Nom: <?php echo $serie['name']; ?><br>
            Matière: <?php echo $serie['matter']; ?><br>
            Cloturer le: <?php echo $serie['closing_date']; ?><br>
        
        </div>
        <div class="milieu">
        <?php $prenom = $userModel->get_prenom($serie['id_workers(createur)']); ?>
        <?php $nom = $userModel->get_nom($serie['id_workers(createur)']); ?>
        <?php $prenom2 = $userModel->get_prenom($serie['id_workers(ingenieur)']); ?>
        <?php $nom2 = $userModel->get_nom($serie['id_workers(ingenieur)']); ?>
            Demandé par :<br>
            <?php echo $prenom[0]['first_name'].' '.$nom[0]['name']; ?><br>
            Réalisé par :<br>
            <?php echo $prenom2[0]['first_name'].' '.$nom2[0]['name']; ?><br>


            
            Nb Pièce: <?php echo $serie['nb_piece']; ?><br>
            

        </div>
        <!-- Div pour l'image -->
        <div class="image">
            <img src="data:image/jpeg;base64,<?php echo base64_encode($serie['picture']); ?>" alt="Image">
        </div>
    </div>
<?php endforeach; ?>


