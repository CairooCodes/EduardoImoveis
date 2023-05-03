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

$id = $_GET['id'];
$product = getProduct($id);

function getProduct($id)
{
  global $pdo;
  $stmt = $pdo->prepare("SELECT * FROM products WHERE id = :id");
  $stmt->bindParam(':id', $id);
  $stmt->execute();
  return $stmt->fetch(PDO::FETCH_ASSOC);
}

$categories = getCategories();

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
  <script src="../assets/js/tw.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.10.2/tinymce.min.js" integrity="sha512-MbhLUiUv8Qel+cWFyUG0fMC8/g9r+GULWRZ0axljv3hJhU6/0B3NoL6xvnJPTYZzNqCQU3+TzRVxhkE531CLKg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>
  <?php include "components/sidebar.php" ?>
  <div class="ml-auto mb-6 lg:w-[75%] xl:w-[80%] 2xl:w-[85%]">
    <?php include "components/header.php" ?>
    <div class="max-w-7xl px-4 pb-8 mx-auto py-8">
      <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <form action="./controllers/edit_product.php?id=<?php echo $product['id']; ?>" method="POST" enctype="multipart/form-data" class="relative bg-white rounded-lg shadow">
          <!-- Modal header -->
          <div class="flex items-start justify-between p-4 border-b rounded-t">
            <h3 class="text-xl font-semibold text-gray-900">
              Editar Produto
            </h3>
          </div>
          <!-- Modal body -->
          <div class="p-6 space-y-6">
            <div class="grid grid-cols-6 gap-6">
              <div class="col-span-6 sm:col-span-3">
                <label class="block mb-2 text-sm font-medium text-gray-900">Name</label>
                <input name="name" type="text" value="<?php echo $product['name']; ?>" id="name" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5" placeholder="Nome do Produto" required="">
              </div>
              <div class="col-span-6 sm:col-span-3">
                <label for="last-name" class="block mb-2 text-sm font-medium text-gray-900">Preço</label>
                <input type="text" name="price" type="text" value="<?php echo $product['price']; ?>" id="price" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5" placeholder="Valor" required="">
              </div>
              <div class="col-span-6 sm:col-span-3">
                <label for="categoria" class="block mb-2 text-sm font-medium text-gray-900">Categoria</label>
                <select class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5" name="categorie_id">
                  <?php foreach ($categories as $categorie) {
                    if ($categorie['id'] == $product['categorie_id']) { ?>
                      <option value="<?php echo $categorie['id']; ?>"><?php echo $categorie['name']; ?> (selecionado)</option>
                  <?php }
                  } ?>
                  <?php foreach ($categories as $categorie) { ?>
                    <option value="<?php echo $categorie['id']; ?>"><?php echo $categorie['name']; ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="col-span-6 sm:col-span-3">
                <label for="minmax-range" class="block mb-2 text-sm font-medium text-gray-900">Estrelas</label>
                <input id="minmax-range" name="stars" onchange="visibleStars();" type="range" min="0" max="5" value="<?php echo $product['stars']; ?>" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer">
                <div id="showStars" class="flex">
                </div>
              </div>
              <input id="id" name="id" type="hidden" value="<?php echo $product['id']; ?>">
              <div class="col-span-6 sm:col-span-3">
                <label for="phone-number" class="block mb-2 text-sm font-medium text-gray-900">Imagem</label>
                <input type="file" id="img" name="img">
              </div>
            </div>
            <textarea name="description" id="description" type="text"><?php echo $product['description']; ?></textarea>
            <!-- Modal footer -->
            <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b">
              <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Editar</button>
            </div>
        </form>
      </div>
    </div>
  </div>
  <script>
    let countStars;

    function visibleStars() {
      let concat = '';
      countStars = document.getElementById('minmax-range').value;
      countStars = parseInt(countStars);
      for (i = 0; i < 5; i++) {
        if (i < countStars && countStars != 0) {
          concat += '<svg style="color: #ffd700 !important" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16"><path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" /></svg>'
        } else {
          concat += '<svg style="color: #ffd700 !important" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16"><path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z" /></svg>'
        }
      }
      document.getElementById('showStars').innerHTML = "";
      document.getElementById('showStars').innerHTML = concat;
    }
    visibleStars();
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
  <script>
    tinymce.init({
      selector: '#description',
      plugins: 'print preview powerpaste casechange importcss tinydrive searchreplace autolink autosave save directionality advcode visualblocks visualchars fullscreen image link media mediaembed template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists checklist wordcount tinymcespellchecker a11ychecker imagetools textpattern noneditable help formatpainter permanentpen pageembed charmap tinycomments mentions quickbars linkchecker emoticons advtable export',
      toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist checklist | forecolor backcolor casechange permanentpen formatpainter removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media pageembed template link anchor codesample | a11ycheck ltr rtl | showcomments addcomment'
    });
  </script>
</body>

</html>