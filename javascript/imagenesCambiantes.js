
var cambioImagenes = document.querySelectorAll('.cambio'),
	flechaIzquierda = document.querySelector('#flecha-izquierda'),
	flechaDerecha = document.querySelector('#flecha-derecha'),
	current=0;
function limpiar(){
	for(var i = 0; i< cambioImagenes.length;i++){
		cambioImagenes[i].style.display="none";
	}
}
function empiezaCambio(){
	limpiar();
	cambioImagenes[0].style.display = "block";
}
//MUESTRA prev
function cambioIzquierda(){
	limpiar();
	cambioImagenes[current-1].style.display = "block";
	current--;
}
// muestra siguiente
function cambioDerecha(){
	limpiar();
	cambioImagenes[current+1].style.display = "block";
	current++;
}
//click en la flecha de la izquierda
flechaIzquierda.addEventListener('click',function(){
	if(current===0){
	current=cambioImagenes.length;
	}
	cambioIzquierda();
});
 //click en la flecha de la Derecha
flechaDerecha.addEventListener('click',function(){
	if(current===cambioImagenes.length-1){
		current=-1;
	}
cambioDerecha();
});
empiezaCambio();

var slideIndex = 0;
showSlides();

function showSlides() {
    for (i = 0; i < cambioImagenes.length; i++) {
       cambioImagenes[i].style.display = "none";  
    }
    slideIndex++;
    if (slideIndex > cambioImagenes.length) {slideIndex = 1;}    
    
    cambioImagenes[slideIndex-1].style.display = "block";  
    setTimeout(showSlides, 5000); // Change image every 2 seconds
}