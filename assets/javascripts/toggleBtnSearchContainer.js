if (window.location.pathname.includes("/shelter")) {

    const btnNewSearch = document.querySelector('.btnNewSearch');
    const btnSearchContainer= document.querySelector('.btnSearchContainer');
    const formSearchContainer = document.querySelector('.formSearchContainer');
    const btnCloseNewSearch = document.querySelector('.cancelSearch')

    btnNewSearch.addEventListener('click', event => {
        if (btnNewSearch) {
            btnSearchContainer.classList.toggle('hidden');
            formSearchContainer.classList.toggle('hidden');
        }
    });

    btnCloseNewSearch.addEventListener('click', event => {
        if (btnCloseNewSearch) {
            btnSearchContainer.classList.toggle('hidden');
            formSearchContainer.classList.toggle('hidden');
        }
    })
}