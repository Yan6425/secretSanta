function lancerTirage(){
    fetch("../scripts/lancerTirage.php")
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
    fetch("../scripts/annulerTirage.php")
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