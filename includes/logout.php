<?php
    //@MARCO BETANCE
    // Se cerrara sesión cuando el usuario decida, por lo cual al hacerlo el arreglo de la sesion se vaciará 

    require "conn.php";
    session_start();
    $_SESSION = array();
    session_destroy ();
        header ("Location:../index.php");