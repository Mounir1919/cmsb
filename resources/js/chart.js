
    import { initializeDoughnutChart } from './chart.js';

    document.addEventListener('DOMContentLoaded', function() {
        // Chart data and options
        var data = {
            labels: ['Label 1', 'Label 2', 'Label 3'],
            datasets: [{
                data: [10, 20, 30],
                backgroundColor: ['#ff6384', '#36a2eb', '#ffce56']
            }]
        };
        var options = {};

        // Initialize the doughnut chart
        initializeDoughnutChart('chart', data, options);
    });
