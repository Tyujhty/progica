// Ajout d'une classe active sur la label des filtres à la sélection

const labelsFilters = document.querySelectorAll('.labelFilter');
const checkboxFilters = document.querySelectorAll('.checkboxFilter');

labelsFilters.forEach(labelFilter => {
    labelFilter.addEventListener('mousedown', event => {
        event.preventDefault();

        labelFilter.classList.toggle('activeFilter');
    })
} )

//Si on revient sur la recherche ou que l'on effectue une recherche depuis shelter
checkboxFilters.forEach(checkboxFilter => {
    if(checkboxFilter.checked === true) {

        // récupère l'élément après la checkbox
        const label = checkboxFilter.nextElementSibling;
        label.classList.add('activeFilter');
    }
})