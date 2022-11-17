<?php 
session_start();
?>
<?php 

require "includes/auth.php";
            $product_ids = array();
            //session_destroy();
            // check if add to cart button has been clicked
            if (isset($_POST['add_to_cart'])) {
               if (isset($_SESSION['shopping_cart'])) {
                   # keep track of shopping cart product
                   $count = count ($_SESSION['shopping_cart']);
                   $products_ids = array_column($_SESSION['shopping_cart'], 'id');
                    if (!in_array(filter_input(INPUT_GET, 'id'), $product_ids)) {
                            $_SESSION['shopping_cart'][$count] = array(

                                'id' => filter_input(INPUT_GET, 'id'),
                                'product_name' => filter_input(INPUT_POST, 'product_name'),
                                'description' => filter_input(INPUT_POST, 'description'),
                                'new_price' => filter_input(INPUT_POST, 'new_price'),
                                'cantidad' => filter_input(INPUT_POST, 'cantidad'),
                                'old_price' => filter_input(INPUT_POST, 'old_price'),
                                'product_img' => filter_input(INPUT_POST, 'product_img')

                            );
                    }else {
                            for ($i = 0 ; $i < count ($product_ids); $i++){
                                    if ($product_ids[$i]  == filter_input(INPUT_GET, 'id')) {
                                            $_SESSION['shopping_cart'][$i]['cantidad'] += filter_input(INPUT_POST, 'cantidad');
                                    }
                            }
                    }
               }else {
                   # if shopping cart doesn't exist, create first product with array key
                   $_SESSION['shopping_cart'][0] = array(
                    'id' => filter_input(INPUT_GET, 'id'),
                    'product_name' => filter_input(INPUT_POST, 'product_name'),
                    'description' => filter_input(INPUT_POST, 'description'),
                    'new_price' => filter_input(INPUT_POST, 'new_price'),
                    'cantidad' => filter_input(INPUT_POST, 'cantidad'),
                    'old_price' => filter_input(INPUT_POST, 'old_price'),
                    'product_img' => filter_input(INPUT_POST, 'product_img')


                   );
               }
            }
            # delete item from the cart
            if (filter_input(INPUT_GET, 'action') == 'delete') {
                # go through the products to check a product that matches the Get Id
                    foreach ($_SESSION['shopping_cart'] as $key => $product) {
                        if ($product['id'] == filter_input(INPUT_GET, 'id')) {
                            # remove the item
                            unset($_SESSION['shopping_cart'][$key]);
                        }
                    }
                    // reset session array keys so they match with product ids number array
                    $_SESSION['shopping_cart'] =array_values($_SESSION['shopping_cart']);
            }

            //check out

if (filter_input(INPUT_GET, 'action')  == 'checkout') {
    // go through the products to check a product that matches the GET ID
    foreach ($_SESSION['shopping_cart'] as $key => $product) {
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart :: Sales Order</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="css/vendors/@fortawesome/fontawesome-free/css/all.min.css">
    
</head>
</body>
<!--- Navigation Start here ----> 
<nav class="navbar navbar-expand-md navbar-light bg-light">
    <div class="container-fluid">
        <a href="#" class="navbar-brand">
            <h4>Shopping Cart</h4>
        </a>
            <button class="navbar-toggler" type="button"
            data-toggle="collapse"
            data-target = "#collapse"
            aria-controls = "navbarCollapse"
            aria-expanded="false"
            aria-label="Toggle navigation"
            >
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapse">
                <ul class="navbar-nav mr-auto mb-2 mb-md-0">

                <li class="nav-item active">
                        <a href="index.php" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item ">
                        <a href="#" class="nav-link">Products</a>
                    </li>
                    <li class="nav-item ">
                        <a href="#" class="nav-link">Contact</a>
                    </li>

                </ul>
                <div class="dflex">
                    <a href="#" class="cart"> <i class="fa fa-shopping-cart"></i>
                        <span class="text-warning bg-dark">  0</span>
                    </a>
                </div>
            </div>
    </div>
</nav>
<!--- Navigation Ends here ---> 

<!--- Checkout products section ends here --->
<div class="container-fluid md-5">
    <div class="row px-5 py-2">
    <table class="table v-middle">
                                    <thead>
                                    <tr class="bg-dark text-white">
                                            
                                            <th class="border-top-0">Order Name</th>
                                            <th class="border-top-0">Total Price</th>
                                            <th class="border-top-0">Remarks</th>
                                        </tr>
                                    </thead>
                                    <?php
                if (!empty ($_SESSION['shopping_cart'])):
                    $total = 0 ;
                    foreach ($_SESSION['shopping_cart'] as $key => $product):
                        $total = $total + ($product['cantidad'] * $product['new_price']);
            ?>
                                   <tbody>
										<td><?php echo $product ['product_name'];?> </td>
										<td> <?php echo $total?></td>
										<td> </td>
										
								   </tbody>
                                   <?php 
                   
                    endforeach;
               ?>
    <?php endif;  ?>
                                </table>
                                
    </div>
</div>
<script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>