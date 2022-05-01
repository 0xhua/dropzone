@extends('layouts.home')
@section('title')
    Dropzone | Branches
@endsection
@section('css')
    <link rel="stylesheet" type="text/css" href="css/branches.css">
@endsection
@section('content')

    <!-------------------------- 1ST ROW/ LOGIN/SIGNUP ------------------------------------------------>
    <h2> Partners and Branches </h2>
    <div class="container container-m">
        <div class="row">
            <div class="col-sm-3" style="text-align: center;">
                <a class="lightbox" href="#branch">
                    <img src="{{asset('images/da10.png')}}">
                </a>
                <div class="caption">
                    <p style="text-align: center; color:#ffbf00; font-size: 20px; "> San Fernando </p>
                    <a href="https://goo.gl/maps/EAkyovoa8vpbBdmv9" style="font-size: 15px;">Open Maps</a>
                </div>
            </div>

            <div class="col-sm-3">
                <a class="lightbox" href="#branch1">
                    <img src="{{asset('images/da2.png')}}">
                </a>
                <div class="caption">
                    <p style="text-align: center; color:#ffbf00; font-size: 20px; "> Bauang </p>
                    <a href="https://goo.gl/maps/XgfPdKNGHnaAWYiZ7" style="font-size: 15px;">Open Maps</a>
                </div>
            </div>

            <div class="col-sm-3">
                <a class="lightbox" href="#branch2">
                    <img src="{{asset('images/da11.png')}}">
                </a>
                <div class="caption">
                    <p style="text-align: center; color:#ffbf00; font-size: 20px; "> Bacnotan </p>
                    <a href="https://goo.gl/maps/ZMfpsRuAAWgyPJ219" style="font-size: 15px;">Open Maps</a>
                </div>
            </div>

            <div class="col-sm-3">
                <a class="lightbox" href="#branch3">
                    <img src="{{asset('images/da8.png')}}">
                </a>
                <div class="caption">
                    <p style="text-align: center; color:#ffbf00; font-size: 20px; "> Agoo </p>
                    <a href="https://goo.gl/maps/nCC3NzwXamsYNwTr6" style="font-size: 15px;">Open Maps</a>
                </div>
            </div>
        </div>


        <!--------------2ND ROW LOCATION ----------------->
        <div class="row" id="branches">
            <div class="col-sm-3">
                <a class="lightbox" href="#branch4">
                    <img src="{{asset('images/da9.png')}}">
                </a>
                <div class="caption">
                    <p style="text-align: center; color:#ffbf00; font-size: 20px; "> Naguilian</p>
                    <a href="https://goo.gl/maps/NZ1jxgKUzx5acj549" style="font-size: 15px;">Open Maps</a>
                </div>
            </div>


            <div class="col-sm-3">
                <a class="lightbox" href="#branch5">
                    <img src="{{asset('images/da3.png')}}">
                </a>
                <div class="caption">
                    <p style="text-align: center; color:#ffbf00; font-size: 20px; "> Caba </p>
                    <a href="https://goo.gl/maps/ovCMD1zZ9Tqn8g2n9" style="font-size: 15px;">Open Maps</a>
                </div>
            </div>

            <div class="col-sm-3">
                <a class="lightbox" href="#branch6">
                    <img src="{{asset('images/da4.png')}}">
                </a>
                <div class="caption">
                    <p style="text-align: center; color:#ffbf00; font-size: 20px; "> Aringay </p>
                    <a href="https://goo.gl/maps/vALRSsg9ck1p9HbXA" style="font-size: 15px;">Open Maps</a>
                </div>
            </div>

            <div class="col-sm-3">
                <a class="lightbox" href="#branch7">
                    <img src="{{asset('images/da13.png')}}">
                </a>
                <div class="caption">
                    <p style="text-align: center; color:#ffbf00; font-size: 20px; "> San Juan </p>
                    <a href="https://goo.gl/maps/ZC8PWLPzB66DEc1u9" style="font-size: 15px;">Open Maps</a>
                </div>
            </div>
        </div>

        <!--------------3RD ROW LOCATION ----------------->
        <div class="row" id="branches">
            <div class="col-sm-3">
                <a class="lightbox" href="#branch8">
                    <img src="{{asset('images/da1.png')}}">
                </a>
                <div class="caption">
                    <p style="text-align: center; color:#ffbf00; font-size: 20px; "> Balaoan</p>
                    <a href="https://goo.gl/maps/6YdLHFExTFEWwPto6" style="font-size: 15px;">Open Maps</a>
                </div>
            </div>

            <div class="col-sm-3">
                <a class="lightbox" href="#branch9">
                    <img src="{{asset('images/da14.png')}}">
                </a>
                <div class="caption">
                    <p style="text-align: center; color:#ffbf00; font-size: 20px; "> Luna</p>
                    <a href="https://goo.gl/maps/nFFGR7f2dreppbtcA" style="font-size: 15px;">Open Maps</a>
                </div>
            </div>

            <div class="col-sm-3">
                <a class="lightbox" href="#branch10">
                    <img src="{{asset('images/da15.png')}}">
                </a>
                <div class="caption">
                    <p style="text-align: center; color:#ffbf00; font-size: 20px; "> Bangar </p>
                    <a href="https://goo.gl/maps/viAHQr3qmihf2LjV7" style="font-size: 15px;">Open Maps</a>
                </div>
            </div>

            <div class="col-sm-3">
                <a class="lightbox" href="#branch11">
                    <img src="{{asset('images/da7.png')}}">
                </a>
                <div class="caption">
                    <p style="text-align: center; color:#ffbf00; font-size: 20px; "> Santo Tomas </p>
                    <a href="https://goo.gl/maps/h1ykHPURDBFZ2zea6" style="font-size: 15px;">Open Maps</a>
                </div>
            </div>
        </div>

        <!--------------4TH ROW LOCATION ----------------->
        <div class="row" id="branches">
            <div class="col-sm-3">
                <a class="lightbox" href="#branch12">
                    <img src="{{asset('images/da5.png')}}">
                </a>
                <div class="caption">
                    <p style="text-align: center; color:#ffbf00; font-size: 20px; "> Pugo</p>
                    <a href="https://goo.gl/maps/eew7deK9nAtXnryQ8" style="font-size: 15px;">Open Maps</a>
                </div>
            </div>

            <div class="col-sm-3">
                <a class="lightbox" href="#branch13">
                    <img src="{{asset('images/da17.png')}}">
                </a>
                <div class="caption">
                    <p style="text-align: center; color:#ffbf00; font-size: 20px; "> Tubao</p>
                    <a href="https://goo.gl/maps/aRufBxPvJhwo8hku8" style="font-size: 15px;">Open Maps</a>
                </div>
            </div>

            <div class="col-sm-3">
                <a class="lightbox" href="#branch14">
                    <img src="{{asset('images/da6.png')}}">
                </a>
                <div class="caption">
                    <p style="text-align: center; color:#ffbf00; font-size: 20px; "> Damortis </p>
                    <a href="https://goo.gl/maps/XDqbdTN6Y76nKBJB9" style="font-size: 15px;">Open Maps</a>
                </div>
            </div>

            <div class="col-sm-3">
                <a class="lightbox" href="#branch15">
                    <img src="{{asset('images/da16.png')}}">
                </a>
                <div class="caption">
                    <p style="text-align: center; color:#ffbf00; font-size: 20px; "> Rosario </p>
                    <a href="https://goo.gl/maps/p9Wrmo8HNSnYuhVPA" style="font-size: 15px;">Open Maps</a>
                </div>
            </div>
        </div>

        <!--------------5TH ROW LOCATION ----------------->
        <div class="row" id="branches">
            <div class="col-sm-3">
                <a class="lightbox" href="#branch16">
                    <img src="{{asset('images/da12.png')}}">
                </a>
                <div class="caption">
                    <p style="text-align: center; color:#ffbf00; font-size: 20px; "> San Gabriel</p>
                    <a href="https://goo.gl/maps/sdGjVrU7EUnC7N7C7" style="font-size: 15px;">Open Maps</a>
                </div>
            </div>

            <div class="col-sm-3">
                <a class="lightbox" href="#branch17">
                    <img src="{{asset('images/da_loc.png')}}">
                </a>
                <div class="caption">
                    <p style="text-align: center; color:#ffbf00; font-size: 20px; "> Baguio</p>
                    <a href="" style="font-size: 15px;">Open Maps</a>
                </div>
            </div>

            <div class="col-sm-3">
                <a class="lightbox" href="#branch18">
                    <img src="{{asset('images/da_loc.png')}}">
                </a>
                <div class="caption">
                    <p style="text-align: center; color:#ffbf00; font-size: 20px; "> Pangasinan </p>
                    <a href="" style="font-size: 15px;">Open Maps</a>
                </div>
            </div>

            <div class="col-sm-3">
                <a class="lightbox" href="#branch19">
                    <img src="{{asset('images/da_loc.png')}}">
                </a>
                <div class="caption">
                    <p style="text-align: center; color:#ffbf00; font-size: 20px; "> Candon </p>
                    <a href="" style="font-size: 15px;">Open Maps</a>
                </div>
            </div>
        </div>


    </div>


    <!--------------------- EACH LIGHTBOX --------------------------->
    <div class="lightbox-target" id="branch">
        <img src="{{asset('images/da10.png"/>)}}">
        <a class="lightbox-close" href="{{route('branches')}}"></a>
    </div>
    <div class="lightbox-target" id="branch1">
        <img src="{{asset('images/da2.png')}}"/>
        <a class="lightbox-close" href="{{route('branches')}}"></a>
    </div>
    <div class="lightbox-target" id="branch2">
        <img src="{{asset('images/da11.png')}}"/>
        <a class="lightbox-close" href="branches.blade.php"></a>
    </div>
    <div class="lightbox-target" id="branch3">
        <img src="{{asset('images/da8.png')}}"/>
        <a class="lightbox-close" href="{{route('branches')}}"></a>
    </div>
    <div class="lightbox-target" id="branch4">
        <img src="{{asset('images/da9.png')}}"/>
        <a class="lightbox-close" href="{{route('branches')}}"></a>
    </div>
    <div class="lightbox-target" id="branch5">
        <img src="{{asset('images/da3.png')}}"/>
        <a class="lightbox-close" href="branches.blade.php"></a>
    </div>
    <div class="lightbox-target" id="branch6">
        <img src="{{asset('images/da4.png')}}"/>
        <a class="lightbox-close" href="{{route('branches')}}"></a>
    </div>
    <div class="lightbox-target" id="branch7">
        <img src="{{asset('images/da13.png')}}"/>
        <a class="lightbox-close" href="branches.blade.php"></a>
    </div>
    <div class="lightbox-target" id="branch8">
        <img src="{{asset('images/da1.png')}}"/>
        <a class="lightbox-close" href="{{route('branches')}}"></a>
    </div>
    <div class="lightbox-target" id="branch9">
        <img src="{{asset('images/da14.png')}}"/>
        <a class="lightbox-close" href="{{route('branches')}}"></a>
    </div>
    <div class="lightbox-target" id="branch10">
        <img src="{{asset('images/da15.png')}}"/>
        <a class="lightbox-close" href="branches.blade.php"></a>
    </div>
    <div class="lightbox-target" id="branch11">
        <img src="{{asset('images/da7.png')}}"/>
        <a class="lightbox-close" href="{{route('branches')}}"></a>
    </div>
    <div class="lightbox-target" id="branch12">
        <img src="{{asset('images/da5.png')}}"/>
        <a class="lightbox-close" href="branches.blade.php"></a>
    </div>
    <div class="lightbox-target" id="branch13">
        <img src="{{asset('images/da17.png')}}"/>
        <a class="lightbox-close" href="{{route('branches')}}"></a>
    </div>
    <div class="lightbox-target" id="branch14">
        <img src="{{asset('images/da6.png')}}"/>
        <a class="lightbox-close" href="{{route('branches')}}"></a>
    </div>
    <div class="lightbox-target" id="branch15">
        <img src="{{asset('images/da16.png')}}"/>
        <a class="lightbox-close" href="branches.blade.php"></a>
    </div>
    <div class="lightbox-target" id="branch16">
        <img src="{{asset('images/da12.png')}}"/>
        <a class="lightbox-close" href="{{route('branches')}}"></a>
    </div>
    <div class="lightbox-target" id="branch17">
        <img src="{{asset('images/da_loc.png')}}"/>
        <a class="lightbox-close" href="branches.blade.php"></a>
    </div>
    <div class="lightbox-target" id="branch18">
        <img src="{{asset('images/da_loc.png')}}"/>
        <a class="lightbox-close" href="{{route('branches')}}"></a>
    </div>
    <div class="lightbox-target" id="branch19">
        <img src="{{asset('images/da_loc.png')}}"/>
        <a class="lightbox-close" href="{{route('branches')}}"></a>
    </div>
@endsection
