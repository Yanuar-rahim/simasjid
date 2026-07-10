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

document.addEventListener("DOMContentLoaded", () => {

    const nominalInput = document.getElementById("nominal");

    const buttons = document.querySelectorAll(".nominal-btn");

    buttons.forEach(button => {

        button.addEventListener("click", () => {

            // isi nominal
            nominalInput.value = button.dataset.value;

            // hapus style aktif
            buttons.forEach(btn => {
                btn.classList.remove(
                    "bg-emerald-600",
                    "text-white",
                    "border-emerald-600"
                );
            });

            // aktifkan tombol yang dipilih
            button.classList.add(
                "bg-emerald-600",
                "text-white",
                "border-emerald-600"
            );

        });

    });

});

document.addEventListener("DOMContentLoaded", () => {

    const nominal = document.getElementById("nominal");
    const jenis = document.getElementById("jenisDonasi");
    const previewNominal = document.getElementById("previewNominal");
    const previewJenis = document.getElementById("previewJenis");
    const previewTotal = document.getElementById("previewTotal");
    const buttons = document.querySelectorAll(".nominal-btn");

    function rupiah(angka) {
        return "Rp" + Number(angka).toLocaleString("id-ID");
    }

    function updatePreview() {
        let nilai = nominal.value || 0;
        previewNominal.innerHTML = rupiah(nilai);
        previewTotal.innerHTML = rupiah(nilai);
        previewJenis.innerHTML = jenis.value;
    }

    buttons.forEach(button => {
        button.addEventListener("click", () => {

            nominal.value = button.dataset.value;
            buttons.forEach(btn => {
                btn.classList.remove(
                    "bg-emerald-600",
                    "text-white",
                    "border-emerald-600"
                );
            });

            button.classList.add(
                "bg-emerald-600",
                "text-white",
                "border-emerald-600"
            );
            updatePreview();
        });
    });

    nominal.addEventListener("input", updatePreview);
    jenis.addEventListener("change", updatePreview);
    updatePreview();
});