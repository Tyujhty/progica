
// Gestion de l'ouverture du volet filtre
const btnFilter = document.querySelector('.btn-filter');
const ctnFilters = document.querySelector('#filters');

btnFilter.addEventListener('click', (event) => {
    event.preventDefault();

    if (ctnFilters.classList.contains("hidden")) {
        ctnFilters.classList.remove("hidden");
        ctnFilters.classList.add("flex");
    } else {
        ctnFilters.classList.remove("flex");
        ctnFilters.classList.add("hidden");
    }
})


//Gestion de la recherche avec un requête Ajax

window.onload = () => {
  const searchForm = document.querySelector('#searchForm');
  const searchFormSelect = document.querySelectorAll(".criteria");

  searchFormSelect.forEach(select => {
    select.addEventListener('change', () => {

      const form = new FormData(searchForm);
      const params = new URLSearchParams();

      form.forEach((value, key) => {
        params.append(key, value);
      });

      const url = new URL(window.location.href);

      // Exclure l'URL "/gite/" de la requête Ajax
      if (!url.pathname.includes("/gite/")) {
        fetch(url.pathname + '?' + params.toString() + "&ajax=1", {
          headers: {
            "X-Requested-With": "XMLHttpRequest"
          }
        })
        .then(response => response.json())
        .then(data => {
          const content = document.querySelector('#content');
          content.innerHTML = data.content;
        })
        .catch(e => alert(e));
      }
    });
  });
};