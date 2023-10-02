<section class="section-favorite-salons">
    <template id="favoriteItemTemplate">
        <div class="swiper-slide">
            <div class="card top_salon">
                <div class="top_salon__img--top" data-top_img>
                    <div class="loading"></div>
                </div>
                <div class="card-body top_salon__info">
                    <div class="top_salon__info--top d-flex gap-2">
                        <div class="top_salon__img--avatar rounded-circle" data-avatar_img>
                            <div class="loading"></div>
                        </div>
                        <div class="brand_container">
                            <h6 class="brand_name fsize-4 mulish-semibold h-color mb-0" data-salon_name>
                                <div class="loading loading-w-2"></div>
                            </h6>
                            <div class="brand_rate d-flex align-items-center gap-1">
                                <div class="rate-star" data-rate_star_icon></div>
                                <div class="lh-18px h-18px">
                                    <span class="fsize-2 mulish-semibold h-color" data-rated_star></span>
                                    <span class="fsize-1 p-color" data-review_number></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="top_salon__info--description fsize-2 p-color" data-description>
                        <span class="loading loading-paragraph"></span>
                        <span class="loading loading-paragraph-2"></span>
                    </p>
                    <div class="top_salon__info--bottom">
                        <div class="geo_distance">
                            <span class="geo_distance__icon" data-geo_distance_icon></span>
                            <span class="fsize-2 h-color align-bottom" data-miles></span>
                            <span class="fsize-2 p-color align-bottom" data-drive></span>
                        </div>
                        <a class="text-decoration-none radius-300 mulish-bold top_salon__booking-btn" data-booking_btn>
                            <span class="top_salon__booking-btn loading loading-button-1"></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </template>
    <div class="section-wrap favorite-salons-container">
        <div class="section-favorite-salons__header">
            <h2 class="section-favorite-salons__heading mulish-bold h-color">Favorites Salons</h2>
            <div class="favorite__salons-navigation-container">
            <div class="swiper-button-prev favs-button-prev"></div>
                <div class="swiper-button-next favs-button-next"></div>
               
            </div>
        </div>

        <div id="swiperFavoriteSalon" class="swiper list_favorite-salons">
            <div class="swiper-wrapper"></div>
        </div>
    </div>
</section>