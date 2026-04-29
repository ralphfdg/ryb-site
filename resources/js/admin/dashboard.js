import Chart from 'chart.js/auto';

document.addEventListener('DOMContentLoaded', function() {
    // 1. Retrieve the backend data passed securely from Blade
    const data = window.rybDashboardData;
    
    // Safety check in case the script loads on a page without the data object
    if (!data) return;

    // Set Global Defaults
    Chart.defaults.color = '#4a4a4a'; 
    Chart.defaults.font.family = 'Inter, sans-serif';

    // --- Sales Bar Chart ---
    const ctxSales = document.getElementById('salesChart').getContext('2d');
    const redGradient = ctxSales.createLinearGradient(0, 0, 0, 300);
    redGradient.addColorStop(0, '#c41d1d'); 
    redGradient.addColorStop(1, '#541212'); 

    new Chart(ctxSales, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                data: data.monthlySales,
                backgroundColor: redGradient,
                borderRadius: 4,
                borderWidth: 0,
                barPercentage: 0.7
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: { 
                    beginAtZero: true, 
                    grid: { color: '#1a1a1a', drawBorder: false },
                    ticks: { 
                        callback: function(value) { return '$' + (value / 1000) + 'k'; }, 
                        font: { size: 9 } 
                    }
                },
                x: { 
                    grid: { display: false, drawBorder: false },
                    ticks: { font: { size: 9 } }
                }
            },
            plugins: { legend: { display: false } }
        }
    });

    // --- Inventory Doughnut Chart ---
    const ctxInventory = document.getElementById('inventoryChart').getContext('2d');
    new Chart(ctxInventory, {
        type: 'doughnut',
        data: {
            labels: [`Available (${data.availableCars})`, `Sold (${data.soldCars})`],
            datasets: [{
                data: [data.availableCars, data.soldCars],
                backgroundColor: ['#2ecc71', '#e52a2a'], 
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '75%',
            plugins: { 
                legend: { 
                    position: 'bottom', 
                    labels: { color: '#666666', boxWidth: 6, boxHeight: 6, usePointStyle: true, font: { size: 9 } } 
                } 
            }
        }
    });
});