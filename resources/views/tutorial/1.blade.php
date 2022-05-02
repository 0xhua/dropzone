@extends("layouts.master")
@section('css')
    <link rel="stylesheet" href="{{asset('css/seller_tutor.css')}}">
    @parent
@endsection
@section("title")
    Drop Zone | Seller Tutorial
@endsection

@section("content")
<div style="margin-top: 80px">
    <h2 style="font-size: 32px;">Tutorials</h2>
    <h5>Know the basic features of the system.</h5>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-7">
                <center>
                    <img class="img" src="{{asset('images/Delivery.png')}}" id="deliver">
                </center>
            </div>

            <div class="col-sm-5">
                <h6>HOW TO REQUEST FOR DELIVERY?</h6>
                <p>
                    For door-to-door delivery, Go to REQUEST LIST and
                    click REQUEST. Select Category and input the Name,
                    Contact Number, Request and Location then wait for
                    the DA's approval of the request. The DA then will
                    inform the rider to pick up the item in the DA and
                    deliver it to the buyer's location.
                </p>
            </div>
        </div>
        @include('partials.tutorial.pagination')
    </div>
</div>
@endsection
