<?php require_once "../src/includes/header.php"; ?>


<main class="container">
  <section>
    <div class="login_page | flow_small">
      <h1 class="heading-1">Login</h1>
      <form novalidate action="/login/validate" method="POST" class="form" id="loginForm">

        <!-- Wrong login show error -->
        <?php if (isset($_SESSION['login_error'])): ?>
          <div class="form_group | span_all">
            <span class="error_message"><?= $_SESSION['login_error'] ?></span>
          </div>
          <?php unset($_SESSION['login_error']); ?>
        <?php endif; ?>

        <!-- username -->
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