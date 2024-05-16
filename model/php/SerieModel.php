<?php

/**
 * Our model classes (UserModel in this example) extends the base class DBModel
 * so that we can factorize every common methods into the super class
 * 
 * Every other model classes (to deal with other data and tables) will follow the same principle
 * 
 * @author: w.delamare
 * @date: Dec. 2023
 */

 //pour gérer suivant de la ou on appelle la page filezila nul nul nul
 try {
    if (!@include_once('DBModel.php')) {
        throw new Exception('Le fichier DBModel.php n\'existe pas.');
    } else {
        require_once('DBModel.php');
    }
} catch (Exception $e) {
    // Si le fichier principal n'est pas trouvé, inclure le fichier de secours
    if (!@include_once('model/php/DBModel.php')) {
        // Gérer l'erreur si le fichier de secours n'existe pas non plus
        echo 'Aucun des fichiers DBModel.php n\'existe.';
        // Vous pouvez également arrêter l'exécution du script ou gérer l'erreur autrement
        // die('Aucun des fichiers DBModel.php n\'existe.');
    } else {
        require_once('model/php/DBModel.php');
    }
}
class UserModel extends DBModel {


    /**
     * @return 
     * an associative array of all employees with first_name, last_name, id, creation_date (not formatted)
     */
    function get_all_serie(string $id) {
        $result = [];
    
        if (!$this->connected) {
            // Gérer le cas où la connexion à la base de données a échoué
            return $result;
        }
    
        $request = "SELECT * FROM serie WHERE `id_workers(ingenieur)` = :id AND states IS NULL";
        $statement = $this->db->prepare($request);
        $statement->execute([
            "id" => $id
        ]);
    
        // FetchAll récupère toutes les lignes du résultat de la requête
        $entries = $statement->fetchAll(PDO::FETCH_ASSOC);
        //print_r($entries); 
    
        // Retourner les IDs des utilisateurs
        return $entries;
    }
    function get_all_user_ids() {
        $result = [];
    
        if (!$this->connected) {
            // Gérer le cas où la connexion à la base de données a échoué
            return $result;
        }
    
        $request = "SELECT * FROM workers_space WHERE job = :id";
        $statement = $this->db->prepare($request);
        $statement->execute([
            "id" => "Ingénieur"
        ]);
    
        // FetchAll récupère toutes les lignes du résultat de la requête
        $entries = $statement->fetchAll(PDO::FETCH_ASSOC);
    
        // Retourner les IDs des utilisateurs
        return $entries;
    }

    function get_serie(string $id) {
        $result = [];
    
        if (!$this->connected) {
            // Gérer le cas où la connexion à la base de données a échoué
            return $result;
        }
    
        $request = "SELECT * FROM serie WHERE id= :id";
        $statement = $this->db->prepare($request);
        $statement->execute([
            "id" => $id
        ]);
    
        // FetchAll récupère toutes les lignes du résultat de la requête
        $entries = $statement->fetchAll(PDO::FETCH_ASSOC);
        //print_r($entries); 
    
        // Retourner les IDs des utilisateurs
        return $entries;
    }
    function get_serie_ssph(string $id) {
        $result = [];
    
        if (!$this->connected) {
            // Gérer le cas où la connexion à la base de données a échoué
            return $result;
        }
    
        $request = "SELECT id, Name, reference, matter, weight, height, length, resistance, color, description, nb_piece, creation_date, deadline, 'id_workers(createur)', 'id_workers(ingenieur)', states, percentage_of_error, closing_date, pdf_cr FROM serie WHERE id = :id";

        $statement = $this->db->prepare($request);
        $statement->execute([
            "id" => $id
        ]);
    
        // FetchAll récupère toutes les lignes du résultat de la requête
        $entries = $statement->fetchAll(PDO::FETCH_ASSOC);
        //print_r($entries); 
    
        // Retourner les IDs des utilisateurs
        return $entries;
    }

    function get_serie_by_id(string $id, string $idpiece) {
        $result = [];
    
        if (!$this->connected) {
            // Gérer le cas où la connexion à la base de données a échoué
            return $result;
        }
    
        $request = "SELECT * FROM test WHERE id_serie= :id AND n_piece= :idpie ";
        $statement = $this->db->prepare($request);
        $statement->execute([
            "id" => $id,
            "idpie" => $idpiece
        ]);
    
        // FetchAll récupère toutes les lignes du résultat de la requête
        $entries = $statement->fetchAll(PDO::FETCH_ASSOC);
        //print_r($entries); 
        if (empty($entries)) {
            $this->createEmptyEntry($id, $idpiece);
            $request = "SELECT * FROM test WHERE id_serie= :id AND n_piece= :idpie ";
        $statement = $this->db->prepare($request);
        $statement->execute([
            "id" => $id,
            "idpie" => $idpiece
        ]);
            $entries = $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        
    
        // Retourner les IDs des utilisateurs
        return $entries;
    }
    private function createEmptyEntry($id, $idpiece) {
        $request = "INSERT INTO test (id_serie,n_piece) VALUES (:id, :piece)";
        $statement = $this->db->prepare($request);
        $statement->execute([
            "id" => $id,            
            "piece" => $idpiece
        ]);
    }
    function savedata(?string $id,?string $name,?string $surname,?string $login,?string $password,?string $idSerie,?string $haut,?string $long) {
        
        $request = "UPDATE test SET compliance = :first, resistance = :last, info = :login, weight = :pwd, length = :lon, height = :haut WHERE n_piece = :id AND id_serie = :idS";
$statement = $this->db->prepare($request);
$statement->execute([
    "id" => $id,
    "first" => $name,
    "last" => $surname,
    "login" => $login,
    "pwd" => $password,
    "idS" => $idSerie,
    "lon" => $long,
    "haut" => $haut
]);
    }

    function savecreat($Nom, $Reference, $Matiere, $Resistance, $poids, $idinge, $hauteur, $longueur, $nbpiece, $couleur, $description, $date ,$idcrea,$erreur,$donnees) {

        $request = "INSERT INTO serie (name, reference, matter, resistance, weight, `id_workers(ingenieur)`, height, length, nb_piece, color, description, deadline, `id_workers(createur)`,percentage_of_error,picture,creation_date) VALUES (:Nom, :Reference, :Matiere, :Resistance, :poids, :idinge, :hauteur, :longueur, :nbpiece, :couleur, :description, :date, :idcrea, :erreur, :donne, :dateactu)";
        $statement = $this->db->prepare($request);
        $statement->execute([
            "Nom" => $Nom,
            "Reference" => $Reference,
            "Matiere" => $Matiere,
            "Resistance" => $Resistance,
            "poids" => $poids,
            "idinge" => $idinge,
            "hauteur" => $hauteur,
            "longueur" => $longueur,
            "nbpiece" => $nbpiece,
            "couleur" => $couleur,
            "description" => $description,
            "date" => $date,
            "idcrea" => $idcrea,
            "erreur" => $erreur,
            "donne" => $donnees,
            "dateactu" => date("Y-m-d")
        ]);
    }

    function get_les_serie() {
        $result = [];
    
        if (!$this->connected) {
            // Gérer le cas où la connexion à la base de données a échoué
            return $result;
        }
    
        $request = "SELECT * FROM serie WHERE states IS NULL";
        $statement = $this->db->prepare($request);
        $statement->execute([
    
        ]);
    
        // FetchAll récupère toutes les lignes du résultat de la requête
        $entries = $statement->fetchAll(PDO::FETCH_ASSOC);
    
        // Retourner les IDs des utilisateurs
        return $entries;
    }

    function cloturetest($id,$pdf) {
        $request = "UPDATE serie SET states = :states, closing_date = :hclo, pdf_cr = :pdf WHERE id = :id";
        $statement = $this->db->prepare($request);
        $statement->execute([
            "states" => "2",
            "hclo" => date("Y-m-d"),
            "id" => $id,
            "pdf" => $pdf
            
        ]);


    }

    function get_finish($id) {
        $result = [];
    
        if (!$this->connected) {
            // Gérer le cas où la connexion à la base de données a échoué
            return $result;
        }
    
        $request = "SELECT * FROM serie WHERE states = :id AND `id_workers(ingenieur)` = :idus";
        $statement = $this->db->prepare($request);
        $statement->execute([
            "id" => "2",
            "idus" => $id
        ]);
    
        // FetchAll récupère toutes les lignes du résultat de la requête
        $entries = $statement->fetchAll(PDO::FETCH_ASSOC);
    
        // Retourner les IDs des utilisateurs
        return $entries;
    }

    function get_finish2() {
        $result = [];
    
        if (!$this->connected) {
            // Gérer le cas où la connexion à la base de données a échoué
            return $result;
        }
    
        $request = "SELECT * FROM serie WHERE states = :id ";
        $statement = $this->db->prepare($request);
        $statement->execute([
            "id" => "2"
        ]);
    
        // FetchAll récupère toutes les lignes du résultat de la requête
        $entries = $statement->fetchAll(PDO::FETCH_ASSOC);
    
        // Retourner les IDs des utilisateurs
        return $entries;
    }

    function get_prenom($id) {
        $result = [];
    
        if (!$this->connected) {
            // Gérer le cas où la connexion à la base de données a échoué
            return $result;
        }
    
        $request = "SELECT first_name FROM workers_space WHERE id= :id";
        $statement = $this->db->prepare($request);
        $statement->execute([
            "id" => $id
        ]);
    
        // FetchAll récupère toutes les lignes du résultat de la requête
        $entries = $statement->fetchAll(PDO::FETCH_ASSOC);
        //print_r($entries); 
    
        // Retourner les IDs des utilisateurs
        return $entries;
    }

    function get_nom($id) {
        $result = [];
    
        if (!$this->connected) {
            // Gérer le cas où la connexion à la base de données a échoué
            return $result;
        }
    
        $request = "SELECT name FROM workers_space WHERE id= :id";
        $statement = $this->db->prepare($request);
        $statement->execute([
            "id" => $id
        ]);
    
        // FetchAll récupère toutes les lignes du résultat de la requête
        $entries = $statement->fetchAll(PDO::FETCH_ASSOC);
        //print_r($entries); 
    
        // Retourner les IDs des utilisateurs
        return $entries;
    }
    function get_states($id) {
        $result = [];
    
        if (!$this->connected) {
            // Gérer le cas où la connexion à la base de données a échoué
            return $result;
        }
    
        $request = "SELECT * FROM test WHERE id_serie= :id";
        $statement = $this->db->prepare($request);
        $statement->execute([
            "id" => $id
        ]);
        
        
        // FetchAll récupère toutes les lignes du résultat de la requête
        $entries = $statement->fetchAll(PDO::FETCH_ASSOC);
        //print_r($entries); 
        if (count($entries) > 0 ) {
            return "En cours";
        } else {
            return "Non Démarré";            
        }
    
        // Retourner les IDs des utilisateurs
        //return $entries;
    }
    function get_all_piece(string $id) {
        $result = [];
    
        if (!$this->connected) {
            // Gérer le cas où la connexion à la base de données a échoué
            return $result;
        }
    
        $request = "SELECT * FROM test WHERE id_serie= :id";
        $statement = $this->db->prepare($request);
        $statement->execute([
            "id" => $id
        ]);
    
        // FetchAll récupère toutes les lignes du résultat de la requête
        $entries = $statement->fetchAll(PDO::FETCH_ASSOC);
        //print_r($entries); 
    
        // Retourner les IDs des utilisateurs
        return $entries;
    }


}