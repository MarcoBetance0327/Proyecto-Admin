<?php 
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
    require 'includes/app.php';

    use App\Proveedor;

    if(!isset($_SESSION)){
        session_start();
    }

    $auth = $_SESSION['login'] ?? null;

    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        // Validar id
        $id = $_POST['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if($id){
            $proveedor = Proveedor::find($id);
            $proveedor->eliminarProveedores();
        }
    }

    if(!isset($inicio)){
        $inicio = false;
    }

    incluirTemplate('header');
?>

<body class="main-index">

    <div class="index">
        <div>
            <div class="collapse navbar-collapse nav-header2" id="collapse">
                <?php if($auth): ?>
                    <div class="card-header  items-header div_edicion">
                        <!-- Se evaluara si la sesión del usuario es el admin, si es el admin, entonces se le otorgara el permiso de agregar un producto, 
                                Si no es el admin, entonces no mostrara nada-->
                        
                        <a href="admin/proveedor/crear.php" class="enlace-crear">Agregar Proveedor</a>
                
                    </div>
                </ul>

                <?php endif; ?>
                
                
            </div>
        
            <div class="col-lg-4">
                <form method="post" enctype="multipart/form-data">
                    <div class="card-shadow card shadow mb-4">
                        <div class="form-index2 card-body">
                            <h3 class="secondary">ID</h3>
                            <h3 class="secondary">NOMBRE</h3>
                            <h3 class="secondary">TELÉFONO</h3>
                            <h3 class="secondary">DIRECCIÓN</h3>
                        </div>
                    </div>
                </form>
            </div>

            <div class="column-index row items">
                <?php 
                    require "includes/conn.php";

                    $query = "SELECT * FROM proveedor ";
                    $result = mysqli_query($conn, $query);

                    if($result):
                        if(mysqli_num_rows ($result) > 0):
                            while ($proveedor = mysqli_fetch_assoc($result)):
                ?>


                <div class="col-lg-4">
                    <form action="checkout.php?action=add&id=<?php echo $proveedor ['id'];?>" method="post" enctype="multipart/form-data">
                        <div class="card-shadow card shadow mb-4">
                            <div class="form-index2 card-body">
                                <h3 class="secondary"><?php echo $proveedor['id'];?></h3>
                                <h3 class="secondary"><?php echo $proveedor['nombre'];?></h3>
                                <h3 class="secondary"><?php echo $proveedor['telefono'];?></h3>
                                <h3 class="secondary"><?php echo $proveedor['direccion'];?></h3>
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
                            <a href="/admin/proveedor/actualizar.php?id=<?php echo $proveedor['id']; ?>" class="enlace-actualizar btn btn-warning">
                                Actualizar Proveedor
                            </a>
                            <form method="POST"class="enlace-eliminar">
                                <input type="hidden" name="id" value="<?php echo $proveedor['id'] ?>">
                                <input type="hidden" name="tipo" value="noticia">
                                <button type="submit" class="btn btn-warning">Eliminar Proveedor</button>
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
