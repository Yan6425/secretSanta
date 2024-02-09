const sectionTemplate = document.getElementById("sectionTemplate");

function changerPage(nomTemplate) {
    fetch(nomTemplate + ".html")
    .then(response => {
        if (!response.ok) {
            throw new Error("Réponse réseau incorrecte");
        }
        return response.text();
    })
    .then(html => {
        // Insérez le contenu du template dans la section
        sectionTemplate.innerHTML = html;
    })
    .catch(error => {
        console.error("Erreur lors du chargement du template :", error.message);
    });
}

changerPage("templates/connexion");

function mdpOublie(){
    changerPage("mdpOublie");
}