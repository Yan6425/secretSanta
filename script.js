if (window.location.href == "pages/connexion.php"){
    const form = document.getElementById("connexion");
    form.addEventListener("submit", event => {
        console.log("bouton cliqué");
        event.preventDefault();
        const data = new FormData(event.target);
        console.log(data);
        fetch("scripts/verifIdentifiants.php", {
            method: "POST",
            body: data
        })
        .then(response => response.text())
        .then(result => {
            console.log(result);
            if (result == "true") {
                window.location.href = "pages/index.php";
            }
            else {
                document.getElementById("incorrect").style.display = "block";
            }
        })
        .catch(error => {
            console.error(error);
        });
    });
}