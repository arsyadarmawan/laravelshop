@extends('layouts.global')
@section('Title')Edit Category @endsection

@section('content')

@if(session('status'))
    <div class="alert alert-success">
    {{session('status')}}
    </div>
@endif 


<div class="cold-md-8">
    <form 
        action="{{route('categories.update', ['id'=> $category->id])}}"
        enctype="multipart/form-data"
        method="POST"
        class="bg-white shadow-sm p-3"
    >
    @csrf

    <input 
        type="hidden"
        value="PUT"
        name="_method"    
    >

    <label>Category Name</label>
    <br>
    <input 
        type="text"
        class="form-control {{$errors->first('name') ? "is-invalid" : ""}}"
        value="{{old('name') ? old('name') : $category->name}}"
        name="name"
    >
    <div class="invalid-feedback">
        {{$errors->first('name')}}
    </div>
    <br><br>

    <label>Slug Name</label>
    <input 
        type="text"
        class="form-control {{$errors->first('slug') ? "is-invalid" : ""}}"
        value="{{old('slug') ? old('slug') : $category->slug}}"
        name="slug" 
    >
    <div class="invalid-feedback">
        {{$errors->first('slug')}}
    </div>
    <br><br>

    <label>Category Image</label>
    <br>
    @if ($category->image)
        <br>
        <img src="{{asset('storage/'.$category->image)}}" width="120px">
        <br><br>
    @endif
    <input type="file" name="image" class="form-control {{$errors->first('image') ? "is-invalid" : ""}}">
    <small class="text-muted">
        kosongkan jika tidak ingin mengubah gambar
    </small>
    <div class="invalid-feedback">
        {{$errors->first('image')}}
    </div>
    <br><br>
    
    <input type="submit" class="btn btn-primary" value="update">
    </form>
    
</div>
    
@endsection