@extends('layouts.master')
@section('content')
    <div class="main">
        <div class="main-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Data Grafik Siswa</h3>
                        </div>
                        <div class="panel-body">
                            <div id="bar-chart" class="ct-chart"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(function() {
            var options;
            var data = {
                labels: {!! json_encode($jml_siswa['category']) !!},
                series: [
                    {!! json_encode($jml_siswa['series']) !!},
                ]
            };
            // line chart
            options = {
                height: "300px",
                showPoint: true,
                axisX: {
                    showGrid: true,
                },
                lineSmooth: true,
            };
            new Chartist.Bar('#bar-chart', data, options);
        });
    </script>
@stop
