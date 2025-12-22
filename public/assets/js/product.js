const addModal = document.getElementById("addProductModal");
const openAddModalBtn = document.getElementById("openAddModalBtn");
const closeBtn = document.querySelectorAll(".modal .close");


// NIET IN GEBRUIK
// const deleteModal = document.getElementById("deleteProductModal");
// const hiddenDeleteInput = document.getElementById("deleteProductInput");
// const openDeleteModalBtn = document.querySelectorAll(".openModalDeleteBtn");

// NOTES
// uiteindelijk niet voorgekozen om de delete functie te gebruiken omdat het ook andere tabellen verwijdert.
// deze data mag niet weg, ik laat het nog wel staan mocht de leraar willen dat het erin komt

// //////////////////
// FUNCTIONS
/////////////////////
// open modal function;
function openModal(btn, modal) {
  btn.addEventListener("click", () => {
    modal.style.display = "block";

    // NIET IN GEBRUIK ZIE NOTES
    // // if button has ID, bind it to INPUT VALUE
    // // enables ID for the DELETE PAGE
    // if (btn.id !== "openAddModalBtn") {
    //   hiddenDeleteInput.value = btn.id;
    // }
  });
}

// close modal when clicked outside of box;
function closeModal(modal) {
  window.addEventListener("click", (e) => {
    if (e.target === modal) {
      modal.style.display = "none";
    }
  });
}

// //////////////////
// ADD PRODUCT MODAL
/////////////////////
openModal(openAddModalBtn, addModal);
closeModal(addModal);

// //////////////////
// CLOSE MODAL BUTTONS
/////////////////////
closeBtn.forEach((btn) => {
  btn.addEventListener("click", () => {
    addModal.style.display = "none";

    // NIET IN GEBRUIK ZIE NOTES
    // deleteModal.style.display = "none";
  });
});

// NIET IN GEBRUIK ZIE NOTES
// // //////////////////
// // DELETE PRODUCT MODAL
// /////////////////////
// openDeleteModalBtn.forEach((btn) => {
//   openModal(btn, deleteModal);
//   closeModal(deleteModal);
// });
