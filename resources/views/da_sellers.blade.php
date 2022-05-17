@extends("layouts.master")
@section("title")

    Drop Zone | Droppers
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('css/tablelist.css')}}">
    <link rel="stylesheet" href="{{asset('css/da_sellers.css')}}">
    <link rel="stylesheet" href="{{asset('css/da_itemList.css')}}">
    @parent
@endsection
@section("content")
    <div class="container-fluid">

        <h2>LIST OF DROPPERS</h2>

        <div class="row" style=" margin-top: 40px;">
            <div class="col-sm-3">
                <div class="input-group mb-3">
                    <input type="text" class="form-control input-text"  id="myInput" placeholder="Search....">

                    <div class="input-group-append">
                        <button class="searchIcon btn btn-outline-warning btn-lg" style="color: white;">
                            <i class="bx bx-search"></i>
                        </button>
                    </div>
                </div>
            </div>



<!------ ADD NEW BUTTON ------------------>
            <div class="col-sm-5 mb-3" style="padding-top: 0px;">
                <button class="addNew btn btn-outline-warning" id="addNew" style="color: white;" data-toggle="modal" data-target="#addNewItem">Create</button>


            </div>

            <div class="col-sm-4 mb-3">
                <form action="{{route('export_excel.sellerlist')}}" method="get">
                    <button type="submit" class="printBtn" id="printBtn" style="color: white;" data-bs-toggle="modal" data-bs-target="#printInfo">
                        <i class="bx bxs-cloud-download"></i>
                    </button>
                </form>
            </div>

<!---------------------- CREATE ACCOUNT MODAL------------------->
            <div class="modal" id="addNewItem">
                <div class="modal-dialog  modal-md">
                    <div class="modal-content">

                    <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title" style="color:#222222;">Create Seller Account</h4>
                            <button type="button" class="btn-close" data-dismiss="modal"></button>
                        </div>

                    <!-- Modal body -->
                        <form action="{{route('register-seller')}}" method="post">\
                        <div class="modal-body">
                            <input  type="hidden" placeholder="" name="location_id" value="{{$da_loc}}"><br>
                                {{csrf_field()}}
                            <div class="row" style="margin-left: 5px;">
                            <div class="col-sm-6 mb-3">
                                <label>Full Name</label><br>
                                <input style="color:#222222;" type="text" placeholder="Full Name" name="name" pattern="^([A-Za-z]+[,.]?[ ]?|[A-Za-z]+['-]?)+$" required value="{{old('name')}}"><br>

                                <label>Contact No.</label><br>
                                <input style="color:#222222;" type="text" placeholder="" name="phone_number" required><br>

                                <label id="">Password</label><br>
                                <input style="color:#222222;" type="password" placeholder="" name="password" ><br>


                            </div>


                            <div class="col-sm-6 mb-3">
                                <label id="">Email</label><br>
                                <input style="color:#222222;" type="email" placeholder="" name="email"><br>

                                <label id="" >Status</label>
                                <form action="#">
                                    <select value="" id="status" name="status_id">
                                        <option disabled selected value> -- select Status --</option>
                                        <option value="2">Activated</option>
                                        <option value="1">Not Activated</option>
                                    </select>
                                    <label id="">Confirm Password</label><br>
                                    <input style="color:#222222;" type="password" placeholder="" name="password_confirmation" ><br>
                                </form>

                                </div>


                             </div>


                        <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Discard</button>

                                <button type="submit" class="btn btn-success" data-bs-dismiss="modal">Create</button>
                            </div>

                        </div>
                        </form>
                    </div>
                </div>
            </div>


<!---------------------- UPDATE ACCOUNT MODAL------------------------->
            <div class="modal" id="editItem">
                <div class="modal-dialog  modal-xl">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title" style="color:#222222;">Update Dropper's Info.</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <div class="row" style="margin-left: 5px;">
                            <div class="col-sm-4 mb-3">
                                <label id="" style="font-size: 18px;">ID</label><br>
                                <input type="text" placeholder="" name="name"><br>

                                <label id="" >Seller Name</label><br>
                                <input type="text" placeholder=""><br>

                                <label id="">User Name</label><br>
                                <input type="text" placeholder=""><br>
                            </div>


                            <div class="col-sm-4 mb-3">
                                <label id="">First Name</label><br>
                                <input type="text" placeholder=""><br>

                                <label id="">Last Name</label><br>
                                <input type="text" placeholder=""><br>

                                <label id="">Contact No.</label><br>
                                <input type="text" placeholder=""><br>
                            </div>


                            <div class="col-sm-4 mb-3">
                                <label id="">Email</label><br>
                                <input type="text" placeholder=""><br>

                                <label id="">Location</label><br>
                                <input type="text" placeholder=""><br>

                                <label id="" >Status</label>
                                <form action="#">
                                    <select value="" name="status" id="status">
                                        <option value="claimed">Activated</option>
                                        <option value="intransit">Not Activated</option>
                                    </select>
                                </form>
                            </div>
                            </div>


                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Discard</button>

                                <button type="button" class="btn btn-success" data-bs-dismiss="modal">Update</button>
                            </div>

                            </div>
                            </div>
                </div>
            </div>



<!------------------------ DELETE ACCOUNT MODAL ------------------------>
            <div class="modal" id="deleteItem">
                <div class="modal-dialog  modal-md">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title" style="color:black">
                                Delete Confirmation
                            </h4>

                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body" style="color: #222222;">
                            Do you really want to delete this item? <br> This process cannot be undone.
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Discard</button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Delete</button>
                        </div>

                        </div>
                </div>
            </div>
        </div>



<!------------------------ TABLE ------------------------>
        <div class="row" style="margin-top: 2%; color: white;">
            <div class="table-responsive">
            <table class="table table-responsive table-border" >
                <center>
                <thead>
                    <tr class="tHead">
                        <th scope="col" width="10%">Full Name</th>
                        <th scope="col" width="10%">Contact No.</th>
                        <th scope="col" width="10">Email</th>
                        <th scope="col" width="10%">Location</th>
                        <th scope="col" width="8%">Status</th>
                        <th scope="col" width="5%">Action</th>
                    </tr>
                </thead>

                <tbody id="myTable">
                @foreach($da_sellers as $sellers)
                    <tr>
                        <td>{{$sellers->name}}</td>
                        <td>{{$sellers->phone_number}}</td>
                        <td>{{$sellers->email}}</td>
                        <td>{{$sellers->area}}</td>
                        <td>{{$sellers->status}}</td>
                        <td>
                            @if($sellers->status_id == 1 || is_null($sellers->status_id))
                            <form method="post" action="{{route('update-seller-status')}}">
                                @csrf
                                <input type="hidden" name="id" value="{{$sellers->id}}">
                                <input type="hidden" name="status" value="1">
                                <button type="submit" class='fas fa-check tooltip' style="font-size: 24px;"
                                        data-toggle="tooltip" data-placement="top" title="approveitem"
                                ><span class="tooltiptext">Activate User</span></button>
                            </form>
                            @endif
                                @if($sellers->status_id == 2)
                            <form method="post" action="{{route('update-seller-status')}}">
                                @csrf
                                <input type="hidden" name="id" value="{{$sellers->id}}">
                                <input type="hidden" name="status" value="2">
                                <button type="submit" class='fas fa-xmark-to-slot tooltip' style="font-size: 24px;"
                                        data-toggle="tooltip" data-placement="top" title="Deactivate"
                                ><span class="tooltiptext">Deactivate user</span></button>
                            </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
                </center>
                </table>
            </div>
        </div>


</div>

</body>
@endsection
