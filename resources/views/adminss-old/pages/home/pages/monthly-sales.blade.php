<div class="card-header">
    <div class="card-title">Tổng doanh số bán hàng theo tháng</div>
    <div class="card-category">March 25 - April 02</div>
</div>
<div class="card-body pb-0">
    <div class="mb-4 mt-2">
        <h1>{{ number_format($presentMonth->total, 0, '', '.') }} VND</h1>
    </div>
    <div class="pull-in">
        <canvas id="dailySalesChart"></canvas>
    </div>
</div>

<script>
    var today = new Date();
    $('.card-category').html('Tháng '+(today.getMonth()+1));
    var dailySalesChart = document.getElementById('dailySalesChart').getContext('2d');

    var myDailySalesChart = new Chart(dailySalesChart, {
        type: 'line',
        data: {
            labels: {!! $arrMonth !!},
            datasets: [{
                label: "",
                fill: !0,
                backgroundColor: "rgba(255,255,255,0.2)",
                borderColor: "#fff",
                borderCapStyle: "butt",
                borderDash: [],
                borderDashOffset: 0,
                pointBorderColor: "#fff",
                pointBackgroundColor: "#fff",
                pointBorderWidth: 1,
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "#fff",
                pointHoverBorderColor: "#fff",
                pointHoverBorderWidth: 1,
                pointRadius: 1,
                pointHitRadius: 5,
                data: {!! $arrTotal !!}
            }]
        },
        options: {
            maintainAspectRatio: !1,
            legend: {
                display: !1
            },
            tooltips: {
                callbacks: {
                    label: function(tooltipItem, data) {
                        return Number(tooltipItem.yLabel).toFixed(0).replace(/./g, function(c, i, a) {
                            return i > 0 && c !== "." && (a.length - i) % 3 === 0 ? "," + c : c;
                        }) + " VND";
                    }
                }
            },
            animation: {
                easing: "easeInOutBack"
            },
            scales: {
                yAxes: [{
                    display: !1,
                    ticks: {
                        fontColor: "rgba(0,0,0,0.5)",
                        fontStyle: "bold",
                        beginAtZero: !0,
                        maxTicksLimit: 10,
                        padding: 0
                    },
                    gridLines: {
                        drawTicks: !1,
                        display: !1
                    }
                }],
                xAxes: [{
                    display: !1,
                    gridLines: {
                        zeroLineColor: "transparent"
                    },
                    ticks: {
                        padding: -20,
                        fontColor: "rgba(255,255,255,0.2)",
                        fontStyle: "bold"
                    }
                }]
            }
        }
    });

</script>