async function boutonAnnulerTirage() {
    await annulerTirage();
    window.location.reload();
}

async function annulerTirage(){
    await fetch("../fonctions/annulerTirage.php")
    .then(response => {
        if (!response.ok) {
            throw new Error(`Erreur HTTP : ${response.status}`);
        }
    })
    .catch(error => {
        console.error('Erreur lors du tirage :', error);
    });
}

async function boutonLancerTirage() {
    await annulerTirage();
    await lancerTirage();
    window.location.reload();
}

async function lancerTirage(){
    await annulerTirage();
    await fetch("../fonctions/lancerTirage.php")
    .then(response => {
        if (!response.ok) {
            throw new Error(`Erreur HTTP : ${response.status}`);
        }    
    })    
    .catch(error => {
        console.error('Erreur lors du tirage :', error);
    });    
}    

function ouvrirFenetreInscrire(){
    document.getElementById("fenetreInscrire").className = "fenetre";
}

async function formInscrire(){
    event.preventDefault();
    const data = new FormData(document.getElementById("formInscrire"));
    const pseudo = data.get('pseudo');
    const mdp = data.get('mdp');
    const mail = data.get('mail');
    const boolPseudoValide = await pseudoValide(pseudo);
    const boolMdpValide = await mdpValide(mdp);
    
    if (boolPseudoValide && boolMdpValide){
        inscrire(pseudo, mdp, mail);
    }
    else {
        console.log("Problème rencontré lors de la vérification du pseudo ou du mot de passe.")
    }
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
            window.location.reload();
        } else {
            console.error("Inscription échouée :", result);
        }
    })
    .catch(error => {
        console.error("Erreur lors de l'inscription :", error);
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
        window.location.reload();
    })
    .catch(error => {
        console.error('Erreur lors du bannissement / débanissement :', error);
    });
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
        document.getElementById('fenetreBL').className = "fenetre";
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

function fenetreMdp(pseudo) {
    document.getElementById("fenetreMdp").className = "fenetre";
    document.getElementById("titreMdp").textContent = "Entrez le nouveau mot de passe pour " + pseudo;
    document.getElementById("confirmerMdp").onclick = () => formMdp(pseudo);
}

async function formMdp(pseudo){
    event.preventDefault();
    const data = new FormData(document.getElementById("formMdp"));
    const mdp = data.get("mdp");
    const boolMdpValide = await mdpValide(mdp);
    
    if (boolMdpValide) {
        changerMdp(pseudo, mdp);
    }
    else {
        console.log("Mot de passe trop commun ou erreur innatendue.")
    }
}

function changerMdp(pseudo, mdp) {
    // Préparer les données au format POST
    const data = new FormData(document.getElementById("formMdp"));
    data.append("pseudo", pseudo);
    data.append("mdp", mdp);
    
    // Envoi de la requête POST
    fetch("../fonctions/changerMdp.php", {
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
            window.location.reload();
        } else {
            console.error("Changement de mot de passe échoué :", result);
        }
    })
    .catch(error => {
        console.error("Erreur lors du changement :", error);
    });
}

function fenetreSupprimer(pseudo) {
    document.getElementById("fenetreSupprimer").className = "fenetre";
    document.getElementById("titreSupprimer").textContent = "Êtes-vous sûr de supprimer " + pseudo;
    document.getElementById("confirmerSupprimer").onclick = () => supprimerUtilisateur(pseudo);
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
            window.location.reload();
        } else {
            console.error("Suppression échouée :", result);
        }
    })
    .catch(error => {
        console.error("Erreur lors de la suppression :", error);
    });
}

function fermerFenetre(id) {
    document.getElementById(id).className = "invisible";
}

window.onclick = function(event) {
    if (event.target.className == "fenetre") {
        fermerFenetre(event.target.id);
    }
}

function activer(pseudo){
    // Préparer les données au format POST
    const data = new FormData();
    data.append("pseudo", pseudo);
    
    // Envoi de la requête POST
    fetch("../fonctions/activer.php", {
        method: "POST",
        body: data, // FormData gère l'encodage
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`Erreur HTTP : ${response.status}`);
        }
        window.location.reload();
    })
    .catch(error => {
        console.error("Erreur lors de l'activation de l'utilisateur :", error);
    });
}