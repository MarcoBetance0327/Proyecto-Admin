<?php 
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
    require 'includes/app.php';

    use App\Producto;
    
    if(!isset($_SESSION)){
        session_start();
    }

    $auth = $_SESSION['login'] ?? null;

    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        // Validar id
        $id = $_POST['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if($id){
            $producto = Producto::find($id);
            $producto->eliminar();
        }
    }

    if(!isset($inicio)){
        $inicio = false;
    }

    incluirTemplate('header');
?>

<body class="main-index">
    <div class="collapse navbar-collapse nav-header2" id="collapse">
        <?php if($auth): ?>
            <div class="card-header  items-header div_edicion">
                <!-- Se evaluara si la sesión del usuario es el admin, si es el admin, entonces se le otorgara el permiso de agregar un producto, 
                        Si no es el admin, entonces no mostrara nada-->
                
                <a href="admin/menu/crear.php" class="enlace-crear">Agregar Producto</a>
        
            </div>
        </ul>

        <?php endif; ?>
        
        
    </div>

    <div class="index">
        <div>
            <div class="col-lg-4">
                <form method="post" enctype="multipart/form-data">
                    <div class="card-shadow card shadow mb-4">
                        <div class="form-index card-body">
                            <h3 class="secondary">ID</h3>
                            <h3 class="secondary">NOMBRE</h3>
                            <h3 class="secondary">NO. PROVEEDOR</h3>
                            <h3 class="secondary">NO. INVENTARIO</h3>
                            <h3 class="secondary">CÓDIGO</h3>
                            <h3 class="secondary">PRECIO</h3>
                        </div>
                    </div>
                </form>
            </div>

            <div class="column-index row items">
                <?php 
                    // Se hace la conexión a la base de datos y seleccionara la tabla de comidas
                    // Luego, se evaluara con una condicional, si es de cierto tipo de sushi se mostrara, y los demás no se mostrarán 
                    // Este mismo proceso se repite 3 veces, por ejemplo, esta sección es una sección que se muestra pero las otras dos no, si se selecciona otra sección,
                    // esta se oculta y mostrará otra validación al tipo de sushi
                

                    require "includes/conn.php";

                    $query = "SELECT * FROM producto ";
                    $result = mysqli_query($conn, $query);

                    if($result):
                        if(mysqli_num_rows ($result) > 0):
                            while ($producto = mysqli_fetch_assoc($result)):
                ?>


                <div class="col-lg-4">
                    <form action="checkout.php?action=add&id=<?php echo $producto ['id'];?>" method="post" enctype="multipart/form-data">
                        <div class="card-shadow card shadow mb-4">
                            <div class="form-index card-body">
                                <h3 class="secondary"><?php echo $producto['id'];?></h3>
                                <h3 class="secondary"><?php echo $producto['nombre'];?></h3>
                                <h3 class="secondary"><?php echo $producto['id_proveedor'];?></h3>
                                <h3 class="secondary"><?php echo $producto['inventario'];?></h3>
                                <h3 class="secondary"><?php echo $producto['codigo'];?></h3>
                                <h3 class="secondary">$ <?php echo $producto['precio'];?></h3>
                            </div>
                        </div>
                    </form>
                    <!-- 
                        Se evaluara si la sesión del usuario es el admin, si es el admin, entonces se le otorgara el permiso de actualizar un producto o eliminarlo, 
                        Si no es el admin, entonces no mostrara nada
                        Actualizar nos redirigira al formulario, solamente que este ya se encontrarán llenos ciertos apartados para evitar que el admin tenga que llenarlos de nuevo
                    -->
                    <?php if($_SESSION['usuario'] === 'admin@admin.com'): ?>
                        <div class="edicion">
                            <a href="/admin/menu/actualizar.php?id=<?php echo $producto['id']; ?>" class="enlace-actualizar btn btn-warning">
                                Actualizar Producto
                            </a>
                            <form method="POST"class="enlace-eliminar">
                                <input type="hidden" name="id" value="<?php echo $producto['id'] ?>">
                                <input type="hidden" name="tipo" value="noticia">
                                <button type="submit" class="btn btn-warning">Eliminar Producto</button>
                            </form>
                        </div>
                    <?php endif; ?>
                </div>
                <?php     
                            endwhile;
                        endif;
                    endif;
                ?>
            </div>

        </div>

    </div>
  
</body>

    <!--
        /*
            Llamamos al template footer para evitar duplicar codigo
        */
    -->
<?php incluirTemplate('footer'); ?>
