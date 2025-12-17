const modal = document.getElementById("addProductModal");
const openBtn = document.getElementById("openModalBtn");
const closeBtn = document.querySelector(".modal .close");
const productFilter = document.getElementById("product_filter");


// submit form on <select> change, <select> filters tabel 
productFilter.addEventListener("change", function () {
  this.form.submit();
});

// Open modal
openBtn.addEventListener("click", () => {
  modal.style.display = "block";
});

// close modal
closeBtn.addEventListener("click", () => {
  modal.style.display = "none";
});

// close modal when clicked outside
window.addEventListener("click", (e) => {
  if (e.target === modal) {
    modal.style.display = "none";
  }
});
