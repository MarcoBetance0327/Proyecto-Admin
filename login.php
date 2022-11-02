<?php 
  require 'includes/app.php';
  $db = mysqli_connect('localhost','root','root','proyecto');
  $db->set_charset('utf8');

  // Autenticar el usuario
  
  $errores = [];

  if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $email = mysqli_real_escape_string( $db, filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL));
    $password = mysqli_real_escape_string( $db, $_POST['password']);

    if(empty($errores)){

      // Revisar si el usuario existe
      $query = "SELECT * FROM usuarios WHERE email = '${email}'";
      $resultado = mysqli_query($db, $query);

      if( $resultado->num_rows ){
        // Revisar si el password es correcto
        $usuario = mysqli_fetch_assoc($resultado);

        //Verificar si el password es correcto o no
        $auth = password_verify($password, $usuario['password']);

        if($auth){
          // el usuario esta autenticado
          session_start();

          // LLenar el arreglo de la sesión
          $_SESSION['usuario'] = $usuario['email'];
          $_SESSION['login'] = true;

          header('Location: /');
        }else{
          $errores[] = "El password es incorrecto";
        }
      }else{
        $errores[] = "El usuario no existe";
      }
  }
  }

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content=""> 
    <meta name="generator" content="Hugo 0.72.0">
    <title>Ponshi Sushi</title>
    <link rel="stylesheet" href="/build/css/app.css">
    <link rel="canonical" href="https://v5.getbootstrap.com/docs/5.0/examples/sign-in/">

    

    <!-- Bootstrap core CSS -->
<link href="dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">
  </head>
  <body class="text-center bg-login">

    <a href="/"><img class="enlace-regresar" src="/build/img/atras.png"></a>

    
    
    <form class="form-signin" method="post" novalidate>
    
      <h1 class="h3 mb-3 font-weight-normal text-login">Iniciar Sesión</h1>
      <label for="email"  class="sr-only">E-mail</label>
      <input type="text"  id="email" name="email" class="form-control mb-2" placeholder="Email" id="email">
      <label for="passwrod" class="sr-only">Password</label>
      <input type="password" name="password" id="passwrod" class="form-control" placeholder="Password" id="password" required>
      <div class="checkbox mb-3">
      
      </div>
      <button class="btn btn-lg btn-success btn-block" name="submit" type="submit">Sign in</button>
      <p class="mt-5 mb-3 text-muted">&copy; 2021-2023</p>
      
    </form>

    
    
  </body>
</html>
