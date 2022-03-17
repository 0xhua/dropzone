@extends("layouts.master")
@section('css')
    <link rel="stylesheet" href="{{asset('css/seller_tutor.css')}}">
    @parent
@endsection
@section("title")
    Drop Zone | Seller Tutorial 3
@endsection
@section("content")
		<h2>Tutorials</h2>
        <h5>Know the basic features of the system.</h5>
        <div class="container-fluid" >
			<div class="row">
				<div class="col-sm-6">
					<center>
						<img class="img-fluid" src="{{asset('images/Cashout.png')}}" id="cashout">
					</center>
				</div>

                <div class="col-sm-6">
					<h6>HOW TO REQUEST FOR CASH-OUT?</h6>
					<p>
						For Cash-Out, the seller will request to the DA. The DA will
						send the verification code to the seller. The seller then will present
						this verification code together with an ID upon Cash-Out.
					</p>
                </div>
            </div>


            @include('partials.tutorial.pagination')
		</div>
@endsection
