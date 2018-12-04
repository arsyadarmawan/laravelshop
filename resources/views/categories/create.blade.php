@extends("layouts.global")
@section('title') create category @endsection
@section('content')

    @if(session('status'))
        <div class="alert alert-success">
        {{session('status')}}
        </div>
    @endif
    
    <form
        enctype="multipart/form-data"
        class="bg-white shadow-sm p-3"
        action="{{route('categories.store')}}"
        method="POST">

        @csrf
        <label>Category Name </label> <br>
        <input 
            type="text"
            class="form-control {{$errors->first('name') ? "is-invalid" : ""}}"
            name="name"
            value="{{old('name')}}"
            required
            >
        <div class="invalid-feedback">
            {{$errors->first('name')}}
        </div>
        <br>

        <label>Category Image </label> <br>
        <input 
            type="file"
            class="form-control {{$errors->first('image') ? "is-invalid" : ""}}"
            name="image"
            >
        <br>

        @if ($errors->has('image'))
            <span class="invalid-feedback"role="alert">
                <strong>{{ $errors->first('image') }}</strong>
            </span>
        @endif
        
        <input 
            type="submit"
            class="btn btn-primary"
            value="save"
            required
            >
    </form>
@endsection