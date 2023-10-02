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
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
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
                        <li class="salon_feature__btn--item radius-300 p-color px-4 py-1 border">
                           <a class="p-color text-decoration-none" href="<?= $_rootPath ?>/write-review/<?= $salon_id ?>"> 
                                <img src="<?= $temporary_src_img ?>" lazy-src="<?= $_rootPath ?>/views/nail360/assets/icons/pencil-write.svg" /> Write a Review
                           </a>
                        </li>
                        <li class="salon_feature__btn--item radius-300 p-color px-4 py-1 border" <?php if ($_isLogin) : ?> onclick="alert('Open Modal Add Photo')" <?php else : ?> data-bs-toggle="modal" data-bs-target="#login" <?php endif ?>><img src="<?= $temporary_src_img ?>" lazy-src="<?= $_rootPath ?>/views/nail360/assets/icons/plus.svg" /> Add Photo</li>
                        <li class="salon_feature__btn--item radius-300 p-color px-4 py-1 border"><img src="<?= $temporary_src_img ?>" lazy-src="<?= $_rootPath ?>/views/nail360/assets/icons/share.svg" /> Share</li>
                        <li class="salon_feature__btn--item radius-300 p-color px-4 py-1 border" <?php if ($_isLogin) : ?> onclick="alert('Call API Toggle Favorite')" <?php else : ?> data-bs-toggle="modal" data-bs-target="#login" <?php endif ?>>
                            <img src="<?= $temporary_src_img ?>" lazy-src="<?= $_rootPath ?>/views/nail360/assets/icons/heart.svg" />
                            Save
                        </li>
                    </ul>

                </div>
            </div>
        </div>
        <div class="row my-4 border radius-10 p-4">
            <div class="col-4">
                <div>
                    <h3 class="mulish-bold fsize-5 h-color">Customer Reviews</h3>
                    <div class="d-flex align-items-baseline gap-1">
                        <div class="d-flex">
                            <i class="fsize-6 rating__icon rating__icon--star fa fa-star"></i>
                            <i class="fsize-6 rating__icon rating__icon--star fa fa-star"></i>
                            <i class="fsize-6 rating__icon rating__icon--star fa fa-star"></i>
                            <i class="fsize-6 rating__icon rating__icon--star fa fa-star"></i>
                            <i class="fsize-6 rating__icon rating__icon--star fa fa-star"></i>
                        </div>
                        <p class="fsize-5 mulish-semibold h-color m-0">4.5</p>
                        <p class="fsize-3 p-color m-0">Out of 5</p>
                    </div>
                    <p class="fsize-2 h-color">12345 Customer Rating</p>
                    <div class="d-flex fsize-2 h-color gap-2">
                        <span>5 star</span>
                        <div class="progress mb-2 w-75">
                            <div class="progress-bar bg-review-5" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <span>80%</span>
                    </div>
                    <div class="d-flex fsize-2 h-color gap-2">
                        <span>4 star</span>
                        <div class="progress mb-2 w-75">
                            <div class="progress-bar bg-review-4" role="progressbar" style="width: 9%" aria-valuenow="9" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <span>9%</span>
                    </div>
                    <div class="d-flex fsize-2 h-color gap-2">
                        <span>3 star</span>
                        <div class="progress mb-2 w-75">
                        <div class="progress-bar bg-review-3" role="progressbar" style="width: 4%" aria-valuenow="4" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <span>4%</span>
                    </div>
                    <div class="d-flex fsize-2 h-color gap-2">
                        <span>2 star</span>
                        <div class="progress mb-2 w-75">
                        <div class="progress-bar bg-review-2" role="progressbar" style="width: 2%" aria-valuenow="2" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <span>2%</span>
                    </div>
                    <div class="d-flex fsize-2 h-color gap-2">
                        <span>1 star</span>
                        <div class="progress mb-2 w-75">
                        <div class="progress-bar bg-review-1" role="progressbar" style="width: 1%" aria-valuenow="1" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <span>1%</span>
                    </div>
                    
                </div>
                <div class="my-5">
                    <h3 class="mulish-bold fsize-4">Location & Hours</h3>
                    <div id="quick-book-map" class="quick-book-map"></div>
                    <div class="quick-book__contact py-3">
                        <div class="contact__address">
                            <div class="d-flex gap-2">
                                <div class="contact__address--icon">
                                    <img src="<?= $temporary_src_img ?>" lazy-src="<?= $_rootPath ?>/views/nail360/assets/icons/distance-white.svg">
                                </div>
                                <p class="contact__address--info mulish-semibold fsize-3">
                                    <?= $salonDetail['street'] . ' '
                                        . $salonDetail['city'] . ', '
                                        . $salonDetail['state'] . ' '
                                        . $salonDetail['zip']; ?>
                                </p>
                            </div>
                            <button class="contact__address--btn mulish-extralight fsize-1">Direction</button>
                        </div>
                        <?php if ($salonDetail['phone']) : ?>
                            <div class="contact__phone">
                                <div class="d-flex gap-2">
                                    <div class="contact__address--icon">
                                        <img src="<?= $temporary_src_img ?>" lazy-src="<?= $_rootPath ?>/views/nail360/assets/icons/call.svg">
                                    </div>

                                    <p class="contact__address--info mulish-semibold fsize-3"><?= format_phone_number($salonDetail['phone']) ?></p>

                                </div>
                                <button class="contact__address--btn mulish-extralight fsize-1"><a href="tel:<?= $salonDetail['phone'] ?>">Call</a></button>
                            </div>
                        <?php endif ?>
                    </div>
                    <div class="quickbook__price text-center">
                        <span class="fsize-3 h-color">Price:</span>
                        <span class="fsize-5 main-color mulish-bold"><?= format_currency($salonDetail['price']); ?></span>
                    </div>
                    <div class="dropdown  py-3">
                        <button class="w-100 btn btn-quickbook dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="fsize-2 mulish-bold green-color">Open Now</span>
                            <span class="fsize-2 mulish-bold p-color">- Closes 10 PM</span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </div>
                    <?php if ($salonDetail['website']) : ?>
                        <p class="fsize-2 h-color"><?= $salonDetail['website'] ?></p>
                    <?php endif ?>
                    <div class="social-connect d-flex align-items-center">
                        <span class="fsize-2 h-color">Social Media</span>
                        <span>
                            <ul class="social-list">
                                <li class="social-list--item list-unstyled"><a href="https://www.facebook.com/"><img lazy-src="<?= $_rootPath ?>/views/nail360/assets/icons/fb-icon.svg" src-alt="fb-icon.svg" /></a></li>
                                <li class="social-list--item list-unstyled"><a href="https://www.instagram.com/"><img lazy-src="<?= $_rootPath ?>/views/nail360/assets/icons/ig-icon.svg" src-alt="ig-icon.svg" /></a></li>
                                <li class="social-list--item list-unstyled"><a href="https://twitter.com/"><img lazy-src="<?= $_rootPath ?>/views/nail360/assets/icons/twitter-icon.svg" src-alt="twitter-icon.svg" /></a></li>

                            </ul>
                        </span>
                    </div>

                    <button type="button" <?php if ($_isLogin) : ?> data-bs-toggle="modal" data-bs-target="#addGuest" <?php else : ?> data-bs-toggle="modal" data-bs-target="#login" <?php endif ?> class="mt-4 btn bg-main text-white mulish-bold w-100 radius-300 ">Book Now</button>
                </div>
            </div>
            <div class="col-8 ps-5">
               <h3 class="mulish-bold fsize-5 h-color">Review with Images</h3>
               <ul class="d-flex justify-content-between list-style-none p-0 m-0">
                <?php for ($i=1; $i <= 4; $i++) : ?>
                    <li class="review-img loading">
                        <img lazy-src="https://i.pravatar.cc/300?img=<?= $i ?>" src-alt="" />
                    </li>
                <?php endfor; ?>
               </ul>
               <div class="text-end"><a href="#" class="h-color fsize-2">View all the images</a></div>
               <div class="d-flex align-items-center justify-content-between py-3 border-bottom">
                    <div class="col-3"><h3 class="mulish-bold fsize-5 h-color">Top Reviews</h3></div>
                    <div class="col-9 d-flex align-items-center justify-content-between">
                        <form action="<?php echo $_rootPath; ?>/searchreview" method="post" class="m-0 d-flex align-items-center justify-content-between fsize-2 sm-navbar__search bg-white <?php if($_isLogin): ?> flex-grow-0pt6 <?php endif; ?>">
                            <input type="text" name="name" value = "<?php echo $_POST['searchreview']; ?>" class="border-0 ms-3 outline-none w-75" placeholder="Search by keyword..." />
                            <button type="submit" class="border-0 rounded-circle sm-circle__search_btn d-flex justify-content-center align-items-center bg-main ">
                                <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M19.6875 18.9507C20.0781 19.3413 20.0781 19.9272 19.6875 20.2788C19.5312 20.4741 19.2969 20.5522 19.0625 20.5522C18.7891 20.5522 18.5547 20.4741 18.3594 20.2788L13.125 15.0444C11.7188 16.1772 9.96094 16.8022 8.08594 16.8022C3.63281 16.8022 0 13.1694 0 8.67725C0 4.22412 3.59375 0.552246 8.08594 0.552246C12.5391 0.552246 16.2109 4.22412 16.2109 8.67725C16.2109 10.5913 15.5859 12.3491 14.4531 13.7163L19.6875 18.9507ZM1.875 8.67725C1.875 12.1538 4.64844 14.9272 8.125 14.9272C11.5625 14.9272 14.375 12.1538 14.375 8.67725C14.375 5.23975 11.5625 2.42725 8.125 2.42725C4.64844 2.42725 1.875 5.23975 1.875 8.67725Z" fill="white" />
                                </svg>
                            </button>
                        </form>
                        <div class="drop-sort-btn position-relative d-flex justify-content-center">
                            <div class="drop-sort-btn--item position-absolute">
                            <button type="button" class="drop-btn btn btn-outline-secondary dropdown-toggle p-color fsize-2 px-3">
                                <span>Sort by : </span>
                                <span class="h-color" id="sort-by">All</span>
                            </button>
                            <ul class="drop-menu">
                                <li><a class="drop-item fsize-2" href="#/">All</a></li>
                                <li><a class="drop-item fsize-2" href="#/">New Added</a></li>
                                <li><a class="drop-item fsize-2" href="#/">REV: Low to High</a></li>
                                <li><a class="drop-item fsize-2" href="#/">DESC: Far to Near</a></li>
                                <li><a class="drop-item fsize-2" href="#/">DESC: Near to Far</a></li>
                            </ul>
                            </div>
                        </div>
                        <div class="drop-sort-btn position-relative d-flex justify-content-end">
                            <div class="drop-sort-btn--item position-absolute">
                            <button type="button" class="drop-btn btn btn-outline-secondary dropdown-toggle p-color fsize-2 px-3">
                       
                                <span class="h-color" id="sort-by">Filter by rating :</span>
                            </button>
                            <ul class="drop-menu">
                                <li><a class="drop-item fsize-2" href="#/">All</a></li>
                                <li><a class="drop-item fsize-2" href="#/">New Added</a></li>
                                <li><a class="drop-item fsize-2" href="#/">REV: Low to High</a></li>
                                <li><a class="drop-item fsize-2" href="#/">DESC: Far to Near</a></li>
                                <li><a class="drop-item fsize-2" href="#/">DESC: Near to Far</a></li>
                            </ul>
                            </div>
                        </div>
                    </div>
               </div>
               <ul class="customer_revies">
                <?php for ($i=1; $i <= 4; $i++) : ?>
                    <li class="py-2">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex justify-content-between align-items-center py-2">
                                <div class="d-flex justify-content-center align-items-center gap-3">
                                    <img class="customer-review-avatar" src="<?= $temporary_src_img ?>" lazy-src="https://i.pravatar.cc/70?img=1" src-alt="">
                                    <div>
                                        <h3 class="mulish-semibold h-color fsize-3">Charlotte Martin</h3>
                                        <div class="d-flex">
                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                        </div>
                                        <p class="p-color mb-1">1/1/2023</p>
                                    </div>
                                
                                </div>
                                <div class="user_post_date text-end">
                                
                                    <span>
                                        <svg width="15" height="13" viewBox="0 0 15 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M3.50244 11.8789C3.50244 12.3711 3.09229 12.7539 2.62744 12.6992H0.877441C0.385254 12.6992 0.00244141 12.3164 0.00244141 11.8516V5.75391C0.00244141 5.28906 0.385254 4.87891 0.877441 4.87891H2.62744C3.09229 4.87891 3.50244 5.26172 3.50244 5.75391V11.8789ZM14.0024 5.78125C14.0024 6.46484 13.4556 7.03906 12.772 7.06641C12.9907 7.3125 13.1274 7.61328 13.1274 7.96875C13.1274 8.59766 12.6626 9.11719 12.0337 9.25391C12.1704 9.44531 12.2524 9.66406 12.2524 9.91016C12.2524 10.5117 11.8696 11.0039 11.3228 11.168C11.3501 11.25 11.3774 11.3594 11.3774 11.4688C11.3774 12.1797 10.7759 12.7539 10.0649 12.7539H8.45166C7.49463 12.7539 6.59229 12.4531 5.82666 11.8789L4.89697 11.1953C4.56885 10.9492 4.37744 10.5664 4.37744 10.1289V5.75391C4.37744 5.78125 4.37744 5.75391 4.37744 5.75391C4.37744 5.37109 4.5415 5.01562 4.86963 4.74219L5.30713 4.38672C7.54932 2.60938 6.5376 0.503906 8.26025 0.503906C9.10791 0.503906 9.62744 1.1875 9.62744 1.84375C9.62744 2.25391 9.29932 3.42969 8.67041 4.46875H12.6899C13.4009 4.46875 14.0024 5.04297 14.0024 5.78125Z" fill="#007AB5" />
                                        </svg>

                                        42
                                    </span>
                                </div>
                            </div>
                            <ul class="salon_feature__btn list-style-none d-flex gap-2 m-0">
                                <li class="salon_feature__btn--item radius-300 p-color px-4 py-1 border" <?php if ($_isLogin) : ?> onclick="alert('Open Modal Add Photo')" <?php else : ?> data-bs-toggle="modal" data-bs-target="#login" <?php endif ?>><img src="<?= $temporary_src_img ?>" lazy-src="<?= $_rootPath ?>/views/nail360/assets/icons/like.svg" /> Like</li>
                                <li class="salon_feature__btn--item radius-300 p-color px-4 py-1 border"><img src="<?= $temporary_src_img ?>" lazy-src="<?= $_rootPath ?>/views/nail360/assets/icons/share.svg" /> Share</li>
                                <li class="salon_feature__btn--item btn-report p-color border rounded-circle" <?php if ($_isLogin) : ?> onclick="alert('Open Modal Add Photo')" <?php else : ?> data-bs-toggle="modal" data-bs-target="#login" <?php endif ?>><img src="<?= $temporary_src_img ?>" lazy-src="<?= $_rootPath ?>/views/nail360/assets/icons/flag-report.svg" /></li>
                            </ul>
                        </div>
                        <strong class="mulish-bold h-color fsize-3">Lorem Ipsum is simply dummy text of the printing</strong>
                        <p class="p-color fsize-2 my-2">The Pacific Grove Chamber of Commerce ould like to thank eLab Communications and Mr. Will Elkadi for all the efforts.</p>
                    </li>
                    <?php endfor; ?>
                </ul>
                <ul class="d-flex justify-content-between list-style-none p-0 m-0 py-3 border-top">
                <?php for ($i=1; $i <= 4; $i++) : ?>
                    <li class="review-img loading">
                        <img lazy-src="https://i.pravatar.cc/300?img=<?= $i ?>" src-alt="" />
                    </li>
                <?php endfor; ?>
               </ul>
               <div class="text-center"><a href="#" class="main-color mulish-bold text-decoration-none see-more-review">See More</a></div>
            </div>
        </div>
    </div>
</section>
<?php require_once __DIR__ . '/../inc/_footer.php'; ?>
<!-- Bootstrap Picker -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/css/bootstrap-datepicker.min.css" integrity="sha512-34s5cpvaNG3BknEWSuOncX28vz97bRI59UnVtEEpFX536A7BtZSJHsDyFoCl8S7Dt2TPzcrCEoHBGeM4SUBDBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js" integrity="sha512-LsnSViqQyaXpD4mBBdRYeP6sRwJiJveh2ZIbW41EBrNmKxgr/LFZIiWT6yr+nycvhvauz8c2nYMhrP80YhG7Cw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<!-- Include JS file for this content below -->
<script src="<?= $_rootPath ?>/assets/js/global-js.js"></script>
<script src="<?= $_rootPath; ?>/views/nail360/assets/js/salon/salon-detail.js"></script>
<!-- Run customize function below -->
<script>
    $(function() {
        async function removeBtnClick() {
            $('.order-number').click(function(e) {
                let li = $(this).parent();
                li.removeClass('ui-state-default');
                li.addClass('file-empty');
                li.removeData('order');
                li.removeData('id');
                li.find('.input_img_label').html('<svg width="26" height="19" viewBox="0 0 26 19" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M22.5634 9.07617C22.6806 8.68555 22.7587 8.29492 22.7587 7.86523C22.7587 5.48242 20.7665 3.49023 18.3837 3.49023C17.7197 3.49023 17.0947 3.64648 16.5087 3.91992C15.2587 2.16211 13.1884 0.990234 10.8837 0.990234C7.1728 0.990234 4.16498 3.91992 4.00873 7.5918C1.78217 8.37305 0.258733 10.4824 0.258733 12.8652C0.258733 15.9902 2.75873 18.4902 5.88373 18.4902H20.2587C22.9931 18.4902 25.2587 16.2637 25.2587 13.4902C25.2587 11.6543 24.2431 9.97461 22.5634 9.07617ZM20.0634 17.2402H6.07905C3.81342 17.2402 1.74311 15.5996 1.50873 13.334C1.27436 11.1465 2.71967 9.19336 4.71186 8.64648C5.02436 8.5293 5.25873 8.2168 5.25873 7.9043C5.25873 7.9043 5.25873 7.9043 5.25873 7.86523C5.21967 5.52148 6.70405 3.33398 8.93061 2.5918C11.7431 1.6543 14.3603 2.82617 15.6884 4.97461C15.8837 5.32617 16.3915 5.44336 16.7822 5.20898C17.4462 4.81836 18.2665 4.66211 19.1259 4.85742C20.1806 5.0918 21.04 5.91211 21.3525 6.92773C21.5869 7.70898 21.5087 8.45117 21.2353 9.07617C21.079 9.4668 21.3134 9.89648 21.704 10.0137C23.1884 10.6387 24.165 12.1621 23.9697 13.9199C23.7353 15.873 22.0165 17.2402 20.0634 17.2402ZM10.0634 10.209L12.1337 8.13867V14.7402C12.1337 15.0918 12.4072 15.3652 12.7587 15.3652C13.0712 15.3652 13.3837 15.0918 13.3837 14.7402V8.13867L15.415 10.209C15.6494 10.4434 16.079 10.4434 16.3134 10.209C16.5478 9.97461 16.5478 9.54492 16.3134 9.31055L13.1884 6.18555C13.0712 6.06836 12.915 5.99023 12.7587 5.99023C12.5634 5.99023 12.4072 6.06836 12.29 6.18555L9.16498 9.31055C8.93061 9.54492 8.93061 9.97461 9.16498 10.209C9.39936 10.4434 9.82905 10.4434 10.0634 10.209Z" fill="#D3427A"></path></svg>' +
                    '<p class="p-color fsize-1 mb-0">Upload Photo/Videos</p>');
                $(this).remove();
            })
        }
        $(".tech-service__select").select2({
            tags: true
        });

        $('.input_img').change(function(e) {
            let index = $(this).data("index");
            let li = $($('#sortable li')[index])
            var files = e.target.files;
            for (var i = 0; i <= files.length; i++) {

                // when i == files.length reorder and break
                if (i == files.length) {
                    // need timeout to reorder beacuse prepend is not done
                    setTimeout(function() {
                        reorderImages();
                        removeBtnClick();
                    }, 100);
                    break;
                }

                var file = files[i];
                var reader = new FileReader();
                reader.onload = (function(file) {
                    li.removeClass('file-empty')
                    li.addClass('ui-state-default')
                    li.data('order', index)
                    li.data('id', file.lastModified)
                    li.prepend('<div class="order-number"></div>')
                    return function(event) {
                        li.find('.input_img_label').html('<img src="' + event.target.result + '" style="width:100%;" />');
                    };
                })(file);

                reader.readAsDataURL(file);
            } // end for;

        });

        function reorderImages() {
            // get the items
            var images = $('#sortable li');

            var i = 0,
                nrOrder = 0;
            for (i; i < images.length; i++) {

                var image = $(images[i]);

                if (image.hasClass('ui-state-default')) {
                    image.attr('data-order', nrOrder);
                    var orderNumberBox = image.find('.order-number');
                    //orderNumberBox.html(nrOrder + 1);
                    orderNumberBox.html('<svg width="8" height="8" viewBox="0 0 8 8" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7.57617 6.68604C7.78711 6.92041 7.78711 7.27197 7.57617 7.48291C7.3418 7.71729 6.99023 7.71729 6.7793 7.48291L4.01367 4.69385L1.22461 7.48291C0.990234 7.71729 0.638672 7.71729 0.427734 7.48291C0.193359 7.27197 0.193359 6.92041 0.427734 6.68604L3.2168 3.89697L0.427734 1.10791C0.193359 0.873535 0.193359 0.521973 0.427734 0.311035C0.638672 0.0766602 0.990234 0.0766602 1.20117 0.311035L4.01367 3.12354L6.80273 0.334473C7.01367 0.100098 7.36523 0.100098 7.57617 0.334473C7.81055 0.54541 7.81055 0.896973 7.57617 1.13135L4.78711 3.89697L7.57617 6.68604Z" fill="white"/></svg>');
                    nrOrder++;
                } // end if;

            } // end for;
        }

    });

    dataReady();
    lazyBackgroundReady();
    // Adds a marker to the map.
    function addMarker(location, map) {
        var icon = {
            url: window._rootPath + '/views/nail360/assets/icons/map-marker.svg',
        };
        // Add the marker at the clicked location, and add the next-available label
        // from the array of alphabetical characters.
        var marker = new google.maps.Marker({
            position: location,
            map: map,
            icon: icon,
            animation: google.maps.Animation.DROP
        });
        const label = "<?= $salonDetail['name'] ?>";
        var infowindow = new google.maps.InfoWindow();
        google.maps.event.addListener(marker, 'click', (function(marker) {
            return function() {
                infowindow.setContent(label);
                infowindow.open(map, marker);
                if (marker.getAnimation() !== null) {
                    marker.setAnimation(null);
                } else {
                    marker.setAnimation(google.maps.Animation.BOUNCE);
                }
            }
        })(marker));
    }

    function initMap() {
        var bangalore = new google.maps.LatLng(<?= $salonDetail['latitude'] ?>, <?= $salonDetail['longitude'] ?>);
        const map = new google.maps.Map(document.getElementById("quick-book-map"), {
            zoom: 12,
            center: bangalore,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });
        // This event listener calls addMarker() when the map is clicked.
        google.maps.event.addListener(map, "click", (event) => {
            addMarker(event.latLng, map);
        });
        // Add a marker at the center of the map.
        addMarker(bangalore, map);
    }
</script>

<script id="script-map" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD3GG7Qq1XgRMAcjPejT9spgnR4RZ9xzbU&callback=initMap&v=weekly" defer></script>