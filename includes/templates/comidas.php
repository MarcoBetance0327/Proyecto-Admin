<?php
    use App\Comidas;

    if($_SERVER['SCRIPT_NAME'] === 'index.php'){
        $comidas = Comidas::all();
    }else{
        $comidas = Comidas::get(3);
    }
?>

<div class="">
    <div class="contenedor-menu index">
        <?php foreach($comidas as $comida) { ?>
            <div class="menu">
                <img loading="lazy" src="/img/<?php echo $comida->imagen; ?>"> 
                <p class="titulo-menu"><?php echo $comida->nombre; ?> $<?php echo $comida->precio; ?></p>
            </div>
        <?php } ?>
    </div>
</div>