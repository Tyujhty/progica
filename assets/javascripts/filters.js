const btnFilter = document.querySelector('.btn-filter');
const ctnFilters = document.querySelector('.filters');

btnFilter.addEventListener('click', (event) => {
    event.preventDefault();

    console.log(ctnFilters.className)

    if (ctnFilters.classList.contains("hidden")) {
        ctnFilters.classList.remove("hidden");
        ctnFilters.classList.add("flex");
    } else {
        ctnFilters.classList.remove("flex");
        ctnFilters.classList.add("hidden");
    }
} )