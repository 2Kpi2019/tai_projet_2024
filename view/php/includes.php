<?php
/**
 * Simple PHP script example to showcase hwo HTML content
 * can be re-used across multiple HTML files
 * 
 * @author: w.delamare
 * @date: Dec. 2023
 */

    function include_header() {
        ?>
        
            <h1>KaliTest</h1>
            
        
        <?php
    }
    function telecharger() {
        ?>
        
            <h1>Cliquer sur le Test pour télécharger le CR</h1>
            
        
        <?php
    }
    function clic() {
        ?>
        
            <h1>Cliquer sur le Test renseigner les résultats</h1>
            
        
        <?php
    }
    function donnes() {
        ?>
        
            <h1>Cliquer sur le Test pour voir les données</h1>
            
        
        <?php
    }
    function include_header5() {
        ?>
     
     <h3>Bienvenue <?php echo $_SESSION['firstname'] . " " . $_SESSION['lastname'] . "!!"; ?></h3>
    
        <?php
    }
    function include_header2() {
        ?>
        <style>
        nav {
            margin-left: 10px;
    display: flex; /* Utilisation de Flexbox */
    justify-content: space-between; /* Les éléments seront espacés également */
    align-items: center; /* Aligner les éléments verticalement au centre */
}
            nav ul {
    list-style-type: none;
    padding: 0;
}

nav ul li {
    display: inline-block;
    margin-right: 10px; /* Espacement entre les éléments */
    border: 2px solid black;
    border-radius: 5px;
    margin: 5px 0;
}

nav ul li a {
    display: block;
    padding: 10px;
    text-decoration: none;
}
.deco {
    background-color: transparent; /* Fond transparent */
    border: 2px solid black; /* Bordure similaire aux liens */
    border-radius: 5px; /* Coins arrondis */
    padding: 10px; /* Espacement interne */
    cursor: pointer; /* Curseur */
    color: black; /* Couleur du texte */
    text-decoration: none; /* Pas de soulignement */
    margin-right: 10px;
}
    

        </style>
        <h2><?php echo $_SESSION['firstname']?></h2>
        <h2><?php echo $_SESSION['lastname']?></h2>
        <body>
        <nav>
                <ul>
                    <li><a href="#" type="submit" id="Test" onclick="loadserie(<?php echo $_SESSION['id']; ?>)">Mes Test</a></li>
                    <li><a href="#" id="compte" onclick="afficherCompteRendu2()">Compte Rendu</a></li>
                    <li><a href="#" id="finit" onclick="test(<?php echo $_SESSION['id']; ?>)">Test Réaliser</a></li>
                    
                </ul>
                <form method="post" action="loginController.php">               
                    
                    <button type="submit" class="deco">Déconnexion</button>
                
            </form>
            </nav>
           

    </body>
        <?php
    }

    function vide() {
        
    }

    function headerespo() {
        ?>
        <style>
        nav {
            margin-left: 10px;
    display: flex; /* Utilisation de Flexbox */
    justify-content: space-between; /* Les éléments seront espacés également */
    align-items: center; /* Aligner les éléments verticalement au centre */
}
            nav ul {
    list-style-type: none;
    padding: 0;
}

nav ul li {
    display: inline-block;
    margin-right: 10px; /* Espacement entre les éléments */
    border: 2px solid black;
    border-radius: 5px;
    margin: 5px 0;
}

nav ul li a {
    display: block;
    padding: 10px;
    text-decoration: none;
}
.deco {
    background-color: transparent; /* Fond transparent */
    border: 2px solid black; /* Bordure similaire aux liens */
    border-radius: 5px; /* Coins arrondis */
    padding: 10px; /* Espacement interne */
    cursor: pointer; /* Curseur */
    color: black; /* Couleur du texte */
    text-decoration: none; /* Pas de soulignement */
    margin-right: 10px;
}
    

        </style>
        <h2><?php echo $_SESSION['firstname']?></h2>
        <h2><?php echo $_SESSION['lastname']?></h2>
        <body>
        <nav>
                <ul>
                    <li><a href="#" type="submit" id="Test" onclick="afficherSerie()">Test</a></li>
                    <li><a href="#" id="nouveau" onclick="nouveau()">Nouveau Test</a></li>
                    <li><a href="#" id="compte" onclick="afficherCompteRendu()">Compte Rendu</a></li>
                    <li><a href="#" id="finit" onclick="test2()">Test Réalisé</a></li>
                    
                    
                </ul>
                <form method="post" action="loginController.php">               
                    
                    <button type="submit" class="deco">Déconnexion</button>
                
            </form>
            </nav>
           

    </body>
        <?php
    }


    function include_footer() {
        ?>
        <footer>
            Copyright!©️TAI <a href="mailto:servies-kalitest@gmail.com">Contact</a>
        </footer>
        <?php
    }


    function include_error_message($message) {
        echo "<p class='error_message'>" . $message . "</p>";
    }


?>