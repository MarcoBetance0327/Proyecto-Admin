<?php

    //@MARCO BETANCE
    // Se cerrara sesión cuando el usuario decida, por lo cual al hacerlo el arreglo de la sesion se vaciará 

    session_start();

    $_SESSION = [];

    header('Location: /');
