<?php

    if(!isset($_SESSION)){
        session_start();
    }

    $auth = $_SESSION['login'] ?? null;

    if(!isset($inicio)){
        $inicio = false;
    }

    error_reporting(0);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SITA</title>
        <link rel="stylesheet" href="/build/css/app.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
        <meta http-equiv=”Content-Type” content=”text/html; charset=UTF-8″ />
        <meta charset="UTF-8">

        <script src="../../build/js/bundle.min.js"></script>
    </head>

    <!--- Navigation Start here ----> 
    <nav class="navbar navbar-expand-md navbar-light nav-header">
        <div class="container-fluid apartados-header">
            <a href="/" class="navbar-brand">
                <h1>SITA</h1>
            </a>
                <button class="navbar-toggler" type="button"
                data-toggle="collapse"
                data-target = "#collapse"
                aria-controls = "navbarCollapse"
                aria-expanded="false"
                aria-label="Toggle navigation"
                >
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse nav-header2" id="collapse">
                    <?php if($auth): ?>
                        <ul class="navbar-nav mr-auto mb-2 mb-md-0">
                        <li class="nav-item ">
                            <a href="/" class="nav-link">Productos</a>
                        </li>
                        <li class="nav-item ">
                            <a href="/proveedores.php" class="nav-link">Proveedores</a>
                        </li>
                        <li class="nav-item venta">
                            <a href="/punto_de_venta.php" class="nav-link">Punto de Venta</a>
                        </li>
                        <li class="nav-item venta">
                            <a href="/detalles.php" class="nav-link">Ventas</a>
                        </li>
                    </ul>

                    <?php endif; ?>
                    
                    
                </div>

                <div class="dflex">
                    <a href="/checkout.php" class="cart"> <i class="fa fa-shopping-cart"></i></a>
                </div>
                <?php if($auth): ?>
                    <div class="dflex">
                        <a href="/includes/logout.php" class="cart"> 
                            <span class="nav-link"> logout</span>
                        </a>
                    </div>
                <?php else: ?>
                    <div class="dflex">
                        <a href="login.php" class="cart"> 
                            <span class="nav-link " style="text-decoration: none;"> Login</span>
                        </a>
                    </div>
                <?php endif; ?>
                
                    
        </div>
    </nav>
    <!--- Navigation Ends here ---> 