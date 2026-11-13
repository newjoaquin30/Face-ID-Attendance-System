document.getElementById("chck").addEventListener("change", e => {
    document.getElementById("password").type = e.target.checked ? "text" : "password";
})