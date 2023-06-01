import { validationDateConstraints } from './validator_date_constraints';

const startDateInput = document.querySelector("#search_start");
const endDateInput = document.querySelector("#search_end");

startDateInput.addEventListener('change', () => {
    validateDateRange();
})
endDateInput.addEventListener('change', () => {
    validateDateRange();
})

function validateDateRange() {
    if (!validationDateConstraints(startDateInput, endDateInput)) {

    }
}