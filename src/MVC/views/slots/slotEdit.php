<?php require_once "../src/includes/header.php"; ?>

<main class="container">

  <section aria-labelledby="slotedit_title">
    <div class="form_small | flow_small">

      <h1 class="heading-1" id="slotedit_title">Vak <?= htmlspecialchars($selectedVak["positie"]) ?> bewerken</h1>

      <form action="/vakkenbeheer/edit/safe" method="POST" class="form" id="edit_vak_form">
        <!-- hidden vak id value -->
        <input type="hidden" value="<?= htmlspecialchars($selectedVak["vak_id"]) ?>" id="edit_vak_id"
          name="edit_vak_id">

        <!-- product -->
        <div class="form_group | span_all">
          <label for="edit_vak_name">Product</label>
          <input type="text" value="<?= htmlspecialchars($selectedProduct["naam"]) ?>" readonly id="edit_vak_name"
            name="edit_vak_name">
          <input type="hidden" value="<?= htmlspecialchars($selectedProduct["product_id"]) ?>" id="edit_product_id"
            name="edit_product_id">
          <span class="error_message" aria-live="polite"></span>
        </div>

        <!-- Amount -->
        <div class="form_group | span_all">
          <label for="edit_vak_amount">Aantal van het product in het vak</label>
          <input type="number" max="1" min="0" id="edit_vak_amount" name="edit_vak_amount"
            value="<?= htmlspecialchars($selectedVak["aantal"]) ?>" required>
          <span class="error_message" aria-live="polite"></span>
        </div>

        <!-- Storage -->
        <div class="form_group | span_all">
          <label for="edit_vak_storage">Voorraad</label>
          <input type="number" min="0" id="edit_vak_storage" name="edit_vak_storage"
            value="<?= htmlspecialchars($selectedProductStock["aantal"]) ?>" required>
          <span class="error_message" aria-live="polite"></span>
        </div>


        <button class="btn crud add" type="submit">Opslaan</button>
        <!-- back button, dont need post? already checked by router -->
        <a class="btn crud delete " href="/vakkenbeheer">Annuleren</a>

      </form>

    </div>
  </section>

</main>

<?php require_once "../src/includes/footer.php"; ?>