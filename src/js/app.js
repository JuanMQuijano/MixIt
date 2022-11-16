document.addEventListener("DOMContentLoaded", function () {
  iniciarApp();
});

function iniciarApp() {
  const btnMenu = document.querySelector("#btnMenu");
  const navBar = document.querySelector("#navBar");

  btnMenu.onclick = mostrarNavBar;
}

function mostrarNavBar() {
  navBar.classList.toggle("mostrar");
}
