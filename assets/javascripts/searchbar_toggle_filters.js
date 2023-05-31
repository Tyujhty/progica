
// Gestion de l'ouverture du volet filtre
const btnFilter = document.querySelector('.btn-filter');
const ctnFilters = document.querySelector('#filters');

if (btnFilter && ctnFilters) {
  btnFilter.addEventListener('click', (event) => {
    event.preventDefault();

    ctnFilters.classList.toggle('hidden');

    if (ctnFilters.classList.contains('hidden')) {
      btnFilter.innerHTML = '<i class="fa-solid fa-plus text-xl"></i> de filtres';
    } else {
      btnFilter.innerHTML = '<i class="fa-solid fa-minus text-xl"></i> de filtres';
    }
  });
}

