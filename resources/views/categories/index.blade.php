@extends("layouts.global")

@section("title") Category list @endsection
@section("content")

<div class="row">
    <div class="col-md-12">
            <table class="table table-hover">
                <thead>
                    <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Slug</th>
                    <th scope="col">Image</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>

                <tbody>
                        @foreach ($category as $category)
                    <tr>
                        
                            <td>{{$category->name}}</td>
                            <td>{{$category->slug}}</td>  
                            <td>
                                @if ($category->image)
                                    <img src="{{asset('storage/'.$category->image)}}" width="48px">
                                @else
                                    N/A
                                @endif
                                
                            </td>
                            <td>
                                [TODO: actions]
                            </td>
                        @endforeach
                    </tr>
                </tbody>
                {{-- <tfoot>
                    <tr>
                        <td colspan=10>
                                {{$category->appends(Request::all())->links()}}
                        </td>
                    </tr>
                </tfoot> --}}
            </table>
    </div>
</div>


@endsection