<template id="carousel-item-template">
  <div class="swiper-slide cursor-pointer loading">
    <div class="d-block w-100" data-banner></div>
    <div class="home-carousel__caption d-flex flex-column justify-content-center">
      <h1 class="carousel__caption--heading mulish-black" data-heading></h1>
      <h4 class="carousel__caption--sub-heading mulish-medium" data-subheading></h4>
    </div>
  </div>
</template>

<style>
  .swiper-pagination-bullet {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background-color: #EDEDED;
    opacity: .8;
  }

  .swiper-pagination-bullet-active {
    opacity: 1;
    background-color: #D3427A;
  }
</style>
<section class="section-home-carousel radius-bottom-10">
  <div id="carouselNail360" class="swiper home-carousel__wrap radius-10 ">
    <div class="swiper-wrapper carousel-inner"></div>
    <div class="swiper-pagination"></div>
  </div>
</section>
