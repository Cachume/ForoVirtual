var publi = 1;



function verpubli() {
    if (publi == 1) {
        document.getElementById("menu").style.display = "flex";
        publi = ++publi;
    } else {
        document.getElementById("menu").style.display = "none";
        publi = --publi;
    }
}