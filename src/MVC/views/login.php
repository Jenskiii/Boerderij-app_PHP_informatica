<?php require_once "../src/includes/header.php"; ?>


<main class="container">
  <section>

    <?php if (isset($_SESSION['login_error'])): ?>
      <p style="color:red"><?= $_SESSION['login_error'] ?></p>
      <?php unset($_SESSION['login_error']); ?>
    <?php endif; ?>


    <div class="login_page | flow_small">
      <h1 class="heading-1">Login</h1>
      <form novalidate action="/login/validate" method="POST" class="form" id="loginForm">
        <!-- fname -->
        <div class="form_group | span_all">
          <label for="fname">Gebruikersnaam</label>
          <input type="text" id="login_username" name="login_username" pattern="[A-Za-z_\-]+"
            data-error="Geen cijfers toegestaan" placeholder="John" required>
          <span class="error_message" aria-live="polite"></span>
        </div>
        <!-- password -->
        <div class="form_group | span_all">
          <label for="email">Wachtwoord</label>
          <input type="password" id="login_password" name="login_password" placeholder="********" required>
          <span class="error_message" aria-live="polite"></span>
        </div>

        <button class="btn primary | span_all" type="submit">Login</button>
      </form>

    </div>
  </section>
</main>




<?php require_once "../src/includes/footer.php"; ?>