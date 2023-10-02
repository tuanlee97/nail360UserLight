<!-- Modal -->
<template id="gallery_img">
    <div class="grid-img-item gallery_img loading" data-img>
        <div class="loading"></div>
        
    </div>                
</template>
<div class="modal fade" id="staticBackdropGalleryAll" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-gallery">
        <div class="modal-content position-relative">
            <div class="modal-header border-0 gallery-header">
                <h1 class="mulish-bold fsize-4 h-color flex-grow-1" id="staticBackdropLabel">Show all Photos</h1>
                <div class="d-flex flex-grow-1 gap-4 z-1 list-btn">
                    <button class="btn salon_feature__btn--item radius-300 p-color px-4 py-1 border"><img src="<?= $temporary_src_img ?>" lazy-src="<?= $_rootPath ?>/views/nail360/assets/icons/share.svg" /> Share</button>
                    <button class="btn salon_feature__btn--item radius-300 p-color px-4 py-1 border" <?php if ($_isLogin) : ?> onclick="alert('Call API Toggle Favorite')" <?php else : ?> data-bs-toggle="modal" data-bs-target="#login" <?php endif ?>>
                        <img src="<?= $temporary_src_img ?>" lazy-src="<?= $_rootPath ?>/views/nail360/assets/icons/heart.svg" />
                        Save
                    </button>
                    <div class="drop-sort-btn position-relative">
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
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body gallery-body">
                <div id="list_gallery_img" class="grid grid-column-3 gap-3">

                </div>
            </div>
            <div class="modal-footer justify-content-center border-0 ">
            <!-- pagination -->
                <nav id="navigation" class="mt-3" aria-label="Page navigation">
                    <ul data-pagination id="pagination-ul" class="pagination justify-content-center gap-2"></ul>
                </nav>
            </div>
        </div>
    </div>
</div>