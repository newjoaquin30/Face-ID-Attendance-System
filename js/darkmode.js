function getInitialTheme() {
    const saved = localStorage.getItem("theme");
    if (saved) return saved;
    return window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
}
 
let theme = getInitialTheme();
const themeToggle = document.getElementById("dark");
 
function applyTheme() {
    if (theme === "light") {
        document.body.classList.add("darkmode");
    } else {
        document.body.classList.remove("darkmode");
    }
    themeToggle.checked = theme === "light";
    localStorage.setItem("theme", theme);
    
   themeToggle.addEventListener("change", () => {
       theme = theme === "light" ? "dark" : "light";
       applyTheme();
   });
}
 
applyTheme();