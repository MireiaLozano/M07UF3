<?php
  session_start();
  abstract class GuessMyNumber {
    public $dificultad;

    function __construct($dificultad) {
      $this->dificultad = $dificultad;
    }

    function set_dificultad($dificultad) {
      $this->dificultad = $dificultad;
    }

    function get_dificultad() {
      return $this->dificultad;
    }

    function check_intentos() {
      if (!isset($_SESSION['intentos'])) { 
        $_SESSION['intentos'] = 0;
      }
    }

    function sumar_intentos() {
      if (isset($_SESSION['intentos'])) {
        $_SESSION['intentos'] = $_SESSION['intentos']+1;
      }
    }

    function volverIndice() {
      session_unset();
      session_destroy();
      header("Location: index.php");       
    }
    
  }
?>