@extends("layouts.master")
@section('css')
    <link rel="stylesheet" href="{{asset('css/seller_itemList.css')}}">
    <link rel="stylesheet" href="{{asset('css/da_itemList.css')}}">
    @parent
@endsection
@section("title")
    Drop Zone | Cashout
@endsection

@section("content")
<div class="container-fluid">

    <h2>PAY-OUT LIST</h2>

    <div class="row" style=" margin-top: 40px;">
        <div class="col-sm-3">
            <div class="input-group mb-3">
                <input type="text" class="form-control input-text"  id="myInput" placeholder="Search....">

                <div class="input-group-append">

                </div>
            </div>
        </div>



        <!------ ADD NEW BUTTON ------------------>
        <div class="col-sm-5 mb-3" style="padding-top: 0px;">
            <button class="addNew btn btn-outline-warning" id="addNew" style="color: white;" data-bs-toggle="modal" data-bs-target="#addNewItem">Request for cashout</button>

        </div>



        <!------ DOWNLOAD AND PRINT BUTTON ------------------>
        <div class="col-sm-4 mb-3">

            <a class="downloadBtn" id="downloadBtn" style="color: white; margin-right: 3.5%;">
                <i class="bx bxs-cloud-download"></i>
            </a>

            <a class="printBtn" id="printBtn" style="color: white;">
                <i class="bx bx-printer"></i>
            </a>

        </div>


        <!---------------------- ADD ITEM MODAL------------------->
        <div class="modal" id="addNewItem">
            <div class="modal-dialog  modal-md">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title" style="color:#222222;">Add Pay-out </h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Modal body -->
                    <form>
                        <div class="modal-body">
                            <div class="row" style="margin-left: 5px;">
                                <div class="col-sm-12 mb-3">
                                    <label id="" style="font-size: 18px;">Code</label><br>
                                    <input type="text" placeholder=""><br>

                                    <label id="" >Date</label><br>
                                    <input type="date" placeholder=""><br>

                                    <label id="">Seller Name</label><br>
                                    <input type="text" placeholder=""><br>

                                    <label id="">Amount</label><br>
                                    <input type="text" placeholder=""><br>
                                </div>


                            </div>
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Discard</button>

                            <button type="button" class="btn btn-success" data-bs-dismiss="modal">Create</button>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>


    <!---------------------- UPDATE/EDIT ITEM MODAL------------------------->
    <div class="modal" id="editItem">
        <div class="modal-dialog  modal-lg">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title" style="color:#222222;">Update Info</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <form>

                    <label id="" style="font-size: 18px;">Status</label>
                    <select value="" name="status" id="status">
                        <option disabled selected value> -- select status -- </option>
                        <option value="claimed">Processing</option>
                        <option value="intransit">Ready to Claim</option>
                        <option value="pullout">Released</option>
                    </select><br>




                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Discard</button>

                        <button type="button" class="btn btn-success" data-bs-dismiss="modal">Update</button>
                    </div>

            </div>
            </form>
        </div>
    </div>
</div>


<!------------------------ TABLE / This must be sorted by date.  ------------------------>
<div class="row" style="margin-top: 2%; color: white;">
    <div class="table-responsive">
        <table class="table table-responsive table-border" >
            <center>
                <thead>
                <tr class="tHead">

                    <th scope="col" >Pay-out Code</th>
                    <th scope="col" >Date</th>
                    <th scope="col" >Seller</th>
                    <th scope="col" >Amount</th>
                    <th scope="col" >Status</th>
                    <th scope="col" >Action</th>
                </tr>
                </thead>

                <tbody id="myTable">

                <tr>
                    <td>KDS-253</td>
                    <td>03-18-2022</td>
                    <td>Heather Calica</td>
                    <td>200</td>
                    <td>Claimed</td>
                    <td>
                        <i class="bx bx-edit" type="button" data-bs-toggle="modal" data-bs-target="#editItem"></i>
                    </td>
                </tr>

                </tbody>
            </center>
        </table>
    </div>
</div>


</div>
@endsection
