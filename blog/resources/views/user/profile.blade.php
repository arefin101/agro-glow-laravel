@extends('layouts/manager_layout')

@section('page1')

<div>

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-6">
                        <div class="p-5">
                            <div class="text-center">
                                <br><br>
                                <h1 class="h4 text-gray-900 mb-4">Hi {{$userInfo[0]['userName']}}</h1>
                            </div>
                            <form class="user">
                                <div class="form-group row">
                                    <div class="col-sm-12 mb-3 mb-sm-0 text-center">
                                        <h3>{{$userInfo[0]['name']}}</h3>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12 mb-3 mb-sm-0 text-center">
                                        <h3>{{$userInfo[0]['email']}}</h3>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12 mb-3 mb-sm-0 text-center">
                                        <h3>{{$userInfo[0]['DOB']}}</h3>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12 mb-3 mb-sm-0 text-center">
                                        <h3>{{$userInfo[0]['contact']}}</h3>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12 mb-3 mb-sm-0 text-center">
                                        <h3>{{$userInfo[0]['userType']}}</h3>
                                    </div>
                                </div><hr>
                                <a href="{{route('home')}}" class="btn btn-primary btn-user btn-block">
                                    Home
                                </a>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="p-5">
                            <div class="text-center">
                                <br>
                                <h1 class="h4 text-gray-900 mb-4">Do You Want To Update This Account?</h1>
                            </div>
                            <form class="user" method="post">
                                @csrf
                                <input type="hidden" class="form-control form-control-user" id="exampleUsername"
                                            placeholder="userName" name="userName" value="{{$userInfo[0]['userName']}}">
                                <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id="exampleFirstName"
                                            placeholder="Name" name ="name" value="{{$userInfo[0]['name']}}">
                                            @error('name')
                                            <div style="color:red; text-align:center">{{$message}}</div>
                                            @enderror
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" id="exampleInputEmail"
                                        placeholder="Email Address" name="email" value="{{$userInfo[0]['email']}}">
                                        @error('email')
                                        <div style="color:red; text-align:center">{{$message}}</div>
                                        @enderror
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="exampleInputDOB"
                                        placeholder="Date of Birth" name="DOB" value="{{ $userInfo[0]['DOB']}}">
                                        @error('DOB')
                                        <div style="color:red; text-align:center">{{$message}}</div>
                                        @enderror
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="exampleInputphoneNo"
                                        placeholder="Mobile Number" name="contact" value="{{$userInfo[0]['contact']}}">
                                        @error('contact')
                                        <div style="color:red; text-align:center">{{$message}}</div>
                                        @enderror
                                </div>
                                
                                <hr>
                                <!-- <a href="/login/register" class="btn btn-primary btn-user btn-block">
                                    Update Account
                                </a> -->
                                <button class="btn btn-primary btn-user btn-block">Update Account</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->

    @endsection
