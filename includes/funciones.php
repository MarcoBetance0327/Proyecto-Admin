<?php
    // @MARCO BETANCE
    /*
        Con los define declaramos nombres a rutas, por ejemplo, si quiero guardar o llamar algo de cierto archivo como las funciones de aquí, en lugar de escribir la ruta solamente
        escribo el nombre dado a la ruta del archvio
    */
    

    define('TEMPLATES_URL' , __DIR__ . '/templates');
    define('FUNCIONES_URL', __DIR__ . 'funciones.php');
    define('CARPETA_IMAGENES', $_SERVER['DOCUMENT_ROOT'] . '/imagenes/');

    // Esta función ayuda a evitar escribir la ruta, es usada para mandar a llamar el header y el footer sin neesidad de escribir la ruta

    function incluirTemplate( $nombre, $inicio = false){
        include TEMPLATES_URL . "/${nombre}.php";
    }

    // Esta función evalua, si esta autenticado, se dirigira la página principal

    function estaAutenticado() {
        session_start();

        if(!$_SESSION['login']){
            header('Location: /');
        }
    }

    // Esta función nos fue útil para ver acerca de errores que no podríamos ver por si solos

    function debuguear($variable){
        echo "<prev>";
        var_dump($variable);
        echo "</prev>";
        exit;
    }

    // Escapa / Sanitizar el HTML
    function s($html) : string{
        $s = htmlspecialchars($html);
        return $s;
    }


    function validarORedireccionar(string $url){
        // Validar la URL por ID Válido 
        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if(!$id){
            header("Location: ${url}");
        }

        return $id;
    }
    
//     function validarTipo($admin){
//         $tipo = '';

//         $tipo = $_SESSION['usuario'];

//         if($admin = $tipo){
//             return $admin;
//         }else{
//             return $tipo;
//         }
//     }

?>
