<?php

if (isset($_POST['submit'])) {
   //echo "Clicked";

   //Connect to database
    require "conn.php";

    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    //Error handles
    if (empty($nombre) || empty($email) || empty($password)) {
       header("Location:../register.php?error=emptyfields&username=".$nombre);
       exit();

       //check for invalid fields
       
    }elseif (!preg_match("/^[a-zA-Z0-9]*/", $nombre)) {
        header("Location:../register.php?error=invalidfields&username".$nombre);
        exit();
        //check if the password match
    }else {
        $sql = "SELECT nombre FROM usuarios WHERE nombre = ?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
           header("Location:../register.php?error=sqlerror");
           exit();
        }else{
            mysqli_stmt_bind_param($stmt, "s", $nombre);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $rowCount = mysqli_stmt_num_rows($stmt);
            if ($rowCount > 0) {
                header("Location:../register.php?error=usernametaken&username".$nombre);
                exit();
                // insert data into the database
            }else {
                $sql = " INSERT INTO usuarios (nombre, password) values (?,?)";
                $stmt = mysqli_stmt_init($conn);
               if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location:../register.php?error=sqlerror");
                exit();
                //create a hashed password
               }else {
                   $hashedPass = password_hash($password, PASSWORD_DEFAULT);
                   mysqli_stmt_bind_param($stmt, "ss" , $nombre, $hashedPass);
                   mysqli_stmt_execute($stmt);
                    header("Location:../login.php?succes=registered");
               }
            }
        }

    }
    
}

?>