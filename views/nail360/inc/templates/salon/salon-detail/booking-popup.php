<!-- Modal Booking : Add Guest -->
<div class="modal fade" id="addGuest" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addGuestLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content py-3 px-4">
            <div class="modal-add-guest-header">
                <button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0 text-center">
                <h1 class="mulish-bold h-color add-guest-title" id="add-guest-title">Add Guest</h1>
                <form class="" id="add-guest-form">
                    <div class="my-3">
                        <label for="firstname" class="visually-hidden">First Name</label>
                        <input type="text" required class="form-control radius-300 h50px n360-border-color px-4" value="<?= explode(" ", $profile['name'])[0] ?>" name="firstname" id="firstname" placeholder="First Name">
                    </div>
                    <div class="mt-3">
                        <label for="lastname" class="visually-hidden">Last Name</label>
                        <input type="text" required class="form-control radius-300 h50px n360-border-color px-4" value="<?= explode(" ", $profile['name'])[1]  ?>" name="lastname" id="lastname" placeholder="Last Name">
                    </div>
                    <div class="mt-3">
                        <input type="text" autocomplete="off" required class="form-control radius-300 h50px n360-border-color px-4 position-relative" name="date" id="date" placeholder="M/DD/YYYY"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                    </div>
                    <p class="mt-3 lh-16px p-color text-center">Please provide the name of the guest and the date of the booking.</p>
                    <div class="my-3">
                        <button type="submit" class="btn bg-main text-white mulish-bold w-100 radius-300 py-2 px-5">Continue</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal Booking : Add Service -->
<div class="modal fade" id="addService" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addServiceLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content py-3 px-4">
            <div class="modal-add-service-header">
                <button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0 text-center">
                <h1 class="mulish-bold h-color add-service-title"></h1>
                <div id="loading"></div>
                <form class="d-none" id="add-service-form">
                <template id="salon_category_service">
                            <div class="accordion-item border-0">
                                <h2 class="accordion-header">
                                    <button class="accordion-button mulish-bold fsize-2 py-3 px-0" type="button" data-bs-toggle="collapse" aria-expanded="true" data-bs-target="" aria-controls="" data-category></button>
                                </h2>
                                <div data-collapse id="" class="accordion-collapse collapse show"></div>
                            </div>
                        </template>

                        <template id="salon_category_service_item">
                            <div class="d-flex py-2 border-bottom gap-2">
                                <input class="form-check-input" type="radio" name="service_selected" data-cb_value>
                                <div class="service_detail flex-grow-1">
                                    <div class="d-flex justify-content-between align-items-end">
                                        <p class="mulish-bold fsize-2 h-color mb-2" data-service_name>Service</p>
                                        <p class="mulish-bold fsize-2 p-color mb-2" data-service_price></p>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-end fsize-1">
                                        <p class="mulish-bold fsize-2 h-color mb-2">Details</p>
                                        <p class="p-color mb-2">
                                            <span><svg height="12" aria-hidden="true" data-prefix="fal" data-icon="clock" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-clock fa-w-16 fa-7x"><path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm216 248c0 118.7-96.1 216-216 216-118.7 0-216-96.1-216-216 0-118.7 96.1-216 216-216 118.7 0 216 96.1 216 216zm-148.9 88.3l-81.2-59c-3.1-2.3-4.9-5.9-4.9-9.7V116c0-6.6 5.4-12 12-12h14c6.6 0 12 5.4 12 12v146.3l70.5 51.3c5.4 3.9 6.5 11.4 2.6 16.8l-8.2 11.3c-3.9 5.3-11.4 6.5-16.8 2.6z" class=""></path></svg></span>
                                            <span class="h-color" data-service_minutes></span>Min</p>
                                    </div>
                                </div>
                            </div>
                        </template>
                    <div class="accordion" id="accordion-list-technical">

                    </div>
                    <div class="my-3">
                        <button disabled id="service_submit" type="submit" class="btn bg-main text-white mulish-bold radius-300 py-2 px-5">Next</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal Booking : Add technician -->
<div class="modal fade" id="addTechnician" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addTechnicianLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content py-3 px-4">
            <div class="modal-add-technician-header">
                <button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0 text-center">
                <h1 class="mulish-bold h-color add-technician-title"></h1>
                <div id="loading"></div>
                <form class="d-none" id="add-technician-form">

                    <h3 class="mulish-bold h-color fsize-4 technician-service_name" technician-service_name></h3>
                    <div class="picker-wrap mt-5">
                        <h4 class="mulish-bold h-color fsize-3" id="monthSelected"></h4>
                        <input type="text" autocomplete="off" class="form-control mulish-bold h-color fsize-3 custom-input-picker" name="monthpicker" id="monthpicker" />
                    </div>
                    <!-- Swiper Date Picker -->
                    <div class="swiper-container position-relative">
                        <div id="formDateList">
                            <div id="dateList"></div>
                        </div>
                        <button id="datePrev">
                            <svg width="9" height="14" viewBox="0 0 9 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.69336 13.5039L0.974609 7.53516C0.818359 7.34766 0.755859 7.16016 0.755859 6.97266C0.755859 6.81641 0.818359 6.62891 0.943359 6.47266L6.66211 0.503906C6.94336 0.191406 7.44336 0.191406 7.72461 0.472656C8.03711 0.753906 8.03711 1.22266 7.75586 1.53516L2.53711 6.97266L7.78711 12.4727C8.06836 12.7539 8.06836 13.2539 7.75586 13.5352C7.47461 13.8164 6.97461 13.8164 6.69336 13.5039Z" fill="#333333" />
                            </svg>
                        </button>
                        <button id="dateNext">
                            <svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1.69727 0.472656L7.41602 6.44141C7.54102 6.59766 7.63477 6.78516 7.63477 6.97266C7.63477 7.16016 7.54102 7.34766 7.41602 7.47266L1.69727 13.4414C1.41602 13.7539 0.916016 13.7539 0.634766 13.4727C0.322266 13.1914 0.322266 12.7227 0.603516 12.4102L5.85352 6.94141L0.603516 1.50391C0.322266 1.22266 0.322266 0.722656 0.634766 0.441406C0.916016 0.160156 1.41602 0.160156 1.69727 0.472656Z" fill="#333333" />
                            </svg>
                        </button>
                    </div>
                    <!-- Swiper Time Picker -->
                    <div class="swiper-times-container position-relative">
                        <div id="formTimeList">
                            <div id="timeList">
                               
                            </div>
                        </div>
                        <button id="timePrev">
                            <svg width="9" height="14" viewBox="0 0 9 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.69336 13.5039L0.974609 7.53516C0.818359 7.34766 0.755859 7.16016 0.755859 6.97266C0.755859 6.81641 0.818359 6.62891 0.943359 6.47266L6.66211 0.503906C6.94336 0.191406 7.44336 0.191406 7.72461 0.472656C8.03711 0.753906 8.03711 1.22266 7.75586 1.53516L2.53711 6.97266L7.78711 12.4727C8.06836 12.7539 8.06836 13.2539 7.75586 13.5352C7.47461 13.8164 6.97461 13.8164 6.69336 13.5039Z" fill="#333333" />
                            </svg>
                        </button>
                        <button id="timeNext">
                            <svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1.69727 0.472656L7.41602 6.44141C7.54102 6.59766 7.63477 6.78516 7.63477 6.97266C7.63477 7.16016 7.54102 7.34766 7.41602 7.47266L1.69727 13.4414C1.41602 13.7539 0.916016 13.7539 0.634766 13.4727C0.322266 13.1914 0.322266 12.7227 0.603516 12.4102L5.85352 6.94141L0.603516 1.50391C0.322266 1.22266 0.322266 0.722656 0.634766 0.441406C0.916016 0.160156 1.41602 0.160156 1.69727 0.472656Z" fill="#333333" />
                            </svg>
                        </button>
                    </div>
                    <!-- Techinician Picker -->
                    <h3 class="mulish-bold h-color fsize-2 text-start technician-title">Select Nail Technician</h3>
                    <div class="grid grid-column-2" id="list-technician"></div>
                    <div class="my-3">
                        <button id="technician_submit" type="submit" class="btn bg-main text-white mulish-bold radius-300 py-2 px-5">Save</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal Booking : Booking Detail -->
<div class="modal fade" id="bookingDetail" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="bookingDetailLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content py-3 px-4">
            <div class="modal-add-booking-detail-header">
                <button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0 text-center">
                <h1 class="mulish-bold h-color add-booking-detail-title">Booking Details</h1>
                <div class="booking_date-container position-relative">
                    <h3 id="booking_date" class="mulish-bold h-color fsize-4 booking_date">
                        <span class="date_booking">Wednesday, May 10, 2023</span>
                        <span class="change_date_booking"><img class="align-baseline" src="<?= $temporary_src_img ?>" lazy-src="<?= $_rootPath ?>/views/nail360/assets/icons/calendar.svg" /></span>
                    </h3>
                    <input type="text" autocomplete="off" required class="form-control radius-300 h50px n360-border-color px-4 position-relative" name="dateBooking" id="dateBooking" placeholder="M/DD/YYYY"/>
                </div>
                <div id="loading"></div>
                <form class="" id="add-booking-detail-form">
                    <template id="ticket_service_detail">
                        <div class="booking-detail-card--item p-3">
                            <div class="content">
                                <div class="d-flex justify-content-between align-items-center fsize-2 mulish-medium h-color mb-1">
                                    <span data-service_times>01:00 PM - 01-30 PM</span>
                                    <span class="delete-service">
                                        <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M8.86328 9.01562C8.69922 9.17969 8.39844 9.17969 8.23438 9.01562L4.625 5.37891L0.988281 9.01562C0.824219 9.17969 0.523438 9.17969 0.359375 9.01562C0.195312 8.85156 0.195312 8.55078 0.359375 8.38672L3.99609 4.75L0.359375 1.14062C0.195312 0.976562 0.195312 0.675781 0.359375 0.511719C0.523438 0.347656 0.824219 0.347656 0.988281 0.511719L4.625 4.14844L8.23438 0.511719C8.39844 0.347656 8.69922 0.347656 8.86328 0.511719C9.02734 0.675781 9.02734 0.976562 8.86328 1.14062L5.22656 4.75L8.86328 8.38672C9.02734 8.55078 9.02734 8.85156 8.86328 9.01562Z" fill="#FF0000" fill-opacity="0.5" />
                                        </svg>
                                    </span>
                                </div>
                                <div class="ticket">
                                    <div class="p-2 ticket-bd-bottom d-flex justify-content-between align-items-center">
                                        <h3 class="mulish-bold fsize-2 h-color mb-0" data-service_name>Service1</h3>
                                        <h3 class="mulish-bold fsize-2 h-color mb-0" data-service_price>$150+</h3>
                                    </div>
                                    <div class="p-2 d-flex justify-content-between align-items-center">
                                        <p class="fsize-2 p-color mb-0" data-service_description>Details</p>
                                        <p class="fsize-2 p-color mb-0" data-service_duration>30ms</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>
                    <template id="booking_ticket">
                        <div class="list-booking-detail-card mb-3">
                            <div class="booking-detail-card">
                                <div class="booking-detail-card--head mulish-bold h-color fsize-4 px-3 py-2" data-ticket_guest_name>Mary Patricia</div>
                                <div id="list-ticket_service_detail" class="list-booking" data-list_ticket_service_detail>

                                </div>
                                <div class="px-3 pb-3">
                                    <a class="h-color mulish-bold fsize-2 add-another-service" data-add_another_service>+ Add Another Service</a>
                                </div>
                            </div>
                        </div>
                    </template>
                    <div id="list_booking_ticket"></div>
                    <div class="another-guest text-center py-2">
                        <a class="mulish-bold fsize-2 main-color btn-add-another-guest">+ Add Another Guest</a>
                    </div>
                    <div class="total py-2">
                        <span class="mulish-bold fsize-5 h-color">Total:</span>
                        <span class="mulish-bold fsize-7 main-color" id="total">$600+</span>
                    </div>
                    <div class="add_note">
                        <textarea class="p-3" id="add_note" name="note" rows="4" cols="50" placeholder="Add note"></textarea>
                    </div>

                    <div class="form-check policy">
                        <input class="form-check-input" require type="checkbox" value="" name="policy" id="policy">
                        <label class="form-check-label text-start fsize-2 p-color" for="policy">By clicking <span class="h-color">Agree and Continue</span> you agree to our <span class="h-color">Terms of Use</span>, our <span class="h-color">Privacy Policy</span>, and our <span class="h-color">Disclaimer</span>.</label>
                    </div>
                    <div id="form-results" class="py-2 alert alert-danger d-none" role="alert"></div>
                    <div class="my-3 d-flex justify-content-center align-items-center gap-2">
                        <button disabled id="booking_detail_pay_now" type="submit" class="btn bg-main text-white mulish-bold radius-300 py-2 px-5">Pay Now</button>
                        <span class="fsize-2 p-color">Or</span>
                        <button disabled id="booking_detail_pay_at_store" type="submit" class="btn bg-main text-white mulish-bold radius-300 py-2 px-5">Pay At Store</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="<?= $_rootPath; ?>/views/nail360/assets/js/salon/booking.js"></script>