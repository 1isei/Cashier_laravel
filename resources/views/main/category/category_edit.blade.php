@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        {{-- Card box --}}
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">{{ __('Change Category Name') }}</div> 
                <div class="card-body">

                    {{-- Card contents --}}


                    {{-- Status --}}
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{-- End of status --}}
                    
                    <form action="{{ route('category.update', $category->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="text" name="name" id="name" value="{{ $category->name }}" required>
                        <input class="btn btn-sm btn-success" type="submit" name="save" value="Save">
                        <a href="/category" class="btn btn-sm btn-danger" type="button" name="Cancel">Cancel</a>
                    </form>
                    {{-- End of card contents --}}

                </div>
            </div>
        </div>
        {{-- End of card box --}}

    </div>
</div>
@endsection
