
// Gestion de l'ouverture du volet filtre
const btnFilter = document.querySelector('.btn-filter');
const ctnFilters = document.querySelector('#filters');

if(btnFilter && ctnFilters ) {
  btnFilter.addEventListener('click', (event) => {
      event.preventDefault();

      ctnFilters.classList.toggle('hidden');
  
  })
}
