export function login(credentials) {
    return new Promise((res, rej) => {
        axios.post('/api/auth/login', credentials)
            .then((response) => {
                res(response.data);
            })
            .catch(err =>{
                rej("Email ou mot de passe incorrects");
            })
    })
}
/*  la fonction registerUser   */
export function registerUser(user){
    return new Promise((res,rej)=>{
        axios.post('/api/auth/register', user)
        .then(response => {
            res(response.data);
        })
        .catch(err => {
            rej('Une erreur est survenue lors de l\'inscription, veuillez réessayer');
        })
    })
}
export function updateprofileuser(user){
    return new Promise((res,rej)=>{
        axios.post('/api/auth/updateuser', user)
        .then(response => {
            res(response.data);
        })
        .catch(err => {
            rej('Une erreur est survenue lors de la modification de votre profil, veuillez réessayer');
        })
    })
}

export function changePassword(password){
    return new Promise ((res,rej)=>{
        axios.post('api/auth/changePassword',password)
        .then(response => {
            res(response.data);
        })
        .catch(err => {
            rej('Une erreur est survenue lors du changement du mot de passe, veuillez réessayer');
        })
    })
}
export function deleteProfilUser(user){
    return new Promise((res,rej)=>{
        axios.post('/api/auth/deleteuser', user)
        .then(response => {
            res(response.data);
        })
        .catch(err => {
            rej('Une erreur est survenue lors de la suppression de votre profil, veuillez réessayer');
        })
    })
}
 /*getLocalUser sert à ne pas perdre le user quand on rafresh la page par exemple et 
 donc à ne pas devoir se reloger ,on va donc prendre le user en le "stringify" et on 
 le met dans le local storage ; quand on refresh on check si on a cette key ou pas */
export function getLocalUser() {
    const userStr = localStorage.getItem("user");

    if(!userStr) {
        return null;
    }  
    return JSON.parse(userStr);
}