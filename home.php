<?php
require "db_config.php";
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
	<?php include "./components/head_core.php"; ?>
	<title>Eduardo Imoveis</title>
	<meta name="title" content="Eduardo Imoveis">
	<meta name="description" content="Eduardo Imoveis">
	<meta property="og:title" content="Eduardo Imoveis">
	<meta property="og:site_name" content="">
	<meta property="og:url" content="" />
	<meta property="og:description" content="">
	<meta property="og:type" content="">
	<meta property="og:image" content="">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
	<link rel="stylesheet" href="./assets/css/swiper.css">
</head>

<body>
	<?php include "./components/navbar.php" ?>
	<?php include "./components/banners.php" ?>
	<section class="pt-10">
		<div class="max-w-6xl px-4 pb-8 mx-auto lg:pb-16 home-swiper1">
			<p class="uppercase text-lg text-color3 font-bold">Preços Incríveis</p>
			<h1 class="text-color1 text-3xl pb-4 font-light">Tarifas tentadoras nos principais destinos internacionais</h1>
			<div class="swiper mySwiper">
				<div class="swiper-wrapper pb-10">
					<?php foreach ($products as $products) { ?>
						<div class="swiper-slide shadow rounded-b-2xl">

							<?php
							if (!empty($products['img'])) {
								$img = base64_encode($products['img']);
								echo "<img class='h-48 w-full rounded-t-xl' src='data:image/jpeg;base64," . $img . "'>";
							}
							?>
							<div class="p-5">
								<p class="uppercase text-sm text-color3">HOTÉIS</p>
								<div class="flex">
									<?php
									for ($i = 0; $i < 5; $i++) {
										if ($i < $products['stars']) { ?>
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
								<h1 class="text-color1 text-lg pb-3"><?php echo $products['name']; ?></h1>
								<h2 class="text-base leading-3">A partir</h2>
								<h2 class="text-xl">R$ <?php echo $products['price']; ?></h2>
								<div class="flex space-x-2  items-center">
									<img class="w-8 h-4" src="./assets/img/apt_duplo.jpg">
									<h2 class="text-base">Apartamento duplo</h2>
								</div>
								<div class="flex justify-center">
									<a class="btn bg-color1 p-2 text-white rounded text-sm mt-4" href="">SAIBA MAIS</a>
								</div>
							</div>
						</div>
					<?php } ?>
				</div>
				<div class="swiper-button-next"></div>
				<div class="swiper-button-prev"></div>
				<div class="swiper-pagination"></div>
			</div>
		</div>
	</section>
	<script src="./assets/js/dark_mode.js"></script>
	<script src="https://unpkg.com/flowbite@1.4.1/dist/flowbite.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
	<script>
		var swiper = new Swiper(".swiper_banners", {
			loop: true,
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
			navigation: {
				nextEl: '.swiper-button-next',
				prevEl: '.swiper-button-prev',
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
					spaceBetween: 40,
				},
				1024: {
					slidesPerView: 4,
					spaceBetween: 50,
				},
			},
		});
	</script>
</body>

</html>