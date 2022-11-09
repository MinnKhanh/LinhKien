@extends('layouts.masteradmin')
@section('content')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/highcharts-3d.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css">

    @push('css')
        <style>
            #container {
                height: 400px;
            }

            .highcharts-figure,
            .highcharts-data-table table {
                min-width: 310px;
                max-width: 800px;
                margin: 1em auto;
            }

            #sliders td input[type="range"] {
                display: inline;
            }

            #sliders td {
                padding-right: 1em;
                white-space: nowrap;
            }
        </style>
    @endpush
    <div>
        <div class="d-flex">
            <select name="typechart" class="ml-2" id="typechart">
                <option value=1>Theo sản phẩm</option>
                <option value=2>Theo loại</option>
                <option value=3>Theo khách hàng</option>
            </select>
            <select name="typetime" class="ml-2" id="typetime">
                <option value=1>Theo tháng</option>
                <option value=2>Theo năm</option>
            </select>
            <div class='input-group date col-2 ml-2' id='datetimepicker'>
                <input type='text' id="year" class="form-control" />
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
            <select class="ml-2" name="" id="mounth">
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
                <option>6</option>
                <option>7</option>
                <option>8</option>
                <option>9</option>
                <option>10</option>
                <option>11</option>
                <option>12</option>
            </select>
            <select name="typedata" class="ml-2" id="typedata">
                <option value=1>Số lượng</option>
                <option value=2>Doanh số</option>
            </select>
            <button type="button" class="ml-5 btn btn-info" id="show">Show</button>
        </div>

        <figure class="highcharts-figure">
            <div id="container"></div>
            <p class="highcharts-description mt-4 text-center w-100">
                Biểu đồ thống kê tình hình kinh doanh của của hàng.
            </p>
            <div id="sliders">
                {{-- <table>
                    <tbody>
                        <tr>
                            <td><label for="alpha">Alpha Angle</label></td>
                            <td><input id="alpha" type="range" min="0" max="45" value="15"> <span
                                    id="alpha-value" class="value"></span></td>
                        </tr>
                        <tr>
                            <td><label for="beta">Beta Angle</label></td>
                            <td><input id="beta" type="range" min="-45" max="45" value="15"> <span
                                    id="beta-value" class="value"></span></td>
                        </tr>
                        <tr>
                            <td><label for="depth">Depth</label></td>
                            <td><input id="depth" type="range" min="20" max="100" value="50"> <span
                                    id="depth-value" class="value"></span></td>
                        </tr>
                    </tbody>
                </table> --}}
            </div>
        </figure>
        @push('js')
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js">
            </script>

            <script type="text/javascript">
                // $('.yearpicker').yearpicker();
                const d = new Date();
                let month = d.getMonth();
                $('#mounth').val(month)
                $('#year').val(new Date().getFullYear())
                showChart();
                $(function() {
                    $('#datetimepicker').datetimepicker({
                        viewMode: 'years',
                        format: 'YYYY'
                    });
                });
                $('#typetime').change(function() {
                    if ($(this).val() == 2) {
                        $('#mounth').attr('disabled', true)
                    } else {
                        $('#mounth').attr('disabled', false)
                    }
                })
                $('#show').click(function() {
                    showChart()
                })

                function showChart() {
                    let typechart = $('#typechart').val()
                    let year = parseInt($('#year').val())
                    let typetime = $('#typetime').val()
                    let mounth = $('#mounth').val()
                    $.ajax({
                        url: "{{ route('api.datachart') }}",
                        type: 'GET',
                        data: {
                            typechart: typechart,
                            year: year,
                            typetime: typetime,
                            mounth: mounth
                        },
                        success: function(response) {
                            console.log('get data chart', response)
                            let data = [];
                            let name = [];
                            let typedata = parseInt($('#typedata').val())
                            response.forEach(myFunction);

                            function myFunction(item, index) {
                                if (typedata == 1) {
                                    data.push(parseInt(item.count))
                                } else {
                                    data.push(parseInt(item.proceed))
                                }
                                name.push(item.name)
                            }
                            console.log(data, name)
                            const chart = new Highcharts.Chart({
                                chart: {
                                    renderTo: 'container',
                                    type: 'column',
                                    options3d: {
                                        enabled: true,
                                        alpha: 15,
                                        beta: 15,
                                        depth: 50,
                                        viewDistance: 25
                                    }
                                },
                                xAxis: {
                                    categories: name
                                },
                                yAxis: {
                                    title: {
                                        enabled: false
                                    }
                                },
                                tooltip: {
                                    headerFormat: '<b>{point.key}</b><br>',
                                    pointFormat: (typedata == 1 ? 'Số lượng' : 'Giá tiền') +
                                        ': {point.y} ' + (typedata == 1 ?
                                            'sản phẩm' : 'Đ')
                                },
                                title: {
                                    text: 'Thông kê doanh số của của hàng theo' + (typechart == 1 ?
                                        ' sản phẩm' : (typechart == 1 ? ' loại' : ' khách hàng')) + (
                                        typetime == 1 ? ` tháng ${mounth} năm ${year}` : ` năm ${year}`)
                                },
                                subtitle: {
                                    text: 'Source: ' +
                                        '<a href="https://ofv.no/registreringsstatistikk"' +
                                        'target="_blank">OFV</a>'
                                },
                                legend: {
                                    enabled: false
                                },
                                plotOptions: {
                                    column: {
                                        depth: 25
                                    }
                                },
                                series: [{
                                    data: data,
                                    colorByPoint: true
                                }]
                            });

                            function showValues() {
                                document.getElementById('alpha-value').innerHTML = chart.options.chart.options3d
                                    .alpha;
                                document.getElementById('beta-value').innerHTML = chart.options.chart.options3d
                                    .beta;
                                document.getElementById('depth-value').innerHTML = chart.options.chart.options3d
                                    .depth;
                            }

                            // Activate the sliders
                            document.querySelectorAll('#sliders input').forEach(input => input.addEventListener(
                                'input', e => {
                                    chart.options.chart.options3d[e.target.id] = parseFloat(e.target
                                        .value);
                                    showValues();
                                    chart.redraw(false);
                                }));

                            showValues();
                        },
                        error: function(response) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Thất bại',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        }
                    });
                }
            </script>
        @endpush
    </div>
@endsection
