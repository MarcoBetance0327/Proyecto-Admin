<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content=""> 
    <meta name="generator" content="Hugo 0.72.0">
    <title>Signin Template · Bootstrap</title>

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
  <body class="text-center">
    
<form action="includes/login_inc.php" class="form-signin" method="post">
  <img class="mb-4" src="images/logo.png" alt="" width="72" height="72">
  <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
  <label for="inputEmail"  class="sr-only">Username</label>
  <input type="text"  id="inputEmail" name="username" class="form-control mb-2" placeholder="Username" >
  <label for="inputPassword" class="sr-only">Password</label>
  <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
  <div class="checkbox mb-3">
   
  </div>
  <button class="btn btn-lg btn-success btn-block" name="submit" type="submit">Sign in</button>
  <p class="mt-5 mb-3 text-muted">&copy; 2021-2023</p>
  <p class="lead">Not a member <a href="register.php">Register Here!</a></p>
  <a href="index.php"><h5 class="mt-5 mb-3 text-muted">Home</h5></a>
</form>


    
  </body>
</html>
