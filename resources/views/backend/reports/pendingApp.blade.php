@extends('masterpage.backend')
@section('title') Appointment reports @stop
@section('header')  Appointment reports @stop
@section('bcumb')  Appointment reports @stop
@section('content')
    <p>Reports from October 2019</p>
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="text-right">
                <button onclick="printContent()" class="btn btn-info btn-sm w-25">P R I N T</button>
            </div>
            <div class="card" id="print">
                <div class="card-header">
                    <h3 class="card-title">Appointment Report</h3>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped table-sm">
                        <thead>
                        <tr class="text-info">
                            <th style="width: 10px">Order#</th>
                            <th>Patient Name</th>
                            <th>Appointment Date</th>
                            <th>Appointment To</th>
                            <th>Appointment Status</th>
                            <th>Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($appReports as $app_report)
                            <tr>
                                <td>{{ $app_report->id }}</td>
                                <td>{{ $app_report->patient->first_name }}</td>
                                <td>{{ $app_report->appointment_date->format('d-m-Y') }}</td>
                                <td>Dr. {{ $app_report->doctor->first_name }} <br> <small>Dept: {{ $app_report->department->name }}</small></td>
                                <td>
                                    @if($app_report->appointment_status == 'prescribed')
                                        <span class="badge bg-info">Successful</span>
                                    @else
                                        <span class="badge bg-warning">Pending</span>
                                    @endif
                                </td>
                                <td class="text-info font-weight-bold">
                                    BDT {{ number_format($app_report->appointment_fee ,2)}} TK
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="text-info font-weight-bold text-center">
                                <h4>Total Refundable Money BDT {{ number_format($appReports->sum('appointment_fee'),2) }} TK</h4>
                            </td>
                            <td></td>
                            <td></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        function printContent() {
            var restore = document.body.innerHTML;
            var printContent = document.getElementById('print').innerHTML;
            document.body.innerHTML = printContent;
            window.print();
            document.body.innerHTML = restore;
        }
    </script>
@stop
