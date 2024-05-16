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
<ul>
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
    
</ul>
</div>
<img class="photo"src="data:image/jpeg;base64,<?php echo base64_encode($lastUserPicture); ?>" alt="Image">
    <div>

<!-- Affichage des informations de la série -->

<ul>
<?php foreach ($piece as $test): ?>
        
        <form id ="formsave" method="post" action="../../save.php">
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
    
</ul>
</div>
</div>

<form id ="update" method="post" action="../../cloture.php">

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
<!-- <style>
.flexattitude {
    display: flex;
    justify-content: center; /* Espacement égal entre les éléments */
    align-items: center; /* Centrer verticalement */
    width: 100%; 
    gap: 100px; 
    font-size: 18px; 
}
.photo {
    max-width: 300px;
            height: auto;
            border-radius: 8px;
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
button#val:hover {
    background-color: #0056b3; /* Couleur de fond au survol */
}
#formsave {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    flex-wrap: wrap;
    justify-content: space-between;
    border: 2px solid black;
    border-radius: 10px;
    padding: 20px;
    max-width: 600px; /* Largeur maximale du formulaire */
    margin: auto;
}

#formsave fieldset {
    margin: 0 auto; /* Centrer le fieldset à l'intérieur du formulaire */
    width: 50%; /* Largeur du fieldset */
}

#formsave input[type="text"] {
    
    width: calc(100% - 20px); /* Largeur du champ de saisie, moins les marges */
    margin: 5px 0; /* Espacement entre les champs de saisie */
}
#formsave button,
#formsave a {
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
#formsave a:hover {
    background-color: #0056b3;
}
#formsave .button-container9 {
    position: absolute; /* Position absolue par rapport au formulaire */
    bottom: 0; /* Placer les boutons en bas */
    margin-bottom: 100px;
    left: 78%; /* Centrer horizontalement */
    transform: translateX(-50%); /* Centrer horizontalement */
}
.button-container9 {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 10px;
}
#formsave .form-group {
            width: 48%; /* Deux colonnes */
            margin-bottom: 10px;
        }
        #formsave .form-group.full-width {
            width: 100%; /* Pour le champ N° Pièce */
            text-align: center;
        }
.form-gauche {
    width: 48%;
    float: left;
    margin-bottom: 10px;
}

.form-droite {
    width: 48%;
    float: right;
    margin-bottom: 10px;
}




</style> -->




<!-- Boutons avec des flèches pour augmenter et diminuer l'ID -->




                
        