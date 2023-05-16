const url = new URL(window.location.href);

if (url.pathname.includes("/gite/")) {
    window.onload = () => {
        const pickerDateForm = document.querySelector("#pickerDiv");
        const formPickerDateInputs = document.querySelectorAll(".datePicker");
    
        formPickerDateInputs.forEach(input => {
    
            input.addEventListener('change', () => {
    
                const formDatePicker = new FormData(pickerDateForm );
                const params = new URLSearchParams();
    
                formDatePicker.forEach((value, key) => {
                    params.append(key, value);
                });

                fetch(url.pathname + '?' + params.toString() + "&ajax=1", {
                    headers: {
                      "X-Requested-With": "XMLHttpRequest"
                    }
                  })
                  .then(response => response.json())
                  .then(data => {
                    const contentDateSearch = document.querySelector('#contentDateSearch');
                    contentDateSearch.innerHTML = data.content;
                  })
                  .catch(e => alert(e));

            })
        })
    }
}

