//Gestion de la recherche avec un requête Ajax

window.onload = () => {
    const searchForm = document.querySelector('#searchForm');
    const searchFormSelect = document.querySelectorAll(".criteria");
  
    searchFormSelect.forEach(select => {
      select.addEventListener('change', async () => {
  
        const form = new FormData(searchForm);
        const params = new URLSearchParams();
  
        form.forEach((value, key) => {
          params.append(key, value);
        });
  
        const url = new URL(window.location.href);
          try {

            const response = await fetch(url.pathname + '?' + params.toString() + "&ajax=1", {

              headers: {
                "X-Requested-With": "XMLHttpRequest"
              }
            });

            const data = await response.json();
            const content = document.querySelector('#content');
            content.innerHTML = data.content;

            // Modifier l'URL dans l'historique de navigation
            const newUrl = url.pathname + '?' + params.toString();
            window.history.pushState({ url: newUrl }, '', newUrl);
          
          } catch (error) {
            console.log(error)
          }
        
      });
    });
  };