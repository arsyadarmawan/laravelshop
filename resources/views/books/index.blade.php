@extends('layouts.global')
@section('title')
    Book Lists    
@endsection
@section('content')
@if(session('status'))
    <div class="alert alert-success">
        {{session('status')}}
    </div>
@endif
    <h2>Books list</h2><br>

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
                    <a class="nav-link {{Request::get('status') == NULL && Request::path() == 'books' ? 'active' : ''}}" href="{{route('books.index')}}">All</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{Request::get('status') == 'publish' ? 'active' : '' }}" href="{{route('books.index', ['status' => 'publish'])}}">Publish</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{Request::get('status') == 'draft' ? 'active' : '' }}" href="{{route('books.index', ['status' => 'draft'])}}">Draft</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{Request::path() == 'books/trash' ? 'active' : ''}}" href="{{route('books.trash')}}">Trash</a>
                </li>
                <li>
                    <a href="{{route('books.create')}}"
                        class="btn btn-primary"
                      >Create book
                    </a>
                </li>
            </ul>
        </div>
        

</div>
<hr class="my-3">

        
    <div class="row">
        <div class="col-md-12">
                {{-- <div class="row mb-3"></div> --}}
                <br>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="text-center" scope="col"><b>Cover</b></th>
                        <th class="text-center" scope="col"><b>Title</b></th>
                        <th class="text-center" scope="col"><b>Author</b></th>
                        <th class="text-center" scope="col"><b>Status</b></th>
                        <th class="text-center" scope="col"><b>Categories</b></th>
                        <th class="text-center" scope="col"><b>Stock</b></th>
                        <th class="text-center" scope="col"><b>Price</b></th>
                        <th class="text-center" scope="col"><b>Action</b></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($books as $book)
                        <tr>
                            <td class="text-center">
                                @if ($book->cover)
                                    <img src="{{asset('storage/' . $book->cover)}}"  width="96px"/>
                                @endif
                            
                            </td> 
                            
                            <td class="text-center">{{$book->title}}</td>
                            <td class="text-center">{{$book->author}}</td>
                            {{-- <td class="text-center">{{$book->status}}</td> --}}
                            <td class="text-center">
                                @if ($book->status == "DRAFT")
                                    <span class="badge bg-dark text-white">{{$book->status}} </span>
                                @else
                                    <span class="badge badge-success">{{$book->status}}</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <ul class="pl-3">
                                    @foreach ($book->categories as $category)
                                        <li>{{$category->name}}</li> 
                                    @endforeach
                                </ul>
                            </td>
                            <td class="text-center">{{$book->stock}}</td>
                            <td class="text-center">{{$book->price}}</td>
                            <td class="text-center">
                                    <form 
                                        action="{{route('books.destroy',['id' => $book->id])}}"
                                        method="POST"
                                        onsubmit="return confirm('Move book to trash?')"
                                        >
                                    
                                        @csrf
                                        <a href="{{route('books.edit',['id' => $book->id])}}" class="btn btn-info btn-sm" >Edit</a>
                                        <input
                                            type="hidden"
                                            value="DELETE"
                                            name="_method"
                                        >
            
                                        <input
                                            type="submit"
                                            class="btn btn-danger btn-sm"
                                            value="Trash"
                                        >
                                        
                                    </form> 
                                    
                            </td>
                        </tr>                        
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection