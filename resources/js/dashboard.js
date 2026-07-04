import Chart from "chart.js/auto";

document.addEventListener("DOMContentLoaded", () => {

    const chartCanvas = document.getElementById("donasiChart");

    if (!chartCanvas) return;

    new Chart(chartCanvas, {

        type: "line",

        data: {

            labels: [
                "Jan",
                "Feb",
                "Mar",
                "Apr",
                "Mei",
                "Jun",
                "Jul",
                "Agu",
                "Sep",
                "Okt",
                "Nov",
                "Des"
            ],

            datasets: [

                {

                    label: "Total Donasi",

                    data: [
                        12,
                        19,
                        15,
                        28,
                        34,
                        31,
                        40,
                        45,
                        52,
                        61,
                        58,
                        70
                    ],

                    borderColor: "#10B981",

                    backgroundColor: "rgba(16,185,129,.15)",

                    fill: true,

                    tension: .45,

                    pointRadius: 5,

                    pointHoverRadius: 7,

                    pointBackgroundColor: "#10B981",

                    pointBorderWidth: 0

                }

            ]

        },

        options: {

            responsive: true,

            maintainAspectRatio: false,

            plugins: {

                legend: {

                    display: false

                },

                tooltip: {

                    backgroundColor: "#ffffff",

                    titleColor: "#0f172a",

                    bodyColor: "#475569",

                    borderColor: "#E2E8F0",

                    borderWidth: 1,

                    padding: 12,

                    displayColors: false

                }

            },

            interaction: {

                intersect: false,

                mode: "index"

            },

            scales: {

                x: {

                    grid: {

                        display: false

                    }

                },

                y: {

                    beginAtZero: true,

                    grid: {

                        color: "#F1F5F9"

                    },

                    ticks: {

                        stepSize: 10

                    }

                }

            }

        }

    });

});