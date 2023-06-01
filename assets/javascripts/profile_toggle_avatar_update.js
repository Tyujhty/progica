//Toggle le menu de changement d'image de l'avatar

if (window.location.pathname.includes("/profile")) {

    const btnChangeAvatar = document.querySelector('.btnChangeAvatar');
    const formUpdateAvatar = document.querySelector('.formUpdateAvatar');

    if(btnChangeAvatar) {
        btnChangeAvatar.addEventListener('click', event => {
            if (btnChangeAvatar) {
                formUpdateAvatar.classList.toggle('hidden');
            }
        });

    }
}
