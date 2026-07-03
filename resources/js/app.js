import AOS from 'aos';
import Swiper from 'swiper';
import { Navigation, Pagination, Autoplay } from 'swiper/modules';
import Chart from 'chart.js/auto';
import "@fontsource/poppins/300.css";
import "@fontsource/poppins/400.css";
import "@fontsource/poppins/500.css";
import "@fontsource/poppins/600.css";
import "@fontsource/poppins/700.css";

window.Chart = Chart;

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

/* ==========================
Chart
========================== */

const ctx = document.getElementById("financeChart");

if (ctx) {

    new Chart(ctx, {

        type: "bar",

        data: {

            labels: [

                "Jan",

                "Feb",

                "Mar",

                "Apr",

                "Mei",

                "Jun",

            ],

            datasets: [

                {

                    label: "Pemasukan",

                    data: [12, 19, 15, 25, 18, 30],

                    backgroundColor: "#047857",

                },

                {

                    label: "Pengeluaran",

                    data: [8, 10, 12, 14, 15, 18],

                    backgroundColor: "#F59E0B",

                },

            ],

        },

        options: {

            responsive: true,

            plugins: {

                legend: {

                    position: "top",

                },

            },

        },

    });

}