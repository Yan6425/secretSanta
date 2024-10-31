function lancerTirage(){
    fetch("../fonctions/lancerTirage.php")
    .then(response => {
    if (!response.ok) {
        throw new Error(`Erreur HTTP : ${response.status}`);
    }
    return response.text();
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
    return response.text();
    })
    .catch(error => {
    console.error('Erreur lors du tirage :', error);
    });
}