<?php 
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
    require 'includes/app.php';
    use App\Producto;
    use App\Ventas;
    use App\Detalles;
    if(!isset($_SESSION)){
        session_start();
    }
    $auth = $_SESSION['login'] ?? null;
    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        // Validar id
        $id = $_POST['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if($id){
            $detalle = Detalles::find($id);
        }
    }

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

    $sentencia = "SELECT count(*) AS conteo FROM producto p JOIN detalles d ON p.id = d.id_producto";
    $result_sentencia = mysqli_query($conn, $sentencia);
    $pan = mysqli_fetch_array($result_sentencia);
    $conteo = $pan[0];
    $paginas = ceil($conteo / $productosPorPagina);
    $query = "SELECT p.nombre, d.precio, d.cantidad FROM producto p JOIN detalles d ON p.id = d.id_producto LIMIT " . $limit . " OFFSET " . $offset;
    $result = mysqli_query($conn, $query);

    incluirTemplate('header');
?>

<body class="main-index">
    <div class="i-detalles">
        <div>
            <div class="col-lg-4">
                <form method="post" enctype="multipart/form-data">
                    <div class="card-shadow card shadow mb-4">
                        <div class="form-index2 card-body">
                            <h3 class="secondary">NOMBRE</h3>
                            <h3 class="secondary">CANTIDAD</h3>
                            <h3 class="secondary">PRECIO</h3>
                            <h3 class="secondary">TOTAL</h3>
                        </div>
                    </div>
                </form>
            </div>

            <div class="column-index row items">
                <?php 
                    require "includes/conn.php";

                    #$query = "SELECT p.nombre, d.precio, d.cantidad FROM producto p JOIN detalles d ON p.id = d.id_producto";
                    #$result = mysqli_query($conn, $query);

                    if($result):
                        if(mysqli_num_rows ($result) > 0):
                            while ($detalle = mysqli_fetch_assoc($result)):
                                
                ?>

                <nav>
                    <div class="col-lg-4">
                        <form action="checkout.php?action=add&id=<?php echo $detalle ['id'];?>" method="post" enctype="multipart/form-data">
                            <div class="card-shadow card shadow mb-4">
                                <div class="form-index2 card-body">
                                    <h3 class="secondary"><?php echo $detalle['nombre'];?></h3>
                                    <h3 class="secondary"><?php echo $detalle['cantidad'];?></h3>
                                    <h3 class="secondary"><?php echo $detalle['precio'];?></h3>
                                    <h3 class="secondary"><?php echo $detalle['precio'] * $detalle['cantidad'];?></h3>
                                </div>
                            </div>
                        </form>                        
                    </div>
                </nav>
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
                            <a href="./detalles.php?pagina=<?php echo $pagina - 1 ?>">
                                <span aria-hidden="true" class="flechas">&laquo;</span>
                            </a>
                        </li>
                    <?php } ?>

                    <!-- Mostramos enlaces para ir a todas las páginas. Es un simple ciclo for-->
                    <?php for ($x = 1; $x <= $paginas; $x++) { ?>
                        <li class="<?php if ($x == $pagina) echo "active" ?> numeros-pagina">
                            <a href="./detalles.php?pagina=<?php echo $x ?>" >
                                <?php echo $x ?></a>
                        </li>
                    <?php } ?>
                    
                    <!-- Si la página actual es menor al total de páginas, mostramos un botón para ir una página adelante -->
                    <?php if ($pagina < $paginas) { ?>
                        <li>
                            <a href="./detalles.php?pagina=<?php echo $pagina + 1 ?>">
                                <span aria-hidden="true" class="flechas">&raquo;</span>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </nav>

        </div>
    </div>
</body>

