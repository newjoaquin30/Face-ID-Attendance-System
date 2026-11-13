const now = new Date();
const monthArrays = ["January", "February", "March", "April", "May", 
                     "June", "July", "August", "September", "October",
                     "November", "December"];
const month = monthArrays[now.getMonth()];
const year = now.getFullYear();
const monthYear = document.getElementById("month-year").innerHTML = `${month} ${year}`;