<head>
    <meta charset="UTF-8">
    <title>Agregar Producto</title>
    <link rel="stylesheet" href="/build/css/app.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="css/style.css" rel="stylesheet">
    <meta http-equiv=”Content-Type” content=”text/html; charset=UTF-8″ />
    <link rel="icon" href="build/img/icono.png">
    <meta charset="UTF-8">
</head>

<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
    require '../../includes/app.php';

    use App\Producto;
    use App\Proveedor;

    $errores = Producto::getErrores();

    $producto = new Producto;
    $proveedores = Proveedor::all();

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $producto = new Producto($_POST['producto']);
        $proveedores = Proveedor::all();

        // Validación 
        $errores = $producto->validar();

        // Revisar que el array de errores este vacio
        if(empty($errores)){
            $resultado = $producto->guardar();
        }
    }

    incluirTemplate('header');
?>

<main class="contenedor">
    <h1 class="encabezado-crud">Agregar Producto</h1>
        
    <form method="POST" action="/admin/menu/crear.php" enctype="multipart/form-data"> 
        <?php include __DIR__ . '/formulario.php' ?>

        <input type="submit" value="Agregar Producto" class="boton buton-edicion">
    </form>
</main>