@extends('layouts.global')

@section('title')Trashed Category  @endsection

@section('content')

<div class="row">
    <div class="col-md-6">
        <form action="{{route('categories.index')}}">
            <div class="input-group">
                <input 
                    type="text" 
                    class="form-control" 
                    placeholder="Filter by category name" 
                    value="{{Request::get('name')}}"
                    name="name">

                <div class="input-group-append">
                    <input 
                        class="btn btn-primary" 
                        type="submit"
                        value="Filter">
                </div>
            </div>          
        </form>
    </div>

    <div class="col-md-6">
        <ul class="nav nav-pills card-header-pills">
            <li class="nav-item">
                <a href="{{route('categories.index')}}">
                    Published
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{route('categories.trash')}}" >
                    Trash
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
                    <th class="text-center">Nama</th>
                    <th class="text-center">Slug</th>
                    <th class="text-center">Image</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                <tr>
                    <th class="text-center">{{$category->name}}</th>
                    <th class="text-center">{{$category->slug}}</th>
                    <td class="text-center">
                        @if ($category->image)
                            <img src="{{asset('storage/'.$category->image)}}" width="48px">
                        @endif
                    </td>
                    <td class="text-center">
                        <a href="{{route('categories.restore', ['id' => $category->id])}}"
                            class="btn btn-success">Restore</a>
                            <form
                                    class="d-inline"
                                    action="{{route('categories.deletepermanent', ['id' => $category->id])}}"
                                    method="POST"
                                    onsubmit="return confirm('Delete this category permanently?')"
                                >
                                @csrf
                                <input
                                    type="hidden"
                                    name="_method"
                                    value="DELETE"
                                />

                                <input
                                    type="submit"
                                    class="btn btn-danger btn-sm"
                                    value="Delete"
                                />
                            </form>
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