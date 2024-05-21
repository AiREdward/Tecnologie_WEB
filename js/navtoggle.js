let navbar = false;

window.onload=function(){
    document.getElementById("toggle-nav").onclick=function(){
        if(navbar) document.getElementById("nav-menu").classList.add("hidden-nav");
        else document.getElementById("nav-menu").classList.remove("hidden-nav");

        navbar = !navbar;
    }
};