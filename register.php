<!--/*
Declaramos las etiquetas meta para hacer uso de los atributos como la lectura del formato utf-8
Tambien se redirecciona a los archivos css y bootstrap
@Jose Rodriguez
-->
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

    

    <!-- Redireccionamos al archivo core de bootstrap para indicar los estilos para el registro
@Jose Rodriguez -->
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

    
    <!-- Declaramos la estructura principal del registro de usuarios -->
    <link href="signin.css" rel="stylesheet">
  </head>
  <body class="text-center bg-registro" > 
    
    <form class="form-signin" action="includes/login_inc.php" method="post">

      <h1 class="h3 mb-3 font-weight-normal">Registro</h1>
      <label for="email" class="sr-only">E-mail</label>
      <input type="email" id="email" name="email" class="form-control mb-2" placeholder="E-mail" required autofocus>
      <label for="password" class="sr-only">Password</label>
      <input type="password"  id="password" name="password" class="form-control" placeholder="Password" required>
      
      <button class="btn btn-lg btn-success btn-block" name="submit" type="submit">Registrar</button>
    
          <p class="lead text-register">Eres miembro? <a href="login.php">Inicia Sesión aquí...</a></p>
        
    </form> 
    
  </body>
</html>
