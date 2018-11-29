@extends('layouts.global')
@section('title')
    Edit book
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8">
            @if (session('status'))
                <div class="alert alert-success">
                    {{session('status')}}
                </div>
            @endif
            
            <form 
                action="{{route('books.update', ['id' => $book->id])}}"
                method="POST"
                enctype="multipart/form-data"
                class="shadow p-3 mb-5 bg-white rounded"
            >
            @csrf
                <input type="hidden" name="_method" value="PUT">
                
                <label for="title">Title</label><br>
                <input class="form-control" type="text" name="title"  value="{{$book->title}}" id="title" placeholder="Book title">
                <br>

                <label for="cover">Cover</label><br>
                <small class="text-muted">Current cover</small><br>

                @if ($book->cover)
                    <img src="{{asset('storage/' . $book->cover)}}" width="96px"/>
                @endif
                <br><br>
                <input type="file" class="form-control" name="cover"><br>

                <label for="slug">Slug</label><br>
                <input class="form-control" type="text" name="slug" id="slug" value="{{$book->slug}}">
                <br>
                
                <label for="description">Description</label><br>
                <textarea name="description" id="description" class="form-control" >
                    {{$book->description}}
                </textarea>
                <br>

                <label for="categories">Categories</label>
                <select multiple class="form-control" name="categories" id="categories">
                </select><br><br>

                <label for="author">author</label>
                <input type="text" class="form-control" value="{{$book->author}}" id="author" name="author">
                <br>

                <label for="stock">Stock</label>
                <input type="text" name="stock" id="stock" value="{{$book->stock}}" class="form-control">
                <br>

                <label for="publisher">Publisher</label>
                <input type="text" name="publisher" id="publisher" class="form-control" value="{{$book->publisher}}">
                <br>

                <label for="price">Price</label>
                <input type="text" name="price" id="price" class="form-control" value="{{$book->price}}">
                <br>

                <label for="status">Status</label>
                <select name="status" id="status" class="form-control">
                    <option 
                    {{$book->status == 'PUBLISH' ? 'selected' : ''}}
                    value="PUBLISH">
                    Publish    
                    </option>

                    <option 
                    {{$book->status == 'DRAFT' ? 'selected' : ''}}
                    value="DRAFT">
                    DRAFT    
                    </option>
                </select>
                <br>

                <button class="btn btn-primary" value="PUBLISH">Update</button>

            </form>
        </div>
    </div>
@endsection

@section('footer-scripts')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>
$('#categories').select2({
    ajax: {
        url: 'http://larashop.me/ajax/categories/search',
        processResults: function(data){
        return {
        results: data.map(function(item){return {id: item.id, text:item.name} })
        }
    }
 }
});

var categories = {!! $book->categories !!}
    categories.forEach(function(category){
    var option = new Option(category.name, category.id, true, true);
    $('#categories').append(option).trigger('change');
    });
</script>
@endsection