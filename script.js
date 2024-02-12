const sectionTemplate = document.getElementById("sectionTemplate");

function chargerPage(nomTemplate) {
    return fetch(nomTemplate)
        .then(response => {
            if (!response.ok) {
                throw new Error("Réponse réseau incorrecte");
            }
            return response.text();
        })
        .then(html => {
            // Insérez le contenu du template dans la section
            return html;
        })
        .catch(error => {
            console.error("Erreur lors du chargement du template :", error.message);
        });
}

const pages = {};

chargerPage("templates/admin.html")
  .then(html => {
    pages.admin= html;
    return chargerPage("templates/connexion.html");
  })
  .then(html => {
    pages.connexion= html;
    return chargerPage("templates/devoiler.html");
  })
  .then(html => {
    pages.devoiler= html;
    return chargerPage("templates/enAttente.html");
  })
  .then(html => {
    pages.enAttente= html;
    return chargerPage("templates/inscription.html");
  })
  .then(html => {
    pages.inscription= html;
    return chargerPage("templates/mail.html");
  })
  .then(html => {
    pages.mail= html;
    return chargerPage("templates/mdpOublie.html");
  })
  .then(html => {
    pages.mdpOublie= html;
    return chargerPage("templates/verifMail.html");
  })
  .then(html => {
    pages.verifMail= html;
    accueil();
  })
  .catch(error => console.error('Erreur lors du chargement des pages :', error));

function accueil(){
    connexion();
}

function connexion(){
    sectionTemplate.innerHTML = pages["connexion"];
    document.getElementById("mdpOublie").addEventListener("click", mdpOublie);
}

function mdpOublie(){
    sectionTemplate.innerHTML = pages["mdpOublie"];
}
