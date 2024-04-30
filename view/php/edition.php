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
    $PieceMax = $entries[0]['Nb_piece'];
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
<div class="flex-container">
    <div class="">
<ul>
<?php foreach ($entries as $user): ?>
         
        
        <fieldset>
        <legend>Information</legend>
            <!-- Afficher les informations de l'utilisateur -->
            
            Nom : <?php echo $user['Name']; ?><br>
            Référence : <?php echo $user['reference']; ?><br>
            Matière : <?php echo $user['matter']; ?><br>
            Poids : <?php echo $user['weight']; ?><br>
            Hauteur : <?php echo $user['height']; ?><br>
            Longueur : <?php echo $user['length']; ?><br>
            Résistance : <?php echo $user['resistance']; ?><br>
            Couleur : <?php echo $user['color']; ?><br>
            Nombre de Pièce : <?php echo $user['Nb_piece']; ?><br>
            Deadline : <?php echo $user['deadline']; ?><br>
            Erreur : <?php echo $user['percentage_of_error']; ?><br>
            Description : <?php echo $user['description']; ?><br>
            <!-- Ajoutez d'autres champs ici si nécessaire -->
            <?php $lastUserPicture = $user['picture']; ?>
            
            </fieldset>
            
            
    <?php endforeach; ?>
    
</ul>
</div>
<img src="data:image/jpeg;base64,<?php echo base64_encode($lastUserPicture); ?>" alt="Image">
    <div>

<!-- Affichage des informations de la série -->

<ul>
<?php foreach ($piece as $user): ?>
        
        <form id ="updateForm" method="post" action="../../save.php">
        <input type="hidden" name="idSerie" value="<?php echo $userID; ?>">
        <fieldset>
        <legend>Résultats</legend>
            <!-- Afficher les informations de l'utilisateur -->
            Nb Pièce: <input type="text" name="N_Piece" value="<?php echo $user['N_Piece']; ?>" readonly><br>

            Compliance: <?php echo '<input type="text" placeholder="login" name="compliance" value="' .$user['compliance'] .'">'; ?><br>
            Résistance: <?php echo '<input type="text" placeholder="login" name="Resistance" value="' .$user['Resistance'] .'">'; ?><br>
            Info: <?php echo '<input type="text" placeholder="login" name="info" value="' .$user['info'] .'">'; ?><br>
            Poids : <?php echo '<input type="text" placeholder="weight" name="date" value="' .$user['weight'] .'">'; ?><br>
            
            <!-- Ajoutez d'autres champs ici si nécessaire -->
            
        <input type="hidden" name="userID" value="<?php echo $userID; ?>">
            <div class="button-container">
            <a href="#" id="fle" onclick="piecemoins(<?php echo $userID; ?>, <?php echo $variable; ?>)">◄</a>
            <button type="submit" id="val">Valider</button>
            <a href="#" id="fle" onclick="pieceplus(<?php echo $userID; ?>, <?php echo $variable; ?>,<?php echo $PieceMax; ?>)">►</a>
            </div>
            </fieldset>
            </form>
        
    <?php endforeach; ?><br>
    
</ul>
</div>
</div>

<form id ="update" method="post" action="../../cloture.php">

        <input type="hidden" name="idSerie" value="<?php echo $userID; ?>">
        
        <button type="button" id="clot" onClick="generatePDF()">Cloturer le Test</button>
            

            
            </form>
            <script>
                messagebox2("")
    // Définir des variables JavaScript avec les données JSON encodées
    var entries = <?php echo $entriesJSON; ?>;
    var allpiece = <?php echo $allpieceJSON; ?>;

    // Appeler la fonction generatePDF() avec les données JSON
    
</script>
<style>
.flex-container {
    display: flex;
    justify-content: center; /* Espacement égal entre les éléments */
    align-items: center; /* Centrer verticalement */
    width: 100%; 
    gap: 100px; 
}

.list-container {
   
}
button#clot {
    display: block;
    margin: 0 auto; /* Centre horizontalement */
    padding: 15px 30px; /* Ajoutez du rembourrage pour rendre le bouton plus grand */
    font-size: 1.2em; /* Taille de police */
    background-color: #007bff; /* Couleur de fond */
    color: #ffffff; /* Couleur du texte */
    border: none; /* Supprime la bordure */
    border-radius: 10px; /* Coins arrondis */
    cursor: pointer; /* Curseur au survol */
}

button#clot:hover {
    background-color: #0056b3; /* Couleur de fond au survol */
}
#updateForm {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
}

#updateForm fieldset {
    margin: 0 auto; /* Centrer le fieldset à l'intérieur du formulaire */
    width: 50%; /* Largeur du fieldset */
}

#updateForm input[type="text"] {
    
    width: calc(100% - 20px); /* Largeur du champ de saisie, moins les marges */
    margin: 5px 0; /* Espacement entre les champs de saisie */
}
#updateForm button,
#updateForm a {
    display: inline-block; /* Rend les éléments en ligne */
    margin-top: 15px;
    margin: 0 10px; /* Ajoute un peu d'espace entre les éléments */
    padding: 15px 30px; /* Ajoutez du rembourrage pour rendre le bouton plus grand */
    font-size: 1.2em; /* Taille de police */
    background-color: #007bff; /* Couleur de fond */
    color: #ffffff; /* Couleur du texte */
    border: none; /* Supprime la bordure */
    border-radius: 10px; /* Coins arrondis */
    cursor: pointer; /* Curseur au survol */
    text-decoration: none; /* Supprime le soulignement des liens */
}
.button-container {
    display: flex;
    justify-content: center;
    align-items: center;
}



</style>




<!-- Boutons avec des flèches pour augmenter et diminuer l'ID -->




                
        