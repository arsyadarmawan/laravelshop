@extends('layouts.global')

@section('title')
    Create Tasks    
@endsection

@section('content')
    <form action="{{ route('tasks.store') }}" method="post">
        {{ csrf_field() }}
        @csrf
        <label for="">Task name:</label>
        <br />
        <input type="text" name="name" class="form-control" />
        <br /><br />
        <label for="">Task description:</label>
        <br />
        <textarea name="description" class="form-control"></textarea>
        <br /><br />
        <label for="">Start time:</label>
        
        <br />
        <input type="text" name="task_date" class="date" />
        <br /><br />
        <input type="submit" value="Save" />
    </form>


@endsection

@section('footer-scripts')
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="https://code.jquery.com/ui/1.11.3/jquery-ui.min.js"></script>
    <script>
    $('.date').datepicker({
        autoclose: true,
        dateFormat: "yy-mm-dd"
    });
    </script>
@endsection
