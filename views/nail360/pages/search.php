<?php
$meta_image = $_rootPath . '/views/nail360/assets/img/nail360-homepage.png';
$GLOBALS['page_meta'] = array(
    "meta_title" => "Search",
    "meta_description" => "Experience the ultimate in nail care services and book your dream appointment today. From classic manicures to gel extensions and nail art, our comprehensive range of services is designed to cater to your individual needs and preferences. Our team of experienced nail technicians is dedicated to providing you with exceptional service and personalized attention, ensuring that you leave our salon feeling confident and beautiful. Discover the perfect nail salon experience and book your appointment now.",
    "meta_image" => $meta_image
);
$GLOBALS['link_css'] = array("search/search.css");
require_once __DIR__ . '/../inc/_header.php';

if( isset($_POST)){
    if($_POST['categories']){
        $category = '';
        for ($i=0; $i < count($_POST['categories']) ; $i++) {
            if($i == (count($_POST['categories']) - 1) ) {
            $category.=  $_POST['categories'][$i];
            }
            else 
            $category.=  $_POST['categories'][$i].',';
        }
         $_POST['categories'] = $category;
    }
    if($_POST['isopen']){
        $_POST['isopen'] = $_POST['isopen'] == 'on' ? 1 : 0;
    }
    if($_POST['book']){
        $_POST['book'] = $_POST['book'] == 'on' ? 1 : 0;
    }
    
    $_POST['search'] = $_POST;
}
// echo "<pre>";
// print_r($_POST['search']);
// echo "</pre>";
?>
<section class="section-search mx-auto">
    <?php
    include __DIR__ . '/../inc/templates/search/modal-filters.php';
    include __DIR__ . '/../inc/templates/search/search-results.php';
    include __DIR__ . '/../inc/templates/search/search-no-results.php';
    ?>
    <div id="page-content" class="position-relative"></div>
</section>
<?php require_once __DIR__ . '/../inc/_footer.php'; ?>
<!-- Include JS file for this content below -->
<script src="<?= $_rootPath ?>/assets/js/global-js.js"></script>
<script type="text/javascript">

    window._searchSalon = {
        name : "<?= urlencode($_POST['search']['name'] ? trim($_POST['search']['name']) : '') ?>",
        address : "<?= urlencode($_POST['search']['address'] ? trim($_POST['search']['address']) : '') ?>",
        sortby : "<?= urlencode($_POST['search']['sortby'] ? trim($_POST['search']['sortby']) : 0) ?>",
        category : "<?= urlencode($_POST['search']['categories'] ? trim($_POST['search']['categories']): '') ?>",
        star: "<?= urlencode($_POST['search']['star'] ? trim($_POST['search']['star']) : 0) ?>",
        distance : "<?= urlencode($_POST['search']['distance'] ? trim($_POST['search']['distance']) : 0) ?>",
        isopen : "<?= urlencode($_POST['search']['isopen'] ? trim($_POST['search']['isopen']) : 0) ?>",
        book : "<?= urlencode($_POST['search']['book'] ? trim($_POST['search']['book']) : 0 ) ?>"
    }
</script>
<script src="<?= $_rootPath; ?>/views/nail360/assets/js/search/search.js"></script>
<!-- Run customize function below -->
<script>
    dataReady();
    lazyBackgroundReady();
</script>
