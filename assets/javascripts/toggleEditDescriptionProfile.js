if (window.location.pathname.includes("/profile")) {

    const btnEditDescription = document.querySelector('.editDesc');
    const fieldDescContainer = document.querySelector('.userDescContainer');
    const formDescField = document.querySelector('.editFormRow')
    
    btnEditDescription.addEventListener('click', event => {

        fieldDescContainer.classList.toggle('hidden');
        formDescField.classList.toggle('hidden');
    })
    
}