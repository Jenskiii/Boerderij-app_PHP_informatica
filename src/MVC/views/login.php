<?php require_once "../src/includes/header.php"; ?>


<main class="container">
  <section class="min-h-screen flex items-center justify-center bg-green-50">
    <div class="bg-white p-8 rounded-2xl shadow-md w-full max-w-sm">
      <h1 class="text-2xl font-bold text-green-800 mb-6 text-center">Login</h1>

      <form action="/login" method="POST" class="space-y-4">
        <div>
          <label for="email" class="block text-sm font-medium text-gray-700 mb-1">E-mail</label>
          <input type="email" id="email" name="email" required
            class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-green-500">
        </div>

        <div>
          <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Wachtwoord</label>
          <input type="password" id="password" name="password" required
            class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-green-500">
        </div>

        <button type="submit" class="w-full bg-green-700 text-white py-2 px-4 rounded-md hover:bg-green-800 transition">
          Login
        </button>
      </form>

      <p class="text-sm text-gray-600 mt-4 text-center">
        <a href="#" class="text-green-700 hover:underline">Wachtwoord vergeten?</a>
      </p>
    </div>
  </section>
</main>




<?php require_once "../src/includes/footer.php"; ?>