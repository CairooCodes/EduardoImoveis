<?php
require "db_config.php";
require "config/helper.php";
require "config/url.class.php";
require "config/functions.php";

$URI = new URI();
$url = explode("/", $_SERVER['REQUEST_URI']);
$get_url = $url[4];
$get_url_2 = "";


$stmt = $pdo->prepare("SELECT * FROM products");
$stmt->execute();
if ($stmt->rowCount() > 0) {
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    extract($row);
    $string1 = remove_symbols_accents(utf8_decode($get_url));
    $string2 = remove_symbols_accents(utf8_decode($name));
    if ($string1 == $string2) {
      $get_url_2 = $name;
    }
  }
}

$product = getHotel($get_url_2);

function getHotel($get_url_2)
{
  global $pdo;
  $stmt = $pdo->prepare("SELECT * FROM products WHERE name = :name");
  $stmt->bindParam(':name', $get_url_2);
  $stmt->execute();
  return $stmt->fetch(PDO::FETCH_ASSOC);
}


?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <?php include "./components/head_core.php"; ?>
  <title><?php echo $product['name']; ?> - Eduardo Leal Imóveis</title>
  <meta name="title" content="Eduardo Leal Imóveis">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
  <link rel="stylesheet" href="./assets/css/swiper.css">
</head>

<body>
  <?php include "./components/navbar.php" ?>
  <section class="pt-20">
    <div class="max-w-6xl px-4 pb-8 mx-auto lg:pb-16">
      <div class="swiper mySwiper lg:hidden">
        <h1 class="text-color1 text-3xl pb-4 font-light">
          <?php echo $product['name']; ?>
        </h1>
        <div class="swiper-wrapper">
          <?php
          if ($product['images']) {
            $imagens = unserialize($product['images']);
            foreach ($imagens as $imagem) {
              $imgs = base64_encode($imagem);
              echo "<div class='swiper-slide'><img class='h-96 w-full' src='data:image/jpeg;base64," . $imgs . "'></div>";
            }
          }
          ?>
        </div>
        <div class="swiper-button-next text-white"></div>
        <div class="swiper-button-prev text-white"></div>
        <div class="swiper-pagination"></div>
      </div>
      <div class="grid lg:grid-cols-12 lg:pt-5">
        <div class="lg:col-span-7">
          <h1 class="text-color1 text-3xl pb-4 font-light">
            <?php echo $product['name']; ?>
          </h1>
          <div class="swiper mySwiper hidden lg:block">
            <div class="swiper-wrapper">
              <?php
              if ($product['images']) {
                $imagens = unserialize($product['images']);
                foreach ($imagens as $imagem) {
                  $imgs = base64_encode($imagem);
                  echo "<div class='swiper-slide px-10 py-5'><img class='w-full' src='data:image/jpeg;base64," . $imgs . "'></div>";
                }
              }
              ?>
            </div>
            <div class="swiper-button-next text-white"></div>
            <div class="swiper-button-prev text-white"></div>
            <div class="swiper-pagination"></div>
          </div>
          <div class="flex justify-center pt-5">
            <a target="_blank" href="<?php echo $product['link']; ?>">
              <button class="bg-color1 rounded-md p-5 text-white">CONFIRA NOSSA DISPONIBILIDADE</button>
            </a>
          </div>
        </div>
        <div class="lg:col-span-5 p-5">
          <?php
          echo $product['description'];
          ?>
        </div>
      </div>
    </div>
  </section>
  <script src="https://unpkg.com/flowbite@1.4.1/dist/flowbite.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
  <script>
    var swiper = new Swiper(".mySwiper", {
      autoplay: {
        delay: 5000,
        disableOnInteraction: false,
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
      slidesPerView: 1,
      spaceBetween: 20,
    });
  </script>
</body>

</html>