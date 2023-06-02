const btnFiltersResponsive = document.querySelector(".fa-sliders");
const filtersContainerResponsive = document.querySelector('#filters')
const btnCloseFilterResponsive = document.querySelector('.btnCloseResponsive')

if(btnCloseFilterResponsive && btnCloseFilterResponsive) {
    btnFiltersResponsive.addEventListener('click', event => {
        
        filtersContainerResponsive.classList.toggle('hidden');
    })
    
    btnCloseFilterResponsive.addEventListener('click', event => {
        filtersContainerResponsive.classList.toggle('hidden');
    })

}
