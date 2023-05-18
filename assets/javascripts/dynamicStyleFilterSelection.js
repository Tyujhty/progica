// Ajout d'une classe active sur la label des filtres à la sélection

const labelsFilters = document.querySelectorAll('.labelFilter');

labelsFilters.forEach(labelFilter => {
    labelFilter.addEventListener('mousedown', event => {
        event.preventDefault();

        labelFilter.classList.toggle('activeFilter');
    })
} )