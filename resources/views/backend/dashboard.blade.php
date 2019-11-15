@extends('masterpage.backend')
@section('title') Dashboard @stop
@section('bcumb') Dashboard @stop
@section('css')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages': ['bar']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Date', 'Amount'],
                <?php
                $orders = \App\Models\Order::get();
                if (count($orders) > 0) {
                    foreach ($orders as $order) {
                        echo "['" . date('d-m-y',strtotime($order->created_at)) . "','" . $order->total_amount . "'],";
                    }
                }
                ?>
            ]);

            var options = {
                chart: {
                    title: '',
                    subtitle: 'Company statistical view: Daily Basis',
                }
            };

            var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

            chart.draw(data, google.charts.Bar.convertOptions(options));
        }
    </script>



    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = google.visualization.arrayToDataTable([
                ['Task', 'Hours per Day'],
                ['Work',     11],
                ['Eat',      2],
                // ['Commute',  2],
                // ['Watch TV', 2],
                // ['Sleep',    7]
                <?php
                $appointments = \App\Models\Appointment::with('department')
                 ->get();
                if (count($appointments) > 0) {
                    foreach ($appointments as $appointment) {
                        echo "['" . $appointment->department->name . "','" . $appointment->id . "'],";
                    }
                }
                ?>
            ]);

            var options = {
                title: 'Department-wise Appointment'
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

            chart.draw(data, options);
        }
    </script>
@stop




@section('content')
    <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">CPU Traffic</span>
                    <span class="info-box-number">
                  10
                  <small>%</small>
                </span>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Likes</span>
                    <span class="info-box-number">41,410</span>
                </div>
            </div>
        </div>

        <div class="clearfix hidden-md-up"></div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Sales</span>
                    <span class="info-box-number">BDT {{ $total_orders }} TK</span>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Total Members</span>
                    <span class="info-box-number">{{ $totals }}</span>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-stethoscope"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Total Appointments</span>
                    <span class="info-box-number">{{ $total_appointments }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-7">
            <div class="card-body">
                <div id="columnchart_material" style=" height: 300px;"></div>
            </div>
        </div>
        <div class="col-md-5 card-body">
            <div id="piechart"></div>
        </div>
    </div>

@stop


