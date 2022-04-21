@extends("layouts.home")
@section("title")
    Drop Zone | Contact us
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('css/contact.css')}}">
    @parent
@endsection
@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12">
                <h1 id="inqu"> Have any inquiries? </h1>
                <h2> Get in touch and let us know how we can help. </h2>
            </div>
        </div>


        <div class="row">
            <div class="col-sm-12">
                <div class="dropdown">
                <button onclick="myFunction()" class="dropbtn">What's your concern?</button>
                <div id="myDropdown" class="dropdown-content">
                    <input type="text" placeholder="Search.." id="myInput" onkeyup="filterFunction()">
                    <a href="#">How much is the transfer fee?</a><br>
                    <a href="#">How can I monitor my items?</a><br>
                    <a href="#">Can someone cashout for me?</a>
                </div>
                </div>
            </div>
        </div>



        <div class="row" id="yellowBg" style="height:270px; margin-top: 135px;"><br><br>
            <div class="col-sm-12">
                <p>You can also send us a message on our Facebook page regarding your concern.</p>
            </div>

            <div class="col-sm-12">
                <img src="images/pencil.png" class="pen">
            </div>
        </div>


        <div class="row" id="yellowBg">
            <div class="col-sm-12">
                <h4>HERE'S HOW YOU CAN REACH US!</h4>
            </div>
        </div>


        <div class="row" id="yellowBg">
            <center>
            <div class="contact-info">

            <div class="col-sm-4" >
                <div class="card">
                <i class="icon fas fa-envelope"></i>
                <div class="card-content">
                    <h3>Email</h3>
                    <span>email@address.com</span>
                </div>
            </div>
            </div>


            <div class="col-sm-4">
                <div class="card">
                <i class="icon fas fa-phone"></i>
                <div class="card-content">
                    <h3>Number</h3>
                    <span>+63</span>
                </div>
            </div>
            </div>

            <div class="col-sm-4">
                <div class="card">
                <i class="icon fas fa-map-marker-alt"></i>
                <div class="card-content">
                    <h3>Location</h3>
                    <span>SFC La Union</span>
                </div>
            </div>
            </div>
            </div>

            </center>
        </div>
        </div>
@endsection

