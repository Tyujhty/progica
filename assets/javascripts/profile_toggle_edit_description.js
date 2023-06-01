//affichage du input d'édition de la description

if (window.location.pathname.includes("/profile")) {

    const btnEditDescription = document.querySelector('.editDesc');
    const fieldDescContainer = document.querySelector('.userDescContainer');
    const formDescField = document.querySelector('.editFormRow')

    if(btnEditDescription) {
        btnEditDescription.addEventListener('click', event => {
    
            fieldDescContainer.classList.toggle('hidden');
            formDescField.classList.toggle('hidden');
        })
    }
    
    
}