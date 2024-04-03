console.log(window.location.href);

if (["admin.php", "devoiler.php", "enAttente.php"].some(page => window.location.href.includes(page))) {
    document.getElementById("deconnexion").style.display = "block";
}

function connexion(){
    event.preventDefault();
    const data = new FormData(document.getElementById("connexion"));
    fetch("../scripts/verifIdentifiants.php", {
        method: "POST",
        body: data
    })
    .then(response => response.text())
    .then(result => {
        if (result == "true") {
            window.location.href = "../index.php";
        }
        else {
            document.getElementById("incorrect").style.display = "block";
        }
    })
    .catch(error => {
        console.error(error);
    });
}

function deconnexion() {
    fetch("../scripts/deconnecter.php")
    .then(response => {
    if (!response.ok) {
        throw new Error(`Erreur HTTP : ${response.status}`);
    }
    return response.text();
    })
    .then(() => {
    window.location.href = "../index.php";
    })
    .catch(error => {
    console.error('Erreur lors de la déconnexion :', error);
    });
}

function inscription(){
    event.preventDefault();
    const data = new FormData(document.getElementById("inscription"));
    fetch("../scripts/identifiantsUniques.php", {
        method: "POST",
        body: data
    })
    .then(response => response.text())
    .then(result => {
        if (result == "false") {
            document.getElementById("incorrect").style.display = "block";
            return;
        }
    })
    .catch(error => {
        console.error(error);
    });
    fetch("../scripts/envoyerMail.php", {
        method: "POST",
        body: data
    })
    .then(response => response.text())
    .then(result => {
        if (result == "true") {
            document.getElementById("mailEnvoye").style.display = "block";
        }
        else if (result == "false") {
            document.getElementById("mailIncorrect").style.display = "block";
        }
    })
    .catch(error => {
        console.error(error);
    });
}