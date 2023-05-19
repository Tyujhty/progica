// Gestion responsive de la searchbar

const btnToggleSearch = document.querySelector('.btn-search');
const ctnSearch = document.querySelector('#container-search');
const closeBtnSearch = document.querySelector('.fa-circle-xmark');

btnToggleSearch.addEventListener('click', Event => {
    Event.preventDefault();

    ctnSearch.classList.remove('hidden');
    ctnSearch.classList.toggle('searchBarActive');
})

closeBtnSearch.addEventListener('click', Event => {
    Event.preventDefault();

    ctnSearch.classList.toggle('searchBarActive');
    ctnSearch.classList.add('hidden');
})