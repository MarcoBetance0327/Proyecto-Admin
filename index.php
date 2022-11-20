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


    if(!isset($inicio)){
        $inicio = false;
    }

    $productosPorPagina = 10;
    $pagina = 1;
    if (isset($_GET["pagina"])) {
        $pagina = $_GET["pagina"];
    }
    # El límite es el número de productos por página
    $limit = $productosPorPagina;
    # El offset es saltar X productos que viene dado por multiplicar la página - 1 * los productos por página
    $offset = ($pagina - 1) * $productosPorPagina;
    
    $sentencia = "SELECT count(*) AS conteo FROM producto p inner join proveedor pv on p.id_proveedor = pv.id";
    $result_sentencia = mysqli_query($conn, $sentencia);
    $pan = mysqli_fetch_array($result_sentencia);
    $conteo = $pan[0];
    $paginas = ceil($conteo / $productosPorPagina);

    $query = "SELECT p.id, p.nombre, pv.nombre as pv_nombre, p.inventario, p.codigo, p.precio FROM producto p inner join proveedor pv on p.id_proveedor = pv.id LIMIT " . $limit . " OFFSET " . $offset;
    $result = mysqli_query($conn, $query);

    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        // Validar id
        $id = $_POST['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if($id){
            $producto = Producto::find($id);
            $producto->eliminar();
        }
    }

    incluirTemplate('header');
?>

<body class="main-index">
    <div class="collapse navbar-collapse nav-header2 btn-agregarP" id="collapse">
        <?php if($auth): ?>
            <div class="card-header  items-header div_edicion">                
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
                        <div class="form-index4 card-body">
                            <h3 class="secondary">CÓDIGO</h3>
                            <h3 class="secondary">PRODUCTO</h3>
                            <h3 class="secondary">PROVEEDOR</h3>
                            <h3 class="secondary">INVENTARIO</h3>
                            <h3 class="secondary">PRECIO</h3>
                        </div>
                    </div>
                </form>
            </div>

            <div class="column-index row items">
                <?php 
                    require "includes/conn.php";

                    if($result):
                        if(mysqli_num_rows ($result) > 0):
                            while ($producto = mysqli_fetch_assoc($result)):
                ?>


                <div class="col-lg-4 contenedor-listado">
                    <form action="checkout.php?action=add&id=<?php echo $producto ['id'];?>" method="post" enctype="multipart/form-data">
                        <div class="card-shadow card shadow mb-4">
                            <div class="form-index4 card-body">
                                <h3 class="secondary"><?php echo $producto['codigo'];?></h3>
                                <h3 class="secondary"><?php echo $producto['nombre'];?></h3>
                                <h3 class="secondary"><?php echo $producto['pv_nombre'];?></h3>
                                <h3 class="secondary"><?php echo $producto['inventario'];?></h3>
                                <h3 class="secondary">$ <?php echo $producto['precio'];?></h3>
                            </div>
                        </div>
                    </form>
                    <?php if($_SESSION['usuario'] === 'admin@admin.com'): ?>
                        <div class="edicion">
                            <a href="/admin/menu/actualizar.php?id=<?php echo $producto['id']; ?>" class="enlace-actualizar btn btn-warning">
                                Actualizar Producto
                            </a>
                            <form method="POST"class="enlace-eliminar">
                                <input type="hidden" name="id" value="<?php echo $producto['id'] ?>">
                                <input type="hidden" name="tipo" value="noticia">
                                <button type="submit" class="btn btn-warning enlace-actualizar">Eliminar Producto</button>
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

            <nav class="nav-paginacion">
                <div class="">

                    <div class="mostrando-paginas">
                        <p>Página <?php echo $pagina ?> de <?php echo $paginas ?> </p>
                    </div>
                </div>

                <ul class="pagination">
                    <!-- Si la página actual es mayor a uno, mostramos el botón para ir una página atrás -->
                    <?php if ($pagina > 1) { ?>
                        <li>
                            <a href="./index.php?pagina=<?php echo $pagina - 1 ?>">
                                <span aria-hidden="true" class="flechas">&laquo;</span>
                            </a>
                        </li>
                    <?php } ?>

                    <!-- Mostramos enlaces para ir a todas las páginas. Es un simple ciclo for-->
                    <?php for ($x = 1; $x <= $paginas; $x++) { ?>
                        <li class="<?php if ($x == $pagina) echo "active" ?> numeros-pagina">
                            <a href="./index.php?pagina=<?php echo $x ?>" >
                                <?php echo $x ?></a>
                        </li>
                    <?php } ?>
                    
                    <!-- Si la página actual es menor al total de páginas, mostramos un botón para ir una página adelante -->
                    <?php if ($pagina < $paginas) { ?>
                        <li>
                            <a href="./index.php?pagina=<?php echo $pagina + 1 ?>">
                                <span aria-hidden="true" class="flechas">&raquo;</span>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </nav>


        </div>

    </div>
  
</body>

