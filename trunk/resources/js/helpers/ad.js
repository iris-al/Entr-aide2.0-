/*  la fonction registerUser   */
export function addAnnonce(ads){
    return new Promise((res,rej)=>{
        axios.post('/api/ads/annonce', ads)
        .then(response => {
            res(response.data);
        })
        .catch(err => {
            rej('Une erreur est survenue lors de l\'insertion de l annonce, veuillez réessayer');
        })
    })
}

export function putAnnonce(ads){
    return new Promise((res,rej)=>{
        axios.put('/api/ads/updateannonce/'+ads.id, ads)
        .then(response => {
            res(response.data);
        })
        .catch(err => {
            rej('Une erreur est survenue lors de la modification de l annonce, veuillez réessayer');
        })
    })
}
export function affAnnonce(){
    return new Promise((res,rej)=>{
        axios.get('/api/ads/annonces')
        .then(response => {
            res(response.data.ads.data);
        })
        .catch(err => {
            rej('Une erreur est survenue lors de l\'affichage de l annonce, veuillez réessayer');
        })
    })
}

export function RechAnnonce(search){
    return new Promise((res,rej)=>{
        axios.post('/api/ads/search', search)
        .then(response => {
            res(response);
        })
        .catch(err => {
            rej('Une erreur est survenue lors de la recherche de l annonce, veuillez réessayer');
        })
    })
}
export function putlike(ads){
    return new Promise((res,rej)=>{
        axios.put('/api/ads/updateCount/'+ads.id, ads)
        .then(response => {
            res(response.data);
        })
        .catch(err => {
            rej('Une erreur est survenue lors de la modification des remerciements, veuillez réessayer'+err);
        })
    })
}