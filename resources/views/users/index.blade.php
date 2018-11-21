@extends("layouts.global")
@section("title") Users List @endsection <!--Ini dari yield global.blade.php jadi berganti -->
@section("content")

@if(session('status'))
    <div class="alert alert-success">
        {{session('status')}}
    </div>
@endif

<h2>User List</h2>

<form action="{{route('users.index')}}">
    <div class="row">
        <div class="col-md-4">
        {{-- value="{{Request::get('keyword')}}" == untuk mendapatkan nilai value --}}
        {{-- kemudian setting di users.index --}}
            <input
            value="{{Request::get('keyword')}}" 
            name="keyword"
            class="form-control col-md-10"
            type="text"
            placeholder="Masukan email untuk filter . . . . ."
            />
        </div>

        <div class="col-md-4 text-left">
            <input {{request::get('status') == 'ACTIVE' ? 'checked':  ''}}
                type="radio"
                name="status"
                class="form-control"
                id="active"
                value="ACTIVE"
            >    
            <label for="active">Active</label>

            <input {{request::get('status') == 'INACTIVE' ? 'checked':  ''}}
                value="INACTIVE"
                type="radio"
                name="status"
                id="inactive"
                class="form-control"
            >    
            <label for="inactive">Inactive</label>

            <input
                type="submit"
                value="Filter"
                class="btn btn-primary"
            >
        </div>
        
        {{-- Untuk membuat user --}}
        <div class="col-md-4 text-right">
                <a href="{{route('users.create')}}"
                class="btn btn-primary">Create user</a>
              
        </div>
        
    </div>

<br>
</form>

<table class="table table-bordered">
    <thead>
        <tr>
            <th class="text-center"><b>Name</b></th>
            <th class="text-center"><b>Username</b></th>
            <th class="text-center"><b>Email</b></th>
            <th class="text-center"><b>Avatar</b></th>
            <th class="text-center"><b>Action</b></th>
            <th class="text-center"><b>Status</b></th>
            <th class="text-center"><b>Delete</b></th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{$user->name}}</td> <!--Untuk mengakses database dan kolomnya -->
                <td>{{$user->username}}</td> <!--Untuk mengakses database dan kolomnya -->
                <td><b><a href="{{route('users.show', ['id' => $user->id])}}">{{$user->email}}</a></b></</td> <!--Untuk mengakses database dan kolomnya -->
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
                    @if ($user->status == "ACTIVE")
                        <span class="badge badge-success"> 
                            {{$user->status}}
                        </span>
                    @else
                        <span class="badge badge-danger">
                            {{$user->status}}
                        </span>
                    @endif        
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
    <tfoot class="text-right">
        <tr>
            <td colspan=10>
            {{$users->links()}}
            </td>
        </tr>
    </tfoot>
           
</table>

<br>



@endsection