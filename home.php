<?php

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
	
	<section>
		<div class="bg-black h-[550px]">

		</div>
	</section>


	<script src="./assets/js/dark_mode.js"></script>
	<script src="https://unpkg.com/flowbite@1.4.1/dist/flowbite.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
	<script>
		var swiper = new Swiper(".mySwiper", {
			freeMode: true,
			spaceBetween: 20,
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
	<script>
		var swiper = new Swiper(".mySwiper2", {
			freeMode: true,
			spaceBetween: 20,
			pagination: {
				el: ".swiper-pacotes",
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