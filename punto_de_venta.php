<?php 
            session_start();
            $productos_ids = array();
            //session_destroy();
            // check if add to cart button has been clicked
            if (isset($_POST['add_to_cart'])) {
                
               if (isset($_SESSION['shopping_cart'])) {
                   # keep track of shopping cart product
                   
                   $count = count ($_SESSION['shopping_cart']);
                   $productos_ids = array_column($_SESSION['shopping_cart'], 'id');
                    if (!in_array(filter_input(INPUT_GET, 'id'), $productos_ids)) {
                        
                            $_SESSION['shopping_cart'][$count] = array(
                                'id' => filter_input(INPUT_GET, 'id'),
                                'nombre' => filter_input(INPUT_POST, 'nombre'),
                                'codigo' => filter_input(INPUT_POST, 'codigo'),
                                'precio' => filter_input(INPUT_POST, 'precio'),
                                'cantidad' => filter_input(INPUT_POST, 'cantidad')
                            );
                    }else {
                            for ($i = 0 ; $i < count ($productos_ids); $i++){
                                    if ($productos_ids[$i]  == filter_input(INPUT_GET, 'id')) {
                                            $_SESSION['shopping_cart'][$i]['cantidad'] += filter_input(INPUT_POST, 'cantidad');
                                    }
                            }
                    }
               }else {
                   # if shopping cart doesn't exist, create first product with array key
                   $_SESSION['shopping_cart'][0] = array(

                    'id' => filter_input(INPUT_GET, 'id'),
                    'nombre' => filter_input(INPUT_POST, 'nombre'),
                    'codigo' => filter_input(INPUT_POST, 'codigo'),
                    'precio' => filter_input(INPUT_POST, 'precio'),
                    'cantidad' => filter_input(INPUT_POST, 'cantidad')
                   );
               }
            }
            
            # delete item from the cart
            if (filter_input(INPUT_GET, 'action') == 'delete') {
                # go through the products to check a product that matches the Get Id
                    foreach ($_SESSION['shopping_cart'] as $key => $producto) {
                        if ($producto['id'] == filter_input(INPUT_GET, 'id')) {
                            # remove the item
                            unset($_SESSION['shopping_cart'][$key]);
                        }
                    }
                    // reset session array keys so they match with product ids number array
                    $_SESSION['shopping_cart'] = array_values($_SESSION['shopping_cart']);
            }

            //check out

if (filter_input(INPUT_GET, 'action')  == 'checkout') {
    // go through the products to check a product that matches the GET ID
    foreach ($_SESSION['shopping_cart'] as $key => $producto) {
        # remove the iitem
        unset($_SESSION['shopping_cart'] [$key]);
        
    }
     // reset session array keys so they match with product ids number array
     $_SESSION['shopping_cart'] =array_values($_SESSION['shopping_cart']);
}

           // pre_r ($_SESSION);

            function pre_r($array){
            echo '<pre>';
            print_r($array);
            echo '<pre>';
            }

?>

<?php 
    require 'includes/app.php';
    use App\Producto;
    use App\Ventas;
    use App\Detalles;

    if(!isset($_SESSION)){
        session_start();
    }

    $auth = $_SESSION['login'] ?? null;

    if(!isset($inicio)){
        $inicio = false;
    }

    $venta = new Ventas;
    $detalles = new Detalles;

    $errores = Ventas::getErrores(); 
    $errores = Detalles::getErrores(); 

    $fecha = date("Y/m/d");

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        
        if(isset($_POST['fecha'])){
            $query = "INSERT INTO venta (fecha) VALUES ('" . $fecha . "')";
            $result = mysqli_query($conn, $query);

            $consultaMax = "SELECT MAX(id) FROM venta";
            $result = mysqli_query($conn, $consultaMax);
            $arr = mysqli_fetch_array($result);
            $idVenta = $arr[0];
            
            if (!empty ($_SESSION['shopping_cart'])):
                
                foreach ($_SESSION['shopping_cart'] as $key => $producto):
                    $query_detalles = "INSERT INTO detalles(id_venta, id_producto, cantidad, precio) Values(". $idVenta . " , " . $producto['id'] . " , " . $producto['cantidad'] . " , " . $producto['precio'] .")";
                    $result = mysqli_query($conn, $query_detalles);
                    
                    $query_update = "UPDATE producto SET inventario = inventario - " . $producto['cantidad'] . " WHERE  id = " . $producto["id"];
                    $result = mysqli_query($conn, $query_update);
                endforeach;
            endif;  
            #Limpiar el carrito 
            foreach ($_SESSION['shopping_cart'] as $key => $producto) {
                # remove the item
                unset($_SESSION['shopping_cart'] [$key]);
                
            }
        }
 
    }

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
                    <div class="form-index3">
                        <h1>CÓDIGO</h1>
                        <h1>NOMBRE</h1>
                        <h1>PRECIO</h1>
                    </div>
            
                    <?php 
                        require "includes/conn.php";

                        if(isset($_GET['enviar'])):
                            $busqueda = $_GET['busqueda'];

                            $query = "SELECT * FROM producto WHERE codigo LIKE '%$busqueda%' ";
                            $result = mysqli_query($conn, $query);

                            if($result):
                                if(mysqli_num_rows ($result) > 0):
                
                                    while ($producto = $result->fetch_array()):
                                        if($producto['inventario'] <= 0):
                    ?>


                    <div class="col-lg-4">
                        <form action="punto_de_venta.php?action=add&id=<?php echo $producto['id'];?>" method="post">
                            <div class="card-shadow card shadow mb-4">
                                <div class="form-index3 card-body">
                                    <h3 class="secondary"><?php echo $producto['codigo'];?></h3>
                                    <h3 class="secondary"><?php echo $producto['nombre'];?></h3>
                                    <h3 class="secondary">$ <?php echo $producto['precio'];?></h3>

                                    <h4 class="seconday">Agotado</h4>
                                </div>
                            </div>
                        </form>
                    </div>
                    <?php    
                                        endif;
                                        if($producto['inventario'] > 0):
                    ?>
                                        <div class="col-lg-4">
                                            <form action="punto_de_venta.php?action=add&id=<?php echo $producto['id'];?>" method="post">
                                                <div class="card-shadow card shadow mb-4">
                                                    <div class="form-index3 card-body">
                                                        <h3 class="secondary"><?php echo $producto['codigo'];?></h3>
                                                        <h3 class="secondary"><?php echo $producto['nombre'];?></h3>
                                                        <h3 class="secondary">$ <?php echo $producto['precio'];?></h3>

                                                        <input type="number" class="form-control mb-3" name="cantidad" value="1">
                                                        <input type="hidden" name="id" value="<?php echo $producto['id'];?>">
                                                        <input type="hidden" name="nombre" value="<?php echo $producto['nombre'];?>">
                                                        <input type="hidden" name="codigo" value="<?php echo $producto['codigo'];?>">
                                                        <input type="hidden" name="precio" value="<?php echo $producto['precio'];?>">
                                                        <button type="submit" name="add_to_cart" class="btn btn-warning"><i class="fa fa-shopping-cart"></i>Agregar</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                    <?php
                                        endif;
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

            <div class="encabezados-ticket">
                <h1>CÓDIGO</h1>
                <h1>NOMBRE</h1>
                <h1>CANTIDAD</h1>
                <h1>PRECIO</h1>
                <h1>TOTAL</h1>
            </div>
 
            <?php
                if (!empty ($_SESSION['shopping_cart'])):
                    $total = 0 ;
                    foreach ($_SESSION['shopping_cart'] as $key => $producto):
                   
            ?>

            <?php
                $totalProducto = ($producto['cantidad'] * $producto['precio']);
            ?>

            
            <div class="encabezados-ticket bg-white shadow mb-4">
                <h4><?php echo $producto['codigo'];?></h4>
                <h4><?php echo $producto['nombre'];?></h4>
                <h4><?php echo $producto['cantidad'];?></h4>
                <h4><?php echo $producto['precio'];?></h6> 

                <div class="col-md-5 py-4">
                    <h5 class="float-right"><b>$ <?php echo $totalProducto;?></b></h5>
                </div>

                <div class="col-md-4 py-5 px-5">
                    <a href="punto_de_venta.php?action=delete&id=<?php echo $producto ['id'];?>">
                            <div class="btn btn-danger">Remover</div>
                    </a>
                </div>
            </div>

            
           <?php 
                    $total = $total + ($producto['cantidad'] * $producto['precio']);
                    endforeach;
                endif;  
           ?>

            <div class="card-body">
                <hr>  
                    <!--- Total price section --->
                <div class="montos">
                    <div class="col-md-5 py-4 monto-total">
                        <h5 class="total-productos"><b>Total</b></h5>

                        <div class="col-md-5 py-4">
                            <h5 class="float-right total-productos"><b>$</b><b class="total"><?php echo $total;?></b></h5>
                        </div>
                    </div>
                    
                    <div class="col-md-5 py-4 monto-total">
                        <h5 class="float-right total-productos"><b>Pago</b></h5>

                        <input id="pago" type="number" placeholder="Pago"  name="pago" class="label-b pago-input pago-valor">
                        <input type="submit" onclick="calcularCambio()" class="boton2 b-buscador boton-input pago-input" value="Pagar">
                    
                    </div>

                    <div class="col-md-5 py-4 monto-total">
                        <h5 class="total-productos"><b>Cambio</b></h5>

                        
                        <h5 class="float-right total-productos"><b class="cambio"></b></h5>
                        
                    </div>
                </div>
            
            </div>

            <form method="post" action=""  class="btn-venta">
                <input type="hidden" name="fecha" value="<?php echo $fecha?>">
                <input type="submit" name="Venta" class="boton  btn-venta" value="Registra Venta">
            </form>
            
        </div>   
        
    </div>
  
</body>

