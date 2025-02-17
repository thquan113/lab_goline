<?php
namespace App\Views\Layout;

use App\Views\BaseViews;

class Scripts extends BaseViews
{
  public static function render($data = null)
  {
    ?>
    <!-- Vendor JS Files -->
    <script src="./public/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="./public/assets/vendor/php-email-form/validate.js"></script>
    <script src="./public/assets/vendor/aos/aos.js"></script>
    <script src="./public/assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="./public/assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="./public/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
    <script src="./public/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="./public/assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
      integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
      crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- <script src="/public/assets/library/location.js"></script> -->
    <script src="./public/assets/library/filter.js"></script>
    <script src="./public/assets/js/main.js"></script>
    <?php
    if (isset($data['scripts'])) {
      foreach ($data['scripts'] as $script) {
        echo "<script src='$script'></script>";
      }
    }
    ?>
    <!-- Main JS File -->

    </body>

    </html>
    <?php
  }
}
?>