<?php 
            session_start();
            $comida_ids = array();
            //session_destroy();

            // check if add to cart button has been clicked
            if (isset($_POST['add_to_cart'])) {
               if (isset($_SESSION['shopping_cart'])) {
                   # keep track of shopping cart product
                   $count = count ($_SESSION['shopping_cart']);
                   $comida_ids = array_column($_SESSION['shopping_cart'], 'id');
                    if (!in_array(filter_input(INPUT_GET, 'id'), $comida_ids)) {
                            $_SESSION['shopping_cart'][$count] = array(

                                'id' => filter_input(INPUT_GET, 'id'),
                                'nombre' => filter_input(INPUT_POST, 'nombre'),
                                'descripcion' => filter_input(INPUT_POST, 'descripcion'),
                                'precio' => filter_input(INPUT_POST, 'precio'),
                                'quantity' => filter_input(INPUT_POST, 'quantity'),
                                'tipo'  => filter_input(INPUT_POST, 'tipo'),
                                'imagen' => filter_input(INPUT_POST, 'imagen')

                            );
                    }else {
                            for ($i = 0 ; $i < count ($comida_ids); $i++){
                                    if ($comida_ids[$i]  == filter_input(INPUT_GET, 'id')) {
                                            $_SESSION['shopping_cart'][$i]['quantity'] += filter_input(INPUT_POST, 'quantity');
                                    }
                            }
                    }
               }else {
                   # if shopping cart doesn't exist, create first product with array key
                   $_SESSION['shopping_cart'][0] = array(
                    'id' => filter_input(INPUT_GET, 'id'),
                    'nombre' => filter_input(INPUT_POST, 'nombre'),
                    'descripcion' => filter_input(INPUT_POST, 'descripcion'),
                    'precio' => filter_input(INPUT_POST, 'precio'),
                    'quantity' => filter_input(INPUT_POST, 'quantity'),
                    'tipo'  => filter_input(INPUT_POST, 'tipo'),
                    'imagen' => filter_input(INPUT_POST, 'imagen')


                   );
               }
            }
            # delete item from the cart
            if (filter_input(INPUT_GET, 'action') == 'delete') {
                # go through the products to check a product that matches the Get Id
                    foreach ($_SESSION['shopping_cart'] as $key => $comida) {
                        if ($comida['id'] == filter_input(INPUT_GET, 'id')) {
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
    foreach ($_SESSION['shopping_cart'] as $key => $comida) {
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

    include 'includes/templates/header.php';
?>

<!--- Checkout products section ends here --->
<div class="container-fluid md-5">

    <div class="row px-5 py-2">
   
    <br>
    <hr>
        <div class="col-md-7">
        <a href="menu.php" class="btn btn-success btn-block">Continuar Comprando</a>
            <h4>My Cart</h4>
            <?php
                if (!empty ($_SESSION['shopping_cart'])):
                    $total = 0 ;
                    foreach ($_SESSION['shopping_cart'] as $key => $comida):
                   
            ?>
           
            <div class="card px-3 mb-5">
            
                <div class="card-body">
                    <div class="row">

                    <!--- Product image --->  
                    <div class="col-md-4">
                    <img src="/img/<?php echo $comida['imagen'];?>" class="img-fluid px-5 prdimg "  alt="product image">
                    </div>
                        <div class="col-md-4">
                            <h4><?php echo $comida['nombre'];?></h4>
                            <h6><b>Descripción</b><?php echo $comida['descripcion'];?></h6>
                            <p></p>
                            <!-- <h5 class="secondary"><small><s><?php echo $comida ['precio'];?>/-</s></small> -->
                                <span class="price"> <b><?php echo $comida ['precio'];?>/-</b></span>
                            <!-- </h5>  -->
                        </div>
                       
                        <div class="col-md-4 py-5 px-5">
                           <a href="checkout.php?action=delete&id=<?php echo $comida ['id'];?>">
                                <div class="btn btn-danger">Remover</div>
                           </a>
                        </div>
                    </div>
                </div>
            </div>
               <?php 
                    $total = $total + ($comida['quantity'] * $comida['precio']);
                    endforeach;
               ?>
    <?php endif;  ?>
        </div>
<!--- Checkout products section ends here ---> 
        <!--- Total Price section ---> 
        <?php 
            if(!empty ($_SESSION['shopping_cart'])):
                if(count($_SESSION['shopping_cart']) > 0);
        ?>
        
<div class="col-md-5 py-5 px5">

    <div class="card">
    
        <div class="card-body">
            <b>Detalles de Precio</b>
            <hr>
            <div class="row">
                <div class="col-md-5">
                    <h5>Precio (  <?php echo $comida['quantity']?> de Productos)</h5>
                </div>
                <div class="col-md-5">
                    <h5 class="float-right">
                        <?php echo $total;?>
                    </h5>
                </div>
                <!--- Price section ---> 
               
                  
                    <!--- Total price section --->
            <div class="row">
                <div class="col-md-5 py-4">
                    <h5><b>Monto a Pagar</b></h5>
                </div>
                <div class="col-md-5 py-4">
                    <h5 class="float-right"><b><?php echo $total;?></b></h5>
                </div>
            </div>
                </div>
            </div>
           
        </div>
        
    </div>
    <?php if($_SESSION['usuario'] === ''): ?>
        <a href="login.php">
            <div class="btn btn-warning btn-block px-5">Continuar Pago</div>
        </a>
    <?php else: ?>
        <a href="sales_order.php">
            <div class="btn btn-warning btn-block px-5">Continuar Pago</div>
        </a>
    <?php endif; ?>
    
</div>

                <?php 
                        endif;
                ?>
        <!--- Total Price section ends here --->
    </div>
</div>
<script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>