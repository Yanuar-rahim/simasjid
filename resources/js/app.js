import AOS from 'aos';
import Swiper from 'swiper';
import { Navigation, Pagination, Autoplay } from 'swiper/modules';
import "@fontsource/poppins/300.css";
import "@fontsource/poppins/400.css";
import "@fontsource/poppins/500.css";
import "@fontsource/poppins/600.css";
import "@fontsource/poppins/700.css";
import Alpine from 'alpinejs';
import Chart from 'chart.js/auto';
import Swal from "sweetalert2";

window.Swal = Swal;

window.Chart = Chart;

window.Alpine = Alpine;

window.Swiper = Swiper;

window.Navigation = Navigation;

window.Pagination = Pagination;

window.Autoplay = Autoplay;

AOS.init({

    duration: 800,

    once: true

});

/* ==========================
Gallery
========================== */

new Swiper(".gallerySwiper", {

    modules: [Pagination, Autoplay],

    loop: true,

    autoplay: {

        delay: 3000,

    },

    pagination: {

        el: ".swiper-pagination",

        clickable: true,

    },

    breakpoints: {

        640: {

            slidesPerView: 1,

        },

        768: {

            slidesPerView: 2,

            spaceBetween: 20,

        },

        1024: {

            slidesPerView: 3,

            spaceBetween: 30,

        },

    },

});

Alpine.start();

import "./dashboard";