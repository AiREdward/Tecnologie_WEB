navbar = false;
window.onload=function(){
    document.getElementById("togglenav").onclick=function(){
        if(navbar){
            document.getElementById("navmenu").classList.add("closednav");
        }
        else{
            document.getElementById("navmenu").classList.remove("closednav");
        }
        navbar = !navbar;
    }
};