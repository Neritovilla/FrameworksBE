<?php

$pdo = null;
$host = "localhost"; // Corregido el nombre del host
$user = "root";
$password = "1234";
$bd = "tutoriales";

function conectar(){
    try{
        $GLOBALS['pdo'] = new PDO("mysql:host=".$GLOBALS['host'].";dbname=".$GLOBALS['bd'], $GLOBALS['user'], $GLOBALS['password']); // Corregido el nombre de la variable de usuario
        $GLOBALS['pdo']->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e){
        print "Error!: No se pudo conectar a la base de datos ".$GLOBALS['bd']."<br/>"; 
        print "\nError!: ".$e->getMessage()."<br/>"; 
    } 
}

function desconectar(){
    $GLOBALS['pdo'] = null;
}

function metodoGet($query){
    try{
        conectar();
        $statement = $GLOBALS['pdo']->prepare($query);
        $statement->setFetchMode(PDO::FETCH_ASSOC); 
        $statement->execute(); 
        desconectar();
        return $statement;
    }catch(Exception $e){
        die("Error: " . $e->getMessage()); 
    }
}


function metodoPost($query,$queryAutoIncrement){
    try{
        conectar();
        $statement = $GLOBALS['pdo']->prepare($query);
        $statement->execute(); 
        $idAutoIncrement = metodoGet($queryAutoIncrement)->fetch(PDO::FETCH_ASSOC);
        $result = array_merge($idAutoIncrement, $_POST);
        $statement->closeCursor();
        desconectar();
        return $result;
    }catch(Exception $e){
        die("Error: " . $e); 
    }
}

function metodoPut($query){
    try{
        conectar();
        $statement = $GLOBALS['pdo']->prepare($query);
        $statement->execute(); 
        $result = array_merge($_GET, $_POST);
        $statement->closeCursor();
        desconectar();
        return $result;
    }catch(Exception $e){
        die("Error: " . $e); 
    }
}


function metodoDelete($query){
    try{
        conectar();
        $statement = $GLOBALS['pdo']->prepare($query);
        $statement->execute(); 
        $statement->closeCursor();
        desconectar();
        return $_GET['id'];
    }catch(Exception $e){
        die("Error: " . $e); 
    }
}



?>
