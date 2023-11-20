var publi = 1;
var tema = document.getElementById("botontema");
var ventanatema = document.getElementById("ventanatema");
var fondotema = document.getElementById("fondotema");
var admingo = document.getElementById("Administrador");


function verpubli() {
    if (publi == 1) {
        document.getElementById("menu").style.display = "flex";
        publi = ++publi;
    } else {
        document.getElementById("menu").style.display = "none";
        publi = --publi;
    }
}

tema.addEventListener("click", function (){

    ventanatema.style.display = "flex";

})

fondotema.addEventListener("click", function () {
    
    ventanatema.style.display ="none";

})

document.getElementById("closev").addEventListener("click", function (){
    ventanatema.style.display ="none";
})

admingo.addEventListener("click", function (){

    alert("No es posible!. Eres un administrador!");
    window.location="index.php?u=admin";
})