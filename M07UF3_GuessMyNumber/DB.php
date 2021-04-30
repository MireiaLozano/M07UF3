<?php
include_once 'ModalitatEnum.php';
/*
 * @author Pep
 * drop database if exists m07uf3;
 * create database m07uf3;
 * use m07uf3;
 * drop table if exists estadistiques;
 * create table estadistiques(id int auto_increment primary key, modalitat enum('Huma', 'Maquina') not null, nivell int default 1, data_partida datetime default current_timestamp, intents int default 0);
 */


/**
 * Mètodes bàsics de connexió i inserció. 
 * En una aplicació real, cladria declarar altres mètodes, com update(), delete()...
 * @author Pep
 */
interface DB {
    public function connect(): void;
    // modalitat és 'Huma'/'Maquina'
    public function insert($modalitat, $nivell, $intents): int;
    
    public function selectAll();
    
    function selectByModalitat($modalitat);

    function delete($id): void;
    
    function update($estadistiques): void;
    
    // function delete($id): void;
    // ...
}


