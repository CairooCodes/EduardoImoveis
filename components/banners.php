<section class="swiper swiper_banners relative mt-20">
  <div class="swiper-wrapper">
    <div class="swiper-slide">
      <?php
      $stmt = $pdo->prepare("SELECT * FROM banners");
      $stmt->execute();
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
      ?>
        <div class="swiper-slide">
          <?php
          if (!empty($row['img'])) {
            $img = base64_encode($row['img']);
            echo "<img class='w-full' src='data:image/jpeg;base64," . $img . "'>";
          }
          ?>
        </div>
      <?php
      }
      ?>
    </div>
  </div>
</section>