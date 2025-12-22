const forms = document.querySelectorAll("form");
const productFilter = document.getElementById("product_filter") ?? null;
const statisticsFilter = document.getElementById("statistics_filter") ?? null;
// //////////////////
// FILTER WITH SELECT FORM
/////////////////////
function filterWithSelect(filter) {
  filter.addEventListener("change", function () {
    this.form.submit();
  });
}

// filter Product page select

if (productFilter) {
  filterWithSelect(productFilter);
}
if (statisticsFilter) {
  filterWithSelect(statisticsFilter);
}

// //////////////////
// HANDLE FORM
//////////////////////
// loop through all forms

forms.forEach((form) => {
  // select all inputs + textarea
  const fields = form.querySelectorAll("input, textarea");

  ////// FUNCTIONS ///////
  function validateField(field) {
    // grab error message
    const errorMessage = field.parentElement.querySelector(".error_message");

    if (!errorMessage) return true;
    // input not valid show error
    if (!field.value) {
      errorMessage.textContent = "Dit veld is verplicht";
      field.classList.add("error");
      return false;
    } else if (!field.validity.valid) {
      // error based on data-error set in html on the input
      errorMessage.textContent = field.dataset.error;
      field.classList.add("error");
      return false;
    }

    // remove error message if true
    errorMessage.textContent = "";
    return true;
  }

  // remove red line after input is valid
  form.querySelectorAll("input, textarea").forEach((field) => {
    field.addEventListener("blur", () => {
      validateField(field);
    });
    field.addEventListener("input", () => {
      validateField(field);
    });
  });

  /////// FORM ///////
  form.addEventListener("submit", function (e) {
    let isValid = true;

    // Loop through all fields
    fields.forEach((field) => {
      const fieldValid = validateField(field);

      if (!fieldValid) {
        isValid = false;
      }
    });

    // check for mistakes, if not = add e.preventDefault()
    // this prevents buggs with multiple form
    if (!isValid) {
      // blokkeer submit als er fouten zijn
      form.querySelector(":invalid")?.focus();

      e.preventDefault();
      return;
    }

    // Target contact form because i'm not handeling the form
    if (form.id === "contactForm") {
      // submit form
      /*
    ik zou hier bij een echte website een link maken naar de email van de boerderij, 
    zodat het bericht gelijk wordt ge-mailed naar de boerderij. Maar dit vind ik 
    persoonlijk buiten de scope van het project vallen.
    */

      // reset form + return home
      form.reset();
      window.location.href = "/";
    }
  });
});
