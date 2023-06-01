import { validationDateConstraints } from './validator_date_constraints';

const url = new URL(window.location.href);


if (url.pathname.includes("/shelter/")) {
  window.onload = () => {
    const pickerDateForm = document.querySelector("#pickerDiv");
    const formPickerDateInputs = document.querySelectorAll(".datePicker");
    const startDateInput = pickerDateForm.querySelector("#search_start");
    const endDateInput = pickerDateForm.querySelector("#search_end");
    
    formPickerDateInputs.forEach(input => {
      input.addEventListener('change', async (event) => {
        
        event.stopPropagation();

        if (validationDateConstraints(startDateInput, endDateInput)) {
          
          const formDatePicker = new FormData(pickerDateForm);
          const params = new URLSearchParams();

          formDatePicker.forEach((value, key) => {
            params.append(key, value);
          });

          try {
            const response = await fetch(url.pathname + '?' + params.toString() + "&ajax=1", {
              headers: {
                "X-Requested-With": "XMLHttpRequest"
              }
            });

            const data = await response.json();
            const contentDateSearch = document.querySelector('#contentDateSearch');
            contentDateSearch.innerHTML = data.content;
          } catch (error) {
            console.log(error);
          }
        }
      });
    });
  };
}
