<?php require_once "../src/includes/header.php"; ?>


<main class="container">
  <section>
    <div class="login_page | flow_small">
      <h1 class="heading-1">Login</h1>
      <form novalidate action="/login" method="POST" class="form">
        <!-- fname -->
        <div class="form_group | span_all">
          <label for="fname">Gebruikersnaam</label>
          <!-- regex allows letters, space, - _ , and special letters: ë etc -->
          <!-- no numbers -->
          <input type="text" id="username" name="user_name" pattern="[A-Za-z_\-]+"
            data-error="Geen cijfers toegestaan" placeholder="John" required>
          <span class="error_message" aria-live="polite"></span>
        </div>

        <!-- password -->
        <div class="form_group | span_all">
          <label for="email">Wachtwoord</label>
          <input minlength="8" type="password" id="password" name="password"
            data-error="Wachtwoord moet 8 characters zijn" placeholder="********" required>
          <span class="error_message" aria-live="polite"></span>
        </div>

        <button class="btn primary | span_all" type="submit">Login</button>
      </form>

    </div>
  </section>
</main>




<?php require_once "../src/includes/footer.php"; ?>