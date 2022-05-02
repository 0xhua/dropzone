@extends("layouts.master")
@section("title")

    Drop Zone | Dashboard
@endsection
@section("content")


<!-----------TITLE/HEADER, CARDTEXT/NUMBERS , CARD FOOTER/BUTTONS-------->
<div class="container">
        <h1>DASHBOARD
{{--            <a href="#" class="icon_top"> <i class='bx bxs-cog bx-pull-right'></i></a>--}}
{{--            <a href="#" class="icon_top"> <i class="bx bxs-bell bx-pull-right" id="notifbell"></i></a>--}}
        </h1>

        <div class="row row-cols-1 row-cols-sm-3 row-cols-md-3 row-cols-lg-8 row-cols-xl-12">

          <div class="col mb-4">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">TOTAL DROPPED ITEMS</h5>
                <p class="card-text"><i class='bx bxl-dropbox' id="card_icon"></i> {{$total_items}}</p>
                <div class="card-footer">
                <a href="{{route('itemlist')}}" class="footer_text"><i class='bx bx-plus' id="icon_footer"></i> Add new Items </a>
               </div>
              </div>
            </div>
          </div>
            @if(auth()->user()->hasRole('seller'))
          <div class="col mb-4">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">READY FOR PICK UP</h5>
                <p class="card-text"> <i class='bx bx-package' id="card_icon"></i> {{$pick_up}}</p>
               <div class="card-footer">
               <a href="{{route('itemlist')}}" class="footer_text"><i class='bx bx-show' id="icon_footer"></i> View Items </a>
               </div>
              </div>
            </div>
          </div>
            @else
                <div class="col mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">TOTAL COLLECTIONS</h5>
                            <p class="card-text"> <i class="bx bxs-wallet" id="card_icon"></i>{{$collection}}</p>
                            <div class="card-footer">
                                <p class="footer_text"><i class="bx bx-calendar" id="icon_footer"></i> Today </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
          <div class="col mb-4">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">FOR PULL-OUT</h5>
                <p class="card-text"><i class="bx bxs-archive-out" id="card_icon"></i> {{$pull_out}}</p>
               <div class="card-footer">
               <a href="{{route('itemlist')}}" class="footer_text"><i class='bx bx-show' id="icon_footer"></i> View Items </a>
               </div>
              </div>
            </div>
          </div>
            @if(auth()->user()->hasRole('seller'))
            <div class="col mb-4">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">IN TRANSIT</h5>
                <p class="card-text"><i class='bx bx-cart' id="card_icon"></i>{{$in_transit}}</p>
               <div class="card-footer">
               <a href="{{route('itemlist')}}" class="footer_text"><i class='bx bx-show' id="icon_footer"></i> View Items </a>
               </div>
              </div>
            </div>
          </div>
            @else
                <div class="col mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">SELLERS/DROPPERS</h5>
                            <p class="card-text"><i class="bx bxs-user-circle" id="card_icon"></i>{{$sellers}}</p>
                            <div class="card-footer">
                                <p class="footer_text"><i class="bx bx-show" id="icon_footer"></i> View Sellers </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

          <div class="col mb-4">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">TOTAL INCOME</h5>
                <p class="card-text"><i class="bx bxs-badge-dollar" id="card_icon"></i>{{$income}}</p>
               <div class="card-footer">
               <p class="footer_text"><i class='bx bx-calendar' id="icon_footer"></i> Today </p>
               </div>
              </div>
            </div>
          </div>


            <div class="col mb-4">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">PENDING REQUEST</h5>
                <p class="card-text"><i class="bx bx-loader" id="card_icon"></i>{{$pending}}</p>
                <div class="card-footer">
                 <a href="{{route('itemrequest')}}" class="footer_text"><i class='bx bx-show' id="icon_footer"></i> View Requests</a>
               </div>
              </div>
            </div>
          </div>

    </div>
  </div>

@endsection

