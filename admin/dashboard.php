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


$products = getAllProducts();
$categories = getCategories();
$page = 'dash';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <title>Dashboard Eduardo Imóveis</title>
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

  <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.10.2/tinymce.min.js" integrity="sha512-MbhLUiUv8Qel+cWFyUG0fMC8/g9r+GULWRZ0axljv3hJhU6/0B3NoL6xvnJPTYZzNqCQU3+TzRVxhkE531CLKg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
                    <button data-modal-target="addUserModal" data-modal-show="addUserModal" class="block px-4 py-2 hover:bg-gray-100">Adicionar Produto</button>
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
                Nome
              </th>
              <th scope="col" class="px-6 py-3">
                Preço
              </th>
              <th scope="col" class="px-6 py-3">
                Estrelas
              </th>
              <th scope="col" class="px-6 py-3">
                Status
              </th>
              <th scope="col" class="px-6 py-3">
                Ação
              </th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($products as $products) { ?>
              <tr class="bg-white border-b">
                <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap">
                  <?php
                  if (!empty($products['img'])) {
                    $img = base64_encode($products['img']);
                    echo "<img class='w-10' src='data:image/jpeg;base64," . $img . "'>";
                  }
                  ?>
                  <div class="pl-3">
                    <div class="text-base font-semibold"><?php echo $products['name']; ?></div>
                  </div>
                </th>
                <td class="px-6 py-4">
                  <?php echo $products['price']; ?>
                </td>
                <td class="px-6 py-4">
                  <div class="flex">
                    <?php
                    for ($i = 1; $i <= 5; $i++) {
                      if ($i <= $products['stars']) { ?>
                        <svg style="color: #ffd700 !important" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                          <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                        </svg>
                      <?php
                      } else { ?>
                        <svg style="color: #ffd700 !important" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
                          <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z" />
                        </svg>
                    <?php
                      }
                    }
                    ?>
                  </div>
                </td>
                <td class="px-6 py-4">
                  <div class="flex items-center">
                    <div class="h-2.5 w-2.5 rounded-full bg-green-500 mr-2"></div> Ativo
                  </div>
                </td>
                <td class="px-6 py-4">
                  <a href="./editar_produto.php?id=<?php echo $products['id']; ?>" type="button" data-modal-target="editUserModal" data-modal-show="editUserModal" class="font-medium text-blue-600 hover:underline">Editar</a>
                  <a href="./controllers/delete_user.php?id=<?php echo $products['id']; ?>" type="button" class="font-medium text-red-600 hover:underline">Excluir</a>
                </td>
                <td>
                  <?php
                  if ($products['images']) {
                    $imagens = unserialize($products['images']);

                    foreach ($imagens as $imagem) {
                      $imgs = base64_encode($imagem);
                      echo "<img class='w-10' src='data:image/jpeg;base64," . $imgs . "'>";
                    }
                  }
                  ?>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
        <?php include "./components/modal_add_product.php"; ?>
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
  <script src="../assets/js/tw.js"></script>
  <script>
    tinymce.init({
      selector: '#description',
      plugins: 'print preview powerpaste casechange importcss tinydrive searchreplace autolink autosave save directionality advcode visualblocks visualchars fullscreen image link media mediaembed template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists checklist wordcount tinymcespellchecker a11ychecker imagetools textpattern noneditable help formatpainter permanentpen pageembed charmap tinycomments mentions quickbars linkchecker emoticons advtable export',
      toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist checklist | forecolor backcolor casechange permanentpen formatpainter removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media pageembed template link anchor codesample | a11ycheck ltr rtl | showcomments addcomment'
    });
  </script>
</body>

</html>