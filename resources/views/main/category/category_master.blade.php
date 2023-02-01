@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        {{-- Card box --}}
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Categories') }}</div>
                <div class="card-body">

                    {{-- Card contents --}}


                    {{-- Status --}}
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{-- End of status --}}
                    
                    <table class="table table-responsive table-striped">
                        <tr>
                            <th>#</th>
                            <th>Category Name</th>
                            <th>Action</th>
                        </tr>
                        @foreach($categories as $category)  
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $category->name }}</td>
                                <td>
                                    <form action="{{ route('category.destroy', $category->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <a href="category/{{ $category->id }}/edit" class="btn btn-sm btn-warning text-light">Edit</a>
                                        <input type="submit" class="btn btn-sm btn-danger" value="Delete">
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    {{-- End of card contents --}}

                </div>
            </div>
        </div>
        {{-- End of card box --}}
        

        {{-- Card box --}}
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">{{ __('Add Category') }}</div>
                <div class="card-body">

                    {{-- Card contents --}}
                    <form action="{{ route('category.store') }}" method="POST">
                        @csrf
                        <input type="text" name="name" id="name" required>
                        <input class="btn btn-sm btn-success" type="submit" value="Save">
                        <a href="" class="btn btn-sm btn-danger" type="button">Cancel</a>
                    </form>
                    {{-- End of card contents --}}

                </div>
            </div>
        </div>
        {{-- End of card box --}}

    </div>
</div>
@endsection
