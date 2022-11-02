<?php 

    function conectarDB() : mysqli{
        $db = new mysqli('localhost', 'root', 'root', 'sita');
        mysqli_set_charset($db, 'utf8');

        if(!$db){
            echo "Error no se pudo ejecutar";
            exit;
        }
        
        return $db;
    }