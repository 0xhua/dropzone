@extends("layouts.master")
@section('css')
    <link rel="stylesheet" href="{{asset('css/seller_tutor.css')}}">
    @parent
@endsection
@section("title")
    Drop Zone | Seller Tutorial 4
@endsection
@section("content")

		<h2>Tutorials</h2>
        <h5>Know the basic features of the system.</h5>
        <div class="container-fluid" >
				<div class="row">
					<div class="col-sm-7">
						<center>
							<img class="img-fluid" src="{{asset('images/Updates.png')}}" id="img">
						</center>
					</div>

					<div class="col-sm-5">
						<h6>HOW TO CHECK IMPORTANT UPDATES AND ANNOUNCEMENTS?</h6>
						<p>
							Click the UPDATES TAB to check and be updated
							of the important announcements and updates
							from the Admin.
						</p>
					</div>
				</div>

@include('partials.tutorial.pagination')
		</div>
@endsection
