<?php
    use App\Comidas;

    if($_SERVER['SCRIPT_NAME'] === 'index.php'){
        $productos = Comidas::all();
    }else{
        $productos = Comidas::get(3);
    }
?>

<div class="">
    <div class="contenedor-menu index">
        <?php foreach($productos as $producto) { ?>
            <div class="menu">
                <img loading="lazy" src="/img/<?php echo $producto->imagen; ?>"> 
                <p class="titulo-menu"><?php echo $producto->nombre; ?> $<?php echo $producto->precio; ?></p>
            </div>
        <?php } ?>
    </div>
</div>