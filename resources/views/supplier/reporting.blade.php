<x-app-layout>
    <style>
        .content {
            margin-left: 250px;
            padding: 20px;
            width: calc(100% - 250px);
            padding-top: 60px; /* Ruang untuk navigasi di atas */
        }

    </style>
</head>
<body class="font-sans">
    <!-- Main layout with sidebar and content -->
    <div class="d-flex">

        <!-- Main Content -->
        <div class="content">
            <button onclick="history.back()" class="btn btn-secondary mb-3">Kembali</button>
            <!-- Input Date Range Picker -->
            <input type="text" name="dates" class="form-control w-50" />

            <select class="js-example-basic-single" name="state" multiple="multiple">
                @foreach($produk as $item)
                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                @endforeach
            </select>
            <div id="product_price_range">
                <canvas class="canvasChartProduct"></canvas>
            </div>
            <div id="output"></div>
        </div>
    </div>
    

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Date Range Picker Scripts -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    
    <!-- select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- chartjs -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <!-- pivot tables -->
    <script type="text/javascript" src="https://pivottable.js.org/dist/pivot.js"></script>

    <script>
        $(document).ready(function() {
            $('input[name="dates"]').daterangepicker({
                opens: 'left'
            }, function(start, end, label) {
                console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
            });

            $('.js-example-basic-single').select2();

            $.ajax({
                url: '/reporting/all-data-produk',
                success: function(response) {
                    console.log(response, "<<<<<<<")
                    $("#output").pivot(
                        response,
                        {
                            rows: ["created_range"],
                            cols: ["price_range"]
                        }
                    );
                }
            })

            var productPriceRange = {
            _defaults: {
                type: 'doughnut',
                tooltipFillColor: "rgba(51, 51, 51, 0.55)",
                data: {
                    labels: [
                        '< 50000',
                        '50000 - 99999',
                        '100000 - 999999',
                        '>= 1000000'
                    ],
                    datasets: [{
                        data: [],
                        backgroundColor: [
                            "#3498DB",
                            "#3498DB",
                            "#9B59B6",
                            "#E74C3C",
                        ],
                        hoverBackgroundColor: [
                            "#36CAAB",
                            "#49A9EA",
                            "#B370CF",
                            "#E95E4F",
                        ]
                    }]
                },
                options: {
                    legend: false,
                    responsive: false
                }
            },
            init: function ($el) {
                var self = this;
                $el = $($el);

                $.ajax({
                    url: '/reporting/chart-produk',
                    success: function (response) {

                        self._defaults.data.datasets[0].data = [
                            response.less_50000, 
                            response._50000_99999, 
                            response._100000_999999, 
                            response.more_1000000];
                        new Chart($el.find('.canvasChartProduct'), self._defaults);
                    }
                });
            }
        };

        productPriceRange.init($('#product_price_range'));
    });
    </script>
</x-app-layout>