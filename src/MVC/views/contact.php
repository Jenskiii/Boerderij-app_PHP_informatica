<?php require_once "../src/includes/header.php"; ?>

<main class="container main_bg section_gap">
  <!-- DECORATIE DIEREN ZIJKANTEN -->
  <!-- decoratie dier links -->
  <img class="decoration_left" src="assets/images/goat.png" alt="geit in cartoon style">
  <!-- decoratie dier rechts -->
  <img class="decoration_right" src="assets/images/goat.png" alt="geit in cartoon style">


  <!-- TITLE -->
  <section>
    <div class="container">
      <div class="page_title">
        <h1 class="heading-1">
          Neem contact op
        </h1>
        <p>
          Heb je een vraag of wil je meer weten over Kinderboerderij 't Erf of de boerderij-automaat?
          Vul hieronder het formulier in of neem direct contact met ons op.
          We horen graag van je!
        </p>
      </div>
    </div>
  </section>


  <section>
    <div class="even_columns container">
      <!-- CONTACT INFO -->
      <div>
        <h2>Contactgegevens</h2>
        <p>
          <strong>Kinderboerderij 't Erf</strong><br>
          Mendelssohnstraat 6<br>
          5144 GG Waalwijk
        </p>
        <p>
          <strong>Telefoon:</strong> 0416 - 12 34 56<br>
          <strong>E-mail:</strong> <a href="mailto:info@boerderij-erf.nl">info@kinderboerderij-erf.nl</a>
        </p>
        <h3>Openingstijden</h3>
        <ul>
          <li>maandag t/m vrijdag: 10:00 - 17:00</li>
          <li>zaterdag t/m zondag: 10:00 - 16:30</li>
        </ul>
      </div>


      <!--
        ik zou hier bij een echte website de informatie van het form doorsturen
        naar de email van de boerderij met JS, zelf vind ik dat dit buiten de scope van het project valt
        vandaar dat ik niks met het form gedaan heb.
      -->

      <!-- FORM -->
      <form novalidate class="form">
        <!-- fname -->
        <div class="form_group">
          <label for="fname">Voornaam</label>
          <!-- regex allows letters, space, - _ , and special letters: ë etc -->
          <!-- no numbers -->
          <input type="text" id="fname" name="first_name" pattern="[A-Za-zÀ-ÖØ-öø-ÿ _\-]+"
            data-error="Geen cijfers toegestaan" placeholder="John" required>
          <span class="error_message" aria-live="polite"></span>
        </div>

        <!-- lname -->
        <div class="form_group">
          <label for="lname">Achternaam</label>
          <!-- regex allows letters, space, - _ , and special letters: ë etc -->
          <!-- no numbers -->
          <input type="text" id="lname" name="last_name" pattern="[A-Za-zÀ-ÖØ-öø-ÿ _\-]+"
            data-error="Geen cijfers toegestaan" placeholder="Doe" required>
          <span class="error_message" aria-live="polite"></span>
        </div>

        <!-- email -->
        <div class="form_group | span_all">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" data-error="Voer een geldig email adres in"
            placeholder="email@example.com" required>
          <span class="error_message" aria-live="polite"></span>
        </div>

        <!-- message -->
        <div class="form_group | span_all">
          <label for="message">Bericht</label>
          <textarea name="message" id="message" minlength="20" data-error="Je bericht is tekort"
            placeholder="Hallo, ik had een vraag over..." required></textarea>
          <span class="error_message" aria-live="polite"></span>
        </div>

        <button class="btn primary | span_all" type="submit">Neem contact op</button>
      </form>
  </section>



</main>


<?php require_once "../src/includes/footer.php"; ?>