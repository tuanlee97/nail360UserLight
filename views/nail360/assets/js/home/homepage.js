//1x1 pixel images
const temporary_src_img = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mM8XQ8AAhsBTLgo62UAAAAASUVORK5CYII=";
// Carousel
const carouselInner = document.querySelector('#carouselNail360 .carousel-inner');
const carouselIndicators = document.querySelector('#carouselNail360 .carousel-indicators');
const carouselItemTemplate = document.getElementById('carousel-item-template');

// Top Rated
const sectionTopRated = document.querySelector('.section-top-rate-salons .list-top-salons');
const topRatedItemTemplate = document.getElementById('topRatedItemTemplate');
const limitDisplaySalon = 8;
for (let i = 0; i < limitDisplaySalon; i++) {
    sectionTopRated.append(topRatedItemTemplate.content.cloneNode(true));
}
// Favorite Salon
const sectionFavoriteSalon = document.querySelector('.list_favorite-salons .swiper-wrapper');
const favoriteItemTemplate = document.getElementById('favoriteItemTemplate');
const limitDisplayFavSalon = 4;
if(sectionFavoriteSalon)
for (let i = 0; i < limitDisplayFavSalon; i++) {
    sectionFavoriteSalon.append(favoriteItemTemplate.content.cloneNode(true));
}
// Testimonial
const sectionCustomerTestimonial = document.querySelector('.section_customer_testimonial_template .list_customer_testimonial');
const customerTestimonialTemplate = document.getElementById('customer_testimonial_template');
if(sectionCustomerTestimonial)
for (let i = 0; i < 3; i++) {
    sectionCustomerTestimonial.append(customerTestimonialTemplate.content.cloneNode(true));
}
$(document).ready(function () {
    // Make API call for : Carousel
    $.ajax({
        url: window._adminApi + "/public?s=Carouse",
        method: "GET",
        success: function (response) {
            if (response.error === "") {
                // Create HTML elements for each item in the array
                carouselInner.innerHTML = "";

                for (var i = 0; i < response.data.length; i++) {
                    let item = response.data[i];
                    let descriptionjson = JSON.parse(item.descriptionjson);
                    const div = carouselItemTemplate.content.cloneNode(true)
                    div.querySelector('[data-banner]').innerHTML = '<img src="' + item.imageurl + '" class="d-block w-100" src-alt="' + item.imageurl + '"/>';
                    div.querySelector('[data-heading]').textContent = descriptionjson[0].text;
                    div.querySelector('[data-subheading]').textContent = descriptionjson[0].text;
                    carouselInner.append(div);

                }
            }

        },
        error: function (response) {
            // Handle error
            console.log('Carouse', response);
        },
        complete: function () {
            var swiper = new Swiper("#carouselNail360", {
                spaceBetween: 30,
                pagination: {
                  el: ".swiper-pagination",
                  clickable: true,
                },
                autoplay: {
                    delay: 4000,
                    disableOnInteraction: false,
                    pauseOnMouseEnter: true,
                },
              });
            dataReady();
        }
    });
    // Make API call for : Top Rated
    $.ajax({
        url: window._adminApi + "/public?s=TopRated&p=1&z=8",
        method: "GET",
        success: function (response) {
            if (response.error === "") {
                // Create HTML elements for each item in the array
                sectionTopRated.innerHTML = "";

                for (var i = 0; i < limitDisplaySalon; i++) {
                    let itemTopRated = response.data[i];
                    const div = topRatedItemTemplate.content.cloneNode(true)

                    div.querySelector('[data-top_img]').innerHTML = '<img src="'+temporary_src_img+'" lazy-src="' + itemTopRated.imageurl + '" class="top_salon__img--top" src-alt="' + itemTopRated.name + '" />';
                    div.querySelector('[data-avatar_img]').innerHTML = '<img src="'+temporary_src_img+'" lazy-src="' + itemTopRated.salonavatar + '" class="rounded-circle top_salon__img--avatar" src-alt="' + itemTopRated.name + '"/>';

                    div.querySelector('[data-rate_star_icon]').innerHTML = '<img src="'+temporary_src_img+'" lazy-src="' + window._rootPath + '/views/nail360/assets/icons/star.svg"/>';
                    div.querySelector('[data-geo_distance_icon]').innerHTML = '<img src="'+temporary_src_img+'" lazy-src="' + window._rootPath + '/views/nail360/assets/icons/distance.svg"/>';

                    div.querySelector('[data-salon_name]').textContent = itemTopRated.name;
                    div.querySelector('[data-rated_star]').textContent = Number.parseFloat(itemTopRated.star).toFixed(1);
                    div.querySelector('[data-review_number]').textContent = '(' + itemTopRated.reviewnumber + ')';
                    div.querySelector('[data-description]').textContent = itemTopRated.description;
                    div.querySelector('[data-miles]').textContent = '5 miles';
                    div.querySelector('[data-drive]').textContent = 'drive';
                    div.querySelector('[data-booking_btn]').href = window._rootPath+'/salon/'+itemTopRated.salonid;
                    div.querySelector('[data-booking_btn]').textContent = 'Booking Now';
                    sectionTopRated.append(div);
                }
            }

        },
        error: function (response) {
            // Handle error
            console.log('TopRated', response);
        },
        complete: function () {
            // Handle the complete event
            dataReady();
        }
    });
    // Make API call for : GetUserSalonFavourite
    if(token){
        $.ajax({
            url: window._adminApi + "/salon/search?s=GetUserSalonFavourite",
            method: "GET",
            headers: {
                'Authorization': `Bearer ${token}`
            },
            success: function (response) {
                if (response.error === "") {
                    // Create HTML elements for each item in the array
                    sectionFavoriteSalon.innerHTML = "";
                  
                    for (var i = 0; i < response.data.length; i++) {
                        let itemFavorite = response.data[i];
                        if(!itemFavorite.avatarimg)
                        itemFavorite.avatarimg= ["/default.jpg"]

                        const div = favoriteItemTemplate.content.cloneNode(true)
                        div.querySelector('[data-top_img]').innerHTML = '<img src="'+temporary_src_img+'" lazy-src="' +  window._adminApi +'/images'+itemFavorite.thumbnail + '" class="top_salon__img--top" src-alt="' + itemFavorite.name + '" />';
          
                        div.querySelector('[data-avatar_img]').innerHTML = '<img src="'+temporary_src_img+'" lazy-src="' + window._adminApi +'/images'+itemFavorite.avatarimg[itemFavorite.avatarimg.length - 1] + '" class="rounded-circle top_salon__img--avatar" src-alt="' + itemFavorite.name + '"/>';
                     
                        div.querySelector('[data-rate_star_icon]').innerHTML = '<img src="'+temporary_src_img+'" lazy-src="' + window._rootPath + '/views/nail360/assets/icons/star.svg"/>';
                        div.querySelector('[data-geo_distance_icon]').innerHTML = '<img src="'+temporary_src_img+'" lazy-src="' + window._rootPath + '/views/nail360/assets/icons/distance.svg"/>';
                        div.querySelector('[data-salon_name]').textContent = itemFavorite.name;
                        div.querySelector('[data-rated_star]').textContent = Number.parseFloat(itemFavorite.star).toFixed(1);
                        div.querySelector('[data-review_number]').textContent = '(' + itemFavorite.reviewnumber + ')';
                        div.querySelector('[data-description]').textContent = itemFavorite.shortdescription;
                        div.querySelector('[data-miles]').textContent = '5 miles';
                        div.querySelector('[data-drive]').textContent = 'drive';
                        div.querySelector('[data-booking_btn]').href = window._rootPath+'/salon/'+itemFavorite.salonid;
                        div.querySelector('[data-booking_btn]').textContent = 'Booking Now';
                        sectionFavoriteSalon.append(div);
                    }
                }

            },
            error: function (response) {
                // Handle error
                console.log('Favorite Salon', response);
            },
            complete: function () {
                // Handle the complete event
                var swiperFavoriteSalon = new Swiper("#swiperFavoriteSalon", {
                    slidesPerView: 1,
                    spaceBetween: 16,
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                      },
                      breakpoints: {
                        0: {
                            slidesPerView: 1,
                            navigation: {
                                nextEl: '',
                                prevEl: ''
                              },
                            initialSlide: 0
                          },
                        700: {
                          slidesPerView: 2,
                          navigation: {
                            nextEl: '.swiper-button-next',
                            prevEl: '.swiper-button-prev',
                          },
                        },
                        992: {
                          slidesPerView: 3
                        },
                        1366: {
                          slidesPerView: 4
                        }
                      }
                });
                window.addEventListener('resize', function() {
                    if (window.innerWidth < 700) {
                        swiperFavoriteSalon.navigation.destroy();
                        swiperFavoriteSalon.slideTo(0);
                    }else {
                        swiperFavoriteSalon.navigation.init();
                        swiperFavoriteSalon.navigation.update();
                      }
                  });
                dataReady();
            }
        });
    }
    // Make API Call for : Testimonail
    const dataTestimonial = {
        "total": 3,
        "error": "",
        "data": [
            {
                "id": "",
                "salonavatar": "https://i.pravatar.cc/60?img=1",
                "name": "Lathersalonaspen",
                "star":"5",
                "reviewdate":"4/28/2023",
                "description":"The Pacific Grove Chamber of Commerce would like to thank eLab Communications and Mr. Will Elkadi for all the efforts that assisted.",
                "useravatar":"https://i.pravatar.cc/50?img=4",
                "username":"Johan Martin",
                "userposition":"CEO"
            },
            {
                "id": "",
                "salonavatar": "https://i.pravatar.cc/60?img=2",
                "name": "IGK Hair",
                "star":"4",
                "reviewdate":"4/28/2023",
                "description":"The Pacific Grove Chamber of Commerce would like to thank eLab Communications and Mr. Will Elkadi for all the efforts that assisted.",
                "useravatar":"https://i.pravatar.cc/50?img=5",
                "username":"Jamie Anderson",
                "userposition":"Manager"
            },
            {
                "id": "",
                "salonavatar": "https://i.pravatar.cc/60?img=3",
                "name": "Hawai'i",
                "star":"4.5",
                "reviewdate":"4/28/2023",
                "description":"The Pacific Grove Chamber of Commerce would like to thank eLab Communications and Mr. Will Elkadi for all the efforts that assisted.",
                "useravatar":"https://i.pravatar.cc/50?img=6",
                "username":"John Peter",
                "userposition":"Manager"
            },
            {
                "id": "",
                "salonavatar": "https://i.pravatar.cc/60?img=3",
                "name": "Hawai'i",
                "star":"4.5",
                "reviewdate":"4/28/2023",
                "description":"The Pacific Grove Chamber of Commerce would like to thank eLab Communications and Mr. Will Elkadi for all the efforts that assisted.",
                "useravatar":"https://i.pravatar.cc/50?img=6",
                "username":"John Peter",
                "userposition":"Manager"
            },
            {
                "id": "",
                "salonavatar": "https://i.pravatar.cc/60?img=3",
                "name": "Hawai'i",
                "star":"4.5",
                "reviewdate":"4/28/2023",
                "description":"The Pacific Grove Chamber of Commerce would like to thank eLab Communications and Mr. Will Elkadi for all the efforts that assisted.",
                "useravatar":"https://i.pravatar.cc/50?img=6",
                "username":"John Peter",
                "userposition":"Manager"
            },
        ]
    }


       if(sectionCustomerTestimonial && dataTestimonial.error === "" && dataTestimonial.total > 0){
            sectionCustomerTestimonial.innerHTML = "";
            for (var i = 0; i < dataTestimonial.data.length; i++) {
                let itemTestimonial = dataTestimonial.data[i];
                const div = customerTestimonialTemplate.content.cloneNode(true)
                div.querySelector('[data-salon_avatar_img]').innerHTML = '<img src="'+temporary_src_img+'" lazy-src="' + itemTestimonial.salonavatar + '" src-alt="' + itemTestimonial.name + '" />';
               
                let starIcon = ''
                let emptyStarNum = 5 - parseInt(itemTestimonial.star);
                for (let index = 0; index < parseInt(itemTestimonial.star); index++) {
                    starIcon+= '<img src="'+temporary_src_img+'" lazy-src="' + window._rootPath + '/views/nail360/assets/icons/star.svg"/>';  
                }
                for (let index = 0; index < emptyStarNum; index++) {
                    starIcon+= '<img src="'+temporary_src_img+'" lazy-src="' + window._rootPath + '/views/nail360/assets/icons/star-empty.svg"/>';   
                }
                div.querySelector('[data-rate_star_icon]').innerHTML = starIcon;
                div.querySelector('[data-user_avatar_img]').innerHTML = '<img src="'+temporary_src_img+'" lazy-src="' + itemTestimonial.useravatar + '" src-alt="' + itemTestimonial.username + '" />';
                div.querySelector('[data-quote_mask]').innerHTML = '<img src="'+temporary_src_img+'" lazy-src="' + window._rootPath + '/views/nail360/assets/icons/quote-mask.svg"/>';

                div.querySelector('[data-salon_name]').textContent = itemTestimonial.name;
                div.querySelector('[data-review_date]').textContent = itemTestimonial.reviewdate
                div.querySelector('[data-description]').textContent = itemTestimonial.description;

                div.querySelector('[data-user_name]').textContent = itemTestimonial.username;
                div.querySelector('[data-user_position]').textContent = itemTestimonial.userposition;

                sectionCustomerTestimonial.append(div);
            }

            var swiperTestimonial = new Swiper("#swiperTestimonial", {
                slidesPerView: 1,
                spaceBetween: 10,
                pagination: {
                  el: ".swiper-pagination",
                  clickable: true,
                },
                breakpoints: {
                320: {
                        slidesPerView: 'auto',
                        spaceBetween: 0,
                      },        
                  768: {
                    slidesPerView: '2',
                    spaceBetween: 0,
                  },
                  1366: {
                    slidesPerView: 3,
                    spaceBetween: 0,
                  },
                },
            });
            
            dataReady();



       }
   
});
