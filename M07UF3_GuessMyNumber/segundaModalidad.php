<?php
  require('guessMyNumber.php');

  class GameSegundaModalidad extends GuessMyNumber { 

    function check_secretNumber($dificultad) {
      if ( !isset($_SESSION["secretNumber"]) ) {
        $_SESSION["secretNumber"] = rand(1,$dificultad);
      }  
    }

    function check_fnumber() {
      if (isset($_POST['fnumber'])) {
        $_SESSION['number'] = htmlspecialchars($_POST['fnumber']);
      } else {
        $_SESSION['number'] = null;
      }      
    }

  }

  $_SESSION['posibilidad'] = $_POST['posibilidad'];
  $dificultad = $_SESSION['posibilidad'];
  $segundaModalidad = new GameSegundaModalidad($dificultad);
  $segundaModalidad->check_secretNumber($dificultad);

?>
<!DOCTYPE HTML>
<html>
  <head>
      <meta charset="utf-8">
      <title>Segona modalitat</title>
      <link rel="stylesheet" href="./style.css">
  </head>
  <body>
    <h1 class="tituloModalidad">Segona modalitat: Màquina</h1>
    <div id="formularioSegundaModalidad">
      <h4>Introdueix un número de l'1 al <?= $_SESSION["posibilidad"] ?></h2>
      <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
      <!--Número: <input type="text" name="fnumber">-->
      <input type="number" name="fnumber" min="1" max="<?= $_SESSION["posibilidad"] ?>" required>
      <input type="hidden" name="posibilidad" value="<?= $_POST['posibilidad'] ?>">
      <input type="submit" name="submit" value="Confirmar" class="button" id="botonConfirmar">
      <?php
        $segundaModalidad->check_intentos();
        $segundaModalidad->check_fnumber();
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
          if (empty($_SESSION['number'])) {
            echo "<br> No pots introduir un camp buit";
          } else {
            if ($_SESSION['number'] == $_SESSION['secretNumber']) {
              $segundaModalidad->sumar_intentos();
              echo "<br> Has encertat el número " . $_SESSION['secretNumber'] . "<br>";
              echo "Intents: " . $_SESSION['intentos'] . "<br>";
              //Quan encerta el número posarem a sota la taula estadístiques perquè es 
              //vegi el registre després d'haver encertat
              include_once 'DatabaseOOP.php';
              include_once 'EstadistiquesRow.php';
              $db = null;
              try {
                  echo "<h1>PHP MySQL</h1>";
                  echo "<h2>Inserció</h2>";
                  $db = new DatabaseOOP("localhost:3306", "mireia", "mireia", "m07uf3");
                  $db->connect();
                  echo "<p>Connected successfully</p>";
                  //$last_record = $db->insert(ModalitatEnum::HUMA, 1, 5);
                  //echo "<p>Registre $last_record inserit correctament</p>";
                  echo "<h2>Estadístiques</h2>";
                  echo DatabaseOOP::TABLE_START;
                  $mysqli = $db->selectAll();
                  foreach (new EstadistiquesRow(new RecursiveArrayIterator(mysqli_fetch_all($mysqli))) as $key => $row) {
                      echo $row;
                  }
              } catch (Exception $error) {
                  echo "connection failed: " . $error->getMessage();
              }         
            } elseif ($_SESSION['number'] > $_SESSION['secretNumber']) {
              echo "<br> El número a endevinar es més petit que " . $_SESSION['number'];
              $segundaModalidad->sumar_intentos();
            } elseif ($_SESSION['number'] < $_SESSION['secretNumber']) {
              echo "<br> El número a endevinar es més gran que " . $_SESSION['number'];
              $segundaModalidad->sumar_intentos();
            }
          } 
        }

        if ( isset($_POST['volverIndice']) ) {
          $segundaModalidad->volverIndice();    
        }
      ?>

      </form>
      <form action="" method="POST">
      <button type='submit' name='volverIndice' value='volverIndice' class="button" id="volverAJugar">Tornar a la selecció de modalitat</button>
      <?php
        if ( isset($_POST['volverIndice']) ) {
          $segundaModalidad->volverIndice();
        }      
      ?>
    </form>      
    </div>
  </body>
</html>