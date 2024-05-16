<?php
    // do all necessary includes first
    // __DIR__ allows you to use relative paths explicitly
    // here, the file is in the same folder as the includes.php file (view/)
    include_once __DIR__ . '/includes.php';
?>


<!DOCTYPE html>
<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="view/css/example.css">
        
        <script src="view/java/java.js"></script>
        <title>Welcome</title>
    </head>
    <body>
    
       
    <div class="fondecran" id="fondecran">
            <img src="/figs/C.jpg" alt="Image">
        </div>
        
        <!-- PHP only used to display stuff -->
        <div class="containerr">
    <div class="titre">
        <div>KALITEST</div>
    </div>
    <div class="legars">
        <h2><?php echo $_SESSION['firstname']?></h2>
        <h2><?php echo $_SESSION['lastname']?></h2>
    </div>
</div>
        <nav>
                <ul>
                    <li><a href="#" id="Test" onclick="loadserie(<?php echo $_SESSION['id']; ?>)">Mes Test</a></li>
                    <li><a href="#" id="compte" onclick="afficherCompteRendu2()">Compte Rendu</a></li>
                    <li><a href="#" id="finit" onclick="test(<?php echo $_SESSION['id']; ?>)">Test Réaliser</a></li>
                    
                </ul>
                <form method="post" action="loginController.php">               
                    
                    <button type="submit" class="deco">Déconnexion</button>
                
            </form>
            </nav>
            <?php 
    if (isset($ingeW3c)) { 
        if ($ingeW3c == 1) {
            
        echo '<script>endit2(' . $_POST['idSerie'] . ',' . $_SESSION['npiece'] . ');</script>';
        }
        if ($ingeW3c == 2) {
            echo '<script>afficherMessageBox2("Test Cloturer")</script>';
        }
    }
    
    ?>
        

        <main id="contenu">
        
        <div class="welcome-message">
        <h3 id="monTexte">Bienvenue <?php echo $_SESSION['firstname'] . " " . $_SESSION['lastname'] . " !!"; ?></h3>
        <script>setMulticolorCharacters('monTexte');</script>
        <p>
        Bienvenue sur votre site de gestion de tests. En tant qu'ingénieur, vous aurez accès aux fonctionnalités suivantes :
    </p>
    <ul>
        <li>Consulter les tests à effectur dans la rubrique "Tests".</li>
        <li>Télécharger les comptes rendus des tests terminés dans la rubrique "Comptes Rendus".</li>
        <li>Consulter les tests terminés dans la rubrique "Tests Clôturés".</li>
    </ul>
</div>
           
            
            <!-- A form to logout -->
            <!-- It redirects to the form controller -->
            <!-- Note that this could have been done with a simple link and a $_GET parameter -->
            
        </main>
        


        <?php include_footer(); ?>
    </body>
    
</html>