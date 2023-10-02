//1x1 pixel images
const temporary_src_img = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mM8XQ8AAhsBTLgo62UAAAAASUVORK5CYII=";
// Page Content
const pageContent = document.getElementById('page-content');
const searchResultsTemplate = document.getElementById('search-results');
const searchNoResultsTemplate = document.getElementById('search-no-results');

const salonSearchItem = document.getElementById('salon-search--item');
var mapLocation = []
var map = null;
// Init

pageContent.innerHTML = '<div class="position-absolute start-50" style=" top: 10rem; "> <div class="spinner-border text-danger" role="status"><span class="visually-hidden">Loading...</span></div> Loading...</div>';

async function loadPlacehoder() {
    const divSearchResultsTemplate = searchResultsTemplate.content.cloneNode(true)
    divSearchResultsTemplate.querySelector('[data-total_search]').innerHTML = 'Over ? Salons';

    const listSalonSearch = divSearchResultsTemplate.querySelector('[data-list_salon_search]')

    listSalonSearch.innerHTML = "";

    for (var i = 0; i < 5; i++) {
        const salonItem = salonSearchItem.content.cloneNode(true)
        listSalonSearch.append(salonItem);
    }
    pageContent.innerHTML = "";
    pageContent.append(divSearchResultsTemplate);
}

let pagination = {
    totalPages: 0,
    pageSize: 8,
    startPage: 0,
    endPage: 0,
    currentPage: 1,
    total: 0
};

function initPagination() {
    const totalPages = Math.ceil(pagination.total / pagination.pageSize);
    const startPage = Math.max(1, pagination.currentPage - 2);
    const endPage = Math.min(totalPages, pagination.currentPage + 2);
    pagination.totalPages = totalPages
    pagination.startPage = startPage
    pagination.endPage = endPage
    return renderPagination();
}
function renderPagination() {
    let pageNumbers = [];
    let classExtra = (pagination.startPage == pagination.currentPage) ? "disabled" : "";
    const preBtn = '<li id="prevBtn" class="page-item ' + classExtra + '">'
        + '<a class="page-link d-flex align-items-center justify-content-center" href="#/">'
        + '<svg class="first" width="9" height="13" viewBox="0 0 9 13" fill="none" xmlns="http://www.w3.org/2000/svg">'
        + '<path d="M7.125 12.7249C6.87891 12.7249 6.66016 12.6428 6.49609 12.4788L1.24609 7.22876C0.890625 6.90063 0.890625 6.32642 1.24609 5.99829L6.49609 0.748291C6.82422 0.392822 7.39844 0.392822 7.72656 0.748291C8.08203 1.07642 8.08203 1.65063 7.72656 1.97876L3.10547 6.59985L7.72656 11.2483C8.08203 11.5764 8.08203 12.1506 7.72656 12.4788C7.5625 12.6428 7.34375 12.7249 7.125 12.7249Z" />'
        + '</svg>'
        + '</a> </li>';
    pageNumbers.push(preBtn);
    for (let i = pagination.startPage; i <= pagination.endPage; i++) {
        classExtra = (i == pagination.currentPage) ? "active" : "";
        let item = '<li class="page-item page-index ' + classExtra + '"><a class="page-link d-flex align-items-center justify-content-center" href="#/">' + i + '</a></li>';
        pageNumbers.push(
            item
        );
    }
    classExtra = (pagination.endPage == pagination.currentPage) ? "disabled" : "";
    const nextBtn = '<li id="nextBtn" class="page-item ' + classExtra + '">'
        + '<a class="page-link d-flex align-items-center justify-content-center" href="#/">'
        + '<svg class="last" width="8" height="13" viewBox="0 0 8 13" fill="none" xmlns="http://www.w3.org/2000/svg">'
        + '<path d="M1.65332 12.7249C1.89941 12.7249 2.11816 12.6428 2.28223 12.4788L7.53223 7.22876C7.8877 6.90063 7.8877 6.32642 7.53223 5.99829L2.28223 0.748291C1.9541 0.392822 1.37988 0.392822 1.05176 0.748291C0.696289 1.07642 0.696289 1.65063 1.05176 1.97876L5.67285 6.59985L1.05176 11.2483C0.696289 11.5764 0.696289 12.1506 1.05176 12.4788C1.21582 12.6428 1.43457 12.7249 1.65332 12.7249Z" />'
        + '</svg>'
        + '</a> </li>';
    pageNumbers.push(nextBtn);
    return pageNumbers;
}
async function changePage() {
    $("#pagination-ul .page-index a").on("click", function () {
        if (pagination.currentPage != $(this).text()) {
            pagination.currentPage = parseFloat($(this).text());
            pageContent.innerHTML = '<div class="position-absolute start-50" style=" top: 10rem; "> <div class="spinner-border text-danger" role="status"><span class="visually-hidden">Loading...</span></div> Loading...</div>';
            fetchData();
        }
    });
}
async function prevPage() {
    $("#prevBtn a").on("click", function () {
        pagination.currentPage -= 1;
        pageContent.innerHTML = '<div class="position-absolute start-50" style=" top: 10rem; "> <div class="spinner-border text-danger" role="status"><span class="visually-hidden">Loading...</span></div> Loading...</div>';
        fetchData();
    });
}
async function nextPage() {
    $("#nextBtn a").on("click", function () {
        pagination.currentPage += 1;
        pageContent.innerHTML = '<div class="position-absolute start-50" style=" top: 10rem; "> <div class="spinner-border text-danger" role="status"><span class="visually-hidden">Loading...</span></div> Loading...</div>';
        fetchData();
    });
}
async function filters() {
    $(".drop-btn").on("click", function () {
        $(this).toggleClass("drop-btn-show");
   
    });
    $(".drop-item").on("click", function () {
        $("#sort-by").text($(this).text());
        window._searchSalon.sortby = $(this).attr('id');
        $(".drop-btn").toggleClass("drop-btn-show");
        fetchData();
    });

}
async function salonSearchItemClicked(){
    $('.salon-search--item').on("click",function(){
        let position = $(this).find(".data-map_postion");
        map.setZoom(10);
        // Move the map position to the clicked marker
        map.panTo(new google.maps.LatLng(position.data("lat"), position.data("long")));
    })
}
async function initMap() {
    var locations = [];
    // locations = [
    //    ['Bondi Beach', -33.890542, 151.274856, 4]
    //]
    for (let index = 0; index < mapLocation.length; index++) {
        const location = mapLocation[index];
        locations.unshift([
            location.name,
            location.latitude,
            location.longitude
        ]);
    }

    map = new google.maps.Map(document.getElementById('map'), {
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var infowindow = new google.maps.InfoWindow();
    var marker, i;

    var icon = {
        url: window._rootPath + '/views/nail360/assets/icons/map-marker.svg',

    };
    var currentMarker = null;
    for (i = 0; i < locations.length; i++) {

        marker = new google.maps.Marker({
            position: new google.maps.LatLng(locations[i][1], locations[i][2]),
            map: map,
            icon: icon,
            animation: google.maps.Animation.DROP
        });
        var bounds = new google.maps.LatLngBounds();
        bounds.extend(marker.position);
        google.maps.event.addListener(marker, 'click', (function (marker, i) {
            return function () {
                if (currentMarker !== null && currentMarker !== marker) {
                    currentMarker.setAnimation(null);
                }
                currentMarker = marker;
                infowindow.setContent(locations[i][0]);
                infowindow.open(map, marker);
                if (marker.getAnimation() !== null) {
                    marker.setAnimation(null);
                } else {
                    marker.setAnimation(google.maps.Animation.BOUNCE);
                }
            }
        })(marker, i));
    }
    map.fitBounds(bounds);
    var listener = google.maps.event.addListener(map, "idle", function () {
        map.setZoom(4);
        google.maps.event.removeListener(listener);
    });
    salonSearchItemClicked();
}



async function renderMap() {
    // // In the following example, markers appear when the user clicks on the map.
    // // Each marker is labeled with a single alphabetical character.
    const scriptMap = document.querySelector("#script-map");
    scriptMap.setAttribute("src", scriptMap.getAttribute("lazy-src"));
    scriptMap.removeAttribute("lazy-src");
    window.initMap = initMap;
}
async function fetchData() {
    // Make API call for : List Search
    // let url = window._adminApi + "/search?s=salon&sfld=id,name,longitude,latitude,street,state,zip";
    // url += "&val=" + window._searchName + "," + window._searchAddress + "&op=like,like&o=,desc&p=" + pagination.currentPage + "&z=" + pagination.pageSize;
    let url = window._adminApi + "/public?s=GetSalons&name=" + window._searchSalon.name 
    + "&address=" + window._searchSalon.address 
    + "&sortby=" + window._searchSalon.sortby
    + "&category=" + window._searchSalon.category
    + "&star=" + window._searchSalon.star
    + "&distance=" + window._searchSalon.distance
    + "&isopen=" + window._searchSalon.isopen
    + "&book=" + window._searchSalon.book
    + "&p=" + pagination.currentPage 
    + "&z=" + pagination.pageSize;
    $.ajax({
        url: url,
        method: "GET",
        success: function (response) {
            pageContent.innerHTML = "";
            if (response.error === "" && response.data.length > 0) {
                loadPlacehoder();
                pagination.total = response.total
                mapLocation = response.data
                const divSearchResultsTemplate = searchResultsTemplate.content.cloneNode(true)
                divSearchResultsTemplate.querySelector('[data-total_search]').innerHTML = 'Over ' + response.total + ' Salons';

                const listSalonSearch = divSearchResultsTemplate.querySelector('[data-list_salon_search]');

                listSalonSearch.innerHTML = "";

                for (var i = 0; i < response.data.length; i++) {
                    let item = response.data[i];
                    const salonItem = salonSearchItem.content.cloneNode(true)

                    salonItem.querySelector('[data-salon_img]').innerHTML = '<img src="' + temporary_src_img + '" lazy-src="https://i.pravatar.cc/400?img=' + i + '" class="salon-img" src-alt="' + item.name + '"/>';
                    salonItem.querySelector('[data-salon_search_logo]').classList.add("border-0");
                    salonItem.querySelector('[data-salon_search_logo]').innerHTML = '<img src="' + temporary_src_img + '" class="salon-search--logo" lazy-src="https://i.pravatar.cc/60?img=' + i + '" src-alt="' + item.name + '" />';
                    salonItem.querySelector('[data-salon_name]').textContent = item.name;
                    salonItem.querySelector('[data-start_count]').textContent = Number.parseFloat(item.star).toFixed(1);
                    salonItem.querySelector('[data-review_count]').textContent = '(' + item.countreview + ')';
                    salonItem.querySelector('[data-open]').textContent = 'Open Now';
                    salonItem.querySelector('[data-time_split]').textContent = '-';
                    salonItem.querySelector('[data-close]').textContent = 'Closes 10 PM';
                    salonItem.querySelector('[data-address]').textContent = item.street + ", " + item.city + ", " + item.state + ' ' + item.zip;
                    salonItem.querySelector('[data-miles]').textContent = '5 miles';
                    salonItem.querySelector('[data-salon_description]').textContent = "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy.";
                    salonItem.querySelector('[data-booking_btn]').textContent = 'Book Now';
                    salonItem.querySelector('[data-booking_btn]').href = window._rootPath + '/salon/' + item.id;
                    salonItem.querySelector('[data-booking_btn]').classList.remove("p-0");
                    salonItem.querySelector('[data-booking_btn]').classList.add("px-3");
                    salonItem.querySelector('[data-linkcard]').href = window._rootPath + '/salon/' + item.id;

                    let position = '<span class="data-map_postion" data-lat="'+item.latitude+'" data-long="'+item.longitude+'"></span>';
                    salonItem.querySelector('[data-map_postion]').innerHTML= position;

                    listSalonSearch.append(salonItem);

                }
                const paginationDiv = divSearchResultsTemplate.querySelector('[data-search_pagination]');
                paginationDiv.innerHTML = "";
                let liPagination = initPagination();
                let paginationHTML = "";

                for (var i = 0; i < liPagination.length; i++) {
                    let item = liPagination[i];
                    paginationHTML += item;
                }
                paginationDiv.innerHTML = paginationHTML;
                pageContent.innerHTML = "";
                pageContent.append(divSearchResultsTemplate);
            }
            else {
                const divNoResults = searchNoResultsTemplate.content.cloneNode(true)
                pageContent.append(divNoResults);
            }
        },
        error: function (response) {
            // Handle error
            console.log('Search Error : ', response);
        },
        complete: function (response) {

            dataReady();
            changePage();
            nextPage();
            prevPage();
            filters();
            renderMap();
        }
    });
}
async function loadData() {
    await fetchData();
}
$(document).ready(async function () {
    await loadData();
})