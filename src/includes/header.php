<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- google fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Poppins:wght@500;600;700&family=Workbench:SCAN@-16&display=swap"
    rel="stylesheet">

  <!-- css -->
  <link rel="stylesheet" href="/assets/styles.css">
  <!-- dynamic js link -->
  <?php if (!empty($jsLinks)): ?>
    <?php foreach ($jsLinks as $js): ?>
      <script src="/assets/js/<?= htmlspecialchars($js) ?>" defer></script>
    <?php endforeach; ?>
  <?php endif; ?>
  <title>Kinderboerderij t' Erf</title>
</head>

<body>
  <header class="header">
    <div class="header_wrapper | container">
      <!-- LOGO -->
      <a href="/"><img src="/assets/images/logo.png" class="logo" alt="logo van kinderboerderij 't Erf"></a>
      <!-- NAV -->
      <nav class="header_nav">
        <ul>
          <img class="duck" src="/assets/images/duck.png" alt="yellow duck">
          <li><a href="/over-ons" class="header_nav-link">Over ons</a></li>
          <li><a href="/ondernemers" class="header_nav-link">Ondernemers</a></li>
          <!-- hide page for non admins -->
          <?php if (isAdmin()): ?>
            <li><a href="/statistieken" class="header_nav-link">Statistieken</a></li>
          <?php endif; ?>
          <?php if (!isLoggedIn()): ?>
            <li><a href="/login" class="header_nav-link">Login</a></li>
          <?php endif; ?>
          <li><a href="/contact" class="btn primary">Contact</a></li>
        </ul>
      </nav>

      <?php if (isLoggedIn()): ?>
        <form action="/logout" method="POST" class="header_profile">
          <p><?= htmlspecialchars(user()['rol'] ?? '') ?></p>
          <button class="btn crud delete">&#10162;</button>
        </form>
      <?php endif; ?>
    </div>


  </header>