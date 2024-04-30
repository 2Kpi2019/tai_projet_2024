<?php
    // do all necessary includes first
    // __DIR__ allows you to use relative paths explicitly
    // here, the file is in the same folder as the includes.php file (view/)
    include_once __DIR__ . '/includes.php';
?>


<!DOCTYPE html>
<html lang="en">
<div class="fondecran" id="fondecran">
            <img src="/figs/B.jpg" alt="Image">
        </div>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="view/css/example.css">
        
        <script src="view/java/java.js"></script>
        <title>Welcome</title>
    </head>
    <body>
        
        <!-- PHP only used to display stuff -->
        <?php include_header(); ?>
        <?php include_header2(); ?>
        

        <main id="contenu">
        
        <div class="welcome-message">
        <?php include_header5(); ?>
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
        


    
    </body>
    <?php include_footer(); ?>
</html>