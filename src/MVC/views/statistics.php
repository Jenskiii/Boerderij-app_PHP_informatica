<?php require_once "../src/includes/header.php"; ?>

<main class="container main_bg flow">
  <!-- DECORATIE DIEREN ZIJKANTEN -->
  <!-- decoratie dier links -->
  <figure class="decoration_left" aria-hidden="true">
    <img src="assets/images/hay-barn.png" alt="varken in cartoon style">
  </figure>
  <!-- decoratie dier rechts -->
  <figure class="decoration_right" aria-hidden="true">
    <img src="assets/images/hay-barn.png" alt="varken in cartoon style">
  </figure>

  <!-- TITLE -->
  <section class="container">
    <!-- header -->
    <div class="page_title">
      <h1 class="heading-1 ">
        Statistieken
      </h1>
      <p>
        Bekijk hier de voorraad per vak, winst en de meest verkochte producten.
      </p>
    </div>
  </section>


  <!-- TABELS -->
  <section class="container">
    <!-- SELECT -->
    <form method="GET" class="statistics_form" id="statistics_filter-form">
      <fieldset>
        <legend class="heading-3" for="statistics_filter">Kies categorie:</legend>
        <select name="statistics_filter" id="statistics_filter">
          <option value="voorraad" <?= $statisticsFilter === 'voorraad' ? 'selected' : '' ?>>Voorraad per
            vak</option>
          <option value="verkocht" <?= $statisticsFilter === 'verkocht' ? 'selected' : '' ?>>Verkochte
            producten</option>
          <option value="winst" <?= $statisticsFilter === 'winst' ? 'selected' : '' ?>>Winst</option>
        </select>
      </fieldset>
    </form>


    <table class="table ">
      <!-- HEADERS -->
      <thead>
        <tr>
          <?php foreach ($headers as $header): ?>
            <th><?= htmlspecialchars($header) ?></th>
          <?php endforeach; ?>
        </tr>
      </thead>

      <!-- ROWS -->
      <tbody>
        <?php foreach ($data as $row): ?>
          <tr>
            <?php foreach ($row as $key => $cell): ?>
              <td class="<?= htmlspecialchars($cell === null ? "bg_red" : "") ?>">
                <?= hasCurrency($currencyColumns, $key, $cell) ?>
              </td>
            <?php endforeach; ?>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>



  </section>
</main>

<?php require_once "../src/includes/footer.php"; ?>