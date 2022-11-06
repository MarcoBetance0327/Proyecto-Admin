<?php 
    
    require 'includes/app.php';

    use App\Producto;

    if(!isset($_SESSION)){
        session_start();
    }

    $auth = $_SESSION['login'] ?? null;

    if(!isset($inicio)){
        $inicio = false;
    }

    

    incluirTemplate('header');
   
?>


<body class="main-index">
    <div class="puntoVenta">
        <div class="contenedor-izquierdo">
            <div class="buscador">
                <form action="" method="GET" class="enlace-eliminar buscador">
                    <input type="text" placeholder="Código de Barras"  name="busqueda" class="label-b">
                    <input type="submit" name="enviar" class="boton b-buscador" value="Buscar">
                </form>
            </div> 

            <div class="articulosVenta">
                <div class="column-index row items">
                    <?php 
                        // Se hace la conexión a la base de datos y seleccionara la tabla de comidas
                        // Luego, se evaluara con una condicional, si es de cierto tipo de sushi se mostrara, y los demás no se mostrarán 
                        // Este mismo proceso se repite 3 veces, por ejemplo, esta sección es una sección que se muestra pero las otras dos no, si se selecciona otra sección,
                        // esta se oculta y mostrará otra validación al tipo de sushi
                    

                        require "includes/conn.php";

                        if(isset($_GET['enviar'])):
                            $busqueda = $_GET['busqueda'];

                            $query = "SELECT * FROM producto WHERE codigo LIKE '%$busqueda%' ";
                            $result = mysqli_query($conn, $query);

                            if($result):
                                if(mysqli_num_rows ($result) > 0):
                
                                    while ($producto = $result->fetch_array()):
                    ?>


                    <div class="col-lg-4">
                        <form action="checkout.php?action=add&id=<?php echo $producto['id'];?>" method="post" enctype="multipart/form-data">
                            <div class="card-shadow card shadow mb-4">
                                <div class="form-index2 card-body">
                                    <h3 class="secondary"><?php echo $producto['nombre'];?></h3>
                                    <h3 class="secondary"><?php echo $producto['inventario'];?></h3>
                                    <h3 class="secondary"><?php echo $producto['codigo'];?></h3>
                                    <h3 class="secondary">$ <?php echo $producto['precio'];?></h3>

                                    <input type="number" class="form-control mb-3" name="quantity" value="1">
                                    <input type="hidden" name="id" value="<?php echo $producto['id'];?>">
                                    <input type="hidden" name="nombre" value="<?php echo $producto['nombre'];?>">
                                    <input type="hidden" name="codigo" value="<?php echo $producto['codigo'];?>">
                                    <input type="hidden" name="precio" value="<?php echo $producto['precio'];?>">
                                    <button type="submit" name="add_to_cart" class="btn btn-warning"><i class="fa fa-shopping-cart"></i>Agregar</button>
                                </div>
                            </div>
                        </form>
                        <!-- 
                            Se evaluara si la sesión del usuario es el admin, si es el admin, entonces se le otorgara el permiso de actualizar un producto o eliminarlo, 
                            Si no es el admin, entonces no mostrara nada
                            Actualizar nos redirigira al formulario, solamente que este ya se encontrarán llenos ciertos apartados para evitar que el admin tenga que llenarlos de nuevo
                        -->

                    </div>
                    <?php    
                                    endwhile;
                                endif;
                            endif;
                        endif;
                    ?>
                </div>
            </div>   
        </div>
        
        <div class="ticket">
            <h2>Ticket</h2>
        </div>   
        
    </div>
  
</body>

    <!--
        /*
            Llamamos al template footer para evitar duplicar codigo
        */
    -->
<?php incluirTemplate('footer'); ?>