<?php
$meta_image = $_rootPath . '/views/nail360/assets/img/nail360-homepage.png';
$GLOBALS['page_meta'] = array(
    "meta_title" => "Thank you",
    "meta_description" => "Experience the ultimate in nail care services and book your dream appointment today. From classic manicures to gel extensions and nail art, our comprehensive range of services is designed to cater to your individual needs and preferences. Our team of experienced nail technicians is dedicated to providing you with exceptional service and personalized attention, ensuring that you leave our salon feeling confident and beautiful. Discover the perfect nail salon experience and book your appointment now.",
    "meta_image" => $meta_image
);
$GLOBALS['link_css'] = array("thankyou/thankyou.css");
require_once __DIR__ . '/../inc/_header.php';

?>
<script>
    let isLogin = <?php echo json_encode($_isLogin); ?>;;
     if(!isLogin){
         // Redirect to the new page
        window.location.href = window._rootPath + "/404";
      }
    const token = "<?= $_COOKIE['token'] ?>";
  
</script>

<section class="section-thankyou mx-auto py-5">
    
    <div class="text-center" >
        <img src-alt="thankyou" lazy-src="<?php echo $_rootPath ?>/views/nail360/assets/icons/thankyou.svg" />
    </div>
    <h1 class="mulish-bold fsize-7 h-color mt-3 text-center">Thank You!</h1>
    <p class="mulish-semibold fsize-4 p-color text-center">Thank you once again for choosing us, and we look forward to<br/>welcoming you soon!</p>
    <div class="order-detail-container p-4">
        <div class="d-flex justify-content-between align-items-baseline">
            <div class="order_info--base">
                <p class="mulish-bold p-color fsize-2 mb-1">Order Date</p>
                <p class="mulish-bold h-color fsize-3 mb-0" data-order_date></p>
            </div>
            <div class="order_info--base ">

                <p class="mulish-bold p-color fsize-2 mb-1">Order #</p>
                <p class="mulish-bold h-color fsize-3 mb-0" data-order_number></p>
            </div>
            <div class="order_info--base ">

                <p class="mulish-bold p-color fsize-2 mb-1">Order Total</p>
                <p class="mulish-bold main-color fsize-3 mb-0" data-order_total></p>
            </div>
        </div>
        <div class="booking-details my-3 p-4">
            <h2 class="mulish-bold fsize-4 h-color text-center">Booking  Details</h2>
            <div class="d-flex justify-content-between align-items-baseline">
                <div class="">
                    <p class="mb-1 p-color fsize-3">Salon Name</p>
                    <p class="mb-0 h-color fsize-3 mulish-bold" data-salon_name></p>
                </div>
                <div class="">
                    <p class="mb-1 p-color fsize-3">Date</p>
                    <p class="mb-0 h-color fsize-3 mulish-bold" data-booking_date></p>
                </div>
            </div>
            <div class="customer-details my-3 p-3">
                <h3 class="mulish-bold fsize-3 h-color mb-0" data-customer-count></h3>
                <template id="template-customer-detail">
                        <div class="customer-details--item py-3">
                            <div class="d-flex">
                                <span class="cs-detail-label  p-color fsize-3">Name:</span>
                                <span class="h-color fsize-3" data-customer_name></span>
                            </div>
                            <div class="d-flex">
                                <span class="cs-detail-label p-color fsize-3">Book Time:</span>
                                <span class="h-color fsize-3"  data-customer_booking_time></span>
                            </div>
                        </div>
                    </template>
                <div id="list-customer-details" class="list-customer-details"></div>
            </div>
            <div class="note d-flex align-items-start gap-1">
                <p class="mulish-semibold fsize-2 h-color">Note:</p>
                <p class="fsize-2 p-color" data-note></p>
            </div>
        </div>
        <h2 class="mulish-bold fsize-4 h-color">Payment Details</h2>
        <div class="payment-container d-flex justify-content-between gap-5">
            <div class="payment-total">
                <div class="payment-total--body p-3">
                    <div class="d-flex justify-content-between align-items-baseline">
                        <p class="h-color fsize-3">Subtotal</p>
                        <p class="mulish-bold fsize-3 h-color" data-order_subtotal></p>
                    </div>
                    <div class="d-flex justify-content-between align-items-baseline">
                        <p class="h-color fsize-3">Tax</p>
                        <p class="mulish-bold fsize-3 h-color" data-order_tax></p>
                    </div>
                    <div class="d-flex justify-content-between align-items-baseline">
                        <p class="h-color fsize-3">Other Charges<span class="ms-1"><svg color="#777" height="1rem" aria-hidden="true" data-prefix="fal" data-icon="info-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-info-circle fa-w-16 fa-7x"><path fill="currentColor" d="M256 40c118.621 0 216 96.075 216 216 0 119.291-96.61 216-216 216-119.244 0-216-96.562-216-216 0-119.203 96.602-216 216-216m0-32C119.043 8 8 119.083 8 256c0 136.997 111.043 248 248 248s248-111.003 248-248C504 119.083 392.957 8 256 8zm-36 344h12V232h-12c-6.627 0-12-5.373-12-12v-8c0-6.627 5.373-12 12-12h48c6.627 0 12 5.373 12 12v140h12c6.627 0 12 5.373 12 12v8c0 6.627-5.373 12-12 12h-72c-6.627 0-12-5.373-12-12v-8c0-6.627 5.373-12 12-12zm36-240c-17.673 0-32 14.327-32 32s14.327 32 32 32 32-14.327 32-32-14.327-32-32-32z" class=""></path></svg></span></p>
                        <p class="mulish-bold fsize-3 h-color" data-other_charges></p>
                    </div>
                </div>
                <div class="payment-total--footer py-3 px-4">
                <div class="d-flex justify-content-between align-items-baseline">
                        <p class="mulish-semibold h-color fsize-3 mb-0">Amount to be Paid</p>
                        <p class="mulish-bold fsize-5 main-color mb-0" data-amount_paid></p>
                    </div>
                </div>
            </div>
            <div class="payment-method d-flex flex-column justify-content-center align-items-center">
                <p class="mulish-bold fsize-3 h-color mb-0">Payment Method</p>
                <p class="mulish-bold fsize-5 main-color mb-0">Payment yet to be Paid</p>
            </div>
        </div>
    </div>
    <div class="text-center mt-4" >
        <a href="<?php echo $_rootPath ?>/search" class="btn bg-main text-white mulish-black fsize-4 radius-300 book-another">Book Another Appointment</a>
    </div>
</section>
<?php require_once __DIR__ . '/../inc/_footer.php'; ?>

<!-- Include JS file for this content below -->
<script src="<?= $_rootPath ?>/assets/js/global-js.js"></script>
<script src="<?= $_rootPath; ?>/views/nail360/assets/js/thankyou/thankyou.js"></script>
<!-- Run customize function below -->
<script>
    dataReady();
    lazyBackgroundReady();
</script>