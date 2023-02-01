@extends('layouts.app')

@section('content')
<div class="container">
    <a type="submit" class="btn btn-sm btn-primary text-light" href="{{'main.transactions.transaction"'}}} style="float: left !important;">Go back</a>
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
                    <table class="tablea">
                        <tr>
                            <th>Date of transaction</th>
                            <th>:&nbsp; &nbsp;</th>
                            <td>01-01-2023</td>
                        </tr>
                        <tr>
                            <th>Cashier</th>
                            <th>:&nbsp; &nbsp;</th>
                            <td>John Doe</td>
                        </tr>
                    </table>
                    <table class="table table-responsive table-striped">
                        <tr>
                            <th>#</th>
                            <th>Item</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                        </tr>

                        {{-- Actual rows --}}
                        <tr>
                            <td>1</td>
                            <td>Instant noodles</td>
                            <td>1</td>
                            <td>2500</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Iced tea</td>
                            <td>1</td>
                            <td>3500</td>
                        </tr>
                        {{-- End of actual rows --}}
                    </table>
                    
                    {{-- TODO: BEAUTIFY LATER --}}
                    {{-- Payment details rows --}}
                    <table class=>
                        <tr class="bg-white">
                            <th colspan="">Grand total</th>
                            <th>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;:&nbsp; &nbsp;</th>
                            <td colspan="2">6000</td>
                        </tr>
                        <tr class="bg-white">
                            <th colspan="">Amount paid</th>
                            <th>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;:&nbsp; &nbsp;</th>
                            <td>6000</td>
                        </tr>
                        <tr class="bg-white">
                            <th colspan="">Return</th>
                            <th>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;:&nbsp; &nbsp;</th>
                            <td>6000</td>
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
