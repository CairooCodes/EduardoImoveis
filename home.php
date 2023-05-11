<?php
require "db_config.php";
require "config/helper.php";
require "config/url.class.php";
require "./functions/get.php";
$URI = new URI();
$products = getAllProducts();
$banners = getBanners();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
	<title>Eduardo Leal Imóveis</title>
	<?php include "./components/head_core.php"; ?>
	<meta name="title" content="Eduardo Leal Imóveis">
	<meta property="og:image" content="https://eduardolealimoveis.com/assets/img/logo.png">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
	<link rel="stylesheet" href="./assets/css/swiper.css">
</head>

<body>
	<?php include "./components/navbar.php" ?>
	<?php include "./components/banners.php" ?>
	<section class="pt-10">
		<div class="max-w-6xl px-4 pb-8 mx-auto lg:pb-16 home-swiper1">
			<p class="uppercase text-xl text-color1 font-bold">Conheça nossos imóveis à venda</p>
			<h1 class="text-xl pb-4 font-light">Conforto, alta qualidade e a localização que você sempre quis. Encontre o seu imóvel.</h1>
			<div class="swiper mySwiper">
				<div class="swiper-wrapper pb-10">
					<?php foreach ($products as $products) { ?>
						<div class="swiper-slide shadow rounded-b-2xl">

							<?php
							if (!empty($products['img'])) {
								$img = base64_encode($products['img']);
								echo "<img class='h-62 w-full' src='data:image/jpeg;base64," . $img . "'>";
							}
							?>
							<div class="p-2 px-1 pb-4">
								<p class="uppercase text-sm text-color1 pt-3"><?php echo $products['bairro']; ?> - <?php echo $products['endereco']; ?></p>
								<h1 class="text-color1 text-lg pb-3 text-bold"><?php echo $products['name']; ?></h1>
								<div class="flex space-x-2  items-center">
									<img class="w-5 h-5" src="./assets/img/quarto.png">
									<h2 class="text-base"><?php echo $products['quartos']; ?></h2>
								</div>
								<div class="flex space-x-2  items-center">
									<img class="w-5 h-5" src="./assets/img/metro.png">
									<h2 class="text-base"><?php echo $products['metro_quadrado']; ?></h2>
								</div>
								<div class="flex justify-center">
									<a class="btn p-2 text-color1 font-bold border-b-2 border-color1 rounded text-sm mt-4" href="<?php echo $URI->base('imovel/' . slugify($products['name'])); ?>">SAIBA MAIS</a>
								</div>
							</div>
						</div>
					<?php } ?>
				</div>
				<div class="swiper-pagination"></div>
			</div>
		</div>
	</section>
	<!-- <img src="./assets/img/banner_comercial.jpg" class="w-full"> -->
	<?php include "./components/form.php" ?>
	<?php include "./components/footer.php" ?>
	<script src="./assets/js/dark_mode.js"></script>
	<script src="./assets/js/tw.js"></script>
	<script src="https://unpkg.com/flowbite@1.4.1/dist/flowbite.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
	<script>
		var swiper = new Swiper(".swiper_banners", {
			loop: true,
			autoplay: {
				delay: 5000,
				disableOnInteraction: false,
			},
			pagination: {
				el: ".swiper-pagination",
				clickable: true,
			},
			navigation: {
				nextEl: ".swiper-button-next",
				prevEl: ".swiper-button-prev",
			},
		});
	</script>
	<script>
		var swiper = new Swiper(".mySwiper", {
			autoplay: {
				delay: 5000,
				disableOnInteraction: false,
			},
			pagination: {
				el: ".swiper-pagination",
				clickable: true,
			},
			breakpoints: {
				640: {
					slidesPerView: 2,
					spaceBetween: 20,
				},
				768: {
					slidesPerView: 4,
					spaceBetween: 20,
				},
				1024: {
					slidesPerView: 4,
					spaceBetween: 20,
				},
			},
		});
	</script>
</body>

</html>