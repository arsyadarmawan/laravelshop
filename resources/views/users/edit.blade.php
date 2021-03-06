@extends('layouts.global')
@section('title') Edit User @endsection
@section('content')
    {{-- user yang akan diedit adalah {{$users->email}} --}}
    <div class="col-md-8">
        @if (session('status'))
            <div class="alert alert-sucess">
                {{session('status')}}
            </div>
        @endif

        {{-- Untuk mengubah data diperlukan form dengan action UsersController@update berada pada action--}}
        <form enctype="multipart/form-data" class="bg-white shadow-sm p-3" action="{{route('users.update', ['id'=>$users->id])}}" method="POST">
            @csrf

            <input 
                type="hidden" 
                value="PUT" 
                name="_method"
            >

            <label for="name">Name</label>
            <input 
                value="{{old('name') ? old('name') : $users->name}}"
                class="form-control {{$errors->first('name') ? "is-invalid" : ""}}" 
                placeholder="Full Name"
                type="text"
                name="name"
                id="name" 
            />
            <div class="invalid-feedback">
                {{$errors->first('name')}}
            </div>
            <br>

            <label for="name">Username</label>
            <input 
                value="{{$users->username}}"
                class="form-control {{$errors->first('username') ? "is-invalid" : ""}}" 
                placeholder="username"
                type="text"
                name="username"
                id="username" 
                disabled
            />
            <div class="invalid-feedback">
                {{$errors->first('username')}}
            </div>
            <br>

            <label for="">Status</label>
            <br>
            <input {{$users->status == "ACTIVE" ? "checked" : ""}}
                value="ACTIVE" 
                type="radio"
                class="form-control"
                id="active"
                name="status"
            />
            <label for="active">Active</label>

            <input {{$users->status == "INACTIVE" ? "checked" : ""}}
            value="INACTIVE" 
            type="radio"
            class="form-control"
            id="inactive"
            name="status"
            />
            <label for="inactive">Inactive</label>
            <br>


            <label for="">Roles</label>
            <br>
            <input
                class="{{$errors->first('roles') ? "is-invalid" : "" }}"
                type="checkbox"
                {{in_array("ADMIN", json_decode($users->roles)) ? "checked" : ""}}
                name = "roles[]"
                id="ADMIN"
                value="ADMIN"
            >
            <br>

            <label for="ADMIN">ADMINISTRATOR</label>

            <input
                class="{{$errors->first('roles') ? "is-invalid" : "" }}"
                type="checkbox"
                {{in_array('STAFF', json_decode($users->roles)) ? "checked" : ""}}
                name = "roles[]"
                id="STAFF"
                value="STAFF"
            >
            <br>

            <label for="STAFF">STAFF</label>

            <input
                class="{{$errors->first('roles') ? "is-invalid" : "" }}"
                type="checkbox"
                {{in_array('CUSTOMER', json_decode($users->roles)) ? "checked" : ""}}
                name = "roles[]"
                id="CUSTOMER"
                value="CUSTOMER"
            >
            <label for="CUSTOMERF">CUSTOMER</label>
            <div class="invalid-feedback">
                {{$errors->first('roles')}}
            </div>
            <br>

            <br>
            <label for="phone">Phone Number</label>
            <br>
            <input
                type="text"
                name="phone"
                class="form-controll {{$errors->first('phone') ? "is-invalid" : ""}}"
                value="{{old('phone') ? old('phone') : $users->phone}}"
            >
            <div class="invalid-feedback">
                {{$errors->first('phone')}}
            </div>
            <br>

            <label for="phone">Adress</label>
            <br>
            <textarea
                name="address"
                id="address"
                class="form-controll {{$errors->first('address') ? "is-invalid" : ""}}">
                {{old('address') ? old('address') : $users->address}}
            </textarea>

            <br><br>

            <label for="avatar">Avatar Image</label>
            <br>
            current avatar : <br>
            @if ($users->avatar)
                <img src="{{asset('storage/'.$users->avatar)}}" width="120px" />
                <br>
            @else
                No Avatar
            @endif
            <br>
            <input
                id="avatar"
                name="avatar"
                type="file"
                class="form-control"
            >

            <small class="text-muted">Kosongkan jika tidak ingin mengubah avatar</small>
            <hr class="my-3">

            <label for="email">Email</label>
            <input
                value="{{$users->email}}"
                disabled
                class="form-control {{$errors->first('email') ? "is-invalid" : ""}}"
                placeholder="user@mail.com"
                type="text"
                name="email"
                id="email"/>
            <div class="invalid-feedback">
                {{$errors->first('email')}}
            </div>
            <br>

            <input
                class="btn btn-primary"
                type="submit"
                value="Save"/>
        </form>
    </div>
@endsection