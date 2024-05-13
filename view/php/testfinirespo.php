<?php
    include_once 'includes.php'; // Assurez-vous que include.php est inclus dans chaque fichier PHP
    require_once("../../model/php/SerieModel.php");
    $userModel = new UserModel();

    // Récupérer les IDs des utilisateurs à partir du modèle
    $entries = $userModel->get_finish2();
    
    
?>
 <style>
    .serie-zone {
    border: solid black;
    display: flex;
    align-items: center;
    justify-content: space-between; /* Espacement équitable entre les éléments */
    margin: 5px;
    padding: 10px;
    width: calc(100%); /* Le cadre prendra toute la largeur de son conteneur, ajusté pour la bordure et le rembourrage */
    box-sizing: border-box; /* Inclure la bordure et le rembourrage dans la largeur totale */
}

.serie-zone .info,
.serie-zone .image img,
.serie-zone .milieu {
    flex: 1; /* Les divs .info, .milieu et .image prendront autant d'espace que possible */
    
}

.serie-zone .image img {
    
    max-width: 150px;
    max-height: 150px;
    margin-right: auto;
}




</style>
<?php donnes(); ?>
<?php foreach ($entries as $user): ?>
    <!-- Créer une zone cliquable autour de chaque utilisateur -->
    <div class="serie-zone" data-serie-id="<?php echo $user['id']; ?>">
        <!-- Div pour les informations -->
        <div class="info">
            <!-- Afficher les informations de l'utilisateur -->
            Référence: <?php echo $user['reference']; ?><br>
            Nom: <?php echo $user['name']; ?><br>
            Matière: <?php echo $user['matter']; ?><br>
            Cloturer le: <?php echo $user['closing_date']; ?><br>
        
        </div>
        <div class="milieu">
        <?php $prenom = $userModel->get_prenom($user['id_workers(createur)']); ?>
        <?php $nom = $userModel->get_nom($user['id_workers(createur)']); ?>
        <?php $prenom2 = $userModel->get_prenom($user['id_workers(ingenieur)']); ?>
        <?php $nom2 = $userModel->get_nom($user['id_workers(ingenieur)']); ?>
            Demandé par :<br>
            <?php echo $prenom[0]['first_name'].' '.$nom[0]['name']; ?><br>
            Réalisé par :<br>
            <?php echo $prenom2[0]['first_name'].' '.$nom2[0]['name']; ?><br>


            
            Nb Pièce: <?php echo $user['nb_piece']; ?><br>
            

        </div>
        <!-- Div pour l'image -->
        <div class="image">
            <img src="data:image/jpeg;base64,<?php echo base64_encode($user['picture']); ?>" alt="Image">
        </div>
    </div>
<?php endforeach; ?>


