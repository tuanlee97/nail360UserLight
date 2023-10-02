<!-- Modal -->
<div class="modal fade" id="staticBackdropGalleryItem" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-gallery-item">
        <div class="modal-content position-relative">
            <div class="modal-header border-0 gallery-header">
                <h1 class="mulish-bold fsize-4 h-color flex-grow-1" id="staticBackdropLabel" data-number></h1>
                <div class="d-flex flex-grow-1 gap-4 z-1 list-btn--item">
                    <button class="btn salon_feature__btn--item radius-300 p-color px-4 py-1 border"><img src="<?= $temporary_src_img ?>" lazy-src="<?= $_rootPath ?>/views/nail360/assets/icons/share.svg" /> Share</button>
                    <button class="btn salon_feature__btn--item radius-300 p-color px-4 py-1 border" <?php if ($_isLogin) : ?> onclick="alert('Call API Toggle Favorite')" <?php else : ?> data-bs-toggle="modal" data-bs-target="#login" <?php endif ?>>
                        <img src="<?= $temporary_src_img ?>" lazy-src="<?= $_rootPath ?>/views/nail360/assets/icons/heart.svg" />
                        Save
                    </button>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body gallery-body">
                <div class="gallery-detail text-center" data-img>
                    <div class="loading"></div>
                </div>
                <div class="user-review py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="user-info d-flex gap-3">
                            <div class="user-info--img">
                                <img lazy-src="https://i.pravatar.cc/400" />
                            </div>
                            <div class="user-info--review">
                                <p class="user-info--name mulish-semibold h-color mb-1">Johan Martin</p>
                                <div class="list-rating d-flex align-items-center">
                                    <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mM8XQ8AAhsBTLgo62UAAAAASUVORK5CYII=" lazy-src="<?= $_rootPath ?>/views/nail360/assets/icons/star.svg" />
                                    <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mM8XQ8AAhsBTLgo62UAAAAASUVORK5CYII=" lazy-src="<?= $_rootPath ?>/views/nail360/assets/icons/star.svg" />
                                    <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mM8XQ8AAhsBTLgo62UAAAAASUVORK5CYII=" lazy-src="<?= $_rootPath ?>/views/nail360/assets/icons/star.svg" />
                                    <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mM8XQ8AAhsBTLgo62UAAAAASUVORK5CYII=" lazy-src="<?= $_rootPath ?>/views/nail360/assets/icons/star.svg" />
                                    <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mM8XQ8AAhsBTLgo62UAAAAASUVORK5CYII=" lazy-src="<?= $_rootPath ?>/views/nail360/assets/icons/star.svg" />
                                </div>
                                <p class="createddate p-color mb-1">1/1/2023</p>
                            </div>

                        </div>
                        <div class="action-btn  d-flex gap-3">
                        <button class="btn salon_feature__btn--item radius-300 p-color px-4 py-1 border"><img src="<?= $temporary_src_img ?>" lazy-src="<?= $_rootPath ?>/views/nail360/assets/icons/like.svg" /> Like</button>
                            <button class="btn salon_feature__btn--item radius-300 p-color px-4 py-1 border"><img src="<?= $temporary_src_img ?>" lazy-src="<?= $_rootPath ?>/views/nail360/assets/icons/share.svg" /> Share</button>
                        </div>
                    </div>
                </div>
                <p class="p-color mb-1 review-description">The Pacific Grove Chamber of Commerce ould like to thank eLab Communications and Mr. Will Elkadi for all the efforts.</p>
            </div>

        </div>
    </div>
</div>