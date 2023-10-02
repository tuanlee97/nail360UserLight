<?php
$meta_image = $_rootPath . '/views/nail360/assets/img/nail360-homepage.png';
$GLOBALS['page_meta'] = array(
    "meta_title" => "Nail360 – Step into a world of nail care bliss with Nail Salon Booking.",
    "meta_description" => "Experience the ultimate in nail care services and book your dream appointment today. From classic manicures to gel extensions and nail art, our comprehensive range of services is designed to cater to your individual needs and preferences. Our team of experienced nail technicians is dedicated to providing you with exceptional service and personalized attention, ensuring that you leave our salon feeling confident and beautiful. Discover the perfect nail salon experience and book your appointment now.",
    "meta_image" => $meta_image
);
$GLOBALS['link_css'] = array("home/homepage.css");
require_once __DIR__ . '/../inc/_header.php';
?>
<!-- Link Swiper's CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
<?php
include __DIR__ . '/../inc/templates/home/carouse.php';
include __DIR__ . '/../inc/templates/home/top_rate_salons.php';
if ($_isLogin)
include __DIR__ . '/../inc/templates/home/favorite_salons.php';

include __DIR__ . '/../inc/templates/home/customer_testimonial.php';
?>
<script>
    const token = "<?= $_COOKIE['token'] ?>";
</script>
<section class="section-salon-owner-question py-3 p-lg-0">
    <div class="section-wrap">
        <div class="section-salon-owner-question__container position-relative" lazy-bg-src="<?= $_rootPath ?>/views/nail360/assets/img/360-vector-1.svg">
            <div class="section-salon-owner-question__container--text">
                <h3 class="mulish-bold fsize-7">Are you a Salon Owner?</h3>
                <p class="mulish-semibold fsize-4 section-salon-owner-question__container--paragraph">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy</p>
            </div>
            <button class="list-salon__btn bg-main radius-300 mulish-bold fsize-4">List Your Salon</button>
        </div>
    </div>
</section>
<?php require_once __DIR__ . '/../inc/_footer.php'; ?> 
<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
<!-- Include JS file for this content below -->
<script src="<?= $_rootPath ?>/assets/js/global-js.js"></script>
<script src="<?= $_rootPath; ?>/views/nail360/assets/js/home/homepage.js"></script>
<!-- Run customize function below -->
<script>
    dataReady();
    lazyBackgroundReady();
</script>