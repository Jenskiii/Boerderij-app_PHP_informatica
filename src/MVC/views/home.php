<?php
require_once "../src/includes/header.php";
?>


<main>

  <section class="home_hero | container">
    <h1 class="home_title | heading-1">Een koe vol plezier, test de automaat nu!</h1>
  </section>


  <section>
    <div class="automaat_wrapper | container ">
      <div class="speech-bubble ">
        <p>Wat vind u van mij? laat het <a class="navigation_link" href="/contact">hier</a> weten</p>
      </div>
      <figure>
        <img class="cow" src="assets/images/Cow_01.png" alt="Bruin witte koe met een bel om zijn nek" loading='lazy'>
      </figure>
      <div class="automaat">
        <!-- TOP VAKKEN -->
        <!-- vak 1 t/m 5 -->
        <?php foreach ($topAutomaatVakken as $vak): ?>
          <article class="automaat_vak" data-value="<?= htmlspecialchars($vak['aantal']) ?>"
            id="<?= htmlspecialchars($vak['positie']) ?>">
            <header>
              <h3 class="automaat_vak-titel"><?= htmlspecialchars($vak['positie']) ?></h3>
            </header>

            <p><?= htmlspecialchars($vak['product_name']) ?></p>
            <p class="automaat_vak-prijs  <?= $vak['aantal'] > 0 ? "active" : "" ?>">&#8364;
              <?= htmlspecialchars($vak['aantal'] > 0 ? $vak['product_price'] : "0.00") ?>
            </p>

            <!-- SHOW PRODUCT -->
            <?php if (!empty($vak['product_id']) && ($vak['aantal'] ?? 0) > 0): ?>
              <!-- Klikbare afbeelding leidt naar ProductController  via router -->
              <a class="automaat_product" href="/product/buy/<?= urlencode($vak['vak_id']) ?>">
                <img src="<?= htmlspecialchars($vak['product_img']) ?>" alt=<?= htmlspecialchars($vak['product_name']) ?>
                  loading="lazy" />
              </a>
              <!-- als uitverkocht show empty -->
            <?php else: ?>
              <figure class="automaat_product">
                <img src="assets/images/uploaded/default-image.png" alt="empty product" />
                <p>Uitverkocht</p>
              </figure>
            <?php endif; ?>

            <button class='automaat_deur'
              aria-label="opent vak <?= htmlspecialchars($vak['positie']) ?> na betaling">&#x1F512;</button>
          </article>
        <?php endforeach; ?>
        <!-- END TOP VAKKEN -->


        <!-- KASSA-->
        <div class=" kassa">

          <!-- show alert when succer or failure -->
          <span class="automaat_alert">Veel plezier met uw product!</span>

          <!-- PIN AUTOMAAT -->
          <div class="pin_automaat | inactive">
            <output class="pin_display">Selecteer product</output>
            <fieldset>
              <legend><span class="accessibility">Select letters</span></legend>
              <button class="pin_letters" disabled>A</button>
              <button class="pin_letters" disabled>B</button>
            </fieldset>
            <fieldset>
              <legend><span class="accessibility">Select numbers</span></legend>
              <button class="pin_numbers" disabled>1</button>
              <button class="pin_numbers" disabled>2</button>
              <button class="pin_numbers" disabled>3</button>
              <button class="pin_numbers" disabled>4</button>
              <button class="pin_numbers" disabled>5</button>
            </fieldset>
            <fieldset>
              <legend><span class="accessibility">Select reset button or accept button</span></legend>
              <button class="pin_accept" disabled>&#10004;</button>
              <button class="pin_clear" disabled>&#10006;</button>
            </fieldset>
          </div>

          <!-- QR CODE -->
          <figure class="kassa_qr-code | inactive">
            <img src="/assets/images/qr-code.png" alt="qr-code used to pay for the products" loading='lazy'>
          </figure>


          <!-- EDIT BUTTON -->
          <?php if (isLoggedIn()): ?>
            <form action="/vakkenbeheer" method="POST" class="automaat_edit">
              <button class="btn edit">&#x270E;</button>
            </form>
          <?php endif; ?>
        </div>


        <!-- BOTTOM VAKKEN -->
        <!-- vak 6 t/m 10 -->
        <?php foreach ($bottomAutomaatVakken as $vak): ?>
          <article class="automaat_vak" data-value="<?= htmlspecialchars($vak['aantal']) ?>"
            id="<?= htmlspecialchars($vak['positie']) ?>">
            <header>
              <h3 class="automaat_vak-titel"><?= htmlspecialchars($vak['positie']) ?></h3>
            </header>

            <p><?= htmlspecialchars($vak['product_name']) ?></p>
            <p class="automaat_vak-prijs  <?= $vak['aantal'] > 0 ? "active" : "" ?>">&#8364;
              <?= htmlspecialchars($vak['product_price']) ?>
            </p>

            <!-- SHOW PRODUCT -->
            <?php if (!empty($vak['product_id']) && ($vak['aantal'] ?? 0) > 0): ?>
              <!-- Klikbare afbeelding leidt naar ProductController  via router -->
              <a class="automaat_product" href="/product/buy/<?= urlencode($vak['vak_id']) ?>">
                <img src="<?= htmlspecialchars($vak['product_img']) ?>" alt=<?= htmlspecialchars($vak['product_name']) ?>
                  loading="lazy" />
              </a>
              <!-- als uitverkocht show empty -->
            <?php else: ?>
              <figure class="automaat_product">
                <img src="assets/images/uploaded/default-image.png" alt="empty product" />
                <p>Uitverkocht</p>
              </figure>
            <?php endif; ?>

            <button class='automaat_deur'
              aria-label="opent vak <?= htmlspecialchars($vak['positie']) ?> na betaling">&#x1F512;</button>
          </article>
        <?php endforeach; ?>
        <!-- END BOTTOM VAKKEN -->
      </div>
    </div>
  </section>

</main>


<?php require_once "../src/includes/footer.php"; ?>