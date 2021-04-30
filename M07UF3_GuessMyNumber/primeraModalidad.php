<?php
    require('guessMyNumber.php');
    class GamePrimeraModalidad extends GuessMyNumber {

      function numeroMasPequeño() {
        $_SESSION['rangoMedio'] = ceil((min(1,$_SESSION['rangoMedio']) + max(1,$_SESSION['rangoMedio']))/2);
      }

      function numeroMasGrande() {
        $_SESSION['rangoMedio'] = ceil(((min(1,$_SESSION['rangoMedio']) + max(1,$_SESSION['rangoMedio']))/2) + $_SESSION['rangoMedio']);
      }

      function check_rangoMedio() {
        if ( !isset($_SESSION["rangoMedio"]) ) {
          $_SESSION["rangoMedio"] = floor((min(1,$_SESSION['posibilidad']) + max(1,$_SESSION['posibilidad']))/2);
        }  
      }

    }

    $_SESSION['posibilidad'] = $_POST['posibilidad'];
    $dificultad = $_SESSION['posibilidad'];
    $primeraModalidad = new GamePrimeraModalidad($dificultad);
    $primeraModalidad->check_rangoMedio();
    
?>
<!DOCTYPE HTML>  
<html>
    <head>
        <meta charset="utf-8">
        <title>Primera modalitat</title>
        <link rel="stylesheet" href="./style.css">
    </head>
    <body>
      <h1 class="tituloModalidad">Primera modalitat: Huma</h1>
      <div id="formularioPrimeraModalidadRespuesta">
      <h2 class="titulos">Utilitza els botons de forma adecuada</h2>
      <h2 class="titulos">Procura pulsar el botó de confirmació després de seleccionar una resposta</h2>    
      <form id="primeraModalidad" action="primeraModalidad.php" method="POST">
          <input type="hidden" id="posibilidad" name="posibilidad" value="<?= $_SESSION['posibilidad'] ?>">
          <div>
            <h2 id="elNumeroEs">¿El número és més gran que <?= $_SESSION['rangoMedio'] ?>?</h2>
            <button type="submit" id="buttonConfirm" class="button">Confirmar selecció</button>
          </div>
          <button type="submit" id="numeroIgual" name="numeroIgual" class="button">El número és correcte</button>
          <button type="submit" id="numeroMasPequeño" name="numeroMasPequeño" class="button">Més petit</button>
          <button type="submit" id="numeroMasGrande" name="numeroMasGrande" class="button">Més gran</button>

          <?php
            $primeraModalidad->check_intentos();
            if ( isset($_POST['numeroIgual'])) {
              $primeraModalidad->sumar_intentos();
              echo "<br> Has acertado el número, enhorabuena. <br>";
              echo "Intentos: " . $_SESSION['intentos'] . "<br>";
              //Quan encerta el número posarem a sota la taula estadístiques perquè es 
              //vegi el registre després d'haver encertat
                    include_once 'DatabaseOOP.php';
                    include_once 'EstadistiquesRow.php';
                    $db = null;
                    try {
                        //echo "<h1>PHP MySQL</h1>";
                        //echo "<h2>Inserció</h2>";
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
            } 
            elseif ( isset($_POST['numeroMasGrande']) ) {
              $primeraModalidad->sumar_intentos();
              $primeraModalidad->numeroMasGrande();
              echo "<br> Has seleccionado más grande, pulsa el botón confirmar";
            } elseif ( isset($_POST['numeroMasPequeño']) ) {
              $primeraModalidad->sumar_intentos();
              $primeraModalidad->numeroMasPequeño();
              echo "<br> Has seleccionado más pequeño, pulsa el botón confirmar";
            } elseif ( $_SESSION['rangoMedio'] > $_SESSION['posibilidad']) {
              $_SESSION['rangoMedio'] = $_SESSION['posibilidad'];
            } elseif ( $_SESSION['rangoMedio'] <= 0) {
              $_SESSION['rangoMedio'] = 1;
            }
          ?>
      </form>
      <form action="" method="POST">
        <button type='submit' name='volverIndice' value='volverIndice' class="button" id="volverInicio">Tornar a la selecció de modalitat</button>
        <?php
          if ( isset($_POST['volverIndice']) ) {
            $primeraModalidad->volverIndice();    
          }     
        ?>
      </form>
      </div>   
    </body>
</html>

