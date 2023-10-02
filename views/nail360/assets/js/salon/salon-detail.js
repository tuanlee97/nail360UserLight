//1x1 pixel images
const temporary_src_img =
  "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mM8XQ8AAhsBTLgo62UAAAAASUVORK5CYII=";
const favoriteIcon =
  '<svg width="18" height="16" viewBox="0 0 18 16" fill="none" xmlns="http://www.w3.org/2000/svg">' +
  '<path d="M15.437 8.46875L9.40576 14.7188C8.99951 15.125 8.34326 15.125 7.96826 14.7188L1.90576 8.46875C0.155762 6.65625 0.249512 3.65625 2.21826 1.96875C3.90576 0.5 6.49951 0.78125 8.06201 2.375L8.68701 3.03125L9.28076 2.375C10.8433 0.78125 13.4058 0.5 15.1558 1.96875C17.0933 3.65625 17.187 6.65625 15.437 8.46875Z" fill-opacity="0.8"/>' +
  '<path d="M15.437 8.46875L15.0054 8.05199L15.0053 8.05211L15.437 8.46875ZM9.40576 14.7188L9.83009 15.1431L9.83751 15.1354L9.40576 14.7188ZM7.96826 14.7188L8.40914 14.3118L8.40411 14.3063L8.39894 14.301L7.96826 14.7188ZM1.90576 8.46875L1.47412 8.88551L1.47509 8.8865L1.90576 8.46875ZM2.21826 1.96875L2.60875 2.42432L2.61218 2.42133L2.21826 1.96875ZM8.06201 2.375L8.49654 1.96116L8.49046 1.95496L8.06201 2.375ZM8.68701 3.03125L8.25253 3.44504L8.69829 3.91309L9.13193 3.4338L8.68701 3.03125ZM9.28076 2.375L8.85232 1.95496L8.8439 1.96354L8.83584 1.97245L9.28076 2.375ZM15.1558 1.96875L15.5499 1.51623L15.5415 1.50917L15.1558 1.96875ZM15.0053 8.05211L8.97401 14.3021L9.83751 15.1354L15.8688 8.88539L15.0053 8.05211ZM8.9815 14.2945C8.79974 14.4762 8.5375 14.4508 8.40914 14.3118L7.52738 15.1257C8.14903 15.7992 9.19929 15.7738 9.83003 15.143L8.9815 14.2945ZM8.39894 14.301L2.33644 8.051L1.47509 8.8865L7.53759 15.1365L8.39894 14.301ZM2.3374 8.05199C0.823683 6.48421 0.906091 3.88371 2.60874 2.4243L1.82779 1.5132C-0.407068 3.42879 -0.512159 6.82829 1.47412 8.88551L2.3374 8.05199ZM2.61218 2.42133C4.02629 1.19053 6.26055 1.39456 7.63357 2.79504L8.49046 1.95496C6.73847 0.167937 3.78523 -0.190526 1.82435 1.51617L2.61218 2.42133ZM7.62753 2.78879L8.25253 3.44504L9.12149 2.61746L8.49649 1.96121L7.62753 2.78879ZM9.13193 3.4338L9.72568 2.77755L8.83584 1.97245L8.24209 2.6287L9.13193 3.4338ZM9.70921 2.79504C11.0777 1.39913 13.287 1.18362 14.77 2.42833L15.5415 1.50917C13.5245 -0.183623 10.6088 0.163367 8.85232 1.95496L9.70921 2.79504ZM14.7617 2.4212C16.4369 3.88027 16.5198 6.48344 15.0054 8.05199L15.8687 8.88551C17.8542 6.82906 17.7496 3.43223 15.5498 1.5163L14.7617 2.4212Z" fill="white"/>' +
  "</svg>";
// Top Salon Services
const sectionListSalonService = document.querySelector(
  ".salon_detail_section .list-salon-services"
);
const topServiceItemTemplate = document.getElementById(
  "topServiceItemTemplate"
);
const limitDisplay = 6;
if(sectionListSalonService)
for (let i = 0; i < limitDisplay; i++) {
  sectionListSalonService.append(
    topServiceItemTemplate.content.cloneNode(true)
  );
}
const listGalleryImg = document.getElementById("list_gallery_img");
let nav_pagination = {
  totalPages: 0,
  pageSize: 24,
  startPage: 0,
  endPage: 0,
  currentPage: 1,
  total: 0
};
function renderServiceItem(dataListSalonService, limit) {
  limit = limit ? limit : dataListSalonService.length;
  for (var i = 0; i < limit; i++) {
    let itemService = dataListSalonService[i];
    const div = topServiceItemTemplate.content.cloneNode(true);
    div.querySelector("[data-top_img]").innerHTML =
      '<img class="feature_img" src="' +
      temporary_src_img +
      '" lazy-src="' +
      itemService.featureimg +
      '" src-alt="' +
      itemService.servicename +
      '" />  <div class="favorite-icon position-absolute top-0 end-0 py-2 px-3">' +
      favoriteIcon +
      "</div>";

    div.querySelector("[data-rate_star_icon]").innerHTML =
      '<img src="' +
      temporary_src_img +
      '" lazy-src="' +
      window._rootPath +
      '/views/nail360/assets/icons/star.svg"/>';

    div.querySelector("[data-rated_star]").textContent = itemService.star;
    div.querySelector("[data-review_number]").textContent =
      "(" + itemService.review + ")";
    div.querySelector("[data-service_name]").textContent =
      itemService.servicename;
    div.querySelector("[data-service_pic_count]").innerHTML =
      '<span class="d-flex gap-1"><img src="' +
      temporary_src_img +
      '" lazy-src="' +
      window._rootPath +
      '/views/nail360/assets/icons/img_thumb.svg"/>' +
      itemService.piccount +
      "</span>";

    div.querySelector("[data-description]").textContent =
      itemService.description;

    div.querySelector("[data-quickbook_btn]").href = "/#";
    div.querySelector("[data-quickbook_btn]").textContent = "Quick Book";
    sectionListSalonService.append(div);
  }
}

const view_all_service_btn = document.querySelector("#view_all_service_btn");
if(view_all_service_btn)
view_all_service_btn.addEventListener("click", function () {
  const data_extra = [
    {
      id: "",
      featureimg: "https://i.pravatar.cc/250?img=2",
      servicename: "Haircut and Styling",
      star: "4.8",
      review: "1850",
      piccount: "98",
      description:
        "Our expert stylists can give you the perfect haircut and style to match your personality and lifestyle.",
    },
    {
      id: "",
      featureimg: "https://i.pravatar.cc/250?img=3",
      servicename: "Facial Treatment",
      star: "4.7",
      review: "2100",
      piccount: "75",
      description:
        "Our facial treatments are designed to rejuvenate your skin and leave you feeling refreshed and renewed.",
    },

    {
      id: "",
      featureimg: "https://i.pravatar.cc/250?img=4",
      servicename: "Massage Therapy",
      star: "4.9",
      review: "2400",
      piccount: "112",
      description:
        "Our massage therapists are trained to provide a range of techniques to help you relax and relieve stress.",
    },

    {
      id: "",
      featureimg: "https://i.pravatar.cc/250?img=5",
      servicename: "Manicure and Pedicure",
      star: "4.6",
      review: "1750",
      piccount: "85",
      description:
        "Our nail technicians use only the highest quality products to ensure your nails look their best.",
    },

    {
      id: "",
      featureimg: "https://i.pravatar.cc/250?img=6",
      servicename: "Teeth Whitening",
      star: "4.4",
      review: "1500",
      piccount: "63",
      description:
        "Our teeth whitening treatments are safe and effective, leaving you with a brighter, more confident smile.",
    },

    {
      id: "",
      featureimg: "https://i.pravatar.cc/250?img=7",
      servicename: "Eyebrow Shaping",
      star: "4.7",
      review: "1950",
      piccount: "80",
      description:
        "Our eyebrow shaping services will help you achieve the perfect arch to complement your face shape.",
    },
  ];
  renderServiceItem(data_extra, null);
  dataReady();
  document.querySelector("#view_all_service").remove();
});


/*****************************************************************************************************************************/


/*API CALL*/

async function getSalonCategoryService(salonid, token) {
  try {
    let options = {
      headers: {
        'Authorization': `Bearer ${token}`
      }
    };
    let url = window._adminApi + "/salon/search?s=GetSalonCategoryService&idsalon=" + salonid;

    let response = await fetch(url, options);
    let dataResults = await response.json();

    if (dataResults && !dataResults.error) {
      return dataResults;
    }
    else {
      window.location.reload();
    }
  } catch (error) {
    console.error(error);
    // Additional error handling code goes here
  }
}

async function getSalonTechnician(salonid, token, pageSize = 100, pageIndex = 1) {
  try {
    let options = {
      headers: {
        'Authorization': `Bearer ${token}`
      }
    };
    let url = window._adminApi + "/salon/search?s=GetSalonTechnician&salonid=" + salonid + "&p=" + pageIndex + "&z=" + pageSize;

    let response = await fetch(url, options);
    let dataResults = await response.json();

    if (dataResults && !dataResults.error) {
      return dataResults;
    }
    else {
      window.location.reload();
    }
  } catch (error) {
    console.error(error);
    // Additional error handling code goes here
  }
}

async function getSalonGallery(salonid) {
  try {
    let url = window._adminApi + "/public?s=GetSalonGallery&idsalon=" + salonid + "&p=" + nav_pagination.currentPage + "&z=" + nav_pagination.pageSize;
    let dataResults = null
    let response = await fetch(url);
        dataResults = await response.json();

    if (dataResults && !dataResults.error) {
      nav_pagination.total = dataResults.total
      return dataResults;
    }
    else {
      return dataResults;
    }
  } catch (error) {
    alert(error);
  }
}

async function getSalonWorkingTime(salonid, token, now) {
  try {
    let options = {
      headers: {
        'Authorization': `Bearer ${token}`
      }
    };
    let url = window._adminApi + "/salon/search?s=GetSalonWorkingTime&salonid=" + salonid + "&fromday=" + new Date(now).toISOString();
    let dataResults = null
    let response = await fetch(url, options);
    return dataResults = await response.json(); 
  } catch (error) {
    alert(error);
  }
}

async function getSalonWorkingTechnicianByTime(salonid, serviceid, token, now) {
  try {
    let options = {
      headers: {
        'Authorization': `Bearer ${token}`
      }
    };
    let url = window._adminApi + "/salon/search?s=GetSalonWorkingTechnicianByTime&salonid=" + salonid + "&serviceid=" + serviceid + "&fromday=" + new Date(now).toISOString();
    let dataResults = null
    let response = await fetch(url, options);
    return dataResults = await response.json(); 
  } catch (error) {
    alert(error);
  }
}

async function createSalonCart(token, data) {
  try {
    let options = {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Authorization': `Bearer ${token}`
      },
      body: JSON.stringify(data)
    };
    let url = window._adminApi + "/salon/cmd?c=CreateSalonCart";
    let response = await fetch(url, options);
    let dataResults = await response.json();

    if (dataResults && !dataResults.error) {
      return dataResults;
    }
    else {
      //window.location.reload();
    }
  } catch (error) {
    console.error(error);
    // Additional error handling code goes here
  }
}
async function getSalonReviewById(idreview) {
  try {
    let options = {
      headers: {
        'Authorization': `Bearer ${token}`
      }
    };
    let url = window._adminApi + "/public?s=GetSalonReviewById&idreview="+idreview;
    let dataResults = null
    let response = await fetch(url, options);
    return dataResults = await response.json(); 
  } catch (error) {
    alert(error);
  }
}
/*****************************************************************************************************************************/

async function filters() {
  $(".drop-btn").on("click", function () {
      $(this).toggleClass("drop-btn-show");
  });
  $(".drop-item").on("click", function () {
      $("#sort-by").text($(this).text());
      $(".drop-btn").toggleClass("drop-btn-show");
  });
  
}
async function openGalleryImgDetail(data) {
  let dataGetSalonReviewById = await getSalonReviewById(data.idreview);
  if(!dataGetSalonReviewById.error){
    let review = dataGetSalonReviewById.data[0];
    $("#staticBackdropGalleryItem .user-info--img").html( '<img class="loading" src="'+temporary_src_img+'" lazy-src="'+window._adminApi+'/images'+review.avatar+'" />');
    $("#staticBackdropGalleryItem .user-info--name").text(review.name);
    let ratingHTML = "";

    for (let y = 0; y < review.star; y++) {
        ratingHTML += '<i class="rating__icon rating__icon--star fa fa-star"></i>'
    }
    for (let y = 0; y < 5 - review.star; y++) {
        ratingHTML += '<i class="rating__icon none_rating__icon--star fa fa-star"></i>'
    }
    $("#staticBackdropGalleryItem .list-rating").html(ratingHTML);
    $("#staticBackdropGalleryItem .createddate").text(new Date(review.createddate).toLocaleDateString("en-US"));
    $("#staticBackdropGalleryItem .review-description").text(review.content.review);
  }
  $("#staticBackdropGalleryItem").find("[data-number]").text(data.number);
  $("#staticBackdropGalleryItem").find("[data-img]").html('<img class="feature_img loading" src="'+temporary_src_img+'" lazy-src="' + data.img + '" lazy-src="' + data.img + '" src-alt="' + data.img +'" />');

  $("#staticBackdropGalleryItem").modal("show"); 
}
async function onClickImgDetail() {
  $(".gallery_img img").on("click", async function () {
    if(!$(this).hasClass("placeholder-img"))
      await openGalleryImgDetail($(this).data());
    dataReady();
  });
}


function galleryInitPagination() {
    const totalPages = Math.ceil(nav_pagination.total / nav_pagination.pageSize);
    const startPage = Math.max(1, nav_pagination.currentPage - 2);
    const endPage = Math.min(totalPages, nav_pagination.currentPage + 2);
    nav_pagination.totalPages = totalPages
    nav_pagination.startPage = startPage
    nav_pagination.endPage = endPage
    return renderNavPagination();
}
function renderNavPagination() {
  let pageNumbers = [];
  let classExtra = (nav_pagination.startPage == nav_pagination.currentPage) ? "disabled" : "";
  const preBtn = '<li id="prevBtn" class="page-item ' + classExtra + '">'
      + '<a class="page-link d-flex align-items-center justify-content-center" href="#/">'
      + '<svg class="first" width="9" height="13" viewBox="0 0 9 13" fill="none" xmlns="http://www.w3.org/2000/svg">'
      + '<path d="M7.125 12.7249C6.87891 12.7249 6.66016 12.6428 6.49609 12.4788L1.24609 7.22876C0.890625 6.90063 0.890625 6.32642 1.24609 5.99829L6.49609 0.748291C6.82422 0.392822 7.39844 0.392822 7.72656 0.748291C8.08203 1.07642 8.08203 1.65063 7.72656 1.97876L3.10547 6.59985L7.72656 11.2483C8.08203 11.5764 8.08203 12.1506 7.72656 12.4788C7.5625 12.6428 7.34375 12.7249 7.125 12.7249Z" />'
      + '</svg>'
      + '</a> </li>';
  pageNumbers.push(preBtn);
  for (let i = nav_pagination.startPage; i <= nav_pagination.endPage; i++) {
      classExtra = (i == nav_pagination.currentPage) ? "active" : "";
      let item = '<li class="page-item page-index ' + classExtra + '"><a class="page-link d-flex align-items-center justify-content-center" href="#/">' + i + '</a></li>';
      pageNumbers.push(
          item
      );
  }
  classExtra = (nav_pagination.endPage == nav_pagination.currentPage) ? "disabled" : "";
  const nextBtn = '<li id="nextBtn" class="page-item ' + classExtra + '">'
      + '<a class="page-link d-flex align-items-center justify-content-center" href="#/">'
      + '<svg class="last" width="8" height="13" viewBox="0 0 8 13" fill="none" xmlns="http://www.w3.org/2000/svg">'
      + '<path d="M1.65332 12.7249C1.89941 12.7249 2.11816 12.6428 2.28223 12.4788L7.53223 7.22876C7.8877 6.90063 7.8877 6.32642 7.53223 5.99829L2.28223 0.748291C1.9541 0.392822 1.37988 0.392822 1.05176 0.748291C0.696289 1.07642 0.696289 1.65063 1.05176 1.97876L5.67285 6.59985L1.05176 11.2483C0.696289 11.5764 0.696289 12.1506 1.05176 12.4788C1.21582 12.6428 1.43457 12.7249 1.65332 12.7249Z" />'
      + '</svg>'
      + '</a> </li>';
  pageNumbers.push(nextBtn);
  return pageNumbers;
}
async function fetchImgGallery() {
  let response = await getSalonGallery(salon_id);
  let galleryImgTemplate = document.getElementById("gallery_img");

  listGalleryImg.innerHTML="";

  for (let index = 0; index < response['data'].length; index++) {
    const element = response['data'][index];
    let div = galleryImgTemplate.content.cloneNode(true);
    div.querySelector("[data-img").innerHTML =   '<img class="loading" data-img="'+window._adminApi + '/images/' + element.imgpath +  element.imgname +'" src="'+temporary_src_img+'" lazy-src="'+window._adminApi + '/images/' + element.imgpath +  element.imgname +'" alt="' +
    element.imgname +'" data-number="'+ `${index+1}` +'/'+ response['data'].length +'" data-idreview="'+element.idreview+'" />';
    listGalleryImg.append(div);
  }
  
  let paginationContainter = document.querySelector("#staticBackdropGalleryAll [data-pagination]");
  paginationContainter.innerHTML = "";
  let liPagination = galleryInitPagination();
  let paginationHTML = "";

  for (var i = 0; i < liPagination.length; i++) {
      let item = liPagination[i];
      paginationHTML += item;
  }
  paginationContainter.innerHTML = paginationHTML;
  changePageNav();
  nextPageNav();
  prevPageNav();
  onClickImgDetail();
}
async function onClickGalleryAll() {
  $("#btnGalleryAll").on("click", async function () {
      nav_pagination.pageSize = 24
      nav_pagination.currentPage = 1
      await fetchImgGallery();
      dataReady();
      $("#staticBackdropGalleryAll").modal("show"); 
  });
}
async function changePageNav() {
  $("#pagination-ul .page-index a").on("click", function () {
      if (nav_pagination.currentPage != $(this).text()) {
        nav_pagination.currentPage = parseFloat($(this).text());
        listGalleryImg.innerHTML = '<div class="position-absolute start-50"> <div class="spinner-border text-danger" role="status"><span class="visually-hidden">Loading...</span></div> Loading...</div>';
        fetchImgGallery();
      }
  });
}
async function prevPageNav() {
  $("#prevBtn a").on("click", function () {
    nav_pagination.currentPage -= 1;
    listGalleryImg.innerHTML = '<div class="position-absolute start-50 top-50"> <div class="spinner-border text-danger" role="status"><span class="visually-hidden">Loading...</span></div> Loading...</div>';
    fetchImgGallery();
  });
}
async function nextPageNav() {
  $("#nextBtn a").on("click", function () {
    nav_pagination.currentPage += 1;
    listGalleryImg.innerHTML = '<div class="position-absolute start-50 top-50"> <div class="spinner-border text-danger" role="status"><span class="visually-hidden">Loading...</span></div> Loading...</div>';
    fetchImgGallery();
  });
}
/* Document Ready */
$(document).ready(function () {
  filters();
  onClickImgDetail();
  onClickGalleryAll();

  // Make API Call for : Testimonail
  const dataListSalonService = {
    total: 6,
    error: "",
    data: [
      {
        id: "",
        featureimg: "https://i.pravatar.cc/250?img=1",
        servicename: "Nail Extension",
        star: "4.5",
        review: "2220",
        piccount: "123",
        description:
          "The Pacific Grove Chamber of Commerce would like to thank eLab Communications and Mr. Will Elkadi for all the efforts that assisted.",
      },
      {
        id: "",
        featureimg: "https://i.pravatar.cc/250?img=8",
        servicename: "Nail Art",
        star: "5",
        review: "5",
        piccount: "123",
        description:
          "The Pacific Grove Chamber of Commerce would like to thank eLab Communications and Mr. Will Elkadi for all the efforts that assisted.",
      },
      {
        id: "",
        featureimg: "https://i.pravatar.cc/250?img=11",
        servicename: "Manicure",
        star: "5",
        review: "5",
        piccount: "123",
        description:
          "The Pacific Grove Chamber of Commerce would like to thank eLab Communications and Mr. Will Elkadi for all the efforts that assisted.",
      },
      {
        id: "",
        featureimg: "https://i.pravatar.cc/250?img=31",
        servicename: "Pedicure",
        star: "5",
        review: "5",
        piccount: "123",
        description:
          "The Pacific Grove Chamber of Commerce would like to thank eLab Communications and Mr. Will Elkadi for all the efforts that assisted.",
      },
      {
        id: "",
        featureimg: "https://i.pravatar.cc/250?img=15",
        servicename: "Nail Trim",
        star: "5",
        review: "5",
        piccount: "123",
        description:
          "The Pacific Grove Chamber of Commerce would like to thank eLab Communications and Mr. Will Elkadi for all the efforts that assisted.",
      },
      {
        id: "",
        featureimg: "https://i.pravatar.cc/250?img=3",
        servicename: "Acrylic Manicure",
        star: "5",
        review: "5",
        piccount: "123",
        description:
          "The Pacific Grove Chamber of Commerce would like to thank eLab Communications and Mr. Will Elkadi for all the efforts that assisted.",
      },
    ],
  };
  if (dataListSalonService.error === "" && dataListSalonService.total > 0) {
    if(sectionListSalonService){
      sectionListSalonService.innerHTML = "";
      renderServiceItem(dataListSalonService.data, 6);
    }
    dataReady();
  }

});