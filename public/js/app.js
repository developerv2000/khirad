(()=>{if($(document).ready((function(){"serviceWorker"in navigator?navigator.serviceWorker.register(document.location.origin+"/service-worker.js").then((function(e){console.log("Service worker registration succeeded:",e)}),(function(e){console.log("Service worker registration failed:",e)})):console.log("Service workers are not supported."),$(".selectize-singular").selectize({}),$(".selectize-singular-linked").selectize({onChange:function(e){window.location=e}}),$(".jq-select").styler()})),$.ajaxSetup({headers:{"X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")}}),document.querySelector("#scroll-top-button").addEventListener("click",(function(){document.body.scrollIntoView({block:"start",behavior:"smooth"})})),document.querySelector("#header-search-button").addEventListener("click",(function(){var e=document.querySelector("#header-search-input");!e.classList.contains("header-search__input--hidden")&&e.value.length>2?document.querySelector("#header-search-form").submit():(e.classList.toggle("header-search__input--hidden"),e.focus())})),document.querySelectorAll('[data-action="toggle-mobile-menu"]').forEach((function(e){e.addEventListener("click",(function(e){document.querySelector(".mobile-menu").classList.toggle("mobile-menu--visible")}))})),document.querySelector("#most-readable-books-carousel")){var e=$("#most-readable-books-carousel").owlCarousel({margin:16,loop:!0,dots:!1,autoplay:!0,autoplayHoverPause:!0,autoplaySpeed:4e3,autoplayTimeout:7e3,responsive:{0:{items:1,autoWidth:!1,nav:!0},991:{autoWidth:!0,items:3}}});document.querySelector("#most-readable-books-carousel-prev-button").addEventListener("click",(function(){e.trigger("prev.owl.carousel")})),document.querySelector("#most-readable-books-carousel-next-button").addEventListener("click",(function(){e.trigger("next.owl.carousel")}))}if(document.querySelector("#map"));document.querySelectorAll(".accordion__button").forEach((function(e){e.addEventListener("click",(function(e){var t=e.target,o=t.closest(".accordion"),c=t.closest(".accordion__item"),r=c.querySelector(".accordion__collapse"),n=o.querySelector(".accordion__item--active");n&&n!==c&&(n.classList.remove("accordion__item--active"),n.querySelector(".accordion__collapse").style.height=null),r.clientHeight?(r.style.height=0,c.classList.remove("accordion__item--active")):(r.style.height=r.scrollHeight+"px",c.classList.add("accordion__item--active"))}))})),document.querySelectorAll('[data-action="show-modal"]').forEach((function(e){e.addEventListener("click",(function(t){document.getElementById(e.dataset.targetId).classList.add("show"),document.body.style.overflowY="hidden"}))})),document.querySelectorAll('[data-action="hide-modal"]').forEach((function(e){e.addEventListener("click",(function(t){document.body.style.overflowY="auto",document.getElementById(e.dataset.targetId).classList.remove("show")}))})),document.querySelectorAll(".collapse__button").forEach((function(e){e.addEventListener("click",(function(e){var t=e.target.closest(".collapse"),o=t.querySelector(".collapse__body");o.clientHeight?(o.style.height=0,t.classList.remove("collapse--active")):(o.style.height=o.scrollHeight+"px",t.classList.add("collapse--active"))}))}))})();