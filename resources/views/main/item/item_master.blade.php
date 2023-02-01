@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        {{-- Card box --}}
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Master Item') }}</div>

                {{-- Card contents --}}
                <div class="card-body">

                    {{-- Status --}}
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{-- End of status --}}

                    
                    {{-- Main table --}}
                    <table class="table table-responsive table-striped">
                        <tr>
                            <th>#</th>
                            <th>Category</th>
                            <th>Item</th>
                            <th>Stock</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                        
                        {{-- Table contents row loop--}}
                        @foreach($items as $item)  
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->category->name }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->stock }}</td>
                                <td>Rp{{ number_format($item->price, 0, ',', '.') }}</td>
                                <td>

                                    {{-- Update and delete buttons and requests --}}
                                    <form action="{{ route('item.destroy', $item->id) }}" method="POST">
                                    @csrf   
                                        @method('DELETE')
                                        <a href="/item/{{ $item->id }}/edit" class="btn btn-sm btn-warning text-light">Edit</a>
                                        <input type="submit" class="btn btn-danger btn-sm" value="Delete">
                                    </form>
                                    {{-- End of update and delete buttons and requests --}}
                                </td>
                            </tr>
                        @endforeach
                        {{-- End of table contents row loop --}}

                    </table>
                    {{-- End of main table --}}

                </div>
            </div>
        </div>
        {{-- End of card box --}}

        
        {{-- Card box --}}
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">{{ __('Add Item') }}</div>
                <div class="card-body">

                    {{-- Card contents --}}
                    <form action="{{ route('item.store') }}" method="POST">
                        @csrf

                        {{-- Inputs for edit --}}
                            <div class="form-group">
                                <label for="">Name</label>
                                <input class="form-control" type="text" name="name" id="" required>
                            </div>
                            <label for="">Category</label>
                            <select name="category_id" id="" class="form-control">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <div class="form-group">
                                <label for="">Stock</label>
                                <input class="form-control" type="number" name="stock" id="" required>
                            </div>
                            <div class="form-group">
                                <label for="">Price</label>
                                <input class="form-control" type="number" name="price" id="" required>
                            </div>
                            <br>
                        {{-- End of inputs for edit --}}


                        {{-- Save and cancel button --}}
                        <input class="btn btn-sm btn-success" type="submit" value="Save">
                        <a href="/item" class="btn btn-sm btn-danger float-end">Cancel</a>
                        {{-- End of save and cancel button --}}

                    </form>
                    {{-- End of card contents --}}

                </div>
            </div>
        </div>
        {{-- End of card box --}}

    </div>
</div>
@endsection
