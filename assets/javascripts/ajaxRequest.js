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
  
        // Exclure l'URL "/shelter/" de la requête Ajax
        if (!url.pathname.includes("/shelter/")) {
  
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