@extends("layouts.global")
@section("title") Users List @endsection <!--Ini dari yield global.blade.php jadi berganti -->
@section("content")

@if(session('status'))
    <div class="alert alert-success">
        {{session('status')}}
    </div>
@endif

<div class="row">
    <div class="col-md-6">
        <form action="{{route('users.index')}}">
            <div class="input-group mb-3">
                {{-- value="{{Request::get('keyword')}}" == untuk mendapatkan nilai value --}}
                <input
                    value="{{Request::get('keyword')}}" 
                    name="keyword"
                    class="form-control col-md-10"
                    type="text"
                    placeholder="Filter berdasarkan email"
                />
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
</div>

<div class="row">
    <div class="col-md-12 text-right">
        <a href="{{route('users.create')}}"
        class="btn btn-primary">Create user</a>
    </div>
</div>
<br>


<table class="table table-bordered">
    <thead>
        <tr>
            <th class="text-center"><b>Name</b></th>
            <th class="text-center"><b>Username</b></th>
            <th class="text-center"><b>Email</b></th>
            <th class="text-center"><b>Avatar</b></th>
            <th class="text-center"><b>Action</b></th>
            <th class="text-center"><b>Detail</b></th>
            <th class="text-center"><b>Delete</b></th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{$user->name}}</td> <!--Untuk mengakses database dan kolomnya -->
                <td>{{$user->username}}</td> <!--Untuk mengakses database dan kolomnya -->
                <td>{{$user->email}}</td> <!--Untuk mengakses database dan kolomnya -->
                <td class="text-center">
                    @if($user->avatar)
                        <img src="{{asset('storage/'.$user->avatar)}}"width="70px"/>
                    @else
                    N/A
                    @endif

                </td>
                <td class="text-center">
                    {{-- users.id  --}} {{--mengarah ke view --}}
                    <a class="btn btn-info text-white btn-sm" href="{{route('users.edit',['id'=>$user->id])}}">Edit</a>
                    
                </td>
                <td class="text-center">
                        <a href="{{route('users.show', ['id' => $user->id])}}" class="btn btn-primary btn-sm">Detail</a>
                </td>
                <td class="text-center">
                        <form
                            onsubmit="return confirm('Delete this user permanently?')"
                            class="d-inline"
                            action="{{route('users.destroy', ['id' => $user->id ])}}"
                            method="POST">
                        @csrf
                        <input
                            type="hidden"
                            name="_method"
                            value="DELETE">
                        <input
                            type="submit"
                            value="Delete"
                            class="btn btn-danger btn-sm">
                        </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection