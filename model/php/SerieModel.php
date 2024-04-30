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

require_once("DBModel.php");

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
    
        $request = "SELECT id, Name, reference, matter, weight, height, length, resistance, color, description, Nb_piece, creation_date, deadline, 'id_workers(createur)', 'id_workers(ingenieur)', states, percentage_of_error, Closing_Date, PDF_cr FROM serie WHERE id = :id";

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
    
        $request = "SELECT * FROM test WHERE Id_Serie= :id AND N_Piece= :idpie ";
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
            $request = "SELECT * FROM test WHERE Id_Serie= :id AND N_Piece= :idpie ";
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
        $request = "INSERT INTO test (Id_Serie,N_Piece) VALUES (:id, :piece)";
        $statement = $this->db->prepare($request);
        $statement->execute([
            "id" => $id,            
            "piece" => $idpiece
        ]);
    }
    function savedata(?string $id,?string $name,?string $surname,?string $login,?string $password,?string $idSerie) {
        
        $request = "UPDATE test SET compliance = :first, Resistance = :last, info = :login, weight = :pwd WHERE N_Piece = :id AND Id_Serie = :idS";
$statement = $this->db->prepare($request);
$statement->execute([
    "id" => $id,
    "first" => $name,
    "last" => $surname,
    "login" => $login,
    "pwd" => $password,
    "idS" => $idSerie
]);
    }

    function savecreat($Nom, $Reference, $Matiere, $Resistance, $poids, $idinge, $hauteur, $longueur, $nbpiece, $couleur, $description, $date ,$idcrea,$erreur,$donnees) {

        $request = "INSERT INTO serie (Name, reference, matter, resistance, weight, `id_workers(ingenieur)`, height, length, Nb_piece, color, description, deadline, `id_workers(createur)`,percentage_of_error,picture,creation_date) VALUES (:Nom, :Reference, :Matiere, :Resistance, :poids, :idinge, :hauteur, :longueur, :nbpiece, :couleur, :description, :date, :idcrea, :erreur, :donne, :dateactu)";
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
        $request = "UPDATE serie SET states = :states, Closing_Date = :hclo, PDF_cr = :pdf WHERE id = :id";
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
    
        $request = "SELECT First_Name FROM workers_space WHERE id= :id";
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
    
        $request = "SELECT Name FROM workers_space WHERE id= :id";
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
    
        $request = "SELECT * FROM test WHERE Id_Serie= :id";
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
    
        $request = "SELECT * FROM test WHERE Id_Serie= :id";
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