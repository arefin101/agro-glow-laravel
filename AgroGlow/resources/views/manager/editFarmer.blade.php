@extends('layouts/manager_layout')


@section('page1')

<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Edit {{$farmer[0]['userName']}} </h1>
                        </div>
                        <form class="user" method="post">
                            @csrf
                            <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="exampleName"
                                        placeholder="Name" name ="name" value="{{$farmer[0]['name']}}">
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control form-control-user" id="exampleInputuserName"
                                    placeholder="Email" name="email" value="{{$farmer[0]['email']}}">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="exampleInputEmail"
                                    placeholder="Date Of Birth" name="DOB" value="{{$farmer[0]['DOB']}}">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="exampleInputDOB"
                                    placeholder="Contact" name="contact" value="{{$farmer[0]['contact']}}">
                            </div>
                            <hr>
                            <button class="btn btn-primary btn-user btn-block">Edit farmer</button>
                        </form>
                    
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection