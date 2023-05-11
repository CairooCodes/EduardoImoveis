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
              Editar Imóvel
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
              <input id="id" name="id" type="hidden" value="<?php echo $product['id']; ?>">
              <div class="col-span-6 sm:col-span-3">
                <label for="phone-number" class="block mb-2 text-sm font-medium text-gray-900">Imagem</label>
                <input type="file" id="img" name="img">
              </div>
            </div>
            <div class="col-span-6 sm:col-span-3">
              <label for="last-name" class="block mb-2 hidden text-sm font-medium text-gray-900">Metro Quadrado</label>
              <input type="text" name="metro_quadrado" value="<?php echo $product['metro_quadrado']; ?>" id="link" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5" placeholder="Metro quadrado do imóvel">
            </div>
            <div class="col-span-6 sm:col-span-3">
              <label for="last-name" class="block mb-2 hidden text-sm font-medium text-gray-900">Zona</label>
              <input type="text" name="zona" value="<?php echo $product['zona']; ?>" id="zona" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5" placeholder="Zona do Imóvel">
            </div>
            <div class="col-span-6 sm:col-span-3">
              <label for="last-name" class="block mb-2 hidden text-sm font-medium text-gray-900">Endereço</label>
              <input type="text" name="endereco" value="<?php echo $product['endereco']; ?>" id="endereco" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5" placeholder="Endereço do Imóvel">
            </div>
            <div class="col-span-6 sm:col-span-3">
              <label for="last-name" class="block mb-2 hidden text-sm font-medium text-gray-900">Quartos</label>
              <input type="text" name="quartos" value="<?php echo $product['quartos']; ?>" id="endereco" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5" placeholder="Quartos e Suítes">
            </div>
            <div class="col-span-6 sm:col-span-3">
              <label for="last-name" class="block mb-2 hidden text-sm font-medium text-gray-900">Bairro</label>
              <input type="text" name="bairro" value="<?php echo $product['bairro']; ?>" id="bairro" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5" placeholder="Bairro do Imóvel">
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