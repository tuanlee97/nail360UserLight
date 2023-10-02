<?php
// Split the URL by the '/' character from the request
$url_parts = explode('/', $_SERVER['REQUEST_URI']);
// Get the last part of the URL, which should be the ID
$salon_id = end($url_parts); //1e85f851-68ba-4f1d-a866-d0f87e2353cc
$salonDetail = array(
    "name" => ""
);
if ($salon_id) {
    // Make a GET request to the API endpoint
    $url = $_adminApi . "/public?s=GetSalonDetail&salonid=" . $salon_id;
    $response = file_get_contents($url);
    $salonDetail = json_decode($response, true);

    if ($salonDetail['error'] === "" && $salonDetail['data']) {
        $salonDetail = $salonDetail['data'];
    } else {
        include __DIR__ . '/404.php';
        exit();
    }
}

$meta_image = $_rootPath . '/views/nail360/assets/img/nail360-homepage.png';
$GLOBALS['page_meta'] = array(
    "meta_title" => "Nail 360  – Write review for `" . $salonDetail['name'] . "`",
    "meta_description" => "Experience the ultimate in nail care services and book your dream appointment today. From classic manicures to gel extensions and nail art, our comprehensive range of services is designed to cater to your individual needs and preferences. Our team of experienced nail technicians is dedicated to providing you with exceptional service and personalized attention, ensuring that you leave our salon feeling confident and beautiful. Discover the perfect nail salon experience and book your appointment now.",
    "meta_image" => $meta_image
);
$GLOBALS['link_css'] = array("salon/salon_details.css", "salon/review.css");
require_once __DIR__ . '/../inc/_header.php';
$temporary_src_img = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mM8XQ8AAhsBTLgo62UAAAAASUVORK5CYII=";
if ($_isLogin) {
    include __DIR__ . '/../inc/templates/salon/salon-detail/booking-popup.php';
}
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> -->
<script>
    const token = "<?= $_COOKIE['token'] ?>";
    const salon_id = "<?= $salon_id ?>";
</script>
<section class=" pt-3 pb-5">
    <div class="section-wrap-medium ">
        <div class="salon_detail_info d-flex align-items-center gap-3">
            <div class="salon_detail_info__brandimg"><img src="<?= $temporary_src_img ?>" lazy-src="https://i.pravatar.cc/70?img=1" src-alt="<?= $salonDetail['name'] ?>"></div>
            <div class="flex-grow-1">
                <div class="d-flex align-items-center gap-3">
                <h2 class="fsize-7 mulish-bold"><a class="h-color mulish-bold text-decoration-none" href="<?= $_rootPath ?>/salon/<?= $salon_id ?>"><?= $salonDetail['name'] ?></a></h2>
                    <div>
                        <span class="fsize-2 mulish-bold green-color">Open Now</span>
                        <span class="fsize-2 mulish-bold p-color">- Closes 10 PM</span>
                    </div>
                </div>
                <div class="salon_feature d-flex justify-content-between align-items-start">
                    <div class="d-flex align-items-end gap-1">
                        <div class="d-flex align-items-center">
                            <img height="20" src="<?= $temporary_src_img ?>" lazy-src="<?= $_rootPath ?>/views/nail360/assets/icons/star.svg" />
                            <div class="h-25px ms-1">
                                <span class="mulish-semibold h-color fsize-5"><?= format_number($salonDetail['star'], 1) ?></span>
                                <span class="mulish-semibold p-color fsize-2">(<?= $salonDetail['countreview'] ?>)</span>
                            </div>
                        </div>
                        <?php if ($salonDetail['approve'] > 0) : ?>
                            <img class="ms-2" height="20" src="<?= $temporary_src_img ?>" lazy-src="<?= $_rootPath ?>/views/nail360/assets/icons/badge-check.svg" />
                            <span class="p-color fsize-2 lh-16px">Verified by Owner</span>
                        <?php endif ?>
                    </div>
                    <ul class="salon_feature__btn list-style-none d-flex gap-2 m-0">
                        <li class="cursor-pointer radius-300 px-4 py-1 bg-main text-white" <?php if ($_isLogin) : ?> data-bs-toggle="modal" data-bs-target="#addGuest" <?php else : ?> data-bs-toggle="modal" data-bs-target="#login" <?php endif ?>>Book now</li>
                        <li class="salon_feature__btn--item radius-300 p-color px-4 py-1 border"><img src="<?= $temporary_src_img ?>" lazy-src="<?= $_rootPath ?>/views/nail360/assets/icons/share.svg" /> Share</li>
                        <li class="salon_feature__btn--item radius-300 p-color px-4 py-1 border" <?php if ($_isLogin) : ?> onclick="alert('Call API Toggle Favorite')" <?php else : ?> data-bs-toggle="modal" data-bs-target="#login" <?php endif ?>>
                            <img src="<?= $temporary_src_img ?>" lazy-src="<?= $_rootPath ?>/views/nail360/assets/icons/heart.svg" />
                            Save
                        </li>
                    </ul>

                </div>
            </div>
        </div>
        <div class="row my-4">
            <div class="col-7">
                <div class="p-4 radius-10 border n360-border review-bg">
                    <form id="write-review" enctype="multipart/form-data">
                        <div class="form-group grid mb-3">
                            <label class="mb-1">Select Your Rate</label>
                            <div class="rating-group">
                                <input disabled checked class="rating__input rating__input--none" name="rating" id="rating-none" value="0" type="radio">
                                <label aria-label="1 star" class="rating__label" for="rating-1"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
                                <input class="rating__input" name="rating" id="rating-1" value="1" type="radio">
                                <label aria-label="2 stars" class="rating__label" for="rating-2"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
                                <input class="rating__input" name="rating" id="rating-2" value="2" type="radio">
                                <label aria-label="3 stars" class="rating__label" for="rating-3"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
                                <input class="rating__input" name="rating" id="rating-3" value="3" type="radio">
                                <label aria-label="4 stars" class="rating__label" for="rating-4"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
                                <input class="rating__input" name="rating" id="rating-4" value="4" type="radio">
                                <label aria-label="5 stars" class="rating__label" for="rating-5"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
                                <input class="rating__input" name="rating" id="rating-5" value="5" type="radio">
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label class="mb-1" for="headline">Add a Headline</label>
                            <input type="text" class="form-control radius-300 h50px n360-border-color px-4" name="headline" id="headline" placeholder="What's most important to know?">
                        </div>
                        <div class="form-group mb-3">
                            <label class="mb-1" for="review">Add a Written Review</label>
                            <textarea class="p-3 radius-20 n360-border-color w-100" id="review" name="review" rows="4" cols="50" placeholder="What did you like or dislike about service/ products?"></textarea>
                        </div>
                        <div class="form-group mb-3">
                            <div id="multiple-file-preview" class="py-3">
                                <ul id="sortable">
                                    <li class="file-empty">
                                        <label class="button input_img_label" for="image_0">
                                            <svg width="26" height="19" viewBox="0 0 26 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M22.5634 9.07617C22.6806 8.68555 22.7587 8.29492 22.7587 7.86523C22.7587 5.48242 20.7665 3.49023 18.3837 3.49023C17.7197 3.49023 17.0947 3.64648 16.5087 3.91992C15.2587 2.16211 13.1884 0.990234 10.8837 0.990234C7.1728 0.990234 4.16498 3.91992 4.00873 7.5918C1.78217 8.37305 0.258733 10.4824 0.258733 12.8652C0.258733 15.9902 2.75873 18.4902 5.88373 18.4902H20.2587C22.9931 18.4902 25.2587 16.2637 25.2587 13.4902C25.2587 11.6543 24.2431 9.97461 22.5634 9.07617ZM20.0634 17.2402H6.07905C3.81342 17.2402 1.74311 15.5996 1.50873 13.334C1.27436 11.1465 2.71967 9.19336 4.71186 8.64648C5.02436 8.5293 5.25873 8.2168 5.25873 7.9043C5.25873 7.9043 5.25873 7.9043 5.25873 7.86523C5.21967 5.52148 6.70405 3.33398 8.93061 2.5918C11.7431 1.6543 14.3603 2.82617 15.6884 4.97461C15.8837 5.32617 16.3915 5.44336 16.7822 5.20898C17.4462 4.81836 18.2665 4.66211 19.1259 4.85742C20.1806 5.0918 21.04 5.91211 21.3525 6.92773C21.5869 7.70898 21.5087 8.45117 21.2353 9.07617C21.079 9.4668 21.3134 9.89648 21.704 10.0137C23.1884 10.6387 24.165 12.1621 23.9697 13.9199C23.7353 15.873 22.0165 17.2402 20.0634 17.2402ZM10.0634 10.209L12.1337 8.13867V14.7402C12.1337 15.0918 12.4072 15.3652 12.7587 15.3652C13.0712 15.3652 13.3837 15.0918 13.3837 14.7402V8.13867L15.415 10.209C15.6494 10.4434 16.079 10.4434 16.3134 10.209C16.5478 9.97461 16.5478 9.54492 16.3134 9.31055L13.1884 6.18555C13.0712 6.06836 12.915 5.99023 12.7587 5.99023C12.5634 5.99023 12.4072 6.06836 12.29 6.18555L9.16498 9.31055C8.93061 9.54492 8.93061 9.97461 9.16498 10.209C9.39936 10.4434 9.82905 10.4434 10.0634 10.209Z" fill="#D3427A" />
                                            </svg>
                                            <p class="p-color fsize-1 mb-0">Upload Photo/Videos</p>
                                        </label>
                                        <input type="file" name="image_0" class="input_img" data-index="0" id="image_0" />
                                    </li>
                                    <li class="file-empty">
                                        <label class="button input_img_label" for="image_1">
                                            <svg width="26" height="19" viewBox="0 0 26 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M22.5634 9.07617C22.6806 8.68555 22.7587 8.29492 22.7587 7.86523C22.7587 5.48242 20.7665 3.49023 18.3837 3.49023C17.7197 3.49023 17.0947 3.64648 16.5087 3.91992C15.2587 2.16211 13.1884 0.990234 10.8837 0.990234C7.1728 0.990234 4.16498 3.91992 4.00873 7.5918C1.78217 8.37305 0.258733 10.4824 0.258733 12.8652C0.258733 15.9902 2.75873 18.4902 5.88373 18.4902H20.2587C22.9931 18.4902 25.2587 16.2637 25.2587 13.4902C25.2587 11.6543 24.2431 9.97461 22.5634 9.07617ZM20.0634 17.2402H6.07905C3.81342 17.2402 1.74311 15.5996 1.50873 13.334C1.27436 11.1465 2.71967 9.19336 4.71186 8.64648C5.02436 8.5293 5.25873 8.2168 5.25873 7.9043C5.25873 7.9043 5.25873 7.9043 5.25873 7.86523C5.21967 5.52148 6.70405 3.33398 8.93061 2.5918C11.7431 1.6543 14.3603 2.82617 15.6884 4.97461C15.8837 5.32617 16.3915 5.44336 16.7822 5.20898C17.4462 4.81836 18.2665 4.66211 19.1259 4.85742C20.1806 5.0918 21.04 5.91211 21.3525 6.92773C21.5869 7.70898 21.5087 8.45117 21.2353 9.07617C21.079 9.4668 21.3134 9.89648 21.704 10.0137C23.1884 10.6387 24.165 12.1621 23.9697 13.9199C23.7353 15.873 22.0165 17.2402 20.0634 17.2402ZM10.0634 10.209L12.1337 8.13867V14.7402C12.1337 15.0918 12.4072 15.3652 12.7587 15.3652C13.0712 15.3652 13.3837 15.0918 13.3837 14.7402V8.13867L15.415 10.209C15.6494 10.4434 16.079 10.4434 16.3134 10.209C16.5478 9.97461 16.5478 9.54492 16.3134 9.31055L13.1884 6.18555C13.0712 6.06836 12.915 5.99023 12.7587 5.99023C12.5634 5.99023 12.4072 6.06836 12.29 6.18555L9.16498 9.31055C8.93061 9.54492 8.93061 9.97461 9.16498 10.209C9.39936 10.4434 9.82905 10.4434 10.0634 10.209Z" fill="#D3427A" />
                                            </svg>
                                            <p class="p-color fsize-1 mb-0">Upload Photo/Videos</p>
                                        </label>
                                        <input type="file" name="image_1" class="input_img" data-index="1" id="image_1" />
                                    </li>
                                    <li class="file-empty">
                                        <label class="button input_img_label" for="image_2">
                                            <svg width="26" height="19" viewBox="0 0 26 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M22.5634 9.07617C22.6806 8.68555 22.7587 8.29492 22.7587 7.86523C22.7587 5.48242 20.7665 3.49023 18.3837 3.49023C17.7197 3.49023 17.0947 3.64648 16.5087 3.91992C15.2587 2.16211 13.1884 0.990234 10.8837 0.990234C7.1728 0.990234 4.16498 3.91992 4.00873 7.5918C1.78217 8.37305 0.258733 10.4824 0.258733 12.8652C0.258733 15.9902 2.75873 18.4902 5.88373 18.4902H20.2587C22.9931 18.4902 25.2587 16.2637 25.2587 13.4902C25.2587 11.6543 24.2431 9.97461 22.5634 9.07617ZM20.0634 17.2402H6.07905C3.81342 17.2402 1.74311 15.5996 1.50873 13.334C1.27436 11.1465 2.71967 9.19336 4.71186 8.64648C5.02436 8.5293 5.25873 8.2168 5.25873 7.9043C5.25873 7.9043 5.25873 7.9043 5.25873 7.86523C5.21967 5.52148 6.70405 3.33398 8.93061 2.5918C11.7431 1.6543 14.3603 2.82617 15.6884 4.97461C15.8837 5.32617 16.3915 5.44336 16.7822 5.20898C17.4462 4.81836 18.2665 4.66211 19.1259 4.85742C20.1806 5.0918 21.04 5.91211 21.3525 6.92773C21.5869 7.70898 21.5087 8.45117 21.2353 9.07617C21.079 9.4668 21.3134 9.89648 21.704 10.0137C23.1884 10.6387 24.165 12.1621 23.9697 13.9199C23.7353 15.873 22.0165 17.2402 20.0634 17.2402ZM10.0634 10.209L12.1337 8.13867V14.7402C12.1337 15.0918 12.4072 15.3652 12.7587 15.3652C13.0712 15.3652 13.3837 15.0918 13.3837 14.7402V8.13867L15.415 10.209C15.6494 10.4434 16.079 10.4434 16.3134 10.209C16.5478 9.97461 16.5478 9.54492 16.3134 9.31055L13.1884 6.18555C13.0712 6.06836 12.915 5.99023 12.7587 5.99023C12.5634 5.99023 12.4072 6.06836 12.29 6.18555L9.16498 9.31055C8.93061 9.54492 8.93061 9.97461 9.16498 10.209C9.39936 10.4434 9.82905 10.4434 10.0634 10.209Z" fill="#D3427A" />
                                            </svg>
                                            <p class="p-color fsize-1 mb-0">Upload Photo/Videos</p>
                                        </label>
                                        <input type="file" name="image_2" class="input_img" data-index="2" id="image_2" />
                                    </li>
                                    <li class="file-empty">
                                        <label class="button input_img_label" for="image_3">
                                            <svg width="26" height="19" viewBox="0 0 26 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M22.5634 9.07617C22.6806 8.68555 22.7587 8.29492 22.7587 7.86523C22.7587 5.48242 20.7665 3.49023 18.3837 3.49023C17.7197 3.49023 17.0947 3.64648 16.5087 3.91992C15.2587 2.16211 13.1884 0.990234 10.8837 0.990234C7.1728 0.990234 4.16498 3.91992 4.00873 7.5918C1.78217 8.37305 0.258733 10.4824 0.258733 12.8652C0.258733 15.9902 2.75873 18.4902 5.88373 18.4902H20.2587C22.9931 18.4902 25.2587 16.2637 25.2587 13.4902C25.2587 11.6543 24.2431 9.97461 22.5634 9.07617ZM20.0634 17.2402H6.07905C3.81342 17.2402 1.74311 15.5996 1.50873 13.334C1.27436 11.1465 2.71967 9.19336 4.71186 8.64648C5.02436 8.5293 5.25873 8.2168 5.25873 7.9043C5.25873 7.9043 5.25873 7.9043 5.25873 7.86523C5.21967 5.52148 6.70405 3.33398 8.93061 2.5918C11.7431 1.6543 14.3603 2.82617 15.6884 4.97461C15.8837 5.32617 16.3915 5.44336 16.7822 5.20898C17.4462 4.81836 18.2665 4.66211 19.1259 4.85742C20.1806 5.0918 21.04 5.91211 21.3525 6.92773C21.5869 7.70898 21.5087 8.45117 21.2353 9.07617C21.079 9.4668 21.3134 9.89648 21.704 10.0137C23.1884 10.6387 24.165 12.1621 23.9697 13.9199C23.7353 15.873 22.0165 17.2402 20.0634 17.2402ZM10.0634 10.209L12.1337 8.13867V14.7402C12.1337 15.0918 12.4072 15.3652 12.7587 15.3652C13.0712 15.3652 13.3837 15.0918 13.3837 14.7402V8.13867L15.415 10.209C15.6494 10.4434 16.079 10.4434 16.3134 10.209C16.5478 9.97461 16.5478 9.54492 16.3134 9.31055L13.1884 6.18555C13.0712 6.06836 12.915 5.99023 12.7587 5.99023C12.5634 5.99023 12.4072 6.06836 12.29 6.18555L9.16498 9.31055C8.93061 9.54492 8.93061 9.97461 9.16498 10.209C9.39936 10.4434 9.82905 10.4434 10.0634 10.209Z" fill="#D3427A" />
                                            </svg>
                                            <p class="p-color fsize-1 mb-0">Upload Photo/Videos</p>
                                        </label>
                                        <input type="file" name="image_3" class="input_img" data-index="3" id="image_3" />
                                    </li>
                                    <li class="file-empty">
                                        <label class="button input_img_label" for="image_4">
                                            <svg width="26" height="19" viewBox="0 0 26 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M22.5634 9.07617C22.6806 8.68555 22.7587 8.29492 22.7587 7.86523C22.7587 5.48242 20.7665 3.49023 18.3837 3.49023C17.7197 3.49023 17.0947 3.64648 16.5087 3.91992C15.2587 2.16211 13.1884 0.990234 10.8837 0.990234C7.1728 0.990234 4.16498 3.91992 4.00873 7.5918C1.78217 8.37305 0.258733 10.4824 0.258733 12.8652C0.258733 15.9902 2.75873 18.4902 5.88373 18.4902H20.2587C22.9931 18.4902 25.2587 16.2637 25.2587 13.4902C25.2587 11.6543 24.2431 9.97461 22.5634 9.07617ZM20.0634 17.2402H6.07905C3.81342 17.2402 1.74311 15.5996 1.50873 13.334C1.27436 11.1465 2.71967 9.19336 4.71186 8.64648C5.02436 8.5293 5.25873 8.2168 5.25873 7.9043C5.25873 7.9043 5.25873 7.9043 5.25873 7.86523C5.21967 5.52148 6.70405 3.33398 8.93061 2.5918C11.7431 1.6543 14.3603 2.82617 15.6884 4.97461C15.8837 5.32617 16.3915 5.44336 16.7822 5.20898C17.4462 4.81836 18.2665 4.66211 19.1259 4.85742C20.1806 5.0918 21.04 5.91211 21.3525 6.92773C21.5869 7.70898 21.5087 8.45117 21.2353 9.07617C21.079 9.4668 21.3134 9.89648 21.704 10.0137C23.1884 10.6387 24.165 12.1621 23.9697 13.9199C23.7353 15.873 22.0165 17.2402 20.0634 17.2402ZM10.0634 10.209L12.1337 8.13867V14.7402C12.1337 15.0918 12.4072 15.3652 12.7587 15.3652C13.0712 15.3652 13.3837 15.0918 13.3837 14.7402V8.13867L15.415 10.209C15.6494 10.4434 16.079 10.4434 16.3134 10.209C16.5478 9.97461 16.5478 9.54492 16.3134 9.31055L13.1884 6.18555C13.0712 6.06836 12.915 5.99023 12.7587 5.99023C12.5634 5.99023 12.4072 6.06836 12.29 6.18555L9.16498 9.31055C8.93061 9.54492 8.93061 9.97461 9.16498 10.209C9.39936 10.4434 9.82905 10.4434 10.0634 10.209Z" fill="#D3427A" />
                                            </svg>
                                            <p class="p-color fsize-1 mb-0">Upload Photo/Videos</p>
                                        </label>
                                        <input type="file" name="image_4" class="input_img" data-index="4" id="image_4" />
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div id="form-results" class="py-2 alert d-none" role="alert"></div>
                        <button <?php if ($_isLogin) : ?> type="submit" <?php else : ?> type="button" data-bs-toggle="modal" data-bs-target="#login" <?php endif ?> class="btn btn-review-submit mulish-bold fsize-4 radius-300">Post Review</button>
                    </form>


                </div>
            </div>
            <div class="col-5 p-4 radius-10 border n360-border">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h3 class="mulish-bold h-color fsize-5">Newest Review</h3>
                    
                        <a class="btn btn-link n360-btn-viewall mulish-bold fsize-2 main-color text-decoration-none" href="<?= $_rootPath ?>/view-review/<?= $salon_id ?>"> 
                        View all
                        <span>
                            <svg width="18" height="18" viewBox="0 0 31 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M19.8184 18.9785C19.5254 18.7441 19.4082 18.3926 19.4082 17.9824C19.4082 17.6309 19.5254 17.2793 19.8184 17.0449L25.3848 11.4199H1.5957C0.775391 11.4199 0.189453 10.834 0.189453 10.0137C0.189453 9.25195 0.775391 8.60742 1.5957 8.60742H25.3848L19.8184 3.04102C19.2324 2.51367 19.2324 1.63477 19.8184 1.10742C20.3457 0.521484 21.2246 0.521484 21.8105 1.10742L29.7793 9.07617C30.3066 9.60352 30.3066 10.4824 29.7793 11.0098L21.8105 18.9785C21.2246 19.5645 20.3457 19.5645 19.8184 18.9785Z" fill="#D3427A" />
                            </svg>
                        </span>
                       </a>
                </div>
                <ul class="list_customer_reviews"></ul>
            </div>

        </div>
    </div>
</section>
<template id="review-items">
    <li class="py-2 item">
        <div class="d-flex justify-content-between align-items-center py-2">
            <div class="d-flex justify-content-center align-items-center gap-3">
                <img class="customer-review-avatar" src="<?= $temporary_src_img ?>" lazy-src="https://i.pravatar.cc/70?img=1" src-alt="">
                <div>
                    <h3 class="mulish-semibold h-color fsize-3 customer-name">Charlotte Martin</h3>
                    <div class="d-flex rating-ul">
                        <i class="rating__icon rating__icon--star fa fa-star"></i>
                        <i class="rating__icon rating__icon--star fa fa-star"></i>
                        <i class="rating__icon rating__icon--star fa fa-star"></i>
                        <i class="rating__icon rating__icon--star fa fa-star"></i>
                        <i class="rating__icon rating__icon--star fa fa-star"></i>
                    </div>
                </div>
            </div>
            <div class="user_post_date text-end">
                <p class="fsize-2 mb-1 post-time">1 day ago</p>
                <span>
                    <span class="thumb-up">
                    <img src="<?= $temporary_src_img ?>" lazy-src="<?= $_rootPath ?>/views/nail360/assets/icons/like.svg" /> 
                    </span>
                    <span class="like-number">42</span>
                </span>
            </div>
        </div>
        <strong class="mulish-bold h-color fsize-3 headline">Lorem Ipsum is simply dummy text of the printing</strong>
        <p class="p-color fsize-2 my-2 review-content text-break">The Pacific Grove Chamber of Commerce ould like to thank eLab Communications and Mr. Will Elkadi for all the efforts.</p>
    </li>
</template>
<?php require_once __DIR__ . '/../inc/_footer.php'; ?>
<!-- Bootstrap Picker -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/css/bootstrap-datepicker.min.css" integrity="sha512-34s5cpvaNG3BknEWSuOncX28vz97bRI59UnVtEEpFX536A7BtZSJHsDyFoCl8S7Dt2TPzcrCEoHBGeM4SUBDBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js" integrity="sha512-LsnSViqQyaXpD4mBBdRYeP6sRwJiJveh2ZIbW41EBrNmKxgr/LFZIiWT6yr+nycvhvauz8c2nYMhrP80YhG7Cw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<!-- Include JS file for this content below -->
<script src="<?= $_rootPath ?>/assets/js/global-js.js"></script>
<script src="<?= $_rootPath; ?>/views/nail360/assets/js/salon/salon-detail.js"></script>
<script src="<?= $_rootPath; ?>/views/nail360/assets/js/salon/write-detail.js"></script>
<!-- Run customize function below -->
<script>
    dataReady();
    lazyBackgroundReady();
</script>