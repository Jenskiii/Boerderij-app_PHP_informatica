<?php require_once "../src/includes/header.php"; ?>

<main class="container">
  <div class="form_small | flow_small">
    <h1 class="heading-1">Product bewerken</h1>
    
    <form novalidate action="/product/safe_edit" method="POST" class="form" id="editProductForm">
      <!-- HIDDEN ID -->
      <input type="hidden" id="edit_pid" name="edit_pid" value="<?= htmlspecialchars($product['product_id']); ?>">

      <div class="form_group">
        <label for="edit_pname">Naam</label>
        <input type="text" id="edit_pname" name="edit_pname" value="<?= htmlspecialchars($product['naam']); ?>"
          readonly>
      </div>

      <div class="form_group">
        <label for="edit_pinkoopprijs">Inkoopprijs</label>
        <input type="number" id="edit_pinkoopprijs" name="edit_pinkoopprijs" min="0" step=".01" placeholder="1.50"
          value="<?= htmlspecialchars($product['inkoopprijs']); ?>" required>
        <span class="error_message" aria-live="polite"></span>
      </div>

      <div class="form_group">
        <label for="edit_pverkoopprijs">Verkoopprijs</label>
        <input type="number" id="edit_pverkoopprijs" name="edit_pverkoopprijs" min="0" step=".01" placeholder="3.00"
          value="<?= htmlspecialchars($product['verkoopprijs']); ?>" required>
        <span class="error_message" aria-live="polite"></span>
      </div>

      <div class="form_group">
        <label for="edit_pvoorraad">Voorraad</label>
        <input type="number" id="edit_pvoorraad" name="edit_pvoorraad" min="0" placeholder="200"
          value="<?= htmlspecialchars($voorraad['aantal']); ?>" required>
        <span class="error_message" aria-live="polite"></span>
      </div>


      <button class="btn crud add" type="submit">Opslaan</button>
      <a class="btn crud delete close" href="/product">Annuleren</a>
    </form>

  </div>

</main>

<?php require_once "../src/includes/footer.php"; ?>