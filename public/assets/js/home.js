// Variables
const pinAutomaat = document.querySelector(".pin_automaat");
const pinDisplay = document.querySelector(".pin_display");
const pinNumbers = document.querySelectorAll(".pin_numbers");
const pinLetters = document.querySelectorAll(".pin_letters");
const pinClear = document.querySelector(".pin_clear");
const pinAccept = document.querySelector(".pin_accept");
const paymentAlert = document.querySelector(".automaat_alert");

////////// FUNCTIONS //////
// reset pin
function resetDisplay() {
  // set base value
  pinDisplay.textContent = "Selecteer product";
  // Enable letters
  pinLetters.forEach((letter) => (letter.disabled = false));
  // disable numbers
  pinNumbers.forEach((number) => (number.disabled = true));
  // disable accept button
  pinAccept.disabled = true;
}

// toggle active class
function toggleActiveClass(component, setActive = true) {
  if (setActive) {
    component.classList.add("active");
    component.classList.remove("inactive");
  } else {
    component.classList.add("inactive");
    component.classList.remove("active");
  }
}

// reset display
function resetPinAutomaat() {
  // remove classes / shrink component
  toggleActiveClass(pinAutomaat, false);

  // Disable all buttons
  pinLetters.forEach((letter) => (letter.disabled = true));
  pinNumbers.forEach((number) => (number.disabled = true));

  // reset display
  pinDisplay.textContent = "Selecteer product";
}

/////////////////////END FUNCTIONS///////////////////////////

// AUTOMAAT
// HANDLE PINAUTOMAAT
pinAutomaat.addEventListener("click", () => {
  if (!pinAutomaat.classList.contains("active")) {
    // add active class / remove inactive class  // grows component
    toggleActiveClass(pinAutomaat);

    // Enable letters
    pinLetters.forEach((letter) => (letter.disabled = false));
    // activate clear button
    pinClear.disabled = false;
  }
});

// shrink pinautomaat when clicking outside of component
document.addEventListener("click", (e) => {
  if (!pinAutomaat.contains(e.target)) {
    resetPinAutomaat();
  }
});

// HANDLE PIN LETTERS
pinLetters.forEach((letter) => {
  letter.addEventListener("click", (e) => {
    // set display to clicked letter
    pinDisplay.textContent = e.target.innerHTML;
    // disable all letters
    pinLetters.forEach((letter) => (letter.disabled = true));
    // Enable all numbers
    pinNumbers.forEach((numbers) => (numbers.disabled = false));
  });
});

//HANDLE PIN NUMBERS
pinNumbers.forEach((number) => {
  number.addEventListener("click", () => {
    // add number to letter
    pinDisplay.textContent += number.textContent;
    // Disable everything
    pinLetters.forEach((letter) => (letter.disabled = true));
    pinNumbers.forEach((number) => (number.disabled = true));
    // activate accept button when complete value is entered
    pinAccept.disabled = false;
  });
});

// RESET Display
pinClear.addEventListener("click", resetDisplay);

// HANDLE PAYMENT
pinAccept.addEventListener("click", (e) => {
  e.stopPropagation();
  // select QR code
  const paymentQrCode = document.querySelector(".kassa_qr-code");
  // bind selected values to var's
  let selectedVak = pinDisplay.value;
  let selectedDoor = document.querySelector(`#${selectedVak} .automaat_deur`);
  let selectedProduct = document.querySelector(
    `#${selectedVak} .automaat_product`
  );

  // als vak gevuld is open deur anders show error
  if (document.getElementById(selectedVak).dataset.value > 0) {
    // enlarge QR code
    paymentQrCode.classList.add("active");

    // reset pin automaat
    resetPinAutomaat();

    setTimeout(() => {
      window.alert(`Uw betaling is gelukt! Vak ${selectedVak} is nu open.`);
      // open door
      selectedDoor.classList.add("active");
      // show open lock when door is open
      selectedDoor.innerHTML = "\uD83D\uDD13";
      // shrink QR code
      paymentQrCode.classList.remove("active");

      // close door
      selectedProduct.addEventListener("click", () => {
        selectedDoor.classList.remove("active");
      });
    }, 2500);
  } else {
    // als geen voorraad, show error message + msg on display
    paymentAlert.classList.add("error");
    paymentAlert.textContent = "Vak bevat geen product!";
    pinDisplay.textContent = "Vak bevat geen product!";
    // remove error after set time
    setTimeout(() => {
      paymentAlert.classList.remove("error");
      resetDisplay();
    }, 2500);
  }
});

// HANDLE URL AFTER PAYMENT
document.addEventListener("DOMContentLoaded", () => {
  // Check of ?succes in de URL staat
  if (window.location.search.includes("succes")) {
    paymentAlert.classList.add("success"); // Fade-in

    // Na 2 seconden verwijderen
    setTimeout(() => {
      paymentAlert.classList.remove("success");
    }, 2500);

    // Verwijder ?succes uit de URL zonder te herladen
    const url = new URL(window.location);
    url.searchParams.delete("succes");
    window.history.replaceState({}, document.title, url);
  }
});
