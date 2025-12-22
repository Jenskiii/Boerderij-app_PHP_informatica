<?php require_once "../src/includes/header.php"; ?>

<main class="container main_bg section_gap">
  <!-- TITLE -->
  <section>
    <div class="container">
      <div class="page_title">
        <h1 class="heading-1">
          Producten
        </h1>
        <p>
          Beheer onze producten: voeg ze toe, maak wijzigingen of verwijder items
        </p>
      </div>
    </div>
  </section>


  <!-- FILTER -->
  <section class="container">
    <div class="product_filter-wrapper">
      <form method="get">
        <label for="product_filter" class="heading-3">Filter producten:</label>
        <select name="product_filter" id="product_filter">
          <option value="all" <?= htmlspecialchars($filter === 'all' ? 'selected' : '') ?>>Alles</option>
          <option value="in_use" <?= htmlspecialchars($filter === 'in_use' ? 'selected' : '') ?>>In gebruik</option>
          <option value="not_in_use" <?= htmlspecialchars($filter === 'not_in_use' ? 'selected' : '') ?>>Niet in gebruik
          </option>
          <option value="in_stock" <?= htmlspecialchars($filter === 'in_stock' ? 'selected' : '') ?>>Op voorraad</option>
          <option value="out_of_stock" <?= htmlspecialchars($filter === 'out_of_stock' ? 'selected' : '') ?>>Niet op
            voorraad</option>
        </select>
      </form>

      <!-- show alert when success or failure -->
      <span class="product_alert | alert_box"><?= htmlspecialchars(
        urlAlertMessages($_GET['error'] ?? $_GET['success'] ?? null)
      ) ?></span>


      <!-- OPENS add product MODAL -->
      <button class="btn primary" id="openAddModalBtn" aria-label="Toggle add product modal">Product toevoegen</button>
    </div>



    <!-- PRODUCTEN TABEL -->
    <table class="table">
      <thead>
        <tr>
          <th>Naam</th>
          <th>Inkoopprijs</th>
          <th>Verkoopprijs</th>
          <th>Voorraad</th>
          <th>In gebruik</th>
          <th>Afbeelding</th>
          <th>Acties</th>
        </tr>
      </thead>

      <tbody>
        <?php foreach ($products as $product): ?>
          <!-- if filterProduct returns false skip row -->
          <?php if (!filterProduct($product, $filter))
            continue; ?>
          <tr>
            <td><?= htmlspecialchars($product['naam']) ?></td>
            <td>&#8364; <?= htmlspecialchars($product['inkoopprijs']) ?></td>
            <td>&#8364; <?= htmlspecialchars($product['verkoopprijs']) ?></td>
            <td><?= htmlspecialchars($product['aantal']) ?></td>
            <td><?= htmlspecialchars($product['ingebruik'] ? 'Ja' : 'Nee') ?></td>
            <td><?= htmlspecialchars($product['afbeelding']) ?></td>
            <td>
              <!-- actions -->
              <div class="table_actions | flex">
                <!-- edit -->
                <form action="/product/edit/<?= htmlspecialchars($product['product_id']) ?>" method="POST">
                  <input type="hidden" name="edit_product_id" id="edit_product_id"
                    value="<?= htmlspecialchars($product['product_id']) ?>">
                  <button class="btn | crud edit">&#x270E;</button>
                </form>



                <!-- NIET IN GEBRUIK ZIE NOTES -->
                <!-- delete / opens delete modal-->
                <!-- <button class="openModalDeleteBtn | btn crud delete" id="<?= htmlspecialchars($product['product_id']) ?>"
                  aria-label="Toggle delete product modal">&#128465;</button> -->
              </div>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>


    <!-- ADD PRODUCT WITH MODAL -->
    <div id="addProductModal" class="modal">
      <div class="modal-content">

        <div class="form_small | flow_small">
          <h1 class="heading-1">Nieuw product <br>toevoegen</h1>
          <form novalidate action="/product/add_new_product" method="POST" class="form" id="new_product_form"
            enctype="multipart/form-data">

            <div class="form_group">
              <label for="new_pname">Naam</label>
              <input type="text" id="new_pname" name="new_pname" pattern="[A-Za-z]+( [A-Za-z]+)*"
                data-error="Alleen letters en enkele spatie tussen woorden toegestaan" placeholder="Kaas" required>
              <span class="error_message" aria-live="polite"></span>
            </div>

            <div class="form_group">
              <label for="new_pinkoopprijs">Inkoopprijs</label>
              <input type="number" id="new_pinkoopprijs" name="new_pinkoopprijs" min="0" step=".01" placeholder="1.50"
                required>
              <span class="error_message" aria-live="polite"></span>
            </div>

            <div class="form_group">
              <label for="new_pverkoopprijs">Verkoopprijs</label>
              <input type="number" id="new_pverkoopprijs" name="new_pverkoopprijs" min="0" step=".01" placeholder="3.00"
                required>
              <span class="error_message" aria-live="polite"></span>
            </div>

            <div class="form_group">
              <label for="new_pvoorraad">Voorraad</label>
              <input type="number" id="new_pvoorraad" name="new_pvoorraad" min="0" placeholder="200" required>
              <span class="error_message" aria-live="polite"></span>
            </div>


            <div class="form_group | span_all">
              <label for="new_pimage">Afbeelding <small>(jpeg,png)</small></label>
              <input type="file" id="new_pimage" name="new_pimage" required accept="image/png, image/jpeg">
              <span class="error_message" aria-live="polite"></span>
            </div>


            <button class="btn crud add" type="submit">Toevoegen</button>
            <span class="btn crud delete close">Annuleren</span>
          </form>

        </div>
      </div>
    </div>



    <!-- NIET INGEBRUIK ZIE NOTES -->
    <!-- DELETE PRODUCT MODAL -->
    <!-- <div id="deleteProductModal" class="modal">
      <div class="form_small flow_small">
        <h2 class="heading-2">Weet je zeker dat je dit product wil verwijderen?
        </h2>
        <form action="/product/delete" method="POST" class="product_delete-actions">
          <input type="hidden" name="deleteProductId" id="deleteProductInput" value="">
          <button class="btn | crud add" type="submit">Ja</button>
          <span class="btn | crud delete close">Nee</span>
        </form>
      </div>
    </div> -->


  </section>

</main>

<?php require_once "../src/includes/footer.php"; ?>