<!DOCTYPE html>
<head>
    <title> Dropzone | Homepage </title>
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/front.css')}}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css"/>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    @notifyCss
    <style type="text/css"> .notify{ z-index: 1000000; margin-top: 5%; } </style>
</head>


<body id="bootstrap-overrides">
@include('notify::components.notify')
<x:notify-messages/>
@include('partials.home.nav')
    <div class="container-fluid">
        <div class="row" id="bgonly">
            <div class="col-md-6">
                <h1 class="droptxt">Drop Now,</h1>
                <h1 class="pickuptxt">Pick up later!</h1>

                <p><img src="{{asset('images/dlogo.png')}}" class="dlogo"></p>
                <p class="trusttxt">TRUSTED BY ONLINE SELLERS.</p>
                <img src="{{asset('images/human.png')}}" class="img-responsive" id="vector1">
                <div class="btn-center">
                    <button class="btn btn-first" onclick="trackbtn()"> TRACK YOUR ITEMS</button>
                    <button class="btn btn-second" data-toggle="modal" data-target="#loginModal" onclick="changeurl()">LOG IN</button>
                    <button class="btn btn-third" data-toggle="modal" data-target="#signUpmodal"> SIGN UP</button>
                </div>
            </div>
            <div class="col-md-6">
                <p><img src="{{asset('images/vector.png')}}" class="img-responsive" id="vector"></p>

            </div>
        </div>

        <div class="modal fade" id="loginModal" role="dialog">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" width="" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <div class="modal-body" style="padding-right:70px; padding-left:70px;">
                        <img src="{{asset('images/hello.png')}}" class="hello_img">
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
                                    <input class="form-control input-lg" placeholder="User Name" name="email" type="text">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-xs-12">
                                    <input class="form-control input-lg" placeholder="Password" name="password" type="password">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-xs-12">
                                    <button class="btn" id="createbtn"> LOGIN</button>
{{--                                    <p>OR</p>--}}
{{--                                    <a href="#" class="btn btn-primary">--}}
{{--                                        <i class="bx bxl-facebook"></i> Login with Facebook--}}
{{--                                    </a>--}}

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
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
                            {{csrf_field()}}
                            <div class="form-group row">
                                <div class="col-xs-12">
                                    <input class="form-control input-lg" placeholder="Full Name" id="" type="text" name="name" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-xs-6">
                                    <select class="form-control input-lg" value="" name="location_id" id="itemOrigin" required>
                                        <option disabled selected value>Location</option>
                                        @foreach($locations as $area)
                                            <option value="{{$area->id}}">{{$area->area}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-xs-6">
                                    <input class="form-control input-lg" placeholder="Phone Number" id="" type="text" name="phone_number" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-xs-12">
                                    <input class="form-control input-lg" placeholder="Email" id="" type="text" name="email" required>
                                </div>
{{--                                <div class="col-xs-6">--}}
{{--                                    <input class="form-control input-lg" placeholder="Username" id="" type="text">--}}
{{--                                </div>--}}
                            </div>

                            <div class="form-group row">
                                <div class="col-xs-12">
                                    <input class="form-control input-lg" placeholder="Password" id="" type="password" name="password" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-xs-12">
                                    <button class="btn" id="createbtn"> CREATE</button>
                                    <p><i>By creating an account you agree to our <a href="rules.blade.php">Terms &
                                                Conditions.</a></i></p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" id="newcontainer">
            <div class="col-sm-4" id="txt1new">
                <p><img src="{{asset('images/arrowright.png')}}" class="arrow1"></p>
                <h1 class="txt1">User-friendly,</h1>
                <h1 class="txt2">Hassle free!</h1>
                <h1 class="txt3">Cash out,</h1>
                <h1 class="txt4">Anytime!</h1>
                <p><img src="{{asset('images/arrowleft.png')}}" class="arrow2"></p>
            </div>
            <div class="col-sm-3">
                <img src="{{asset('images/cp.png')}}" class="img-responsive" id="cp">
            </div>
            <div class="col-sm-5">
                <p class="allitemstxt">All items are sorted by codes to speed up <br>searching and releasing process.
                    Real-time<br> updates are within your reach!</p>
                <p class="fblink"><i class='bx bxl-facebook-square' style="font-size: 30px;"></i>&nbsp;https://facebook.com/dropzonelu
                </p>
            </div>
        </div>

        <div class="row" id="whycontainer">
            <div class="col-sm-12" id="why">
                <h1 class="whytxt" style="font-size: 36px;">WHY CHOOSE US?</h1>
            </div>
        </div>

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



</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script>
    function trackbtn() {
        location.replace("{{route('scan')}}")
    }
    function changeurl(){
        window.history.pushState('page2', 'Title', '/#login');
        return false;
    }
    $(document).ready(function() {

        url = '{{ url()->previous() }}';
        if(url.indexOf('#login') !== -1){
            $('#loginModal').modal('show');
        }
        if(window.location.href.indexOf('#login') !== -1) {
            $('#loginModal').modal('show');
        }

    });
</script>
</html>
