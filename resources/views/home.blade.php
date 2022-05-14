<!DOCTYPE html>
<head>
    <title> Dropzone | Homepage </title>
    <link rel="stylesheet" type="text/css" href="{{asset('css/front.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css"/>

    <!---- SCRIPTS --->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    @notifyCss
    <style type="text/css"> .notify {
            z-index: 1000000;
            margin-top: 5%;
        } </style>

</head>


<body id="bootstrap-overrides">
@include('notify::components.notify')
<x:notify-messages/>
<!-------------------------- NAVIGATION BAR ------------------------------------------------->
@include('partials.home.nav')

<!-------------------------- 1ST ROW/ LOGIN/SIGNUP ------------------------------------------------>
<div class="container-fluid">
    <div class="row" id="bgonly">
        <div class="col-md-12">
            <h1 class="droptxt">Drop Now,</h1>
            <h1 class="pickuptxt">Pick up later!</h1>

            <p><img src="{{asset('images/dlogo.png')}}" class="dlogo"></p>
            <p class="trusttxt">TRUSTED BY ONLINE SELLERS.</p>

            <div class="btn-center">
                <button class="btn btn-first" onclick="trackbtn()"> TRACK YOUR ITEMS</button>
                <button class="btn btn-second" data-toggle="modal" data-target="#loginModal">LOG IN</button>
                <button class="btn btn-third" data-toggle="modal" data-target="#signUpmodal"> SIGN UP</button>
            </div>
        </div>


    </div>

    <!-------------------------- LOGIN MODAL ------------------------------------------------------------>
    <div class="modal fade" id="loginModal" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" width="" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body" style="padding-right:70px; padding-left:70px;">
                    <img src="images/hello.png" class="hello_img">
                    <p style="padding-bottom: 30px;">Join the community.</p>
                    @if($errors->any())
                        @foreach($errors->all() as $error)
                            <p style="color: red;">{{$error}}</p>
                        @endforeach
                    @endif

                    <form method="post" action="{{route('login')}}">
                        {{csrf_field()}}
                        <div class="form-group row">
                            <div class="col-xs-12">
                                <input class="form-control input-lg" placeholder="Email" name="email" type="text">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-xs-12">
                                <input class="form-control input-lg" placeholder="Password" name="password"
                                       type="password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-xs-12">
                                <button class="btn" id="createbtn"> LOGIN</button>

                            </div>
                            <a href="/#forgotpass" id="forgotPass"> forgot your password? Reset it here.</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-------------------------- SIGN UP MODAL ------------------------------------------------------------>
    <div class="modal fade" id="signUpmodal" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" width="" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <img src="{{asset('images/create.png')}}" class="create_img">
                    <p style="padding-bottom: 30px;">Join the community.</p>
                    @if($errors->any())
                        @foreach($errors->all() as $error)
                            <p style="color: red;">{{$error}}</p>
                        @endforeach
                    @endif

                    <form method="post" action="{{route('register')}}">
                        {{@csrf_field()}}
                        <div class="form-group row">
                            <div class="col-xs-12">
                                <input class="form-control input-lg" placeholder="Full Name(e.g. Joe D. Doe)" id="" type="text"
                                       name="name" pattern="^([A-Za-z]+[,.]?[ ]?|[A-Za-z]+['-]?)+$" required value="{{old('name')}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-xs-6">
                                <select class="form-control input-lg" value="{{old('location_id')}}" name="location_id" id="itemOrigin"
                                        required>
                                    <option disabled selected value>Location</option>
                                    @foreach($locations as $area)
                                        <option value="{{$area->id}}">{{$area->area}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-xs-6">
                                <input class="form-control input-lg" placeholder="Phone #(09123456789)" id="" type="tel"
                                       name="phone_number" pattern="[09][0-9]{1-0}" required value="{{old('phone_number')}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-xs-12">
                                <input class="form-control input-lg" placeholder="Email" id="" type="email" name="email"
                                       required value="{{old('email')}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-xs-6">
                                <input class="form-control input-lg" placeholder="Password" id="" type="password"
                                       name="password" required>
                            </div>
                            <div class="col-xs-6">
                                <input class="form-control input-lg" placeholder="Confirm Password" id=""
                                       type="password" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-xs-12">
                                <button class="btn" id="createbtn"> CREATE</button>
                                <p><i>By creating an account you agree to our <a href="rules.html">Terms &
                                            Conditions.</a></i></p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--------------------------FORGOT PASS MODAL ------------------------------------------------->
    <div class="modal fade" id="forgotPassModal" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" width="" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <h1 style="font-size: 32px">Forgot Password</h1>
                    @if($errors->any())
                        @foreach($errors->all() as $error)
                            <p style="color: red;">{{$error}}</p>
                        @endforeach
                    @endif
                    <form method="post" action="{{route('forget.password.post')}}">
                        {{csrf_field()}}
                        <div class="form-group row">
                            <div class="col-xs-12">
                                <input class="form-control input-lg" placeholder="email" id="" type="text"
                                       name="email" required>
                            </div>
                        </div>


                        <div class="form-group row">
                            <div class="col-xs-12">
                                <button class="btn" id="createbtn" style="width: auto;" type="submit">  Send Password Reset Link</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-------------------------- 3RD ROW / WHY CHOOSE US ------------------------------------------------->

    <div class="row" id="whycontainer">
        <div class="col-sm-12" id="why">
            <h1 class="whytxt">WHY CHOOSE US?</h1>
        </div>
    </div>

    <!-------------------------- 4TH ROW / REASONS ------------------------------------------------->

    <div class="row" id="columncontainer">
        <div class="col-sm-4" id="col1">
            <p class="titletxt">Precise and Systematic.</p>
            <p>Discover an efficent way to track your drop-off your items using dropzone's database.</p>
        </div>
        <div class="col-sm-4" id="col2">
            <p class="titletxt">Secure Transaction.</p>
            <p>We provide a safe and effective way to secure payment transactions. Cash-out anytime safely.</p>
        </div>
        <div class="col-sm-4" id="col3">
            <p class="titletxt">Always Updated.</p>
            <p>Check latest update of your items status. Real-time updates are within your reach!<br></p>
        </div>
    </div>

</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script>
    function trackbtn() {
        location.replace("{{route('scan')}}")
    }

    function changeurl() {
        window.history.pushState('page2', 'Title', '/#login');
        return false;
    }

    $(document).ready(function () {

        @if(request()->get('token'))
        $('#newPassword').modal('show');
        @endif

            url = '{{ url()->previous() }}';
        if (window.location.href.indexOf('#login') !== -1) {
            $('#loginModal').modal('show');
        }
        if (window.location.href.indexOf('#forgotpass') !== -1) {
            $('#forgotPassModal').modal('show');
        }
        if (window.location.href.indexOf('?token') !== -1) {
            $('#newPassword').modal('show');
        }

        $('#forgotPass').click(function (){
            $('#loginModal').modal('hide');
            $('#forgotPassModal').modal('show');
        });

    });
</script>
</body>
</html>
