<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Register</title>

    <!-- Custom fonts for this template-->
    <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('css/sb-admin-2.min.css')}}" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5"><img src="{{asset('img/agri.jpg')}}" alt="picture" style="width:500px;height:600px;"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <form class="user" method="post">
                                @csrf
                                <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id="exampleFirstName"
                                            placeholder="Name" name="name" value="{{old('name')}}">
                                            @error('name')
                                            <div style="color:red; text-align:center">{{$message}}</div>
                                            @enderror
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="exampleInputuserName"
                                        placeholder="User Name" name="userName" value="{{old('userName')}}">
                                        @error('userName')
                                            <div style="color:red; text-align:center">{{$message}}</div>
                                            @enderror
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" id="exampleInputEmail"
                                        placeholder="Email Address" name="email" value="{{old('email')}}">
                                        @error('email')
                                            <div style="color:red; text-align:center">{{$message}}</div>
                                            @enderror
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="exampleInputDOB"
                                        placeholder="Date of Birth" name="DOB" value="{{old('DOB')}}">
                                        @error('DOB')
                                            <div style="color:red; text-align:center">{{$message}}</div>
                                            @enderror
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="exampleInputphoneNo"
                                        placeholder="Phone Number" name="contact" value="{{old('contact')}}">
                                        @error('contact')
                                            <div style="color:red; text-align:center">{{$message}}</div>
                                            @enderror
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user"
                                            id="exampleInputPassword" placeholder="Password" name="password">
                                            @error('password')
                                            <div style="color:red; text-align:center">{{$message}}</div>
                                            @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user"
                                            id="exampleRepeatPassword" placeholder="Repeat Password" name="repassword">
                                            @error('repassword')
                                            <div style="color:red; text-align:center">{{$message}}</div>
                                            @enderror
                                    </div>
                                </div>
                                
                                <!-- <a href="/login/register" class="btn btn-primary btn-user btn-block">
                                    Register Account
                                </a> -->

                                <button class="btn btn-primary btn-user btn-block">
                                    Register Account
                                </button>
                                
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="{{route('login')}}">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('js/sb-admin-2.min.js')}}"></script>

</body>

</html>