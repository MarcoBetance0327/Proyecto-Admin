<?php 
    require 'includes/app.php';
    incluirTemplate('header');
?>

<main class="main-noticias">    
    <div class="a-acerca">
        <h2>Acerca de Nosotros</h2>

        <div class="acerca-superior">
            <div class="parrafo-acerca">
                <p>Ponshi Sushi es un negocio de comida juarense cuyo fin es proporcionar a sus clientes la mejor experiencia al disfrutar de 
                    comida asiática, con opción de que los clientes reciban la comida en los lugares que especifiquen. ¡Disfruta de Ponshi Sushi y 
                    permite que más gente en México y el mundo conozca de él!</p>
            </div>
            <div class="mapa">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3393.1739156985086!2d-106.44044964994056!3d31.738453543425923!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x86e75bfd1a22e41b%3A0xaa98f209ef5d6264!2sDelisushi!5e0!3m2!1ses-419!2smx!4v1635559280432!5m2!1ses-419!2smx" width="550" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>

        <h2>¿Deseas contactarte con la empresa?</h2>

        <div class="div-login">
            <form method="POST" class="formulario" novalidate action="/login">
                <fieldset>
                    <label for="nombre">Nombre</label>
                    <input type="nombre" name="nombre" placeholder="Tu nombre" id="nombre" class="input-contacto">

                    <label for="e-mail">E-mail</label>
                    <input type="e-mail" name="e-mail" placeholder="Tu e-mail" id="e-mail" class="input-contacto">

                    <label for="mensaje">Mensaje</label>
                    <textarea  name="mensaje" class="input-contacto"></textarea>

                </fieldset>

                <input type="submit" value="Enviar" class="boton">
            </form>
        </div>
    </div>
    
</main>

<?php incluirTemplate('footer'); ?>   