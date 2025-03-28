function lancerTirage(){
    fetch("../fonctions/lancerTirage.php")
    .then(response => {
        if (!response.ok) {
            throw new Error(`Erreur HTTP : ${response.status}`);
        }
        window.location.reload();
    })
    .catch(error => {
        console.error('Erreur lors du tirage :', error);
    });
}

function annulerTirage(){
    fetch("../fonctions/annulerTirage.php")
    .then(response => {
        if (!response.ok) {
            throw new Error(`Erreur HTTP : ${response.status}`);
        }
        window.location.reload();
    })
    .catch(error => {
        console.error('Erreur lors du tirage :', error);
    });
}

function banDeban(pseudo){
    // Préparer les données au format POST
    const data = new FormData();
    data.append("pseudo", pseudo);

    // Envoi de la requête POST
    fetch("../fonctions/bannirDebannir.php", {
        method: "POST",
        body: data, // FormData gère l'encodage
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`Erreur HTTP : ${response.status}`);
        }
        document.getElementById("ban" + pseudo).textContent = 
            (document.getElementById("ban" + pseudo).textContent == "Bannir")? 
            "Débannir" : "Bannir";
    })
    .catch(error => {
        console.error('Erreur lors du bannissement / débanissement :', error);
    });
}

function inscrire(pseudo, mdp, mail) {
    // Préparer les données au format POST
    const data = new FormData();
    data.append("pseudo", pseudo);
    data.append("mdp", mdp);
    data.append("mail", mail);

    // Envoi de la requête POST
    fetch("../fonctions/inscrire.php", {
        method: "POST",
        body: data, // FormData gère l'encodage
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`Erreur HTTP : ${response.status}`);
        }
        return response.text();
    })
    .then(result => {
        if (result === "true") {
            console.log("Inscription réussie !");
        } else {
            console.log("Inscription échouée :", result);
        }
    })
    .catch(error => {
        console.error("Erreur lors de l'inscription :", error);
    });
}

function supprimerUtilisateur(pseudo) {
    // Préparer les données au format POST
    const data = new FormData();
    data.append("pseudo", pseudo);

    // Envoi de la requête POST
    fetch("../fonctions/supprimerUtilisateur.php", {
        method: "POST",
        body: data, // FormData gère l'encodage
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`Erreur HTTP : ${response.status}`);
        }
        return response.text();
    })
    .then(result => {
        if (result === "true") {
            console.log("Suppression réussie !");
        } else {
            console.log("Suppression échouée :", result);
        }
    })
    .catch(error => {
        console.error("Erreur lors de la suppression :", error);
    });
}

function fermerBL() {
    document.getElementById('fenetreBL').className = 'invisible';
}

window.onclick = function(event) {
	if (event.target.id == 'fenetreBL') {
		fermerBL();
	}
}

function ouvrirBL(pseudo) {
    // Préparer les données au format POST
    const data = new FormData();
    data.append("pseudo", pseudo);
    
    // Envoi de la requête POST
    fetch("../fonctions/tblBlackList.php", {
        method: "POST",
        body: data, // FormData gère l'encodage
    })
    .then(response => response.text())
    .then(tblBlackList => {
        document.getElementById('titreBL').innerText = "BlackList de " + pseudo;
        document.getElementById('tblBlackList').innerHTML = tblBlackList;
        document.getElementById('fenetreBL').className = '';
    })
    .catch(error => {
        console.error("Erreur lors de l'ouverture de la blacklist :", error);
    });
}

function modifBL(pseudoBL, pseudo){
    // Préparer les données au format POST
    const data = new FormData();
    data.append("pseudoBL", pseudoBL);
    data.append("pseudo", pseudo);

    // Envoi de la requête POST
    fetch("../fonctions/modifBL.php", {
        method: "POST",
        body: data, // FormData gère l'encodage
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`Erreur HTTP : ${response.status}`);
        }
        ouvrirBL(pseudoBL);
    })
    .catch(error => {
        console.error('Erreur lors du bannissement / débanissement :', error);
    });
}
