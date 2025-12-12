document.getElementById("loginForm").addEventListener("submit", function(e){
    e.preventDefault();

    let email = document.getElementById("email").value.trim();
    let password = document.getElementById("password").value.trim();

    if(email === "" || password === ""){
        alert("Please fill all fields");
        return;
    }

    if(email === "admin@gmail.com" && password === "admin123"){
        alert("Login Successful!");
        window.location.href = "../dashboard/index.html";
    } else {
        alert("Invalid Credentials!");
    }
});
