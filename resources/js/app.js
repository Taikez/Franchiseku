import "./bootstrap";

import Alpine from "alpinejs";
import AOS from "aos";

AOS.init();
window.Alpine = Alpine;

Alpine.start();


// sidebar bro
const mainNavigation = document.querySelector(".main-navigation");
const overlay = mainNavigation.querySelector(".overlay");
const toggler = mainNavigation.querySelector(".navbar-toggler");

const openSidebar = () => mainNavigation.classList.add("active");
const closeSidebar = () => mainNavigation.classList.remove("active");

// toggler.addEventListener("click", openSidebar);
// overlay.addEventListener("click", closeSidebar);

// document.addEventListener("swiped-right", openSidebar);
// document.addEventListener("swiped-left", closeSidebar);
