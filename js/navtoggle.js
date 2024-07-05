let navbar = false;

window.onload=function(){
    document.getElementById("toggle-nav").onclick=function(){
        if(navbar) {
            document.getElementById("nav-menu").classList.add("hidden-nav");
            document.getElementById("nav-line").classList.add("hidden-line");
        }
        else {
            document.getElementById("nav-menu").classList.remove("hidden-nav");
            document.getElementById("nav-line").classList.remove("hidden-line");
        }

        navbar = !navbar;
    }
};