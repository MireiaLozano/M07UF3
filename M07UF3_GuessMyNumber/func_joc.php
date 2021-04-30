<?php
session_start();
include_once 'DatabasePDO.php';
include_once 'DatabaseProc.php';
include_once 'DatabaseOOP.php';
include_once 'EstadistiquesRow.php';
class Maquina{
    //generem variables
    private $intents;
    private $nivell;
    public $modalitat;
    private $primeraModalidad;
    
     function __construct() {
        $this->intents = 0;
        
    }

    public function guardar(){
         $db = new DatabaseOOP("localhost:3306", "mireia", "mireia", "m07uf3");
         $db->connect();
         
         
         if($this->modalitat == "Huma"){
             
              if($this->nivell == 10){
                        $db->insert(ModalitatEnum::HUMA, 1 , $this->intents);

              }elseif ($this->nivell == 50){
                        $db->insert(ModalitatEnum::HUMA, 2 , $this->intents);

              } elseif ($this->nivell == 100){
                        $db->insert(ModalitatEnum::HUMA, 3 , $this->intents);
              }
              $primeraModalidad->guardar();
         }else{
            if($this->nivell == 10){
                        $db->insert(ModalitatEnum::MAQUINA, 1 , $this->intents);

              }elseif ($this->nivell == 50){
                        $db->insert(ModalitatEnum::MAQUINA, 2 , $this->intents);

              } elseif ($this->nivell == 100){
                        $db->insert(ModalitatEnum::MAQUINA, 3 , $this->intents);
              }
              $segundaModalidad->guardar();
             
         }
         
         
        
        
    }
    
}