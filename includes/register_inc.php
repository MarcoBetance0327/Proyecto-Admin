
<?php
/*
En este apartado se llama al archivo que contiene la conexión a la base de datos
@Jose Rodriguez
*/

if (isset($_POST['submit'])) {
   
    require "conn.php";

/*
Aqui asignamos los valores a una variable, correspondiente a la base de datos
@Jose Rodriguez
*/
    $email = $_POST['email'];
    $password = $_POST['password'];

/*
En este apartado se comprueban si existe un error en el correo o el password
@Jose Rodriguez
*/
    if (empty($email) || empty($email) || empty($password)) {
       header("Location:../register.php?error=emptyfields&username=".$email);
       exit();
       
    }elseif (!preg_match("/^[a-zA-Z0-9]*/", $email)) {
        header("Location:../register.php?error=invalidfields&username".$email);
        exit();
       
    }else {
        $sql = "SELECT email FROM usuarios WHERE email = ?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
           header("Location:../register.php?error=sqlerror");
           exit();
        }else{
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $rowCount = mysqli_stmt_num_rows($stmt);
            if ($rowCount > 0) {
                header("Location:../register.php?error=usernametaken&username".$email);
                exit();
/*
En este apartado se agregan los registros a la base de datos
@Jose Rodriguez
*/
            }else {
                $sql = " INSERT INTO usuarios (email, password) values (?,?)";
                $stmt = mysqli_stmt_init($conn);
               if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location:../register.php?error=sqlerror");
                exit();
/*
En este apartado se reprocesa el password para ocultar el password real
@Jose Rodriguez
*/
               }else {
                   $hashedPass = password_hash($password, PASSWORD_DEFAULT);
                   mysqli_stmt_bind_param($stmt, "ss" , $email, $hashedPass);
                   mysqli_stmt_execute($stmt);
                    header("Location:../login.php?succes=registered");
               }
            }
        }

    }
    
}

?>