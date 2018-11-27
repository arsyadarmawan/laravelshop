@extends('layouts.global')
@section('title')
    Book Lists    
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
                <div class="row mb-3">
                        <div class="col-md-12 text-right">
                        <a
                        href="{{route('books.create')}}"
                        class="btn btn-primary"
                        >Create book</a>
                        </div>
                       </div>

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
                            <td class="text-center">[TODOS ACTION]</td>
                        </tr>                        
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection