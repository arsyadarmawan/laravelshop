@extends('name')

@section('title')Trashed Category  @endsection

@section('content')

<div class="row">
    <div class="col-md-6">
        <form action="{{route('categories.index')}}">
            <div class="input-group mb-3">
                <input 
                    type="text" 
                    class="form-control" 
                    placeholder="Filter by category name" 
                    aria-label="Recipient's username" 
                    aria-describedby="basic-addon2"
                    value="{{Request::get('name')}}"
                    name="name"
                    >
                <div class="input-group-append">
                    <input 
                        class="btn btn-outline-secondary" 
                        type="submit"
                        value="Filter">
                </div>
            </div>          
        </form>
    </div>

    <div class="col-md-6">
        <ul class="nav nav-pills card-header-pills">
            <li class="nav-item">
                <a href="{{route('categories.index')}}" class="nav-link">
                    Published
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('categories.trash')}}" class="nav-link active">
                    Published
                </a>
            </li>
        </ul>
    </div>
</div>

<hr class="my-3">

<div class="row">
    <div class="col-md-12">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Slug</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                <tr>
                    <th>{{$category->name}}</th>
                    <th>{{$category->slug}}</th>
                    <td>
                        @if ($category->image)
                            <img src="{{asset('storage/'.$category->image)}}" width="48px">
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colSpan="10">
                        {{$categories->appends(Request::all())->links()}}
                    </td>         
                </tr>
            </tfoot>
        </table>
    </div>
</div>
    
@endsection