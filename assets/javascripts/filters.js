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
})

window.onload = () => {
    const searchForm = document.querySelector('#searchForm');
    const searchFormSelect = document.querySelectorAll("#searchForm select");

    searchFormSelect.forEach(select => {
        select.addEventListener('change', () => {

            const Form = new FormData(searchForm)

            const Params = new URLSearchParams()
            Form.forEach((value, key) => {
                Params.append(key, value)
            })

            const Url = new URL(window.location.href)
            
            fetch(Url.pathname + '?' + Params.toString() + "&ajax=1", {
                headers: {
                    "x-Requested-with": "XMLHttpRequest"
                }
            }).then(response => 
                response.json()
            ).then(data => {
                const content = document.querySelector('#content')
                content.innerHTML = data.content;
        })
            .catch(e => alert(e))
        }) 
    })
}