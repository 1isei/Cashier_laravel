@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        {{-- First card box --}}
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">Transactions</div>
                <div class="card-body">

                    {{-- Card contents --}}
                    <table class="table table-responsive table-striped">
                        <tr>
                            <th>#</th>
                            <th>Category</th>
                            <th>Item</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Action</th>
                        </tr>
                        
                        {{-- Table contents --}}
                        @if($items->isEmpty())
                            <tr>
                                <td class="text-center" colspan="5">All items are already in cart.</td>
                            </tr>
                        @else

                            @foreach($items as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->category->name }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>Rp{{ number_format($item->price, 0, ',', '.') }}</td>
                                    <td>{{ $item->stock }}</td>
                                    <form action="{{ route('transaction.store') }}" method="POST">
                                        @csrf
                                        <td>
                                            <input type="hidden" name="item_id" id="" value="{{ $item->id }}">
                                            <input type="hidden" name="qty" id="" value="1">
                                            <input type="submit" class="btn btn-sm btn-success text-light" value="Add to cart">
                                        </td>
                                    </form>
                                </tr>
                            @endforeach

                        @endif
                        {{-- End of table contents --}}

                    </table>
                    {{-- End of card contents --}}

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

                    {{-- Card contents --}}
                    <table class="table table-responsive table-striped">
                        <tr>
                            <th>#</th>
                            <th>Item</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                            <th>Action</th>
                        </tr>

                        {{-- Items in cart --}}
                        @if($itemsInCart->isEmpty())
                            <tr>
                                <td class="text-center" colspan="5">No items in cart.</td>
                            </tr>
                        @else
                        
                            {{-- Table contents row loop--}}
                            @foreach($itemsInCart as $itemInCart)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $itemInCart->name }}</td>

                                    {{-- Update request overlaps update and delete buttons. I hate it. --}}
                                    
                                    
                                    {{-- Update request --}}
                                    <form action="{{ route('transaction.update', $itemInCart->cart->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <td><input type="number" class="form-control" name="qty" min="1" max="{{ $itemInCart->stock + $itemInCart->cart->qty }}" value="{{ $itemInCart->cart->qty }}" onchange="changeDeleteToUpdate{{ $loop->iteration }}()"></td>
                                        
                                        {{-- Not part of form, but here it will stay --}}
                                        <td>Rp{{ number_format($itemInCart->price * $itemInCart->cart->qty, 0, ',', '.') }}</td>
                                    
                                    {{-- Update and delete buttons --}}
                                    <td> 
                                        <input type="submit" id="update{{ $loop->iteration }}" class="btn btn-sm btn-primary text-light" style="Display: none;" value="Update">
                                    </form>
                                    {{-- End of update request --}}


                                        {{-- Delete request --}}
                                        <form action="{{ route('transaction.destroy', $itemInCart->cart->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <input type="submit" id="delete{{ $loop->iteration }}" class="btn btn-sm btn-danger text-light" style="Width: 58.62px" value="Delete">
                                        </form>
                                        {{-- end of delete request --}}

                                    </td>
                                    {{-- End of update and delete buttons --}}

                                </tr>

                                {{-- Javascript bullshitery --}}
                                    <script>
                                        function changeDeleteToUpdate{{ $loop->iteration }}(){
                                            document.getElementById("update{{ $loop->iteration }}").style.display="inline";
                                            document.getElementById("delete{{ $loop->iteration }}").style.display="none";
                                        }
                                    </script>
                                {{-- End of Javascript bullshitery --}}
                                
                            @endforeach
                            {{-- End of table contents row loop--}}

                        @endif

                        {{-- Payment details rows --}}
                        <form action="{{ route('transaction.checkout') }}" method="POST">
                            @csrf
                            <tr>
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                <td colspan="3">Grand total</td>

                                {{-- Grand total summation --}}
                                <td colspan="2">
                                        <input type="text" class="form-control" id="grand_total" name="grand_total"
                                        value="{{ 

                                                // Actual calculation
                                                $itemsInCart->sum(function($item){
                                                    return $item->price * $item->cart->qty;
                                                }
                                                // End of actual calculation

                                        ) }}" readonly>
                                    </td>
                                {{-- End of grand total summation --}}

                            </tr>
                            <tr>
                                <td colspan="3">Payment</td>

                                {{-- Payment min value set to Grand Total value --}}
                                <td colspan="2">
                                    <input  required type="number" class="form-control" id="amount_paid" name="amount_paid"
                                        min="{{ 

                                                // Actual calculation
                                                $itemsInCart->sum(function($item){
                                                    return $item->price * $item->cart->qty;
                                                }
                                                // End of actual calculation

                                        ) }}"

                                        value="{{

                                            // Actual calculation
                                            $itemsInCart->sum(function($item){
                                                return $item->price * $item->cart->qty;
                                            }
                                            // End of actual calculation

                                            ) }}">
                                    </td>
                                {{-- End of payment min value set to Grand Total value --}}
                                
                            </tr>
                            {{-- End of payment details row --}}


                            {{-- Checkout and reset --}}
                            <tr>
                                <td class="text-end" colspan="4"><input class="btn btn-primary" type="submit"></td>
                                <td class="text-end" colspan=""><input class="btn btn-danger" type="reset"></td>
                            </tr>
                            {{-- End of checkout and reset --}}

                        </form>
                    </table>
                    {{-- End of card contents --}}

                </div>
            </div>
        </div>
        {{-- End of second card box --}}

    </div>
</div>


@endsection
