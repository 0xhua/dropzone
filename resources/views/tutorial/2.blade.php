@extends("layouts.master")
@section('css')
    <link rel="stylesheet" href="{{asset('css/seller_tutor.css')}}">
    @parent
@endsection
@section("title")
    Drop Zone | Seller Tutorial 2
@endsection

@section("content")
		<h2>Tutorials</h2>
        <h5>Know the basic features of the system.</h5>
        <div class="container-fluid" >
			<div class="row">
				<div class="col-sm-7">
					<center>
						<img class="img" src="{{asset('images/Pickup.png')}}" id="img">
					</center>
				</div>

				<div class="col-sm-5">
					<h6>HOW TO REQUEST FOR PICK UP?</h6>
					<p>
						To pick up ordered item in the DA, the buyer needs to show the
						QR code sent by the seller. Then the DA will scan the QR code
						using the QR scanner. The item will be ready for pick up and
						item status in the system will be changed to CLAIMED.
					</p>
                </div>
             </div>

            @include('partials.tutorial.pagination')
		</div>
@endsection
