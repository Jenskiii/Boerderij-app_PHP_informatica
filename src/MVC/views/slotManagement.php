<?php require_once "../src/includes/header.php"; ?>

<main class="container main_bg section_gap">



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
  <section>
    <table>
      <thead>
        <tr>
          <th>Vak</th>
          <th>Product</th>
          <th>Voorraad</th>
          <th>Acties</th>
        </tr>
      </thead>

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


              <!-- voorraad -->
              <td>
                <?= htmlspecialchars($vak['stock']) ?>
              </td>

              <td>
                <!-- actions -->
                <div class="flex">
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
              <form action="/vakkenbeheer/add" class="slotManagement_select-form" method="POST">

                <td>
                  <select name="product_option_id" id="product_option_id" required>
                    <option value="">---Kies product---</option>
                    <!-- loop through all products -->
                    <?php foreach ($getAllProducts as $product): ?>
                      <option value="<?= htmlspecialchars($product['product_id']) ?>">
                        <?= htmlspecialchars($product['naam']) ?>
                      </option>
                      <!-- hidden values -->
                      <input type="hidden" name="vak_option_id" id="vak_option_id"
                        value="<?= htmlspecialchars($vak['vak_id']) ?>">
                    <?php endforeach; ?>
                  </select>
                </td>

                <!-- voorraad -->
                <td>
                  <?= htmlspecialchars($vak['stock']) ?>
                </td>

                <!-- add button -->
                <td>
                  <button class="btn | crud add" >&#x2B;</button>
                </td>
              </form>

            <?php endif; ?>
          </tr>
        <?php endforeach; ?>

      </tbody>

    </table>

  </section>

</main>