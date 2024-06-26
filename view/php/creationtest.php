

<?php
    
    include_once 'includes.php'; // Assurez-vous que include.php est inclus dans chaque fichier PHP
    require_once("../../model/php/SerieModel.php");
    
    $userModel = new UserModel();
   // $userID = $_GET['userID']; 

    // Récupérer les IDs des utilisateurs à partir du modèle
    $entries = $userModel->get_all_user_ids();    
    session_start();     
// Vérifiez si un message d'erreur est présent dans la session
// Afficher les données du formulaire précédemment saisies s'il y en a
if (isset($_SESSION['form_data'])) {
    $form_data = $_SESSION['form_data'];
    // Utilisez $form_data pour remplir les valeurs dans les champs du formulaire
        
}
// N'oubliez pas de supprimer les données du formulaire de la session une fois qu'elles ont été utilisées
unset($_SESSION['form_data']);
unset($_SESSION['form_submitted']);    

// Récupérer les informations de la base de données en fonction de l'ID actuel

// Définir les ID pour les boutons d'augmentation et de diminution
// Assurez-vous que l'ID ne devienne jamais inférieur à 1

    ?>
   

<form id="updateForm" method="post" action="creasave.php" enctype="multipart/form-data">
        <fieldset>
            <legend>Création d'un Nouveau Test</legend>
            <!-- Afficher les informations de l'utilisateur -->
            Nom : <input type="text" placeholder="Nom" name="Nom" value="<?php echo isset($form_data['Nom']) ? $form_data['Nom'] : ''; ?>"><br>
            Référence: <input type="text" placeholder="Référence" name="Reference" value="<?php echo isset($form_data['Reference']) ? $form_data['Reference'] : ''; ?>"><br>
            Matière: <input type="text" placeholder="Matière" name="Matiere" value="<?php echo isset($form_data['Matiere']) ? $form_data['Matiere'] : ''; ?>"><br>
            Résistance (Pa): <input type="text" oninput="this.value = this.value.replace(/[^\d.,]/g, '').replace(',', '.')" placeholder="Résistance" name="Resistance" value="<?php echo isset($form_data['Resistance']) ? $form_data['Resistance'] : ''; ?>"><br>
            Poids (Kg): <input type="text" oninput="this.value = this.value.replace(/[^\d.,]/g, '').replace(',', '.')" placeholder="Poids" name="poids" value="<?php echo isset($form_data['poids']) ? $form_data['poids'] : ''; ?>"><br>
            Attribué à :
            <select name="idinge">
            <option value="">Sélectionnez un Ingénieur</option>
                <?php foreach ($entries as $user): ?>
                <option value="<?php echo $user['id'] ?>" <?php if (isset($form_data['idinge']) && $form_data['idinge'] == $user['id']) echo 'selected'; ?>><?php echo $user['name'].' '.$user['first_name'] ?></option>
                <?php endforeach; ?>            
            </select><br>
            Hauteur (cm): <input type="text" oninput="this.value = this.value.replace(/[^\d.,]/g, '').replace(',', '.')" placeholder="Hauteur" name="hauteur" value="<?php echo isset($form_data['hauteur']) ? $form_data['hauteur'] : ''; ?>"><br>
            Longueur (cm): <input type="text" oninput="this.value = this.value.replace(/[^\d.,]/g, '').replace(',', '.')" placeholder="Longueur" name="longueur" value="<?php echo isset($form_data['longueur']) ? $form_data['longueur'] : ''; ?>"><br>
            Nb de pièce : <input type="text" oninput="this.value = this.value.replace(/[^\d.,]/g, '').replace(/^0+/, '').replace(',', '.')" placeholder="Nombre de pièces" name="nbpiece" value="<?php echo isset($form_data['nbpiece']) ? $form_data['nbpiece'] : ''; ?>"><br>
            Couleur : <input type="text" placeholder="Couleur" name="couleur" value="<?php echo isset($form_data['couleur']) ? $form_data['couleur'] : ''; ?>"><br>
            Description : <input type="text" placeholder="Description" name="description" value="<?php echo isset($form_data['description']) ? $form_data['description'] : ''; ?>"><br>
            Erreur (%): <input type="text" oninput="this.value = this.value.replace(/[^\d.,]/g, '').replace(',', '.')" placeholder="Erreur" name="erreur" value="<?php echo isset($form_data['erreur']) ? $form_data['erreur'] : ''; ?>"><br>
            <label for="date">Sélectionnez une date (Deadline) :</label>
            <input type="date" id="date" name="date" value="<?php echo isset($form_data['date']) ? $form_data['date'] : ''; ?>"><br>
            <!-- Ajoutez d'autres champs ici si nécessaire -->
            <label for="inputFilenouv">Sélectionnez une image :</label>
            <input type="file" id="inputFilenouv" name="inputFile" accept="image/*">
            <div class="image" style="text-align: center;">
        <img id="previewImage" class="limage" src=" " alt=" ">
    </div>
            <button class ="buttoncrea" type="submit">Valider</button>
        </fieldset>
    </form>
    
    
    

