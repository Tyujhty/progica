// Gestion responsive de la searchbar

const btnToggleSearch = document.querySelector('.search-btn');
const ctnSearch = document.querySelector('#container-search');
const closeBtnSearch = document.querySelector('.fa-circle-xmark');

if (btnToggleSearch) {
    btnToggleSearch.addEventListener('click', Event => {
        Event.preventDefault();
    
        ctnSearch.classList.remove('hidden');
        ctnSearch.classList.toggle('searchBarActive');
    })
    
}

if (closeBtnSearch) {
    closeBtnSearch.addEventListener('click', Event => {
        Event.preventDefault();
    
        ctnSearch.classList.toggle('searchBarActive');
        ctnSearch.classList.add('hidden');
    })
    
}