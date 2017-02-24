@extends('main')

    @section('stylesheets')

    @endsection

    @section('title', ' | Avatar')

    @section('content')
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h1>Avatar</h1>

                <br>

                <div>
                    <img src="/avatars/{{ $user->avatar }}" style="width: 150px; height: 150px; float:left; border-radius:50%; margin-right: 25px;" alt="" class="src">
                    <h1>{{ $user->name }}'s Profile</h1>
                    <br>
                </div>
                
                <form action="/profile" method="POST" enctype="multipart/form-data">
                    <label>Update Profile Image</label>
                    <input type="file" name="avatar">
                    <input type="hidden" name="_token" value="{{ csrf_token()}} ">
                    <input type="submit" class="pull-right btn btn-sm btn-primary">                    
                </form>
            </div>
        </div>
    @endsection

    @section('scripts')

    @endsection