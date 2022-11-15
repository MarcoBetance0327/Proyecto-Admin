document.addEventListener("DOMContentLoaded", function(){
    iniciarApp();
});

function iniciarApp(){
    const total = document.querySelector('.total');
    console.log(total.textContent);

    boton = document.querySelector('.boton-input');
    
    boton.addEventListener('click', e =>{
        e.preventDefault();
        calcularCambio();

    });
    
}

function calcularCambio(){
    const total = document.querySelector('.total').textContent * 1;  
    const pago = document.querySelector('.pago-valor').value * 1;

    const res = pago-total;

    if(res < 0){
        window.alert("La cantidad ingresa no cubre el total");
    }else{
        const cambio = document.querySelector('.cambio');
        cambio.innerHTML = '<b>$'+ res  +'</b>';
    }
    

}