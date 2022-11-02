<?php

// @MARCO BETANCE
//Checar si el boton es clickeado o no

if (isset($_POST['submit'])) {
    //echo "Clicked";
//Conectar a la base de datos

    require "conn.php";
    //Recolectar los datos para el form

    $username = $_POST ['username'];
    $password = $_POST['password'];

    //Checar si los campos estan vacíos

    if (empty($username) || empty($password)) {
        header("Location:../login.php?error=emptyfields");
        exit();
    }
    //Checar si el password se encuentra en la base de datos
    $sql = "SELECT * FROM users WHERE username =?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../login.php?error=sqlerror");
        exit();
    }else {
        mysqli_stmt_bind_param($stmt, "s" , $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if ($row = mysqli_fetch_assoc($result)) {
           $passCheck = password_verify($password, $row['password']);
           if ($passCheck == false) {
              header("Location:../login.php?error=wrongpass");
           }elseif ($passCheck == true) {
              session_start();
              $_SESSION['sessionId'] = $row ['id'];
              $_SESSION ['sessionUser'] = $row['user'];
              header("Location: ../index.php?success=Loggedin");
           }
        }else {
            header("Locaton:../login.php?error=nouser");
        }
    }


}else {
    header("Location:../login.php?error=accessforbbiden");
}

?>