document.getElementById("abrirPopup").addEventListener("click", function () {
  document.getElementById("popup").style.display = "flex";
});

document.querySelector(".cerrar").addEventListener("click", function () {
  document.getElementById("popup").style.display = "none";
});
