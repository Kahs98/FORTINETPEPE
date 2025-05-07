// assets/js/dashboard.js
document.addEventListener('DOMContentLoaded', function () {
    const colors = {
        primary: '#2a5298',
        primaryLight: '#3a62b8',
        primaryLighter: '#4a72d8',
        primaryVeryLight: '#6a92f8',
        danger: '#e74c3c',
        warning: '#f39c12',
        info: '#3498db',
        success: '#2ecc71',
        grey: '#7f8c8d',
        background: '#1f2937',
        textColor: '#f3f4f6',
    };

    Chart.defaults.color = colors.textColor;
    Chart.defaults.font.family = "'Segoe UI', Tahoma, Geneva, Verdana, sans-serif";

    const createChart = (id, config) => {
        const el = document.getElementById(id);
        if (el) new Chart(el.getContext('2d'), config);
    };

    // — Detección de actividad (barra)
    createChart('detectionActivityChart', {
        type: 'bar',
        data: {
            labels: Array.from({ length: 24 }, (_, i) => `${i.toString().padStart(2, '0')}:00`),
            datasets: [
                {
                    label: 'Detecciones críticas',
                    data: [1,0,0,0,1,0,2,3,5,4,2,1,3,15,12,8,5,3,2,1,0,2,3,1],
                    backgroundColor: colors.danger,
                    borderColor: colors.danger,
                    borderWidth: 1
                },
                {
                    label: 'Detecciones altas',
                    data: [2,1,0,0,0,1,1,4,6,5,3,2,4,18,14,9,6,4,3,2,1,3,4,2],
                    backgroundColor: colors.primaryVeryLight,
                    borderColor: colors.primaryVeryLight,
                    borderWidth: 1
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,   // respeta el height de CSS
            plugins: {
                legend: { position: 'bottom', labels: { boxWidth: 12, padding: 15 } },
                tooltip: { mode: 'index', intersect: false }
            },
            scales: {
                y: { beginAtZero: true, grid: { color: 'rgba(255,255,255,0.1)' } },
                x: { grid: { color: 'rgba(255,255,255,0.05)' } }
            }
        }
    });

    // — Observaciones (línea)
    createChart('observationsTimelineChart', {
        type: 'line',
        data: {
            labels: ['04/14','04/16','04/18','04/20','04/22','04/24','04/26','04/28','04/30','05/02','05/04'],
            datasets: [
                {
                    label: 'HTTP C2',
                    data: [1,0,2,3,1,0,1,2,0,0,1],
                    borderColor: colors.primaryVeryLight,
                    backgroundColor: 'rgba(106,146,248,0.1)',
                    borderWidth: 2,
                    tension: 0.4,
                    fill: false
                },
                {
                    label: 'Malicious File',
                    data: [0,1,0,1,0,0,0,1,0,1,0],
                    borderColor: colors.danger,
                    backgroundColor: 'rgba(231,76,60,0.1)',
                    borderWidth: 2,
                    tension: 0.4,
                    fill: false
                },
                {
                    label: 'Remote Service',
                    data: [0,0,1,0,0,1,0,0,1,0,0],
                    borderColor: colors.warning,
                    backgroundColor: 'rgba(243,156,18,0.1)',
                    borderWidth: 2,
                    tension: 0.4,
                    fill: false
                },
                {
                    label: 'Data Exfil',
                    data: [0,0,0,0,1,0,0,0,0,1,0],
                    borderColor: colors.success,
                    backgroundColor: 'rgba(46,204,113,0.1)',
                    borderWidth: 2,
                    tension: 0.4,
                    fill: false
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: { mode: 'index', intersect: false }
            },
            scales: {
                y: { beginAtZero: true, max: 5, grid: { color: 'rgba(255,255,255,0.1)' } },
                x: { grid: { display: false } }
            }
        }
    });

    // — Detecciones Promedio (barra)
    createChart('averageDetectionsChart', {
        type: 'bar',
        data: {
            labels: ['Lun','Mar','Mié','Jue','Vie','Sáb','Dom'],
            datasets: [{
                label: 'Detecciones promedio',
                data: [15,12,18,22,17,8,6],
                backgroundColor: colors.primaryLight,
                borderRadius: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: { beginAtZero: true, grid: { color: 'rgba(255,255,255,0.1)' } },
                x: { grid: { display: false } }
            }
        }
    });

    // — Mitigaciones (doughnut)
    createChart('mitigationsChart', {
        type: 'doughnut',
        data: {
            labels: ['Mitigadas','Pendientes'],
            datasets: [{
                data: [80,31],
                backgroundColor: [colors.success, colors.grey],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'bottom' }
            }
        }
    });
});
