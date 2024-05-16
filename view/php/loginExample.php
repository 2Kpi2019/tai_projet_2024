<!-- 
    Example HTML file to showcase a simple login form which uses
        - a php controller script (logic-related aspects) that calls a php model script (data-related aspects)
        - a php view script (UI-related aspects)

* @author: w.delamare
* @date: Dec. 2023
 -->

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
    <title>Connexion</title>
    <link rel="stylesheet" href="view/css/connexcion.css">
</head>
<body>

<div class="image-container">
    <img src="figs/roue3.png" alt="Background Image">
</div>
    <section>
<?php 
            // pour afficher si il manque un mdp ou un email...
            if (isset($something_to_say)) {
                include_error_message($something_to_say);
            }
        ?>
        <h1><span>KALITEST</span></h1>
        <form method="post" action="index.php">
        
            
            
            <input type="text" placeholder="E-mail" id="login" name="login">
            
            <input type="password" placeholder="Mot de Passe" id="pwd" name="pwd">
            <span class="submit-button"><input type="submit" value="Se connecter"></span>
        </form>
    </section>
   
   
   
    <div class="image">
            <img src="figs/C.jpg" alt="Image" >
            
        </div>
        
<?php include_footer(); ?>
</body>
</html>