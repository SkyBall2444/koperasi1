document.getElementById("loginForm").addEventListener("submit", function(e) {
    e.preventDefault();

    // Username dan password statis (contoh)
    const validUser = "admin";
    const validPass = "12345";

    const username = document.getElementById("username").value.trim();
    const password = document.getElementById("password").value.trim();

    if (username === validUser && password === validPass) {
        // Simpan status login ke sessionStorage
        sessionStorage.setItem("loggedIn", "true");

        // Redirect ke dashboard (index.html)
        window.location.href = "index.html";
    } else {
        document.getElementById("loginError").style.display = "block";
    }
});
