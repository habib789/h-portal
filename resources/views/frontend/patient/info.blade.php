@extends('masterpage.account')
@section('title') Account information @stop
@section('page')<h5 class="text-info font-weight-bold">Account Information</h5>@stop
@section('bcumb') Account information @stop
@section('content')
    @if(session()->has('message'))
        <div class="alert alert-{{ session('type') }}">
            {{ session('message') }}
        </div>
    @endif
    <div class="row">
        <div class="col-md-8">
            <div class="card p-2">
                <table class="table table-sm table-hover">
                    <tr>
                        <td class="font-weight-bold">Name</td>
                        <td>{{ $patient->first_name.' '.$patient->last_name}}</td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold">Phone</td>
                        <td>{{ $patient->phone }}</td>
                    </tr>
                    @if($patient->address !== null)
                        <tr>
                            <td class="font-weight-bold">Address</td>
                            <td>{{ $patient->address }}</td>
                        </tr>
                    @endif
                    <tr>
                        <td class="font-weight-bold">Blood Group</td>
                        <td>{{ $patient->blood_group }}</td>
                    </tr>

                    <tr>
                        <td class="font-weight-bold">Gender</td>
                        <td class="text-capitalize">{{ $patient->gender }}</td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold">Age</td>
                        <td class="text-capitalize">{{ date('Y',strtotime(today())) - date('Y',strtotime($patient->date_of_birth)) }}</td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold">Date of Birth</td>
                        <td>{{ date('M,d Y', strtotime($patient->date_of_birth)) }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <a href="{{ route('UserInfo.update', auth()->user()->patient->id) }}"
                               class="button btn btn-info btn-sm btn-block">Update Info</a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

{{--        <div class="col-md-4">--}}
{{--            <div class="card">--}}
{{--                <div class="card-body">--}}
{{--                    <h6 class="card-title">Change Password</h6>--}}
{{--                    <button class="button btn btn-info">Change Password</button>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>
@stop
