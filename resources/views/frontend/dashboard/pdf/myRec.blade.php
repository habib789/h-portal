<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>@yield('title', 'Health Portal')</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body>
<section class="content card">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="invoice p-3 mb-3">
                    <div class="row">
                        <div class="col-12">
                            <h4>
                                <i class="fas fa-globe"></i> Health Portal
                                <small
                                    class="float-right">Date: {{ $report->created_at->format('d-m-Y h:i A') }}</small>
                            </h4>
                        </div>
                    </div>

                    <div class="row invoice-info card-header">
                        <div class="col-sm-12 text-right ml-auto">
                                <span
                                    class="font-weight-bold">Dr. {{ $report->doctor->first_name.' '.$report->doctor->last_name }}</span>
                            <address>
                                {{ $report->doctor->degrees }}<br>
                                Phone: {{ $report->doctor->phone }}<br>
                                Email: {{ $report->doctor->user->email }}<br>
                            </address>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div>
                                <strong>Patient Name</strong>
                                <p>{{ $report->patient_name }}</p>
                            </div>
                            <div>
                                <strong>Patient Age</strong>
                                <p>{{ date('Y',strtotime($report->appointment_date)) - date('Y',strtotime($report->patient->date_of_birth)) }}</p>
                            </div>
                            <div>
                                <strong>Patient Phone</strong>
                                <p>{{ $report->patient->phone }}</p>
                            </div>
                            <div>
                                <strong>Patient Email</strong>
                                <p>{{ $report->patient->user->email }}</p>
                            </div>
                            <div>
                                <strong>Patient health issue</strong>
                                <p>{{ $report->health_issue }}</p>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6">
                            @if($rep->test !== "")
                                <div class="card-body">
                                    <small><strong>Tests Name</strong></small><br>
                                    <div>
                                        {{ $rep->test }}
                                    </div>
                                </div>
                            @endif

                            @if($rep->medication !== "")
                                <div class="card-body">
                                    <small><strong>Medication</strong></small><br>
                                    <div>
                                        {{ $rep->medication }}
                                    </div>
                                </div>
                            @endif

                            @if($rep->notes !== "")
                                <div class="card-body">
                                    <small><strong>Notes</strong></small><br>
                                    <div>
                                        {{ $rep->notes }}
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</body>
</html>

