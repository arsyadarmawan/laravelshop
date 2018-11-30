@extends('layouts.global')
@section('title')
    Trashed book
@endsection

@section('content')
@if(session('status'))
    <div class="alert alert-success">
        {{session('status')}}
    </div>
@endif

<h2>Trashed book</h2>
<div class="row">
    <div class="col-md-6">
        <form action="{{route('books.index')}}">
                <div class="input-group">
                    <input 
                        type="text"
                        class="form-control"
                        placeholder="Filtered by title . . . . ."
                        value="{{Request::get('keyword')}}"
                        name="keyword"
                    >
                    <div class="input-group-append">
                        <input 
                            type="submit"
                            value="Filter"
                            class="btn btn-primary"
                            >
                    </div>
                </div>
            </form>

    </div>
    <div class="col-md-6">
        <ul class="nav nav-pills card-header-pills">
            <li class="nav-item">
                <a class="nav-link" href="{{route('books.index')}}">All</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('books.index', ['status' => 'publish'])}}">
                    Publish
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('books.index', ['status' =>'draft'])}}">
                    Draft
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('books.trash')}}">Trash</a>
            </li>
        </ul>
    </div>
</div>
<hr class="my-3">
       

<table class="table table-bordered table-stripped">
    <thead>
        <tr>
            <th class="text-center"><b>Cover</b></th>
            <th class="text-center"><b>Title</b></th>
            <th class="text-center"><b>Author</b></th>
            <th class="text-center"><b>Categories</b></th>
            <th class="text-center"><b>Stock</b></th>
            <th class="text-center"><b>Price</b></th>
            <th class="text-center"><b>Action</b></th>
        </tr>
    </thead>
    <tbody>
            @foreach($books as $book)
            <tr>
                <td>
                    @if($book->cover)
                        <img src="{{asset('storage/' . $book->cover)}}" width="96px"/>
                    @endif
                </td>
                <td>{{$book->title}}</td>
                <td>{{$book->author}}</td>
                <td>
                <ul class="pl-3">
                    @foreach($book->categories as $category)
                        <li>{{$category->name}}</li>
                    @endforeach
                </ul>
            </td>
            <td>{{$book->stock}}</td>
            <td>{{$book->price}}</td>
            <td class="text-center">
                <a href="{{route('books.restore', ['id' => $book->id])}}" class="btn btn-success">
                    Restore
                </a>
                    <form
                        class="d-inline"
                        action="{{route('books.deletepermanent', ['id' => $book->id])}}"
                        method="POST"
                        onsubmit="return confirm('Delete this book permanently?')"
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
            <td colspan="10">
                {{$books->appends(Request::all())->links()}}
            </td>
        </tr>
    </tbody>
</table>

@endsection