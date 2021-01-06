@extends('layouts/seller_layout')

@section('page1')
<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Add Farmer</h1>
                        </div>
                        <form class="user" method="post">
                            @csrf
                            <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="exampleLastName"
                                        placeholder="Name" name = "name">
                                        @error('name')
                                            <div class="alert-danger">{{$message}}</div>
                                            @enderror
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="exampleInputuserName"
                                    placeholder="User Name" name="userName">
                                    @error('userName')
                                            <div class="alert-danger">{{$message}}</div>
                                            @enderror
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control form-control-user" id="exampleInputEmail"
                                    placeholder="Email Address" name="email">
                                    @error('email')
                                            <div class="alert-danger">{{$message}}</div>
                                            @enderror
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="exampleInputDOB"
                                    placeholder="Date of Birth" name="DOB">
                                    @error('DOB')
                                            <div class="alert-danger">{{$message}}</div>
                                            @enderror
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="exampleInputphoneNo"
                                    placeholder="Phone Number" name="contact">
                                    @error('contact')
                                            <div class="alert-danger">{{$message}}</div>
                                            @enderror
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" class="form-control form-control-user"
                                        id="exampleInputPassword" placeholder="Password" name="password">
                                        @error('password')
                                            <div class="alert-danger">{{$message}}</div>
                                            @enderror
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control form-control-user"
                                        id="exampleRepeatPassword" placeholder="Repeat Password" name="repassword">
                                        @error('repassword')
                                            <div class="alert-danger">{{$message}}</div>
                                            @enderror
                                </div>
                            </div>
                            <hr>
                            <button class="btn btn-primary btn-user btn-block">Add Farmer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection