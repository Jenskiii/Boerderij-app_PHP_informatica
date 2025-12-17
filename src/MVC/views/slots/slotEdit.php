<?php require_once "../src/includes/header.php"; ?>

<main class="container">

  <section>
    <div class="form_small | flow_small">

      <h1 class="heading-1">Vak <?= htmlspecialchars($selectedVak["positie"]) ?> bewerken</h1>

      <form novalidate action="/vakkenbeheer/edit/safe" method="POST" class="form">
        <!-- hidden vak id value -->
        <input type="hidden" value="<?= htmlspecialchars($selectedVak["vak_id"]) ?>" id="edit_vak_id"
          name="edit_vak_id">

        <!-- product -->
        <div class="form_group | span_all">
          <label for="fname">Product</label>
          <input type="text" value="<?= htmlspecialchars($selectedProduct["naam"]) ?>" readonly
            id="edit_product_name" name="edit_product_name">
          <input type="hidden" value="<?= htmlspecialchars($selectedProduct["product_id"]) ?>" id="edit_product_id"
            name="edit_product_id">
          </select>
          <span class="error_message" aria-live="polite"></span>
        </div>

        <!-- Amount -->
        <div class="form_group | span_all">
          <label for="email">Aantal van het product in het vak</label>
          <input type="number" max="1" min="0" id="edit_product_amount" name="edit_product_amount"
            value="<?= htmlspecialchars($selectedVak["aantal"]) ?>" required>
          <span class="error_message" aria-live="polite"></span>
        </div>

        <!-- Storage -->
        <div class="form_group | span_all">
          <label for="email">Voorraad</label>
          <input type="number" min="0" id="edit_product_storage" name="edit_product_storage"
            value="<?= htmlspecialchars($selectedProductStock["aantal"]) ?>" required>
          <span class="error_message" aria-live="polite"></span>
        </div>


        <button class="btn primary | span_all" type="submit">Opslaan</button>
      </form>

    </div>
  </section>

</main>

<?php require_once "../src/includes/footer.php"; ?>