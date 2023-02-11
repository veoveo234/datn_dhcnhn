$(function() {
    var Options = {
        series: {
            lines: {
                show: true,
                fill: true,
                fillColor: {
                    colors: [{
                        opacity: 0.8
                    }, {
                        opacity: 0.8
                    }]
                }
            }
        },
        xaxis: {
            tickDecimals: 0,
        },
        colors: ["#2ecc71"],
        grid: {
            color: "#999999",
            hoverable: true,
            clickable: true,
            tickColor: "#DADDE0",
            borderWidth:0
        },
        legend: {
            show: false
        },
        tooltip: true,
        tooltipOpts: {
            content: "x: %x, y: %y"
        }
    };
    var Data = {
        label: "bar",
        data: data.statisticalUser
    };
    $.plot($("#flot_area_chart"), [Data], Options);
});


$(function() {
    var barOptions = {
        series: {
            bars: {
                show: true,
                barWidth: 0.6,
                align   : 'center',
                fillColor: {
                    colors: [{
                        opacity: 0.6
                    }, {
                        opacity: 0.6
                    }]
                }
            }
        },
        xaxis: {
            tickDecimals: 0,
            mode: 'categories',
        },
        colors: ["#3498db"],
        grid: {
            color: "#999999",
            hoverable: true,
            clickable: true,
            tickColor: '#DADDE0',
            borderWidth:0
        },
        legend: {
            show: false
        },
        tooltip: true,
        tooltipOpts: {
            content: "x: %x, y: %y"
        }
    };
    var barData = {
        label: "bar",
        data: data.statisticalAffiliatePartner
    };
    $.plot($("#flot_bar_chart"), [barData], barOptions);

    Morris.Line({
        element: 'morris_line_chart',
        data: data.statisticalOrder,
        xkey: 'day',
        ykeys: ['price'],
        resize: true,
        lineWidth:4,
        labels: ['Value'],
        lineColors: ['#3498db'],
        pointSize:5,
    });
});


