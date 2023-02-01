@extends('layouts.app')

@section('content')
<div class="container">
    <a href="/history" class="btn btn-sm btn-primary text-light" style="float: left !important;">Go back</a>
    <div class="row justify-content-center">

        {{-- Container --}}
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Transactions Detail</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{-- Infos --}}
                    <table>
                        <tr>
                            <th>Date of transaction</th>
                            <th>:&nbsp; &nbsp;</th>
                            <td>{{ date('Y F d', strToTime($itemDetail->created_at)) }}</td>
                        </tr>
                        <tr>
                            <th>Cashier</th>
                            <th>:&nbsp; &nbsp;</th>
                            <td>{{ $itemDetail->user->name }}</td>
                        </tr>
                    </table>
                    {{-- End of infos --}}

                    <table class="table table-responsive table-striped">
                        <tr>
                            <th>#</th>
                            <th>Item</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                        </tr>

                        {{-- Actual rows --}}
                            @foreach($itemDetail->detail as $item)
                                <tr>
                                    <th>{{ $loop->iteration }}</th>
                                    <th>{{ $item->item->name }}</th>
                                    <th>{{ $item->quantity }}</th>
                                    <th>Rp{{ number_format($item->quantity * $item->item->price, 0, ',', '.') }}</th>
                                </tr>
                            @endforeach
                        {{-- End of actual rows --}}
                    </table>
                    
                    {{-- TODO: BEAUTIFY LATER --}}
                    {{-- Payment details rows --}}
                    <table class=>
                        <tr class="bg-white">
                            <th colspan="">Grand total</th>
                            <th>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;:&nbsp; &nbsp;</th>
                            <td colspan="2">Rp{{ number_format($itemDetail->grand_total, 0, ',', '.') }}</td>
                        </tr>
                        <tr class="bg-white">
                            <th colspan="">Amount paid</th>
                            <th>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;:&nbsp; &nbsp;</th>
                            <td>Rp{{ number_format($itemDetail->amount_paid, 0, ',', '.') }}</td>
                        </tr>
                        <tr class="bg-white">
                            <th colspan="">Change</th>
                            <th>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;:&nbsp; &nbsp;</th>
                            <td>Rp{{ number_format($itemDetail->amount_paid - $itemDetail->grand_total, 0, ',', '.') }}</td>
                        </tr>
                    </table>
                    {{-- End of payment details row --}}

                </div>
            </div>
        </div>
        {{-- End of container --}}

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
