$((function(){"use strict";var e=$(".swiper-responsive-breakpoints"),t=$(".product-color-options li"),s=$(".btn-cart"),a=$(".btn-wishlist"),i="app-ecommerce-checkout.html",r="rtl"===$("html").attr("data-textdirection");if("laravel"===$("body").attr("data-framework")){var n=$("body").attr("data-asset-path");i=n+"app/ecommerce/checkout"}e.length&&new Swiper(".swiper-responsive-breakpoints",{slidesPerView:5,spaceBetween:55,navigation:{nextEl:".swiper-button-next",prevEl:".swiper-button-prev"},breakpoints:{1600:{slidesPerView:4,spaceBetween:55},1300:{slidesPerView:3,spaceBetween:55},768:{slidesPerView:2,spaceBetween:55},320:{slidesPerView:1,spaceBetween:55}}}),s.length&&s.on("click",(function(e){var t=$(this),s=t.find(".add-to-cart");s.length>0&&(e.preventDefault(),s.text("View In Cart").removeClass("add-to-cart").addClass("view-in-cart"),t.attr("href",i),toastr.success("","Added Item In Your Cart 🛒",{closeButton:!0,tapToDismiss:!1,rtl:r}))})),a.length&&a.on("click",(function(){var e=$(this);e.find("svg").toggleClass("text-danger"),e.find("svg").hasClass("text-danger")&&toastr.success("","Added to wishlist ❤️",{closeButton:!0,tapToDismiss:!1,rtl:r})})),t.length&&t.on("click",(function(){$(this).addClass("selected").siblings().removeClass("selected")}))}));
