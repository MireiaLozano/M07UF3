<?php

include_once 'DatabaseConnection.php';

/*
 * Implementació de la clase DatabaseConnection segons el model PDO, 
 * PHP Data Object.
 * @author Pep
 */

class DatabasePDO extends DatabaseConnection {

    const TABLE_START = "<table align='center'; style='border: solid 1px black;'><tr style='background: grey;'><th>Id</th><th>Modalitat</th><th>Nivell</th><th>Data</th><th>Intents</th></tr>";
    const TABLE_END = "</table>";

    private $database;

    public function __construct($servername, $username, $password, $database) {
        parent::__construct($servername, $username, $password);
        $this->database = $database;
    }

    function connect(): void {
        try {
            $this->connection = new PDO("mysql:host=$this->servername;dbname=$this->database", $this->username, $this->password);
            // set the PDO error mode to exception
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }

    function insert($modalitat, $nivell, $intents): int {
        try {
            // prepare sql and bind parameters
            $stmt = $this->connection->prepare("INSERT INTO estadistiques (modalitat, nivell, intents) VALUES (:modalitat, :nivell, :intents)");
            $stmt->bindParam(':modalitat', $modalitat);
            $stmt->bindParam(':nivell', $nivell);
            $stmt->bindParam(':intents', $intents);
            $stmt->execute();
            return $this->connection->lastInsertId();
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }

    function selectAll() {
        $stmt = $this->connection->prepare("SELECT id, modalitat, nivell, data_partida, intents FROM estadistiques");
        $stmt->execute();
        // set the resulting array to associative
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        return $stmt;
    }

    function selectByModalitat($modalitat) {
        $stmt = $this->connection->prepare("SELECT id, modalitat, nivell, data_partida, intents FROM estadistiques WHERE modalitat = :modalitat");
        $stmt->bindParam(':modalitat', $modalitat);
        $stmt->execute();
        // set the resulting array to associative
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        return $stmt;
    }

function delete($id): void{
    try{
    $sql = "DELETE FROM estadistiques WHERE id=3";

    // use exec() because no results are returned
    $this->connection->exec($sql);
    echo "Record deleted successfully";
    } catch (Exception $error) {
    echo $sql . "<br>" . $error->getMessage();
    }
 }

function update($estadistiques): void{
    try{
        $sql = "UPDATE estadistiques SET modalitat='segona' WHERE id=2";

            // Prepare statement
                 $stmt = $this->connection->prepare($sql);
  
            // execute the query
        $stmt->execute();
  
            // echo a message to say the UPDATE succeeded
            echo $stmt->rowCount() . " records UPDATED successfully";
              } catch(PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
             }
    }
}

/*
    function createTable($table_sql) {
        try {
            $this->connection->exec($table_sql);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
     */

    /*
    function insert($modalitat, $nivell, $intents) {
        $sql = "INSERT INTO estadistiques (modalitat, nivell, intents) VALUES ('$modalitat', $nivell, $intents)";
        try {
            $this->connection->exec($sql);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
*/