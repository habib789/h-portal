@extends('masterpage.account')
@section('title') Prescription @stop
@section('page') Prescription @stop
@section('bcumb') Prescription @stop

@section('content')
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



                        <div class="row no-print">
                            <div class="col-12">
                                <a href="" target="" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                                <a href="{{ route('electronic.prescription', $report->id) }}" class="button btn btn-primary float-right" style="margin-right: 5px;">
                                    <i class="fas fa-download"></i> Download Prescription
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@stop
