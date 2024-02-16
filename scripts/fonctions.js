function accueil(){
    if (lireCookie("utilisateur")){
        enAttente();
    }
    else {
        connexion();
    }
}  

function deconnexion(){
    supprimerCookie("utilisateur");
    connexion();
}

function verifIdentifiants(utilisateur){
    creerCookie("utilisateur", utilisateur);
    document.getElementById("deconnexion").style.display = "block";
    enAttente();
}

function creerCookie(key, value) {
    const cookieOptions = {
        path: '/',
        sameSite: 'Lax',
        expires: 0
    };

    const cookieString = `${key}=${value}; ${Object.entries(cookieOptions).map(([k, v]) => `${k}=${v}`).join('; ')}`;
    document.cookie = cookieString;
}

function lireCookie(key) {
    const cookies = document.cookie.split("; ").map(cookie => cookie.split("="));
    const cookie = cookies.find(cookie => cookie[0] === key);
    return cookie ? cookie[1] : null;
}

function supprimerCookie(key) {
    document.cookie = `${key}=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;`;
}
