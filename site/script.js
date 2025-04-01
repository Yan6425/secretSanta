console.log(window.location.href);

if (["admin.php", "devoiler.php", "enAttente.php"].some(page => window.location.href.includes(page))) {
    document.getElementById("deconnexion").style.display = "block";
}

function connexion(){
    event.preventDefault();
    const data = new FormData(document.getElementById("connexion"));
    fetch("../fonctions/verifIdentifiants.php", {
        method: "POST",
        body: data
    })
    .then(response => response.text())
    .then(result => {
        if (result == "true") {
            window.location.href = "../index.php";
        }
        else {
            document.getElementById("incorrect").className = "invalide";
        }
    })
    .catch(error => {
        console.error(error);
    });
}

function deconnexion() {
    fetch("../fonctions/deconnecter.php")
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

async function pseudoValide(pseudo){
    const data = new FormData();
    data.append("pseudo", pseudo);
    const response = await fetch("../fonctions/pseudoValide.php", {
        method: "POST",
        body: data
    });
    return await response.text() === "true";
}

async function mdpValide(mdp) {
    const data = new FormData();
    data.append("mdp", mdp);
    const response = await fetch("../fonctions/mdpValide.php", {
        method: "POST",
        body: data
    });
    return await response.text() === "true";
}

async function inscription(){
    event.preventDefault();
    const data = new FormData(document.getElementById("inscription"));
    document.getElementById("mdpIncorrect").className = "invisible";
    document.getElementById("pseudoIncorrect").className = "invisible";
    document.getElementById("mailIncorrect").className = "invisible";
    const boolPseudoValide = await pseudoValide(data.get("pseudo"));
    const boolMdpValide = await mdpValide(data.get("mdp"));
    
    if (!boolPseudoValide){
        document.getElementById("pseudoIncorrect").className = "invalide";
    }
    if (!boolMdpValide){
        document.getElementById("mdpIncorrect").className = "invalide";
    }
    if (boolPseudoValide && boolMdpValide){
        fetch("../fonctions/envoyerMail.php", {
            method: "POST",
            body: data
        })
        .then(response => response.text())
        .then(result => {
            if (result === "true") {
                document.getElementById("mailEnvoye").className = "valide";
            }
            else if (result === "false") {
                document.getElementById("mailIncorrect").className = "invalide";
            }
        })
        .catch(error => {
            console.error(error);
        });
    }
}

