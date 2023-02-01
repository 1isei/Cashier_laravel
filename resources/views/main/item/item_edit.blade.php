@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        {{-- Card box --}}
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">{{ __('Edit Item') }}</div>
                <div class="card-body">

                    {{-- Card contents --}}


                    {{-- Status --}}
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{-- End of status --}}
                    

                    {{-- Update request --}}
                    <form action="{{ route('item.update', $item->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- Inputs for edit --}}
                            <div class="form-group">
                                <label for="">Name</label>
                                <input class="form-control" type="text" name="name" id="" value="{{ $item->name }}">
                            </div>
                            <label for="">Category</label>
                            <select name="category_id" id="" class="form-control">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <div class="form-group">
                                <label for="">Stock</label>
                                <input class="form-control" type="number" name="stock" id="" value="{{ $item->stock }}">
                            </div>
                            <div class="form-group">
                                <label for="">Price</label>
                                <input class="form-control" type="number" name="price" id="" value="{{ $item->price }}">
                            </div>
                            <br>
                        {{-- End of inputs for edit --}}


                        {{-- Save and cancel button --}}
                        <input class="btn btn-sm btn-success" type="submit" name="save" value="Save">
                        <a href="/item" class="btn btn-sm btn-danger float-end">Cancel</a>
                        {{-- End of save and cancel button --}}

                    </form>
                    {{-- End of update request --}}

                </div>
                {{-- End of card contents --}}

            </div>
        </div>
        {{-- End of card box --}}
    
    </div>
</div>
@endsection
