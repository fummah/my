let months_arr3=[];
let values_arr3=[];
$(function() {
$.ajax({
    url:"/gettrends/topics/",
    type:"GET",
    async:false,
    data:{},
    success:function (data) {
console.log(data);
        for(key in data)
        {
            months_arr3.push(data[key]["months"]);
            values_arr3.push(data[key]["totals"]);
        }
    },
    error:function(jqXHR, exception)
    {
        console.log("Connection error");
    }
});
var ctx1 = document.getElementById("chart-line3").getContext("2d");

var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

gradientStroke1.addColorStop(1, 'rgba(251, 99, 64, 0.2)');
gradientStroke1.addColorStop(0.2, 'rgba(251, 99, 64, 0.0)');
gradientStroke1.addColorStop(0, 'rgba(251, 99, 64, 0)');
new Chart(ctx1, {
    type: "line",
    data: {
        labels: months_arr3,
        datasets: [{
            label: "Number of Votes",
            tension: 0.4,
            borderWidth: 0,
            pointRadius: 0,
            borderColor: "#fb6340",
            backgroundColor: gradientStroke1,
            borderWidth: 3,
            fill: true,
            data: values_arr3,
            maxBarThickness: 6

        }],
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false,
            }
        },
        interaction: {
            intersect: false,
            mode: 'index',
        },
        scales: {
            y: {
                grid: {
                    drawBorder: false,
                    display: true,
                    drawOnChartArea: true,
                    drawTicks: false,
                    borderDash: [5, 5]
                },
                ticks: {
                    display: true,
                    padding: 10,
                    color: '#fbfbfb',
                    font: {
                        size: 11,
                        family: "Open Sans",
                        style: 'normal',
                        lineHeight: 2
                    },
                }
            },
            x: {
                grid: {
                    drawBorder: false,
                    display: false,
                    drawOnChartArea: false,
                    drawTicks: false,
                    borderDash: [5, 5]
                },
                ticks: {
                    display: true,
                    color: '#ccc',
                    padding: 20,
                    font: {
                        size: 11,
                        family: "Open Sans",
                        style: 'normal',
                        lineHeight: 2
                    },
                }
            },
        },
    },
});
});