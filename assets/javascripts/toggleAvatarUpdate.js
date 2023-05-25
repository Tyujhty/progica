//Toggle le menu de changement d'image de l'avatar

const btnChangeAvatar = document.querySelector('.btnChangeAvatar');
const formUpdateAvatar = document.querySelector('.formUpdateAvatar');


btnChangeAvatar.addEventListener('click', event => {

    if(btnChangeAvatar) {
        formUpdateAvatar.classList.toggle('hidden')
    }
})