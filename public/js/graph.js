(function ($) {
    var charts = {
        init: function () {
            this.ajaxPostGraph();
        },

        ajaxPostGraph: function () {
            var urlPath =
                window.location.protocol +
                "//" +
                window.location.hostname +
                ":1881/post-graph";
            var request = $.ajax({
                method: "GET",
                url: urlPath,
            });

            request.done(function (response) {
                charts.createCompletedJobsChart(response);
            });
        },

        createCompletedJobsChart: function (response) {
            var ctx = document.getElementById("myChart");
            var myLineChart = new Chart(ctx, {
                type: "bar",
                data: {
                    labels: response.years, // The response got from the ajax request containing all month names in the database
                    datasets: [
                        {
                            label: "Jumlah Alumni",
                            lineTension: 0.3,
                            backgroundColor: "#003EA4",
                            data: response.count_per_year, // The response got from the ajax request containing data for the completed jobs in the corresponding months
                        },
                    ],
                },
                options: {
                    scales: {
                        xAxes: [
                            {
                                time: {
                                    unit: "date",
                                },
                                gridLines: {
                                    display: false,
                                },
                                ticks: {
                                    maxTicksLimit: 7,
                                },
                            },
                        ],
                        yAxes: [
                            {
                                ticks: {
                                    min: 0,
                                    max: response.max, // The response got from the ajax request containing max limit for y axis
                                    maxTicksLimit: 5,
                                },
                                gridLines: {
                                    color: "rgba(0, 0, 0, .125)",
                                },
                            },
                        ],
                    },
                    legend: {
                        display: true,
                        position: "top",
                    },
                },
            });
        },
    };

    charts.init();
})(jQuery);
