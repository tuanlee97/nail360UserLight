
$(function () {
    async function getSalonReviews() {
        try {
            let options = {
                headers: {
                    'Authorization': `Bearer ${token}`
                }
            };
            let url = window._adminApi + "/public?s=GetSalonReviews&salonid=" + salon_id;

            let response = await fetch(url, options);
            let dataResults = await response.json();

            if (dataResults)
                return dataResults;

        } catch (error) {
            console.error(error);
            // Additional error handling code goes here
        }
    }
    async function addSalonReview(token, data) {
        try {
            let options = {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${token}`
                },
                body: JSON.stringify(data)
            };
            let url = window._adminApi + "/salon/cmd?c=AddSalonReview";

            let response = await fetch(url, options);
            let dataResults = await response.json();

            return dataResults;
        } catch (error) {
            console.error(error);
            // Additional error handling code goes here
        }
    }
    async function uploadPictureSalonReview(token, formData) {
        try {
            let options = {
                method: 'POST',
                headers: {
                    'Authorization': `Bearer ${token}`
                },
                body: formData
            };
            let url = window._adminApi + "/salon/cmd?c=UploadPictureSalonReview";

            let response = await fetch(url, options);
            let dataResults = await response.json();

            return dataResults;
        } catch (error) {
            console.error(error);
            // Additional error handling code goes here
        }
    }
    async function removeBtnClick() {
        $('.order-number').click(function (e) {
            let li = $(this).parent();
            li.removeClass('ui-state-default');
            li.addClass('file-empty');
            li.removeData('order');
            li.removeData('id');
            li.find('.input_img_label').html('<svg width="26" height="19" viewBox="0 0 26 19" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M22.5634 9.07617C22.6806 8.68555 22.7587 8.29492 22.7587 7.86523C22.7587 5.48242 20.7665 3.49023 18.3837 3.49023C17.7197 3.49023 17.0947 3.64648 16.5087 3.91992C15.2587 2.16211 13.1884 0.990234 10.8837 0.990234C7.1728 0.990234 4.16498 3.91992 4.00873 7.5918C1.78217 8.37305 0.258733 10.4824 0.258733 12.8652C0.258733 15.9902 2.75873 18.4902 5.88373 18.4902H20.2587C22.9931 18.4902 25.2587 16.2637 25.2587 13.4902C25.2587 11.6543 24.2431 9.97461 22.5634 9.07617ZM20.0634 17.2402H6.07905C3.81342 17.2402 1.74311 15.5996 1.50873 13.334C1.27436 11.1465 2.71967 9.19336 4.71186 8.64648C5.02436 8.5293 5.25873 8.2168 5.25873 7.9043C5.25873 7.9043 5.25873 7.9043 5.25873 7.86523C5.21967 5.52148 6.70405 3.33398 8.93061 2.5918C11.7431 1.6543 14.3603 2.82617 15.6884 4.97461C15.8837 5.32617 16.3915 5.44336 16.7822 5.20898C17.4462 4.81836 18.2665 4.66211 19.1259 4.85742C20.1806 5.0918 21.04 5.91211 21.3525 6.92773C21.5869 7.70898 21.5087 8.45117 21.2353 9.07617C21.079 9.4668 21.3134 9.89648 21.704 10.0137C23.1884 10.6387 24.165 12.1621 23.9697 13.9199C23.7353 15.873 22.0165 17.2402 20.0634 17.2402ZM10.0634 10.209L12.1337 8.13867V14.7402C12.1337 15.0918 12.4072 15.3652 12.7587 15.3652C13.0712 15.3652 13.3837 15.0918 13.3837 14.7402V8.13867L15.415 10.209C15.6494 10.4434 16.079 10.4434 16.3134 10.209C16.5478 9.97461 16.5478 9.54492 16.3134 9.31055L13.1884 6.18555C13.0712 6.06836 12.915 5.99023 12.7587 5.99023C12.5634 5.99023 12.4072 6.06836 12.29 6.18555L9.16498 9.31055C8.93061 9.54492 8.93061 9.97461 9.16498 10.209C9.39936 10.4434 9.82905 10.4434 10.0634 10.209Z" fill="#D3427A"></path></svg>' +
                '<p class="p-color fsize-1 mb-0">Upload Photo/Videos</p>');
            $(this).remove();
        })
    }
    // $(".tech-service__select").select2({
    //     tags: true
    // });
    $('.input_img').change(function (e) {
        let index = $(this).data("index");
        let li = $($('#sortable li')[index])
        var files = e.target.files;
        for (var i = 0; i <= files.length; i++) {

            // when i == files.length reorder and break
            if (i == files.length) {
                // need timeout to reorder beacuse prepend is not done
                setTimeout(function () {
                    reorderImages();
                    removeBtnClick();
                }, 100);
                break;
            }

            var file = files[i];
            var reader = new FileReader();
            reader.onload = (function (file) {
                li.removeClass('file-empty')
                li.addClass('ui-state-default')
                li.data('order', index)
                li.data('id', file.lastModified)
                li.prepend('<div class="order-number"></div>')
                return function (event) {
                    li.find('.input_img_label').html('<img src="' + event.target.result + '" style="width:100%;" />');
                };
            })(file);

            reader.readAsDataURL(file);
        } // end for;

    });



    function reorderImages() {
        // get the items
        var images = $('#sortable li');

        var i = 0,
            nrOrder = 0;
        for (i; i < images.length; i++) {

            var image = $(images[i]);

            if (image.hasClass('ui-state-default')) {
                image.attr('data-order', nrOrder);
                var orderNumberBox = image.find('.order-number');
                //orderNumberBox.html(nrOrder + 1);
                orderNumberBox.html('<svg width="8" height="8" viewBox="0 0 8 8" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7.57617 6.68604C7.78711 6.92041 7.78711 7.27197 7.57617 7.48291C7.3418 7.71729 6.99023 7.71729 6.7793 7.48291L4.01367 4.69385L1.22461 7.48291C0.990234 7.71729 0.638672 7.71729 0.427734 7.48291C0.193359 7.27197 0.193359 6.92041 0.427734 6.68604L3.2168 3.89697L0.427734 1.10791C0.193359 0.873535 0.193359 0.521973 0.427734 0.311035C0.638672 0.0766602 0.990234 0.0766602 1.20117 0.311035L4.01367 3.12354L6.80273 0.334473C7.01367 0.100098 7.36523 0.100098 7.57617 0.334473C7.81055 0.54541 7.81055 0.896973 7.57617 1.13135L4.78711 3.89697L7.57617 6.68604Z" fill="white"/></svg>');
                nrOrder++;
            } // end if;

        } // end for;
    }

    function formatTime(timeString) {
        const createdDate = new Date(timeString);
        const differenceInMs = new Date() - createdDate;

        const seconds = Math.floor(differenceInMs / 1000);
        const minutes = Math.floor(seconds / 60);
        const hours = Math.floor(minutes / 60);
        const days = Math.floor(hours / 24);

        let timeAgo = "";
        if (days > 0) {
            timeAgo += days + " day" + (days > 1 ? "s" : "") + " ";
        }
        else if (hours > 0) {
            timeAgo += hours % 24 + " hour" + (hours % 24 > 1 ? "s" : "") + " ";
        }
        else if (minutes > 0) {
            timeAgo += minutes % 60 + " minute" + (minutes % 60 > 1 ? "s" : "") + " ";
        }
        else if (seconds > 0) {
            timeAgo += seconds % 60 + " second" + (seconds % 60 > 1 ? "s" : "") + " ";
        }

        timeAgo += "ago";

        if (days > 7) {
            timeAgo = new Date(timeString).toLocaleDateString("en-US");
        }
        return timeAgo;
    }
    async function renderSalonReviews() {
        let dataSalonReview = await getSalonReviews();
        const listCustomerReviews = document.querySelector(".list_customer_reviews");
        if (!dataSalonReview.error && dataSalonReview.data.length > 0) {
            listCustomerReviews.innerHTML = "";
            const reviewItemTemplate = document.getElementById("review-items");
            for (let index = 0; index < dataSalonReview.data.length; index++) {
                const review = dataSalonReview.data[index];
                const div = reviewItemTemplate.content.cloneNode(true);
                div.querySelector("li.item").dataset.review_id = review.id;
                div.querySelector(".customer-review-avatar").setAttribute("lazy-src", window._adminApi + "/images" + review.avatar);
                div.querySelector(".customer-name").textContent = review.name
                let ratingHTML = "";

                for (let y = 0; y < review.star; y++) {
                    ratingHTML += '<i class="rating__icon rating__icon--star fa fa-star"></i>'
                }
                for (let y = 0; y < 5 - review.star; y++) {
                    ratingHTML += '<i class="rating__icon none_rating__icon--star fa fa-star"></i>'
                }
                div.querySelector(".rating-ul").innerHTML = ratingHTML;
                div.querySelector(".post-time").textContent = formatTime(review.createddate);

                if (review.like) {
                    div.querySelector(".thumb-up").innerHTML = '<svg width="15" height="13" viewBox="0 0 15 13" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3.50244 11.8789C3.50244 12.3711 3.09229 12.7539 2.62744 12.6992H0.877441C0.385254 12.6992 0.00244141 12.3164 0.00244141 11.8516V5.75391C0.00244141 5.28906 0.385254 4.87891 0.877441 4.87891H2.62744C3.09229 4.87891 3.50244 5.26172 3.50244 5.75391V11.8789ZM14.0024 5.78125C14.0024 6.46484 13.4556 7.03906 12.772 7.06641C12.9907 7.3125 13.1274 7.61328 13.1274 7.96875C13.1274 8.59766 12.6626 9.11719 12.0337 9.25391C12.1704 9.44531 12.2524 9.66406 12.2524 9.91016C12.2524 10.5117 11.8696 11.0039 11.3228 11.168C11.3501 11.25 11.3774 11.3594 11.3774 11.4688C11.3774 12.1797 10.7759 12.7539 10.0649 12.7539H8.45166C7.49463 12.7539 6.59229 12.4531 5.82666 11.8789L4.89697 11.1953C4.56885 10.9492 4.37744 10.5664 4.37744 10.1289V5.75391C4.37744 5.78125 4.37744 5.75391 4.37744 5.75391C4.37744 5.37109 4.5415 5.01562 4.86963 4.74219L5.30713 4.38672C7.54932 2.60938 6.5376 0.503906 8.26025 0.503906C9.10791 0.503906 9.62744 1.1875 9.62744 1.84375C9.62744 2.25391 9.29932 3.42969 8.67041 4.46875H12.6899C13.4009 4.46875 14.0024 5.04297 14.0024 5.78125Z" fill="#007AB5" /></svg>';
                }
                div.querySelector(".like-number").textContent = review.like;
                div.querySelector(".headline").textContent = review.content.headline;
                div.querySelector(".review-content").textContent = review.content.review;
                listCustomerReviews.append(div);
            }

        }
        else {
            listCustomerReviews.innerHTML = "This salon has no reviews yet";
        }
        dataReady();
    }

    // EXECUTE JS
    //1. Call Load Salon review
    renderSalonReviews();
    //2. Form post review
    const form = document.querySelector('#write-review');
    form.addEventListener('submit', async (event) => {
        $('.btn-review-submit').html('<div class="d-flex justify-content-center align-items-center"><p class="p-color fsize-3 mb-0 me-2">Please wait...</p><div class="spinner-border text-danger" role="status"><span class="visually-hidden">Loading...</span></div></div>')

        event.preventDefault(); // prevent the form from submitting normally
        const formData = new FormData(form);

        // addSalonReview
        let addSalonReviewRequest = {
            salonid: salon_id,
            content: JSON.stringify({
                headline: formData.get('headline'),
                review: formData.get('review')
            }),
            star: formData.get('rating')
        };
        let dataAddSalonReview = await addSalonReview(token, addSalonReviewRequest);

        if (dataAddSalonReview.error) {
            $("#write-review #form-results").removeClass("d-none");
            $("#write-review #form-results").addClass("alert-danger");

            $("#write-review #form-results").text(dataAddSalonReview.error);
            $('.btn-review-submit').html('Post Review');
        } else {
            let idreview = dataAddSalonReview.new_id;
            if (idreview) {
                // uploadPictureSalonReview
                const uploadPictureSalonReviewRequest = new FormData();
                uploadPictureSalonReviewRequest.append('idsalon', salon_id);
                uploadPictureSalonReviewRequest.append('idreview', idreview);
                for (let i = 0; i < 5; i++) {
                    if (formData.get('image_' + i).name !== "")
                        uploadPictureSalonReviewRequest.append('file[]', formData.get('image_' + i), formData.get('image_' + i).name);
                }
                let dataUploadPictureSalonReview = await uploadPictureSalonReview(token, uploadPictureSalonReviewRequest);
                if (dataUploadPictureSalonReview.error) {
                    $("#write-review #form-results").removeClass("d-none");
                    $("#write-review #form-results").addClass("alert-danger");
                    $("#write-review #form-results").text(dataUploadPictureSalonReview.error);
                    $('.btn-review-submit').html('Post Review');
                } else {
                    $("#write-review #form-results").removeClass("d-none");
                    $("#write-review #form-results").addClass("alert-success");
                    $("#write-review #form-results").text(dataUploadPictureSalonReview.data.message)
                    window.location.reload();
                }
            }
        }



        return false;
        // Do something with the file, such as upload it to the server
    });
});