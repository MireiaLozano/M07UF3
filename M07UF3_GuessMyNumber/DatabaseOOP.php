<?php

include_once 'DatabaseConnection.php';

/**
 * Implementació de la clase DatabaseConnection segons el model OOP,
 * Object Oriented Programming.
 *
 * @author Pep
 */
class DatabaseOOP extends DatabaseConnection {
    const TABLE_START = "<table align='center'; style='border: solid 1px black;'><tr style='background: grey;'><th>Id</th><th>Modalitat</th><th>Nivell</th><th>Data</th><th>Intents</th></tr>";
    const TABLE_END = "</table>";

    private $database;

     function __construct($servername, $username, $password, $database) {
        parent::__construct($servername, $username, $password);
        $this->database = $database;
    }

    //put your code here
     function connect(): void {
        $this->connection = new mysqli($this->servername, $this->username, $this->password, $this->database);
        // Check connection
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
            $this->connection = null;
        }
    }

     function insert($modalitat, $nivell, $intents): int {
        try {
            $mysqli = "INSERT INTO `estadistiques` (modalitat, nivell, intents) VALUES ('$modalitat' ,'$nivell', '$intents')";
            if ($this->connection != null) {
                     if ($this->connection->query($mysqli) === TRUE) {
                        return $this->connection->insert_id;
                 } else {
                     return -1;
              }
            }
                 } catch (Exception $error) {
                 throw new Exception($error->getMessage());
        }
    }
    /*
       
    }
    */


     function selectAll() {
        $mysqli = "SELECT id, modalitat, nivell, data_partida, intents FROM estadistiques";
        $result = null;
        if ($this->connection != null) {
            $result = $this->connection->query($mysqli, MYSQLI_USE_RESULT);
        }
        return $result;
    }

     function selectByModalitat($modalitat) {
        $mysqli = "SELECT id, modalitat, nivell, data_partida, intents FROM estadistiques WHERE modalitat = '$modalitat'";
        $result = null;
        if ($this->connection != null) {
            $result = $this->connection->query($mysqli, MYSQLI_USE_RESULT);
        }
        return $result;
    }

    function delete($id): void{
        $mysqli = "DELETE FROM estadistiques WHERE id=3";

            if ($this->connection->query($mysqli) === TRUE) {
                    echo "Record deleted successfully";
            } else {
                    echo "Error deleting record: " . $this->connection->connect_error;
            }
    }

    function update($estadistiques): void{
        $mysqli = "UPDATE estadistiques SET modalitat='segona' WHERE id=3";

            if ($this->connection->query($mysqli) === TRUE) {
                echo "Record updated successfully";
            } else {
                echo "Error updating record: " . $this->connection->error;
            }
    }
}


