@extends("layouts.global")

@section("title") Category list @endsection
@section("content")

@if(session('status'))
    <div class="alert alert-success">
        {{session('status')}}
    </div>
@endif

<h2>Category list</h2>


<div class="row">
    <div class="col-md-6">
        <form action="{{route('categories.index')}}">
            <div class="input-group">
                <input 
                    type="text"
                    class="form-control"
                    placeholder="mencari nama kateori"
                    name="name"
                >
                <div class="input-group-append">
                <input 
                    type="submit"
                    value="filter"
                    class="btn btn-primary"
                    >
                </div>

            </div>
        </form>
    </div>
</div>

<hr class="my-3">


<div class="row">
    <div class="col-md-12">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col" class="text-center">Name</th>
                    <th scope="col" class="text-center">Slug</th>
                    <th scope="col" class="text-center">Image</th>
                    <th scope="col" class="text-center">Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($categories as $category)
                <tr>
                        
                    <td class="text-center"><a href="{{route('categories.show',['id'=> $category->id])}}"><b>{{$category->name}}</b></a></td>
                    <td class="text-center" >{{$category->slug}}</td>  
                    <td class="text-center">
                        @if ($category->image)
                            <img 
                                src="{{asset('storage/'.$category->image)}}" 
                                width="48px">
                        @else
                            No Image
                        @endif
                        
                    </td>
                    <td class="text-center">
                        <a href="{{route('categories.edit',['id' => $category->id])}}" class="btn btn-info btn-sm" >Edit</a>
                        <form 
                            action="{{route('categories.destroy',['id' => $category->id])}}"
                            method="POST"
                            onsubmit="return confirm('Move category to trash?')"
                            
                            >
                        
                            @csrf
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
                    @endforeach
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colSpan="5">
                        {{$categories->appends(Request::all())->links()}}
                    </td>
                </tr>
            </tfoot>

        </table>
    </div>
</div>


@endsection