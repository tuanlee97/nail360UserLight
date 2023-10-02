<?php 
    // Make a GET request to the API endpoint
    $url = $_adminApi . "/public?s=GetSalonGallery&idsalon=" . $salon_id ."&p=1&z=9";
    $response = file_get_contents($url);
    $response = json_decode($response, true);

    if ($response['error'] === "" && $response['data']) {
        $gallery = $response['data'];
    
    } 
?>
<div class="gallery-container position-relative">
    <button id="btnGalleryAll" class="show-all-photos radius-300 py-1 px-3"><svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M12.25 0.625H1.75C0.765625 0.625 0 1.41797 0 2.375V11.125C0 12.1094 0.765625 12.875 1.75 12.875H12.25C13.207 12.875 14 12.1094 14 11.125V2.375C14 1.41797 13.207 0.625 12.25 0.625ZM5.25 1.5H8.75V4.42578H5.25V1.5ZM5.25 5.30078H8.75V8.22656H5.25V5.30078ZM4.375 12H1.75C1.25781 12 0.875 11.6172 0.875 11.125V9.10156H4.375V12ZM4.375 8.22656H0.875V5.30078H4.375V8.22656ZM4.375 4.42578H0.875V2.375C0.875 1.91016 1.25781 1.5 1.75 1.5H4.375V4.42578ZM5.25 12V9.10156H8.75V12H5.25ZM13.125 11.125C13.125 11.6172 12.7148 12 12.25 12H9.625V9.10156H13.125V11.125ZM13.125 8.22656H9.625V5.30078H13.125V8.22656ZM13.125 4.42578H9.625V1.5H12.25C12.7148 1.5 13.125 1.91016 13.125 2.375V4.42578Z" fill="#333333" fill-opacity="0.8"/>
</svg>
<span class="fsize-2 align-text-bottom">Show all Photos</span></button>
    <div class="salon_detail--gallery py-3 rounded-4 gallery_img">
        <?php
            for ($i=0; $i < 9 ; $i++) { 
                if($gallery[$i]){ ?>
                    <img src="<?= $temporary_src_img ?>"  class="loading" data-number="<?= $i + 1 ?>/<?= count($gallery) ?>" data-id="<?= $gallery[$i]["id"] ?>" data-img="<?= $_adminApi ?>/images/<?= $gallery[$i]["imgpath"] . $gallery[$i]["imgname"] ?>"  lazy-src="<?= $_adminApi ?>/images/<?= $gallery[$i]["imgpath"] . $gallery[$i]["imgname"] ?>" src-alt="<?= $gallery[$i]["imgname"] ?>">
                <?php }
                else{ ?>
                    <img src="<?= $temporary_src_img ?>"  class="placeholder-img loading" data-number="<?= $i + 1 ?>/9" data-id="<?= $i + 1 ?>" data-img="<?= $temporary_src_img ?>" src-alt="placeholder">
                <?php }
               
            }
        ?>

    </div>
</div>
