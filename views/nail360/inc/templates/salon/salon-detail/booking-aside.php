<div class="booking_aside_container">
<aside class="booking_aside">
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
</aside>
</div>