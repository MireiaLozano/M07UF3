<?php
    session_start();
?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
         <title>Guess My Number</title>
        <link rel="stylesheet" href="./style.css">
        <script type="text/javascript">
          window.onload= function popUp() {
             window.open("credits.txt", target="_blank",'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=1,width=300,height=200,left = 390,top = 50');
        }
    </script>
    </head>
    <body>
         <?php
         /*
        
        include_once '../PhpProject1/DatabaseOOP.php';
        include_once '../PhpProject1/DatabasePDO.php';
        include_once '../PhpProject1/EstadistiquesRow.php';
        $db = null;
        try {
            echo "<h1>PHP MySQL</h1>";
            echo "<h2>Inserció</h2>";
            $db = new DatabasePDO("localhost:3306", "mireia", "mireia", "m07uf3");
            $db->connect();
            echo "<p>Connected successfully</p>";
            $last_record = $db->insert(ModalitatEnum::MAQUINA, 2, 5);
            echo "<p>Registre $last_record inserit correctament</p>";
            echo "<h2>Estadístiques</h2>";
            echo DatabasePDO::TABLE_START;
            $stmt = $db->selectAll();
            foreach (new EstadistiquesRow(new RecursiveArrayIterator($stmt->fetchAll())) as $key => $row) {
                echo $row;
            }
        } catch (Exception $error) {
            echo "connection failed: " . $error->getMessage();
        }
        DatabasePDO::TABLE_END
        */?>
        <div id="contingut" align="center"><h1 id="tituloForm">Guess My Number</h1>
    <form id="formularioIndex" action="" method="POST">
        <h4>Primera modalitat: La màquina tractarà d'endevinar el número que has pensat</h4>
        <h4>Segona modalitat: Tractarás d'endevinar el número que ha pensat la màquina</h4>
        <label for="modalidad" class="label">Escull la modalitat de joc:</label>
        <select id="modalidad" name="modalidad" size="1">
            <option disabled selected value>Selecciona una opció</option>
            <option value="primeraModalidad">Primera modalitat</option>
            <option value="segundaModalidad">Segona modalitat</option>   
        </select>
        <br/>
        <br/>
        <label for="posibilidad" class="label">Selecciona el nivell de dificultat:</label>
        <select id="posibilidad" name="posibilidad" size="1">
            <option id="1" value="10">De l'1 al 10</option>
            <option id="2" value="50">Del l'1 al 50</option>
            <option id="3" value="100">Del l'1 al 100</option>
        </select> 
        <br />
        <br />
        <!--<input value="Seleccionar" type="submit" name="submit" class="button" id="buttonIndex">-->
        <button type="submit" name="submit" class="button" id="buttonIndex">Seleccionar</button>
    </form>
    <form id="formularioIndex" action="taula_estadistiques.php" method="POST">

    <button type="submit" id="estadistiques" name="estadistiques" value="Estadístiques">Estadístiques</button>
    </form>
    </div>
    </body>
</html>

<script>
    document.getElementById('modalidad').onchange = function() {
        var modalidad = document.getElementById('modalidad').value;
        document.getElementById('formularioIndex').action = '/M07UF3_GuessMyNumber/' + modalidad + '.php';
    };
</script>

<!--
    Control de errores:
        Gestionar errores como los números fuera de rango i otros
        que se puedan encontrar.

    Primera modalidad:
        A la primera modalitat, l’aplicació troba el número que algú ha pensat, 
        cal implementar una estratègia que minimitzi el nombre d’intents. 
        Habitualment, el punt mig del rang, ja que ens permet eliminar el màxim 
        nombre de números en cada intent. Quan resten pocs números, podeu afegir 
        un cert grau d’atzar controlat. El joc acaba quan l’aplicació troba el 
        nostre número i ens diu el número d’intents que ha necessitat. 
        En cada iteració, només podem respondre si és el numero correcte, 
        més petit o més gran.

        Generar un número aleatorio.

        setcookie('partida',$_POST['posibilidad']);
        $_COOKIE['partida'] = $_POST['posibilidad'];          
        setCookie('posibilidad', rand(1,$_COOKIE['partida']));

        Crear cookies o variable para punto medio del rango.
        setCookie('puntoMedio', ($_COOKIE['posibilidad'])/2);
        $puntoMedio = ($_COOKIE['posibilidad'])/2;

    Segunda modalidad: (DONE)
        A la segona modalitat, els papers s’inverteixen, som nosaltres 
        que hem de trobar el número que ha inventat la màquina en el mínim 
        número d’intents possibles.

    Tres niveles de juego: (DONE)
        -Primer nivel del 1 al 10
        -Segundo nivel del 1 al 50
        -Tercer nivel deel 1 al 100

    Funciones necesarias:
        rand(m, n) retorna un número aleatori entre m i n ambdós inclosos.
        max(a, b, ...) retorna el número més gran.
        min(a, b, ...) retorna el número més petit.

    Utilizar una función rand para el nivel de juego.
    Modificar el número máximo pasando el valor.
    del nivel de juego a través del formulario.

-->