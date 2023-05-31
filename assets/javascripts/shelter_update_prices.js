const url = new URL(window.location.href);

if (url.pathname.includes("/shelter/")) {
    window.onload = () => {
        const pickerDateForm = document.querySelector("#pickerDiv");
        const formPickerDateInputs = document.querySelectorAll(".datePicker");
    
        formPickerDateInputs.forEach(input => {
    
            input.addEventListener('change', async () => {
    
                const formDatePicker = new FormData(pickerDateForm );
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
                  console.log(error)
                }
            })
        })
    }
}

