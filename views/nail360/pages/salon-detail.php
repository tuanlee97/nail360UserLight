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
    "meta_title" => "Nail 360  – " . $salonDetail['name'],
    "meta_description" => "Experience the ultimate in nail care services and book your dream appointment today. From classic manicures to gel extensions and nail art, our comprehensive range of services is designed to cater to your individual needs and preferences. Our team of experienced nail technicians is dedicated to providing you with exceptional service and personalized attention, ensuring that you leave our salon feeling confident and beautiful. Discover the perfect nail salon experience and book your appointment now.",
    "meta_image" => $meta_image
);
$GLOBALS['link_css'] = array("salon/salon_details.css");
require_once __DIR__ . '/../inc/_header.php';
$temporary_src_img = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mM8XQ8AAhsBTLgo62UAAAAASUVORK5CYII=";
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script>
    const token = "<?= $_COOKIE['token'] ?>";
    const salon_id = "<?= $salon_id ?>";
    const salon_name = "<?= $salonDetail['name'] ?>";
</script>
<section data-id="<?= $salon_id ?>" data-name="<?= $salonDetail['name'] ?>" class="salon_detail_section pt-3 pb-5">
    <?php
    if ($_isLogin) {
        include __DIR__ . '/../inc/templates/salon/salon-detail/booking-popup.php';
    }
    ?>
    <div class="section-wrap-medium ">
        <div class="salon_detail_info">
            <div class="d-flex gap-2 gap-sm-0">
            <div class="salon_detail_info__brandimg"><img src="<?= $temporary_src_img ?>" lazy-src="https://i.pravatar.cc/70?img=1" src-alt="<?= $salonDetail['name'] ?>"></div>
            <div class="flex-grow-1">
                <div class="d-flex flex-wrap flex-sm-nowrap align-items-center gap-0 gap-sm-3">
                    <h2 class="fsize-7 mulish-bold"><a class="h-color mulish-bold text-decoration-none" href="<?= $_rootPath ?>/salon/<?= $salon_id ?>"><?= $salonDetail['name'] ?></a></h2>
                    <div>
                        <span class="fsize-2 mulish-bold green-color">Open Now</span>
                        <span class="fsize-2 mulish-bold p-color">- Closes 10 PM</span>
                    </div>
                </div>
                <div class="salon_feature">
                    <div class="d-flex align-items-end gap-1 flex-wrap flex-sm-nowrap w-100 justify-content-between justify-content-sm-start">
                        <div class="d-flex align-items-center">
                            <img height="21" src="<?= $temporary_src_img ?>" lazy-src="<?= $_rootPath ?>/views/nail360/assets/icons/star.svg" />
                            <div class="h-25px ms-1">
                                <span class="mulish-semibold h-color fsize-5"><?= format_number($salonDetail['star'], 1) ?></span>
                                <span class="mulish-semibold p-color fsize-2">(<?= $salonDetail['countreview'] ?>)</span>
                            </div>
                        </div>
                        <?php if ($salonDetail['approve'] == 0) : ?>
                            <div class="d-flex align-items-end">
                            <img class="ms-0 ms-sm-2" height="20" src="<?= $temporary_src_img ?>" lazy-src="<?= $_rootPath ?>/views/nail360/assets/icons/badge-check.svg" />
                            <span class="p-color fsize-2 lh-16px">Verified by Owner</span>
                            </div>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
        <ul class="salon_feature__btn list-style-none d-flex gap-2 m-0">
                        <li class="cursor-pointer radius-300 salon_feature__btn--item bg-main text-white" <?php if ($_isLogin) : ?> data-bs-toggle="modal" data-bs-target="#addGuest" <?php else : ?> data-bs-toggle="modal" data-bs-target="#login" <?php endif ?>>Book now</li>
                        <li class="salon_feature__btn--item radius-300 p-color border">
                            <a id="link-write-review" class="p-color text-decoration-none" href="<?= $_rootPath ?>/write-review/<?= $salon_id ?>">
                                <img src="<?= $temporary_src_img ?>" lazy-src="<?= $_rootPath ?>/views/nail360/assets/icons/pencil-write.svg" />
                            </a>
                        </li>
                        <li class="salon_feature__btn--item radius-300 p-color border" <?php if ($_isLogin) : ?> onclick="alert('Open Modal Add Photo')" <?php else : ?> data-bs-toggle="modal" data-bs-target="#login" <?php endif ?>><img src="<?= $temporary_src_img ?>" lazy-src="<?= $_rootPath ?>/views/nail360/assets/icons/plus.svg" /> Add Photo</li>
                        <li id="link-share" class="salon_feature__btn--item radius-300 p-color border"><img src="<?= $temporary_src_img ?>" lazy-src="<?= $_rootPath ?>/views/nail360/assets/icons/share.svg" /></li>
                        <li id="link-save" class="salon_feature__btn--item radius-300 p-color border" <?php if ($_isLogin) : ?> onclick="alert('Call API Toggle Favorite')" <?php else : ?> data-bs-toggle="modal" data-bs-target="#login" <?php endif ?>>
                            <img src="<?= $temporary_src_img ?>" lazy-src="<?= $_rootPath ?>/views/nail360/assets/icons/heart.svg" />
                        </li>
                    </ul>
                        </div>
        <?php include __DIR__ . '/../inc/templates/salon/salon-detail/gallery.php'; ?>
        <?php include __DIR__ . '/../inc/templates/salon/salon-detail/gallery-popup.php'; ?>
        <?php include __DIR__ . '/../inc/templates/salon/salon-detail/gallery-detail-popup.php'; ?>
    </div>
    <div class="section-wrap">
        <div class="salon-service-container">
            <?php
            include __DIR__ . '/../inc/templates/salon/salon-detail/list-service.php';
            include __DIR__ . '/../inc/templates/salon/salon-detail/booking-aside.php';
            ?>
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
    document.addEventListener("DOMContentLoaded", (event) => {
        dataReady();
        lazyBackgroundReady();
    });


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
    // async function initMap() {

    //     // In the following example, markers appear when the user clicks on the map.
    //     // Each marker is labeled with a single alphabetical character.




    //     window.initMap = initMap;
    // }
</script>
<script id="script-map" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD3GG7Qq1XgRMAcjPejT9spgnR4RZ9xzbU&callback=initMap&v=weekly" defer></script>