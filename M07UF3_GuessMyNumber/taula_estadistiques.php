<form id="formularioIndex" action="index.php" method="POST">

    <button type="submit" id="inici" name="inici" value="Tornar">Tornar a inici</button>
 </form>
      
      <?php
        include_once 'DatabaseOOP.php';
        include_once 'DatabasePDO.php';
        include_once 'EstadistiquesRow.php';
        $db = null;
        try {
            echo "<h1>PHP MySQL</h1>";
            echo "<h2>Inserció</h2>";
            $db = new DatabaseOOP("localhost:3306", "mireia", "mireia", "m07uf3");
            $db->connect();
            //echo "<p>Connected successfully</p>";
            //$last_record = $db->insert(ModalitatEnum::MAQUINA, 2, 5);
            //echo "<p>Registre $last_record inserit correctament</p>";
            echo "<h2>Taula d'estadístiques</h2>";
            echo DatabaseOOP::TABLE_START;
            $mysqli = $db->selectAll();
            foreach (new EstadistiquesRow(new RecursiveArrayIterator(mysqli_fetch_all($mysqli))) as $key => $row) {
                echo $row;
            }
        } catch (Exception $error) {
            echo "connection failed: " . $error->getMessage();
        }
     DatabaseOOP::TABLE_END;
?>
