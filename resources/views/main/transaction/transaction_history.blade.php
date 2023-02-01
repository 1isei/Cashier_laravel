@extends('layouts.app')

@section('content')
<div class="container">
    <a type="submit" class="btn btn-sm btn-primary text-light" style="float: left !important;">Go back</a>
    <div class="row justify-content-center">

        {{-- Card box --}}
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Transactions History</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table class="table table-responsive table-striped">
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>Cashier</th>
                            <th>Grand total</th>
                            <th>Amount paid</th>
                            <th>Action</th>
                        </tr>

                        {{-- Actual rows --}}
                        @foreach($histories as $history)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ date('Y F d', strToTime($history->created_at)) }}</td>
                                <td>{{ $history->user->name }}</td>
                                <td>Rp{{ number_format($history->grand_total, 0, ',', '.') }}</td>
                                <td>Rp{{ number_format($history->amount_paid, 0, ',', '.') }}</td>
                                <td><a href="transaction/{{ $history->id }}" type="submit" class="btn btn-sm btn-primary text-light">Detail</a></td>
                            </tr>
                        @endforeach
                        {{-- End of actual rows --}}

                    </table>
                </div>
            </div>
        </div>
        {{-- End of card box --}}

    </div>
</div>

{{-- Javascript bullshitery --}}
<script>
    function changeDeleteToUpdate(){
        document.getElementById("update").style.display="inline";
        document.getElementById("delete").style.display="none";
    }
</script>
{{-- End of Javascript bullshitery --}}
@endsection
