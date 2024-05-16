<?php
/**
 * Simple PHP script example to showcase hwo HTML content
 * can be re-used across multiple HTML files
 * 
 * @author: w.delamare
 * @date: Dec. 2023
 */

    
    function telecharger() {
        ?>
        
            <h1>Cliquer sur le Test pour télécharger le CR</h1>
            
        
        <?php
    }
    function clic() {
        ?>
        
            <h1>Cliquer sur le Test pour renseigner les résultats</h1>
            
        
        <?php
    }
    function donnes() {
        ?>
        
            <h1>Cliquer sur le Test pour voir les données</h1>
            
        
        <?php
    }
    
    function include_footer() {
        ?>
    <footer>
            Copyright!©️KALITEST <a href="mailto:servies-kalitest@gmail.com">Contact</a>
        </footer>
        <?php
    }


    function include_error_message($message) {
        echo "<p class='error_message'>" . $message . "</p>";
    }


?>