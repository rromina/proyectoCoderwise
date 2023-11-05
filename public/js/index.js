/* Header */

let menu = document.querySelector("#menu");
let nav = document.querySelector("nav");
let icons = document.querySelector(".icons-box");
let iconMain = document.querySelector("#link-icon-main");
let iconMovil = document.querySelector("#icon-main-movil");

menu.onclick = () => {
  nav.classList.toggle("open");
  icons.classList.toggle("open");
  menu.classList.toggle("fa-xmark");
  iconMain.classList.toggle("open");
  iconMovil.classList.toggle("open");
};

/* Estilos compra pasaje */

const back = document.getElementById("back");
const go = document.getElementById("go");
const dayBack = document.getElementById("day-back");
const inputBack = document.getElementById("input-back");

try 
{
  back.addEventListener("click", function () {
    dayBack.style.display = "block";
    back.style.backgroundColor = "#E79115";
    go.style.backgroundColor = "transparent";
    inputBack.setAttribute("required", "true");
  });
}catch(err)
{

}

try 
{
  go.addEventListener("click", function () {
    dayBack.style.display = "none";
    go.style.backgroundColor = "#E79115";
    back.style.backgroundColor = "transparent";
    inputBack.removeAttribute("required");
  });
}catch(err)
{

}
