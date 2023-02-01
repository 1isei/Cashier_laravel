@extends('layouts.app')

@section('content')
<div class="container">
    <a type="submit" class="btn btn-sm btn-primary text-light" style="float: left !important;">Go back</a>
    <div class="row justify-content-center">

        {{-- Container --}}
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
                        <tr>
                            <td>1</td>
                            <td>01-01-01</td>
                            <td>John Doe</td>
                            <td>6000</td>
                            <td>12000</td>
                            <td><a type="submit" class="btn btn-sm btn-primary text-light">Detail</a></td>
                        </tr>
                        {{-- End of actual rows --}}

                    </table>
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
