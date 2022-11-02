<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SITA</title>
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

    /*
        @MARCO BETANCE
        Se manda a llamar la clase de Comidas
        Se obtiene el id del producto deseado, y se valida que sea un dato correcto
        
    */

    use App\Proveedor;

    // Validar la URL por ID Válido 
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id){
        header('Location: /admin');
    }

    // Obtener los datos de la propiedad 
    $proveedor = Proveedor::find($id);

    // Arreglo con mensajes de errores 
    $errores = Proveedor::getErrores();

    // Ejecutar el código después de que el usuario envia el formulario
    if($_SERVER['REQUEST_METHOD'] === 'POST') {

        $args = $_POST['proveedor'];

        $proveedor->sincronizar($args);

        // Validación 
        $errores = $proveedor->validar();

        
        // Revisar que el array de errores este vacio

        if(empty($errores)) {
            $proveedor->guardar();
        }

    }

    incluirTemplate('header');
?>

<main class="contenedor">
    <h1 class="encabezado-crud">Actualizar Proovedor</h1>

    <!-- Se crea un formulario el cual dentro se asigna que se pueda subir cualquier tipo de archivo,
        y dentro de esta función se agrega un formulario que almacena los elementos para que el admin pueda evitar
        escribir todo de nuevo -->

    <form method="POST" enctype="multipart/form-data">
        <?php include __DIR__ . '/formulario.php'; ?>

        <input type="submit" value="Actualizar Proovedor" class="boton">
    </form>
    
</main>

<?php incluirTemplate('footer'); ?>