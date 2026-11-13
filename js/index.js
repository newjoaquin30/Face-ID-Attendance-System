const nav = document.getElementById("navbar");

function fixedNav(){
    if(window.scrollY > 60){
        nav.classList.add("scroll");
    }else{
        nav.classList.remove("scroll");
    }
}

window.addEventListener("scroll", fixedNav);

function openNav(){
    const link = document.getElementById("nav-links");
    if(link.style.left === "-10%"){
        link.style.left = "-120%";
    }else{
        link.style.left = "-10%";
    }
}