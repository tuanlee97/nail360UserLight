<?php
// // Make a GET request to the API endpoint
// $url = $_adminApi . "/public?s=TopRated";
// $response = file_get_contents($url);
// $dataTopRated = json_decode($response, true);
// if ($dataTopRated['error'] === "") {
//   // The JSON data was decoded successfully
//   // Do something with $dataTopRated here
  $limitDisplaySalon = 8;
?>
<section class="section-top-rate-salons">
<div class="section-wrap">
    <h2 class="section-top-rate-salons__heading mulish-bold text-center h-color">Top Rated Salons Near You</h2>
    <div class="list-top-salons">
        <template id="topRatedItemTemplate">
            <div class="g-col-3 p-0">
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
    </div>
</div>
<div class="text-center pt-2">
    <button  class="btn btn-link n360-btn-viewall mulish-bold fsize-2 main-color text-decoration-none">
    View all
    <span>
        <svg width="18" height="18" viewBox="0 0 31 20" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M19.8184 18.9785C19.5254 18.7441 19.4082 18.3926 19.4082 17.9824C19.4082 17.6309 19.5254 17.2793 19.8184 17.0449L25.3848 11.4199H1.5957C0.775391 11.4199 0.189453 10.834 0.189453 10.0137C0.189453 9.25195 0.775391 8.60742 1.5957 8.60742H25.3848L19.8184 3.04102C19.2324 2.51367 19.2324 1.63477 19.8184 1.10742C20.3457 0.521484 21.2246 0.521484 21.8105 1.10742L29.7793 9.07617C30.3066 9.60352 30.3066 10.4824 29.7793 11.0098L21.8105 18.9785C21.2246 19.5645 20.3457 19.5645 19.8184 18.9785Z" fill="#D3427A"/>
        </svg>
    </span>
    </button>
</div>



</section>



<?php
// } else {
//   // There was an error decoding the JSON data
//   echo 'Error: ' . json_last_error_msg();
// }
?>