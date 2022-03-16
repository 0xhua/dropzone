@extends("layouts.master")
@section("title")
    Drop Zone | Seller Dashboard
@endsection

@section("content")

    <div class="container-fluid">

        <h2>SELLER'S ITEM LIST</h2>

        <div class="row" style=" margin-top: 40px;">
            <div class="col-sm-3">
                <div class="input-group mb-3">
                    <input type="text" class="form-control input-text" id="myInput" placeholder="Search....">
                </div>
            </div>

            <!------ ADD NEW BUTTON ------------------>
            <div class="col-sm-5 mb-3" style="padding-top: 0px;">
                <button class="addNew btn btn-outline-warning" id="addNew" style="color: white;" data-toggle="modal"
                        data-target="#addNewItem">Add New
                </button>
            </div>


            <!---------------------- ADD ITEM MODAL------------------->
            <div class="modal" id="addNewItem">
                <div class="modal-dialog  modal-md">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title" style="color:#222222;">Add New Item</h4>
                            <button type="button" class="btn-close" data-dismiss="modal"></button>
                        </div>

                        <!-- Modal body -->
                        <form>
                            <div class="modal-body">
                                <div class="row" style="margin-left: 5px;">
                                    <div class="col-sm-6 mb-3">

                                        <label id="">Date</label><br>
                                        <input type="date" placeholder=""><br>

                                        <label id="">Seller</label><br>
                                        <input type="text" placeholder=""><br>

                                        <label id="">Buyer</label><br>
                                        <input type="text" placeholder=""><br>

                                        <label id="">Paid</label>
                                        <select value="" name="paid" id="paid">
                                            <option disabled selected value> -- paid/unpaid --</option>
                                            @foreach($paid_statuses as $status)
                                                <option value="{{$status->id}}">{{$status->status}}</option>
                                            @endforeach
                                        </select>
                                    </div>


                                    <div class="col-sm-6 mb-3">
                                        <label id="">Origin</label><br>
                                        <select value="" name="origin" id="itemOrigin">
                                            <option disabled selected value> -- select origin --</option>
                                            @foreach($location as $area)
                                                <option value="{{$area->id}}">{{$area->area}}</option>
                                            @endforeach
                                        </select> <br>


                                        <label id="" style="margin-top: 20px;">Destination </label><br>
                                        <select value="" name="destination" id="itemDesti">
                                            <option disabled selected value> -- select destination --</option>
                                            @foreach($location as $area)
                                                <option value="{{$area->id}}">{{$area->area}}</option>
                                            @endforeach
                                        </select> <br>

                                        <label id="" style="margin-top: 20px;">Item Size</label><br>
                                        <select value="" name="itemSize" id="itemSize">
                                            <option disabled selected value> -- select size --</option>
                                            @foreach($sizes as $size)
                                                <option value="{{$size->id}}">{{$size->size}}</option>
                                            @endforeach
                                        </select>
                                        <br>

                                        <label id="" style="margin-top: 20px;"> Item Amount</label><br>
                                        <input type="text" placeholder="">
                                    </div>

                                </div>

                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Discard
                                    </button>

                                    <button type="button" class="btn btn-success" data-dismiss="modal">Create
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!---------------------- GENERATE QR MODAL------------------------->
            <div class="modal" id="generateQr">
                <div class="modal-dialog  modal-lg">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-dismiss="modal"></button>
                        </div>

                        <!-- Modal body -->
                        <form>


                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Discard</button>

                                <button type="button" class="btn btn-success" data-dismiss="modal">Save</button>
                            </div>

                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!------------------------ TABLE ------------------------>
    <div class="row" style="margin-top: 2%; color: white;">
        <div class="table-responsive">
            <table class="table table-responsive table-border">
                <center>
                    <thead>
                    <tr class="tHead">
                        <th scope="col" width="9%">Code</th>
                        <th scope="col" width="10%">DropDate</th>
                        <th scope="col" width="10%">Seller</th>
                        <th scope="col" width="10%">Buyer</th>
                        <th scope="col" width="10%">Origin</th>
                        <th scope="col" width="10%">Destination</th>
                        <th scope="col" width="3%">TH/HF</th>
                        <th scope="col" width="5%">Amount</th>
                        <th scope="col" width="7%">Payment</th>
                        <th scope="col" width="7%">Status</th>
                        <th scope="col" width="9%">Claimed Date</th>
                        <th scope="col" width="9%">Released Date</th>
                        <th scope="col" width="7%">Approval</th>
                        <th scope="col" width="7%">Action</th>
                    </tr>
                    </thead>

                    <tbody id="myTable">
                    <tr>
                        <td>KDS-253</td>
                        <td>03-18-2022</td>
                        <td>Janice</td>
                        <td>Lotlot</td>
                        <td>Naguilian</td>
                        <td>SFC</td>
                        <td>20</td>
                        <td>200</td>
                        <td>Paid</td>
                        <td>Claimed</td>
                        <td>02-05-2021</td>
                        <td>02-15-2021</td>
                        <td>Approved</td>
                        <td>
                            <i class='bx bx-qr-scan' style="font-size: 24px;" data-toggle="modal"
                               data-target="#generateQr"></i>
                        </td>
                    </tr>

                    <tr>

                        <td>KDS-253</td>
                        <td>03-18-2022</td>
                        <td>Janice</td>
                        <td>Lotlot</td>
                        <td>Naguilian</td>
                        <td>SFC</td>
                        <td>20</td>
                        <td>200</td>
                        <td>Unpaid</td>
                        <td>Pullout</td>
                        <td>02-05-2021</td>
                        <td>02-15-2021</td>
                        <td>Pending</td>
                        <td>
                            <i class='bx bx-qr-scan' style="font-size: 24px;" data-toggle="modal"
                               data-target="#generateQr"></i>
                        </td>
                    </tr>
                    </tbody>
                </center>
            </table>
        </div>
    </div>


    </div>

    </body>
@endsection
@section('javascript')
    <script>
        $(document).ready(function () {
            $("#myInput").on("keyup", function () {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function (event) {

            const showNavbar = (toggleId, navId, bodyId, headerId) => {
                const toggle = document.getElementById(toggleId),
                    nav = document.getElementById(navId),
                    bodypd = document.getElementById(bodyId),
                    headerpd = document.getElementById(headerId)

                // Validate that all variables exist
                if (toggle && nav && bodypd && headerpd) {
                    toggle.addEventListener('click', () => {
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

            showNavbar('header-toggle', 'nav-bar', 'body-pd', 'header')

            /*===== LINK ACTIVE =====*/
            const linkColor = document.querySelectorAll('.nav_link')

            function colorLink() {
                if (linkColor) {
                    linkColor.forEach(l => l.classList.remove('active'))
                    this.classList.add('active')
                }
            }

            linkColor.forEach(l => l.addEventListener('click', colorLink))

        });

    </script>
@endsection
