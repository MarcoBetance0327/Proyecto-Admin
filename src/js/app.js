/*
Archivo de js para oculta y mostrar secciones de acuerdo a lo que seleccione el usuario.
@Francisco Enríquez*/

/*
Variable para indicar qué página se muestra
@Francisco Enríquez*/
let pagina = 1;

/*
Función que se carga apenas el DOM está totalmente cargado.
@Francisco Enríquez*/


document.addEventListener("DOMContentLoaded", function(){
    iniciarApp();
});

/*
Función que manda a llamar la página principal y oculta las demás
@Francisco Enríquez*/

function iniciarApp(){
    mostrarSeccion();

    cambiarSeccion();
}

/*
Función que muestra la sección que el usuario quiere y oculta las demás.
@Francisco Enríquez*/

function mostrarSeccion(){
    
        /*
    Obtener elementos mostrados
    @Francisco Enríquez*/
    
    const seccionAnterior = document.querySelector('.mostrar-seccion');
    
        /*
    Verificar si existen elementos mostrados y ocultarlos
    @Francisco Enríquez*/

    if(seccionAnterior){
        seccionAnterior.classList.remove('mostrar-seccion');
    }
    
        /*
    Mostrar la sección que el usuario indicó con base en el cambio de la variable página
    @Francisco Enríquez*/

    const seccionActual = document.querySelector(`#paso-${pagina}`);
    seccionActual.classList.add('mostrar-seccion');
    
        /*
    Mostrar la sección que el usuario indicó con base en el cambio de la variable página
    @Francisco Enríquez*/

    const tabAnterior = document.querySelector('.navegacion .actual');
    if(tabAnterior){
        tabAnterior.classList.remove('actual');
    }
    
        /*
    Cambiar la clase "actual" al elemento a mostrar y actualizar el número de la página mostrada
    @Francisco Enríquez*/

    const tab = document.querySelector(`[data-paso="${pagina}"]`);
    tab.classList.add("actual");
}

/*
Función que se manda a llamar para mostrar la sección principal de la página y de ahí poder visitar las demás
@Francisco Enríquez*/


function cambiarSeccion(){
    
        /*
    Identificar y seleccionar aquellos botones del menu con la clase "button"
    @Francisco Enríquez*/
    
    const enlaces = document.querySelectorAll('.navegacion button');
    
        /*
    Función para detecar clics en las secciones del menú y mandar a llamar la sección a mostrar mediante la función mostrarSeccion().
    @Francisco Enríquez*/

    enlaces.forEach( enlace =>{
        enlace.addEventListener('click', e =>{
            e.preventDefault();
            pagina = parseInt(e.target.dataset.paso);

            mostrarSeccion();
        });
    });
    
}

