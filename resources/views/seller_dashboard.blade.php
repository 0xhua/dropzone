@extends("layouts.master")
@section("title")
    Drop Zone | Seller Dashboard
@endsection

@section("content")


<!-----------TITLE/HEADER, CARDTEXT/NUMBERS , CARD FOOTER/BUTTONS-------->
<div class="container">
        <h1> Seller Dashboard
            <a href="#" class="icon_top"> <i class='bx bxs-cog bx-pull-right'></i></a>
            <a href="#" class="icon_top"> <i class="bx bxs-bell bx-pull-right" id="notifbell"></i></a>
        </h1>

        <div class="row row-cols-1 row-cols-sm-3 row-cols-md-3 row-cols-lg-8 row-cols-xl-12">

          <div class="col mb-4">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">TOTAL DROPPED ITEMS</h5>
                <p class="card-text"><i class='bx bxl-dropbox' id="card_icon"></i> 165</p>
                <div class="card-footer">
                <p class="footer_text"><i class='bx bx-plus' id="icon_footer"></i> Add new Items </p>
               </div>
              </div>
            </div>
          </div>

          <div class="col mb-4">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">READY FOR PICK UP</h5>
                <p class="card-text"> <i class='bx bx-package' id="card_icon"></i> 2,340</p>
               <div class="card-footer">
               <p class="footer_text"><i class='bx bx-show' id="icon_footer"></i> View Items </p>
               </div>
              </div>
            </div>
          </div>

          <div class="col mb-4">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">FOR PULL-OUT</h5>
                <p class="card-text"><i class="bx bxs-archive-out" id="card_icon"></i> 8</p>
               <div class="card-footer">
               <p class="footer_text"><i class='bx bx-show' id="icon_footer"></i> View Items </p>
               </div>
              </div>
            </div>
          </div>

            <div class="col mb-4">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">IN TRANSIT</h5>
                <p class="card-text"><i class='bx bx-cart' id="card_icon"></i></i>290</p>
               <div class="card-footer">
               <p class="footer_text"><i class='bx bx-show' id="icon_footer"></i> View Items </p>
               </div>
              </div>
            </div>
          </div>


          <div class="col mb-4">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">TOTAL INCOME</h5>
                <p class="card-text"><i class="bx bxs-badge-dollar" id="card_icon"></i>1,340</p>
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
                <p class="card-text"><i class="bx bx-loader" id="card_icon"></i>3</p>
                <div class="card-footer">
                 <p class="footer_text"><i class='bx bx-show' id="icon_footer"></i> View Requests</p>
               </div>
              </div>
            </div>
          </div>

    </div>
  </div>

@endsection
@section('javascript')
    <script>
        document.addEventListener("DOMContentLoaded", function(event) {

            const showNavbar = (toggleId, navId, bodyId, headerId) =>{
                const toggle = document.getElementById(toggleId),
                    nav = document.getElementById(navId),
                    bodypd = document.getElementById(bodyId),
                    headerpd = document.getElementById(headerId)

                // Validate that all variables exist
                if(toggle && nav && bodypd && headerpd){
                    toggle.addEventListener('click', ()=>{
                        // show navbar
                        nav.classList.toggle('show')
                        // change icon
                        toggle.classList.toggle('bx-x')
                        // add padding to body
                        bodypd.classList.toggle('body-pd')
                        // add padding to header
                        headerpd.classList.toggle('body-pd')
                    })
                }
            }

            showNavbar('header-toggle','nav-bar','body-pd','header')

            /*===== LINK ACTIVE =====*/
            const linkColor = document.querySelectorAll('.nav_link')

            function colorLink(){
                if(linkColor){
                    linkColor.forEach(l=> l.classList.remove('active'))
                    this.classList.add('active')
                }
            }
            linkColor.forEach(l=> l.addEventListener('click', colorLink))

        });

    </script>
    @parent
@endsection

