// Gestion du menu burger en responsive

const btnBurger = document.querySelector('.fa-bars');
const menuContainer = document.querySelector('.menuBurger');
const appContentContainer = document.querySelector('.app-content');

btnBurger.addEventListener('click', event => {
    event.preventDefault();

    menuContainer.classList.toggle('hidden');
})

appContentContainer.addEventListener('click', event =>{
    
    if(!menuContainer.classList.contains('hidden')) {
        menuContainer.classList.toggle('hidden');
    }
})