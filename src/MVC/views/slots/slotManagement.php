<?php require_once "../src/includes/header.php"; ?>

<main class="container main_bg flow">

  <!-- TITLE -->
  <section class="ondernemers">
    <!-- header -->
    <div class="page_title">
      <h1 class="heading-1 ">
        Vakken aanpassen
      </h1>
      <p> Beheer de inhoud van de automaat. Voeg producten toe, pas voorraad aan of verwijder items.</p>
    </div>
  </section>


  <!-- TABLE -->
  <section class="container flow_small">

    <form class="slotManagement_add-button" action="">
      <button class="btn primary" type="submit">Nieuw product toevoegen</button>
    </form>

    <table class="table">
      <thead>
        <tr>
          <th>Vak</th>
          <th>Product</th>
          <th>Vakstatus</th>
          <th>Voorraad</th>
          <th>Acties</th>
        </tr>
      </thead>

      <!-- show alert when succer or failure -->
      <span class="slotManagement_alert | alert_box">Wijziging is succesvol!</span>
      
      <tbody>
        <?php foreach ($slotsWithProducts as $vak): ?>
          <tr>
            <!-- SLOT -->
            <td>
              <?= htmlspecialchars($vak['positie']) ?>
            </td>


            <?php if ($vak['product_name'] !== 'geen product'): ?>
              <!-- IF CONTAINS PRODUCT -->
              <!-- product name -->
              <td>
                <?= htmlspecialchars($vak['product_name']); ?>
              </td>

              <!-- vak status -->
              <td class="status <?= $vak['status'] === 'Leeg' ? 'clr_red' : 'clr_green' ?>">
                <?= htmlspecialchars($vak['status']); ?>
              </td>

              <!-- storage -->
              <td>
                <?= htmlspecialchars($vak['stock']) ?>
              </td>

              <td>
                <!-- actions -->
                <div class="table_actions | flex">
                  <!-- edit -->
                  <form action="/vakkenbeheer/edit" method="POST">
                    <input type="hidden" name="vak_edit_id" id="vak_edit_id"
                      value="<?= htmlspecialchars($vak['vak_id']) ?>">
                    <button class="btn | crud edit">&#x270E;</button>
                  </form>
                  <!-- delete -->
                  <form action="/vakkenbeheer/delete" method="POST">
                    <input type="hidden" name="vak_delete_id" id="vak_delete_id"
                      value="<?= htmlspecialchars($vak['vak_id']) ?>">
                    <button class="btn | crud delete">&#128465;</button>
                  </form>
                </div>
              </td>
            <?php else: ?>

              <!-- ELSE -->

              <!-- show dropdownlist -->
              <form action="/vakkenbeheer/add?vak_id=<?= $vak["vak_id"] ?>" class="slotManagement_select-form"
                method="POST">

                <td>
                  <select name="product_option_id" id="product_option_id" required>
                    <option value="">---Kies product---</option>
                    <!-- loop through all products -->
                    <?php foreach ($getAllProductsInStock as $product): ?>
                      <option value="<?= htmlspecialchars($product['product_id']) ?>">
                        <?= htmlspecialchars($product['naam']) ?>
                      </option>

                    <?php endforeach; ?>
                  </select>
                </td>

                <!-- vak status -->
                <td class="status <?= $vak['status'] === 'Leeg' ? 'clr_red' : 'clr_green' ?>">
                  <?= htmlspecialchars($vak['status']); ?>
                </td>

                <!-- voorraad -->
                <td>
                  <?= htmlspecialchars($vak['stock']) ?>
                </td>

                <!-- add button -->
                <td>
                  <button class="btn | crud add">&#x2B;</button>
                </td>
              </form>

            <?php endif; ?>
          </tr>
        <?php endforeach; ?>

      </tbody>

    </table>

  </section>

</main>

<?php require_once "../src/includes/footer.php"; ?>