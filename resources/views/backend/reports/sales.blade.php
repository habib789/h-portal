@extends('masterpage.backend')
@section('title') Sales @stop
@section('header')  Sales @stop
@section('bcumb')  Sales @stop
@section('content')
    <div class="row">

        <div class="col-lg-12 col-md-12">
{{--            @php--}}
{{--                use Carbon\Carbon;--}}
{{--                --}}
{{--            @endphp--}}
            <div class="text-left">
                <form action="" method="post">
                    <select name="" class="form-control" id="">
                        <option value="">fbf</option>
                    </select>
                </form>
            </div>
            <div class="text-right">
                <button onclick="printContent()" class="btn btn-info btn-sm w-25">P R I N T</button>
            </div>
            <div class="card" id="print">
                <div class="card-header">
                    <h3 class="card-title">Sales Report</h3>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped table-sm">
                        <thead>
                        <tr class="text-info">
                            <th style="width: 10px">Order#</th>
                            <th>Order From</th>
                            <th>Date</th>
                            <th>Ship To</th>
                            <th>Payment Status</th>
                            <th>Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($sales as $sale)
                            <tr>
                                <td>{{ $sale->id }}</td>
                                <td>{{ $sale->user->patient->first_name }}</td>
                                <td>{{ $sale->created_at->format('d-m-Y') }}</td>
                                <td>{{ $sale->customer_name }}</td>
                                <td>{{ $sale->payment_status }}</td>
                                <td class="text-info font-weight-bold">
                                    BDT {{ number_format($sale->total_amount ,2)}} TK
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="text-info font-weight-bold text-center">
                                <h4>Total BDT {{ number_format($sales->sum('total_amount'),2) }} TK</h4>
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
