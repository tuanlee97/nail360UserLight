<?php $temporary_src_img  = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mM8XQ8AAhsBTLgo62UAAAAASUVORK5CYII="; ?>

<template id="salon-search--item">
    <div class="salon-search--item gap-4">
        <a class="" data-linkcard>
        <div class="salon-img" data-salon_img>
            <div class="loading"></div>
        </div>
        </a>
        <div class="d-flex flex-column justify-content-between">
            <div data-map_postion></div>
            <div class="d-flex align-items-center gap-3">
                <div class="salon-search--logo" data-salon_search_logo>
                    <div class="loading"></div>
                </div>
                <h1 class="h-color mulish-semibold fsize-4" data-salon_name>
                    <div class="loading loading-w-2"></div>
                </h1>
            </div>
            <div class="d-flex align-items-baseline">
                <div class="d-flex align-items-baseline me-4 gap-1">
                    <span><img height="14" src="<?= $temporary_src_img ?>" lazy-src="<?= $_rootPath ?>/views/nail360/assets/icons/star.svg" /></span>
                    <span>
                        <p class="m-0 mulish-semibold h-color fsize-2" data-start_count>
                            <span class="loading d-block" style=" width: 10px; height: 8px; "></span>
                        </p>
                    </span>
                    <span>
                        <p class="m-0 p-color fsize-1" data-review_count><span class="loading d-block" style=" width: 4rem; height: 8px; "></span></p>
                    </span>
                </div>
                <div class="d-flex align-items-baseline flex-grow-1 gap-1">
                    <p class="m-0 green-color fsize-2" data-open></p>
                    <p class="m-0 p-color fsize-1" data-time_split></p>
                    <p class="m-0 p-color fsize-1" data-close></p>
                </div>
            </div>
            <div class="salon-address d-flex flex-wrap align-items-center p-color fsize-2 gap-1">
                <span>
                <span><img height="16" src="<?php echo $_rootPath ?>/views/nail360/assets/icons/location-dot.svg" /></span>
                <span data-address>
                    <div class="loading loading-w-2"></div>
                </span>
                </span>
                <span>-</span>
                <div class=" fsize-2">
                    <span>(<img class="mx-1" height="14" src="<?= $temporary_src_img ?>" lazy-src="<?= $_rootPath ?>/views/nail360/assets/icons/distance.svg"></span>
                    <span class="h-color" data-miles>? miles</span>
                    <span> drive )</span>
                </div>
            </div>
            <p class="salon-description p-color fsize-2 mb-2" data-salon_description><span class="loading loading-paragraph"></span></p>
            <div class="btn-booknow">
                <a data-booking_btn class="btn btn-outline-secondary radius-300 mulish-bold h-color fsize-2 p-border-color overflow-hidden p-0">
                    <span class="loading d-block" style="width: 8rem;height: 1.5rem;"></span>
                </a>
            </div>
        </div>
    </div>

</template>
<template id="search-results">
    <div class="section-wrap grid grid-column-custom position-relative">
        <div class="list-salons py-3 position-relative">
            <div class="d-flex flex-wrap flex-sm-nowrap justify-content-between align-items-baseline p-3 w-100 position-absolute top-0">
                <h1 class="fsize-2 h-color" data-total_search>
                    <div class="loading loading-w-2"></div>
                </h1>
                <div class="filters-btn-list">
                    <button type="button" class="filter-btn btn btn-outline-secondary p-color fsize-2 px-3"  data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        <svg width="16" height="13" viewBox="0 0 16 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M14.8633 1.36328C14.6719 0.925781 14.207 0.625 13.7148 0.625H2.25781C1.76562 0.625 1.30078 0.925781 1.10938 1.36328C0.890625 1.80078 0.972656 2.32031 1.27344 2.67578L5.8125 8.22656V10.0859C5.8125 10.4414 5.97656 10.7422 6.25 10.9609L8.49219 12.6836C8.68359 12.8203 8.90234 12.875 9.12109 12.875C9.69531 12.875 10.1602 12.4102 10.1602 11.8359V8.22656L14.6992 2.67578C15 2.32031 15.082 1.80078 14.8633 1.36328ZM9.06641 7.51562C8.92969 7.65234 8.875 7.84375 8.875 8.0625V11.3164L7.125 9.94922V8.08984C7.125 7.87109 7.04297 7.67969 6.90625 7.51562L2.36719 1.96484H13.6055L9.06641 7.51562Z" fill="#333333" />
                        </svg>
                        Filters
                    </button>
                    <!-- Example split button -->
                    <div class="drop-sort-btn">
                        <button type="button" class="drop-btn btn btn-outline-secondary dropdown-toggle p-color fsize-2 px-3">
                            <span>Sort by : </span>
                            <span class="h-color" id="sort-by">All</span>
                        </button>
                        <ul class="drop-menu">
                            <li><a class="drop-item fsize-2" id="0" href="#/">All</a></li>
                            <li><a class="drop-item fsize-2" id="1" href="#/">New Added</a></li>
                            <li><a class="drop-item fsize-2" id="2" href="#/">REV: Low to High</a></li>
                            <li><a class="drop-item fsize-2" id="3" href="#/">DESC: Far to Near</a></li>
                            <li><a class="drop-item fsize-2" id="4" href="#/">DESC: Near to Far</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div id="list-salon-search" data-list_salon_search></div>

            <nav id="navigation" class="mt-3" aria-label="Page navigation">
                <ul data-search_pagination id="pagination" class="pagination justify-content-center gap-2"></ul>
            </nav>
        </div>
        <div id="map" class="list-maps sticky" style="height: 100%">
        
        </div>
        <script id="script-map" lazy-src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD3GG7Qq1XgRMAcjPejT9spgnR4RZ9xzbU&callback=initMap&v=weekly" defer></script>
    </div>
</template>
