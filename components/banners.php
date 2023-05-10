<section class="swiper swiper_banners relative mt-20">
  <div class="swiper-wrapper">
    <?php
     foreach ($banners as $banners){
    ?>
      <div class="swiper-slide">
        <?php
        if (!empty($banners['img'])) {
          $img = base64_encode($banners['img']);
          echo "<img class='w-full' src='data:image/jpeg;base64," . $img . "'>";
        }
        ?>
      </div>
    <?php
    }
    ?>
  </div>
  <div class="swiper-button-next text-white"></div>
  <div class="swiper-button-prev text-white"></div>
  <div class="swiper-pagination"></div>
</section>