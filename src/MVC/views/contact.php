<?php require_once "../src/includes/header.php"; ?>

<main class="container main_bg section_gap">
  <!-- DECORATIE DIEREN ZIJKANTEN -->
  <!-- decoratie dier links -->
  <figure class="decoration_left">
    <img src="assets/images/goat.png" alt="varken in cartoon style">
  </figure>
    <!-- decoratie dier rechts -->
  <figure class="decoration_right">
    <img src="assets/images/goat.png" alt="varken in cartoon style">
  </figure>


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

      <figure>
        <img class="contact_donation-img" src="/assets/images/donate.png"
          alt="Qr-code waarmee je kunt doneren aan de boerderij">
      </figure>

      <!--
        ik zou hier bij een echte website de informatie van het form doorsturen
        naar de email van de boerderij met JS, zelf vind ik dat dit buiten de scope van het project valt
        vandaar dat ik niks met het form gedaan heb.
      -->

      <!-- FORM -->
      <form novalidate class="form" id="contactForm">
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

  <section class="container flow">
    <!-- CONTACT INFO -->

    <h2 class="heading-2">Contactgegevens</h2>
    <div class="contact_details">

      <div>
        <h3 class="heading-3">Kinderboerderij 't Erf</h3>
        <ul>
          <li><strong>Straat: </strong>Mendelssohnstraat 6</li>
          <li><strong>Postcode: </strong>5144 GG Waalwijk</li>
        </ul>
      </div>

      <div>
        <h3 class="heading-3">Contact</h3>
        <ul>
          <li><strong>Telefoon: </strong> 0416 - 12 34 56 78</li>
          <li><strong>Email: </strong> <a href="mailto:info@boerderij.nl"
              class="navigation_link">info@kinderboerderij.nl</a></li>
        </ul>
      </div>
      <div>
        <h3 class="heading-3">Openingstijden</h3>
        <ul>
          <li><strong>maandag t/m vrijdag: </strong>10:00 - 17:00</li>
          <li><strong>zaterdag t/m zondag: </strong>10:00 - 16:30</li>
        </ul>
      </div>
    </div>
  </section>



</main>


<?php require_once "../src/includes/footer.php"; ?>