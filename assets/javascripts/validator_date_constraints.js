export function validationDateConstraints(startDateInput, endDateInput) {
  
    const errorContainter = document.querySelector('.error_date_message');
  
    if ((startDateInput.value) && (endDateInput.value) && (startDateInput.value > endDateInput.value)) {
      
      errorContainter.classList.remove('hidden');
      const temp = startDateInput.value;
      startDateInput.value = endDateInput.value;
      endDateInput.value = temp;
  
      setTimeout(() => {
        errorContainter.classList.add('hidden');
      }, 3000); 
      return false;
    }
    return true; // Les contraintes sont valides
}