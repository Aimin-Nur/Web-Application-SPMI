@include('layouts.header-admin')

<canvas id="chart-line" height="600" width="500"></canvas>

<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        var ctx2 = document.getElementById("chart-line").getContext("2d");

        var lembagaScores = <?php echo json_encode($radar)?>;

        var labels = lembagaScores.map(function (item) { return item.nama_lembaga; });
        var averageData = lembagaScores.map(function (item) { return item.average; });
        var poorData = lembagaScores.map(function (item) { return item.poor; });
        var goodData = lembagaScores.map(function (item) { return item.good; });
        var excellentData = lembagaScores.map(function (item) { return item.excellent; });

        const radarData = {
            labels: labels,
            datasets: [
                {
                    label: 'Poor',
                    data: poorData,
                    fill: true,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgb(255, 99, 132)',
                    pointBackgroundColor: 'rgb(255, 99, 132)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgb(255, 99, 132)'
                },
                {
                    label: 'Average',
                    data: averageData,
                    fill: true,
                    backgroundColor: 'rgba(255, 205, 86, 0.2)',
                    borderColor: 'rgb(255, 205, 86)',
                    pointBackgroundColor: 'rgb(255, 205, 86)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgb(255, 205, 86)'
                },
                {
                    label: 'Good',
                    data: goodData,
                    fill: true,
                    backgroundColor: 'rgba(0, 153, 204, 0.2)',
                    borderColor: 'rgb(0, 153, 204)',
                    pointBackgroundColor: 'rgb(0, 153, 204)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: 'rgb(0, 153, 204)',
                    pointHoverBorderColor: '#fff'
                },
                {
                    label: 'Excellent',
                    data: excellentData,
                    fill: true,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgb(75, 192, 192)',
                    pointBackgroundColor: 'rgb(75, 192, 192)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgb(75, 192, 192)'
                }
            ]
        };

        const config = {
            type: 'radar',
            data: radarData,
            options: {
                elements: {
                    line: {
                        borderWidth: 3
                    }
                },
                responsive: true,
                maintainAspectRatio: false,
                tooltips: {
                    callbacks: {
                        label: function(tooltipItem, data) {
                            var label = data.labels[tooltipItem.index];
                            var datasetLabel = data.datasets[tooltipItem.datasetIndex].label;
                            var value = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
                            var totalMajor = majorData[tooltipItem.index];
                            var totalMinor = minorData[tooltipItem.index];
                            var totalClose = closeData[tooltipItem.index];
                            return label + ': ' + datasetLabel + ' - ' + value + '\n' +
                                   'Major: ' + totalMajor + '\n' +
                                   'Minor: ' + totalMinor + '\n' +
                                   'Close: ' + totalClose;
                        }
                    }
                },
                scales: {
                    r: {
                        angleLines: {
                            display: true
                        },
                        grid: {
                            display: true
                        },
                        pointLabels: {
                            display: true,
                            padding: 10,
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 1.5,
                            },
                            callback: function(value) {
                                var maxLength = 0;
                                if (value.length > maxLength) {
                                    var line1 = value.substring(0, maxLength);
                                    var line2 = value.substring(maxLength);
                                    return line1 + '\n' + line2;
                                } else {
                                    return value;
                                }
                            }
                        },
                        ticks: {
                            display: false
                        }
                    }
                }
            },
        };

        new Chart(ctx2, config);
    });
</script>

@include('layouts.script-admin')
