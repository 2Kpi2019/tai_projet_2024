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
    function check_login(string $login, string $password) {
        $result = [];
        if (!$this->connected) {
            // Something went wrong during the connection to the database.
            // In this example, we simply do not perform the query...
            // A real website should display a message for users to understand while they cannot log in
            return $result;
        }
        // The request uses the MD5() functions since password should not be stored
        // without any protection in the database (i.e., use MD5() to store and retrieve passwords)
        $request = "SELECT * FROM workers_space WHERE Mail=:login AND password=:password";
        $statement = $this->db->prepare($request);
        $statement->execute([
            "login" => $login,
            "password" => $password
        ]);
        $entries = $statement->fetchAll();
        if (count($entries) == 1) {
            $result["firstname"] = $entries[0]['Name'];
            $result["lastname"] = $entries[0]['First_Name'];
            $result["id"] = $entries[0]['id'];
            $result["job"] = $entries[0]['JOB'];
        }
        return $result;
    }

    function savedata(string $id,string $name, string $surname, string $login, string $password) {
        $request = "UPDATE user SET firstname = :first, lastname = :last, login = :login, password = :pwd WHERE id = :id";
$statement = $this->db->prepare($request);
$statement->execute([
    "id" => $id,
    "first" => $name,
    "last" => $surname,
    "login" => $login,
    "pwd" => $password
]);
    }

    function get_all_user_ids() {
        $result = [];
    
        if (!$this->connected) {
            // Gérer le cas où la connexion à la base de données a échoué
            return $result;
        }
    
        $request = "SELECT * FROM workers_space WHERE JOB = :id";
        $statement = $this->db->prepare($request);
        $statement->execute([
            "id" => "Ingénieur"
        ]);
    
        // FetchAll récupère toutes les lignes du résultat de la requête
        $entries = $statement->fetchAll(PDO::FETCH_ASSOC);
    
        // Retourner les IDs des utilisateurs
        return $entries;
    }
    function get_all_info(string $id) {
        $result = [];
    
        if (!$this->connected) {
            // Gérer le cas où la connexion à la base de données a échoué
            return $result;
        }
    
        $request = "SELECT * FROM workers_space WHERE id=:id";
        $statement = $this->db->prepare($request);
        $statement->execute([
            "id" => $id
        ]);
    
        // FetchAll récupère toutes les lignes du résultat de la requête
        $entries = $statement->fetchAll(PDO::FETCH_ASSOC);
    
        // Retourner les IDs des utilisateurs
        return $entries;
    }
    

    // other useful methods to interact with the database
    // could be to add a new user, to delete a user, to update a user, etc.
    // all these methods will be called by the controller
    // and will be used to display the correct view
    // (e.g., if the user is added, the controller will call the view to display the welcome page)
    // (e.g., if the user is not added, the controller will call the view to display the login form with an error message)
    
}

