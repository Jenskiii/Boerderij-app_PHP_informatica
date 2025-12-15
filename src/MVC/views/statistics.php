<?php require_once "../src/includes/header.php"; ?>

<main class="container main_bg">
  <!-- DECORATIE DIEREN ZIJKANTEN -->
  <!-- decoratie dier links -->
  <figure class="decoration_left">
    <img src="assets/images/hay-barn.png" alt="varken in cartoon style">
  </figure>
  <!-- decoratie dier rechts -->
  <figure class="decoration_right">
    <img src="assets/images/hay-barn.png" alt="varken in cartoon style">
  </figure>
  
  <section class="py-16 bg-green-50">
    <div class="container mx-auto px-6 md:px-12 max-w-5xl">
      <h1 class="text-4xl font-bold text-green-800 mb-8 text-center">
        Statistieken
      </h1>

      <!-- Dropdown selector -->
      <div class="mb-8 text-center">
        <label for="stat-select" class="block mb-2 font-semibold text-gray-700">Kies categorie:</label>
        <select id="stat-select"
          class="border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-green-500">
          <option value="bezoekers">Bezoekers</option>
          <option value="producten">Producten</option>
          <option value="vrijwilligers">Vrijwilligers</option>
        </select>
      </div>

      <!-- Tabellen -->
      <div id="tables">

        <!-- Bezoekers tabel -->
        <table id="bezoekers" class="min-w-full border border-gray-300 rounded-md mb-6 hidden">
          <thead class="bg-green-100">
            <tr>
              <th class="py-2 px-4 border-b">Maand</th>
              <th class="py-2 px-4 border-b">Aantal bezoekers</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="py-2 px-4 border-b">Januari</td>
              <td class="py-2 px-4 border-b">1200</td>
            </tr>
            <tr>
              <td class="py-2 px-4 border-b">Februari</td>
              <td class="py-2 px-4 border-b">950</td>
            </tr>
          </tbody>
        </table>

        <!-- Producten tabel -->
        <table id="producten" class="min-w-full border border-gray-300 rounded-md mb-6 hidden">
          <thead class="bg-green-100">
            <tr>
              <th class="py-2 px-4 border-b">Product</th>
              <th class="py-2 px-4 border-b">Aantal verkocht</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="py-2 px-4 border-b">Jam</td>
              <td class="py-2 px-4 border-b">120</td>
            </tr>
            <tr>
              <td class="py-2 px-4 border-b">Eieren</td>
              <td class="py-2 px-4 border-b">250</td>
            </tr>
          </tbody>
        </table>

        <!-- Vrijwilligers tabel -->
        <table id="vrijwilligers" class="min-w-full border border-gray-300 rounded-md mb-6 hidden">
          <thead class="bg-green-100">
            <tr>
              <th class="py-2 px-4 border-b">Naam</th>
              <th class="py-2 px-4 border-b">Aantal uren</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="py-2 px-4 border-b">Jan</td>
              <td class="py-2 px-4 border-b">12</td>
            </tr>
            <tr>
              <td class="py-2 px-4 border-b">Sophie</td>
              <td class="py-2 px-4 border-b">18</td>
            </tr>
          </tbody>
        </table>

      </div>
    </div>
  </section>
</main>

<?php require_once "../src/includes/footer.php"; ?>