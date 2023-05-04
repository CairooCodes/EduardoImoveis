<?php
session_start();
require "../db_config.php";
require "../functions/get.php";

if (!isset($_SESSION['id'])) {
  header('Location: login.php');
  exit;
}

$user_id = $_SESSION['id'] ?? null;
$sql = "SELECT name, email, img FROM users WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$user_id]);
$user = $stmt->fetch();

// Consulta SQL
$sql = "SELECT * FROM users";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
$page = 'users';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <title>Dashboard Eduardo Imóveis Leal</title>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta content="" name="keywords">
  <meta content="" name="description">
  <meta name="author" content="Cairo Felipe Developer">

  <meta property="og:title" content="" />
  <meta property="og:url" content="" />
  <meta property="og:image" content="" />
  <meta property="og:description" content="" />

  <link rel="stylesheet" href="./assets/css/style.css">
  <link href="../assets/img/logo.png" rel="icon">
  <link href="../assets/img/logo.png" rel="apple-touch-icon">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.4/flowbite.min.css" rel="stylesheet" />
  <script src="../assets/js/tw.js"></script>
</head>

<body>
  <?php include "components/sidebar.php" ?>
  <div class="ml-auto mb-6 lg:w-[75%] xl:w-[80%] 2xl:w-[85%]">
    <?php include "components/header.php" ?>
    <div class="max-w-7xl px-4 pb-8 mx-auto py-8">
      <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <div class="flex items-center justify-between py-4 bg-white">
          <div>
          </div>
          <div class="flex space-x-2">
            <button id="dropdownActionButton" data-dropdown-toggle="dropdownAction" class="inline-flex items-center text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-3 py-1.5" type="button">
              Opções
              <svg class="w-3 h-3 ml-2" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
              </svg>
            </button>
            <div>
              <div id="dropdownAction" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
                <ul class="py-1 text-sm text-gray-700" aria-labelledby="dropdownActionButton">
                  <li>
                    <a href="registro.php" class="block px-4 py-2 hover:bg-gray-100">Adicionar Usuário</a>
                  </li>
                  <li>
                    <a href="#" class="block px-4 py-2 hover:bg-gray-100">Exportar Dados</a>
                  </li>
                </ul>
              </div>
            </div>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg class="w-5 h-5 text-gray-500" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                </svg>
              </div>
              <input type="text" id="busca" class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500" placeholder="Busca">
            </div>
          </div>
        </div>
        <table class="w-full text-sm text-left text-gray-500">
          <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
              <th scope="col" class="px-6 py-3">
                ID
              </th>
              <th scope="col" class="px-6 py-3">
                Nome
              </th>
              <th scope="col" class="px-6 py-3">
                Email
              </th>
              <th scope="col" class="px-6 py-3">
                Status
              </th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($usuarios as $usuario) : ?>
              <tr class="bg-white border-b">
                <td class="pl-5 text-gray-900 font-semibold"><?= $usuario['id'] ?></td>
                <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap">
                  <?php
                  if (!empty($usuario['img'])) {
                    $img = base64_encode($usuario['img']);
                    echo "<img class='w-10' src='data:image/jpeg;base64," . $img . "'>";
                  }
                  ?>
                  <div class="pl-3">
                    <div class="text-base font-semibold"><?php echo $usuario['name']; ?></div>
                  </div>
                </th>
                <td class="pl-5 text-gray-900 font-semibold"><?= $usuario['email'] ?></td>
              <?php endforeach; ?>
              <td class="px-6 py-4">
                <div class="flex items-center">
                  <div class="h-2.5 w-2.5 rounded-full bg-green-500 mr-2"></div> Ativo
                </div>
              </td>
              </tr>

          </tbody>
        </table>
        <?php include "./components/modal_add_product.php"; ?>
        <!-- Edit user modal -->
        <div id="editUserModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 items-center justify-center hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
          <div class="relative w-full h-full max-w-2xl md:h-auto">
            <!-- Modal content -->
            <form action="#" class="relative bg-white rounded-lg shadow">
              <!-- Modal header -->
              <div class="flex items-start justify-between p-4 border-b rounded-t">
                <h3 class="text-xl font-semibold text-gray-900">
                  Edit user
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-hide="editUserModal">
                  <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                  </svg>
                </button>
              </div>
              <!-- Modal body -->
              <div class="p-6 space-y-6">
                <div class="grid grid-cols-6 gap-6">
                  <div class="col-span-6 sm:col-span-3">
                    <label for="first-name" class="block mb-2 text-sm font-medium text-gray-900">First Name</label>
                    <input type="text" name="first-name" id="first-name" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5" placeholder="Bonnie" required="">
                  </div>
                  <div class="col-span-6 sm:col-span-3">
                    <label for="last-name" class="block mb-2 text-sm font-medium text-gray-900">Last Name</label>
                    <input type="text" name="last-name" id="last-name" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5" placeholder="Green" required="">
                  </div>
                  <div class="col-span-6 sm:col-span-3">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                    <input type="email" name="email" id="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5" placeholder="example@company.com" required="">
                  </div>
                  <div class="col-span-6 sm:col-span-3">
                    <label for="phone-number" class="block mb-2 text-sm font-medium text-gray-900">Phone Number</label>
                    <input type="number" name="phone-number" id="phone-number" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5" placeholder="e.g. +(12)3456 789" required="">
                  </div>
                  <div class="col-span-6 sm:col-span-3">
                    <label for="department" class="block mb-2 text-sm font-medium text-gray-900">Department</label>
                    <input type="text" name="department" id="department" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5" placeholder="Development" required="">
                  </div>
                  <div class="col-span-6 sm:col-span-3">
                    <label for="company" class="block mb-2 text-sm font-medium text-gray-900">Company</label>
                    <input type="number" name="company" id="company" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5" placeholder="123456" required="">
                  </div>
                  <div class="col-span-6 sm:col-span-3">
                    <label for="current-password" class="block mb-2 text-sm font-medium text-gray-900">Current Password</label>
                    <input type="password" name="current-password" id="current-password" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5" placeholder="••••••••" required="">
                  </div>
                  <div class="col-span-6 sm:col-span-3">
                    <label for="new-password" class="block mb-2 text-sm font-medium text-gray-900">New Password</label>
                    <input type="password" name="new-password" id="new-password" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5" placeholder="••••••••" required="">
                  </div>
                </div>
              </div>
              <!-- Modal footer -->
              <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b">
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Save all</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    const inputBusca = document.querySelector('#busca');
    inputBusca.addEventListener('input', () => {
      const termoBusca = inputBusca.value.toLowerCase();
      filtrarLinhas(termoBusca);
    });

    function filtrarLinhas(termo) {
      const tbody = document.querySelector('table tbody');
      const linhas = tbody.querySelectorAll('tr');

      linhas.forEach((linha) => {
        const textoLinha = linha.textContent.toLowerCase();
        if (textoLinha.includes(termo)) {
          linha.classList.remove('hidden');
        } else {
          linha.classList.add('hidden');
        }
      });
    }
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.4/flowbite.min.js"></script>
</body>

</html>