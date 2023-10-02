<div class="list-salon-container">
<h2 class="mulish-bold fsize-7">Services</h2>
    <div class="grid row-gap-4 column-gap-3 list-salon-services">
        <template id="topServiceItemTemplate">
            <div class="list-salon-services--item p-0">
                <div class="card n360_card">
                    <div class="n360_card__feature_img position-relative" data-top_img>
                        <div class="loading"></div>

                    </div>
                    <div class="card-body">
                        <div class="n360_card__header">
                            <div class="d-flex justify-content-between align-items-center gap-2 overflow-hidden mb-2">
                                <h6 class="brand_name fsize-4 mulish-semibold h-color mb-0" data-service_name>
                                    <div class="loading loading-w-2"></div>
                                </h6>
                                <div class="brand_rate d-flex align-items-center gap-1 fsize-1 p-color" data-service_pic_count>
                                    <div class="loading loading-w-1"></div>
                                </div>
                            </div>
                        </div>
                        <p class="n360_card__description fsize-2 p-color" data-description>
                            <span class="loading loading-paragraph"></span>
                            <span class="loading loading-paragraph-2"></span>
                        </p>
                        <div class="n360_card__footer">
                            <div class="d-flex justify-content-between align-items-center gap-2 overflow-hidden">
                                <div class="brand_rate d-flex align-items-baseline gap-1">

                                    <div class="rate-star" data-rate_star_icon></div>
                                    <div class="lh-18px h-18px">
                                        <span class="fsize-2 mulish-semibold h-color" data-rated_star></span>
                                        <span class="fsize-1 p-color" data-review_number></span>
                                    </div>
                                </div>
                                <a class="text-decoration-none radius-300 mulish-bold n360_card__btn h-color fsize-2" data-quickbook_btn>
                                    <span class="loading radius-300 n360_card__btn--loading"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </div>
    <div id="view_all_service" class="text-center pt-5">
        <button id="view_all_service_btn" class="btn btn-link n360-btn-viewall mulish-bold fsize-2 main-color text-decoration-none">
            View all
            <span>
                <svg width="18" height="18" viewBox="0 0 31 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M19.8184 18.9785C19.5254 18.7441 19.4082 18.3926 19.4082 17.9824C19.4082 17.6309 19.5254 17.2793 19.8184 17.0449L25.3848 11.4199H1.5957C0.775391 11.4199 0.189453 10.834 0.189453 10.0137C0.189453 9.25195 0.775391 8.60742 1.5957 8.60742H25.3848L19.8184 3.04102C19.2324 2.51367 19.2324 1.63477 19.8184 1.10742C20.3457 0.521484 21.2246 0.521484 21.8105 1.10742L29.7793 9.07617C30.3066 9.60352 30.3066 10.4824 29.7793 11.0098L21.8105 18.9785C21.2246 19.5645 20.3457 19.5645 19.8184 18.9785Z" fill="#D3427A" />
                </svg>
            </span>
        </button>
    </div>
</div>