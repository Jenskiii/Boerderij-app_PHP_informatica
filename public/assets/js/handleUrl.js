const messageAlert = document.querySelector(".alert_box");

// HANDLE URL AFTER CHANGE
document.addEventListener("DOMContentLoaded", () => {
  // Check of ?succes in de URL staat
  if (window.location.search.includes("success")) {
    messageAlert.classList.add("success");

    // Na 3 seconden verwijderen
    setTimeout(() => {
      messageAlert.classList.remove("success");
    }, 2750);
  }

  // Check of ?error in de URL staat
  if (window.location.search.includes("error")) {
    messageAlert.classList.add("error");

    // Na 3 seconden verwijderen
    setTimeout(() => {
      messageAlert.classList.remove("error");
    }, 2750);
  }

  // Verwijder ? uit de URL zonder te herladen
  const url = new URL(window.location);
  url.searchParams.delete("success");
  window.history.replaceState({}, document.title, url);
});
