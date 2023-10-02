// ********************************************************
// * 1. Lazyload IMG : using lazy-src, src-alt (optional) *
// ********************************************************
function load(img) {
    const url = img.getAttribute('lazy-src')
    const alt = img.getAttribute('src-alt')
    if(url){
        img.setAttribute('src', url)
        img.removeAttribute('lazy-src')
    }

    if(alt){
        img.setAttribute('alt', alt)
        img.removeAttribute('src-alt')
    }
    if(img.classList.contains('loading')){
        img.classList.remove('loading')
    }
    const parentWithClassLoading = img.closest('.loading');
    if(parentWithClassLoading){
        parentWithClassLoading.classList.remove('loading');
    }
}
//Run dataReady after DOM created by template
function dataReady() {
    if ('IntersectionObserver' in window) {
        var lazyImgs = document.querySelectorAll('[lazy-src]')
        let observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    load(entry.target);
                    observer.unobserve(entry.target);
                }
            })
        });
        lazyImgs.forEach(img => {
            observer.observe(img)
        })
    } else {
        // https://developer.mozilla.org/en-US/docs/Web/API/Element/getBoundingClient Rect
    }
}
// *******************************************************************
// * 2. Lazyload Background IMG : using lazy-bg-src                  *
// *******************************************************************
function loadBgImg(bgImg) {
    const urlBackground = bgImg.getAttribute('lazy-bg-src')
    if(urlBackground){
        bgImg.style.backgroundImage = "url("+urlBackground+")"
        bgImg.removeAttribute('lazy-bg-src')
    }
}
//Run dataReady after DOM created by template
function lazyBackgroundReady() {
    if ('IntersectionObserver' in window) {
        var lazyBackgroundImgs = document.querySelectorAll('[lazy-bg-src]')
        let observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    loadBgImg(entry.target);
                    observer.unobserve(entry.target);
                }
            })
        });
        lazyBackgroundImgs.forEach(bgImg => {
            observer.observe(bgImg)
        })
    } else {
        // https://developer.mozilla.org/en-US/docs/Web/API/Element/getBoundingClient Rect
    }
}
//Mobile
async function toogleSearchForm(){
    document.querySelector('.navbar__logo').classList.toggle("d-none");
    document.querySelector('.mobile-action-menu').classList.toggle("d-none");
    document.querySelector('.search-form-container').classList.toggle("search-form-container--hidden");
}
document.addEventListener("DOMContentLoaded", (event) => {
   document.querySelector('.mobile-search-btn').addEventListener("click", (e) => {
    toogleSearchForm();
  });
  document.querySelector('.expand-menu').addEventListener("click", (e) => {
    document.getElementById('menu').classList.toggle('transform-none');
  });
  document.getElementById('close-expand-menu').addEventListener("click", (e) => {
        const menu = document.getElementById('expand-menu');
        menu.checked = menu.checked ? false : true;
        document.getElementById('menu').classList.toggle('transform-none');
  });
  
});
document.addEventListener('click', async (e) =>{   
    const headerNavbar = document.querySelector('.header__navbar');
    const menu = document.getElementById('menu');
    const searchFormContainer = document.querySelector('.search-form-container');

    if (!searchFormContainer.classList.contains("search-form-container--hidden") && 
        !headerNavbar.contains(e.target) && 
        !menu.contains(e.target)) {
        toogleSearchForm();
    }
  });