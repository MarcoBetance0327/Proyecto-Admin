<head>
    <meta charset="UTF-8">
    <title>Ponshi Sushi</title>
    <link rel="stylesheet" href="/build/css/app.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="css/style.css" rel="stylesheet">
    <meta http-equiv=”Content-Type” content=”text/html; charset=UTF-8″ />
    <link rel="icon" href="build/img/icono.png">
    <meta charset="UTF-8">
</head>

<?php
    require '../../includes/app.php';

    use App\Proveedor;

    /* @MARCO BETANCE
        Se crea un nuevo objeto de Comidas, y a la variable de errores se le asigna la clase de Comidas para verificar sus 
        válidaciones
    */

    $proveedores = new Proveedor;

    $errores = Proveedor::getErrores(); 

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $proveedores = new Proveedor($_POST['proveedor']);

        // Validación 
        $errores = $proveedores->validar();

        // Revisar que el array de errores este vacio

        if(empty($errores)){

            $resultado = $proveedores->guardar();
        }
    }

    incluirTemplate('header');
?>

<main class="contenedor">
    <h1 class="encabezado-crud">Agregar Proveedor</h1>

    <!-- Se crea un formulario el cual dentro se asigna que se pueda subir cualquier tipo de archivo,
        y dentro de esta función se agrega un formulario que almacena los elementos para que el admin pueda evitar
        escribir todo de nuevo -->
        
    <form method="POST" action="/admin/proveedor/crear.php" enctype="multipart/form-data"> 
        <?php include __DIR__ . '/formulario.php' ?>

        <input type="submit" value="Agregar Proveedor" class="boton">
    </form>
</main>

<?php incluirTemplate('footer');