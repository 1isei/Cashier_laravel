@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        {{-- First card box --}}
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">Transactions</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table table-responsive table-striped">
                        <tr>
                            <th>No</th>
                            <th>Category</th>
                            <th>Item</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Quantity</th>
                            <th>Action</th>
                        </tr>

                        @foreach($items as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->category->name }}</td>
                                <td>{{ $item->name }}</td>
                                <td>Rp{{ number_format($item->price, 0, ',', '.') }}</td>
                                <td>{{ $item->stock }}</td>
                                <form action="{{route("transaction.store")}}" method="POST">
                                    @csrf
                                <td><input type="number"min=0  name="quantity" id=""></td>
                                <td><input type="hidden" name="item_id" value="{{$item->id}}"></td>
                                <td><a type="submit" value="{{ $loop->iteration}}" class="btn btn-sm btn-success text-light">Add to cart</a></td>
                            </tr>
                        @endforeach

                    </table>
                </div>
            </div>
        </div>
        {{-- End of first card box --}}

        {{-- Second card box --}}
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">Transactions</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table class="table table-responsive table-striped">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Item</th> 
                            <th>Category</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                            <th >Action</th>
                        </tr>
                        </thead>
                        @if($itemsInCart->isEmpty())
                        <tr>
                        <td class="text-center" colspan="5"> No item in carts</td>
                        </tr>
                        @else
                        @endif
                        {{-- Table contents row loop--}}
                        @foreach($itemsInCart as $cart)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $cart->name }}</td>
                                <td>{{ $cart->category->name }}</td>
                                <td><input type="number" class="form-control" min="1" max="{{ $cart->stock }}" value="{{ $cart->cart->qty }}" onchange="changeDeleteToUpdate{{ $loop->iteration }}()"></td>
                                <td>Rp{{ number_format($cart->price * $cart->cart->qty, 0, ',   ', '.') }}</td> <td>
                                    <a type="submit" id="update{{ $loop->iteration }}" class="btn btn-sm btn-primary text-light" style="Display: none;">Update</a>
                                    {{-- <form action="{{route("transaction.destroy", $cart->cart->id}}) --}}
                                    <a type="submit" id="delete{{ $loop->iteration }}" class="btn btn-sm btn-danger text-light" style="Width: 58.62px">Delete</a>
                                </td>
                            </tr>

                            {{-- Javascript     bullshitery --}}
                                <script>
                                    function changeDeleteToUpdate{{ $loop->iteration }}(){
                                        document.getElementById("update{{ $loop->iteration }}").style.display="inline";
                                        document.getElementById("delete{{ $loop->iteration }}").style.display="none";
                                    }
                                </script>

                            {{-- End of Javascript bullshitery --}}
                            
                        @endforeach
                        {{-- End of table contents row loop--}}

                        {{-- Payment details rows --}}
                        <form action="{{route('transaction.checkout')}}"method="post">
                            @csrf

                        <tr>
                            @foreach($itemsInCart as $item)
                            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                <td colspan="3">Grand total</td>
                        <td colspan=" 2"><input type="number" class="form-control" id="grandTotal" name="grandTotal" disabled value="{{ $itemsInCart    ->sum(function($item){
                                return $item->price * $item->cart->qty;
                                }) }}"></td>
                                
                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="3">Payment</td>
                            <td colspan="2"><input type="number"min="0" class="form-control" id="payment"></td>
                        </tr>
                        <tr>
                            <td colspan="3">Change</td>
                            <td colspan="2"><input class="form-control" id="change" disabled></td>
                        </tr>
                        {{-- End of payment details row --}}

                        {{-- Checkout and reset --}}
                        <tr>
                            <td class="text-end" colspan="4"><input class="btn btn-primary" type="submit"></td>
                            <td class="text-end" colspan=""><input class="btn btn-danger" type="reset"></td>
                        </tr>

                    </table>
                </div>
            </div>
        </div>
        {{-- End of second card box --}}

    </div>
</div>


@endsection
