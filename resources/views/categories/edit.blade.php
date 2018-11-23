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
        class="form-control"
        value="{{$category->name}}"
        name="name"
    >
    <br><br>

    <label>Slug Name</label>
    <input 
        type="text"
        class="form-control"
        value="{{$category->slug}}"
        name="slug" 
    >
    <br><br>

    <label>Category Image</label>
    <br>
    @if ($category->image)
        <br>
        <img src="{{asset('storage/'.$category->image)}}" width="120px">
        <br><br>
    @endif
    <input type="file" name="image" class="form-control">
    <small class="text-muted">
        kosongkan jika tidak ingin mengubah gambar
    </small>
    <br><br>
    
    <input type="submit" class="btn btn-primary" value="update">
    </form>
    
</div>
    
@endsection