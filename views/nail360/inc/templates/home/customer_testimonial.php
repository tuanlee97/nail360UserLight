<style>
    @media (max-width : 1365px) {
        .card-testimonial {
            width: 95%;
        }
    }

    @media (max-width : 768px) {
        .list_customer_testimonial .swiper-slide {
            width: 80%;
        }
    }
</style>
<template id="customer_testimonial_template">
    <div class="swiper-slide">
        <div class="card-testimonial p-4 d-flex flex-column justify-content-between">
            <div class="d-flex flex-wrap gap-2">
                <div class="testimonial__img--avatar rounded-circle" data-salon_avatar_img>
                    <div class="loading"></div>
                </div>
                <div class="brand_container">
                    <h6 class="brand_name fsize-4 mulish-semibold h-color mb-0" data-salon_name>
                        <div class="loading loading-w-2"></div>
                        <div class="loading loading-w-2 mt-1"></div>
                    </h6>
                    <div class="brand_rate d-flex align-items-baseline gap-1">
                        <div class="rate-star" data-rate_star_icon></div>
                        <span class="fsize-1 p-color" data-review_date></span>

                    </div>
                </div>
            </div>
            <p class="testimonial__description fsize-3 p-color fst-italic" data-description>
                <span class="loading loading-paragraph"></span>
                <span class="loading loading-paragraph"></span>
                <span class="loading loading-paragraph-2"></span>
            </p>
            <div class="testimonial__bottom d-flex flex-wrap justify-content-between  align-items-center">
                <div class="d-flex flex-wrap gap-2">
                    <div class="testimonial__img--user_avatar rounded-circle" data-user_avatar_img>
                        <div class="loading"></div>
                    </div>
                    <div>
                        <h6 class="mulish-semibold fsize-3 h-color mb-1" data-user_name><span class="loading loading-w-1 d-block mb-0"></span></h6>
                        <p class="fsize-2 p-color" data-user_position><span class="loading loading-w-1 d-block"></span></p>
                    </div>
                </div>
                <div data-quote_mask>
                    <div class="loading" style="width: 38px; height:28px;"></div>
                </div>
            </div>
        </div>
    </div>
</template>
<section class="section_customer_testimonial_template">
    <div id="swiperTestimonial" class="section-wrap position-relative swiper">
        <img class="position-absolute top-0 start-0" lazy-src="<?= $_rootPath ?>/views/nail360/assets/icons/hand-1.svg" src-alt="Hand 1" />
        <img class="position-absolute top-0 end-0" lazy-src="<?= $_rootPath ?>/views/nail360/assets/icons/hand-2.svg" src-alt="Hand 2" />
        <h2 class="mulish-bold customer_testimonial__heading h-color text-center">What Our Users Say</h2>
        <p class="fsize-3 sub-h-color mx-auto text-center lh-24px customer_testimonial__subheading">Explore on the world's best & largest Bidding marketplace with our beautiful Bidding products. We want to be a part of your smile, success and future growth.</p>
        <div class="p-2 py-3 list_customer_testimonial swiper-wrapper"></div>
    </div>
</section>