@extends("layouts.master")
@section('css')
    <link rel="stylesheet" href="{{asset('css/seller_itemList.css')}}">
    <link rel="stylesheet" href="{{asset('css/da_itemList.css')}}">
    @parent
@endsection
@section("title")
    Drop Zone | Dashboard
@endsection

@section("content")
    @include('popper::assets')
    <div class="container-fluid">
        @if(auth()->user()->hasRole('Admin'))
            <h2>ADMIN SELLER'S ITEM LIST</h2>
        @elseif(auth()->user()->hasRole('da'))
            <h2>Dropping area SELLER'S ITEM LIST</h2>
        @else
            <h2>SELLER'S ITEM LIST</h2>
        @endif

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
                        <form method="post" action="{{route('add-item')}}">
                            <div class="modal-body">
                                <div class="row" style="margin-left: 5px;">
                                    <div class="col-sm-6 mb-3">
                                        {{csrf_field()}}
                                        <label id="">Seller</label>
                                        <select value="" name="seller_id" id="paid">
                                            <option disabled selected value> -- seller --</option>
                                            @foreach($sellers as $seller)
                                                <option value="{{$seller->id}}">{{$seller->name}}</option>
                                            @endforeach
                                        </select>

                                        <label id="">Buyer</label>
                                        <select value="" name="buyer_id" id="paid">
                                            <option disabled selected value> -- buyer --</option>
                                            @foreach($buyers as $buyer)
                                                <option value="{{$buyer->id}}">{{$buyer->name}}</option>
                                            @endforeach
                                        </select>

                                        <label id="">Paid</label>
                                        <select value="" name="payment_status_id" id="paid">
                                            <option disabled selected value> -- paid/unpaid --</option>
                                            @foreach($paid_statuses as $status)
                                                <option value="{{$status->id}}">{{$status->status}}</option>
                                            @endforeach
                                        </select>
                                    </div>


                                    <div class="col-sm-6 mb-3">
                                        @if(auth()->user()->hasRole('Admin') || auth()->user()->hasRole('seller'))
                                        <label id="">Origin</label><br>
                                        <select value="" name="origin_id" id="itemOrigin">
                                            <option disabled selected value> -- select origin --</option>
                                            @foreach($location as $area)
                                                <option value="{{$area->id}}">{{$area->area}}</option>
                                            @endforeach
                                        </select> <br>
                                        @endif

                                        <label id="" style="margin-top: 20px;">Destination </label><br>
                                        <select value="" name="destination_id" id="itemDesti">
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
                                        <input style="color:#222222;" type="text" placeholder="₱100.00" name="amount">
                                    </div>

                                </div>

                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Discard
                                    </button>

                                    <button type="submit" class="btn btn-success">Create
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @if(auth()->user()->hasRole('Admin'))
            <!---------------------- UPDATE/EDIT ITEM MODAL------------------------->
                <div class="modal" id="editItem">
                    <div class="modal-dialog  modal-lg">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title" style="color:#222222;">Update Item</h4>
                                <button type="button" class="btn-close" data-dismiss="modal"></button>
                            </div>

                            <!-- Modal body -->
                            <form>
                                <div class="modal-body">
                                    <div class="row" style="margin-left: 5px;">
                                        <div class="col-sm-4 mb-3">
                                            <label id="" style="font-size: 18px;">Code</label><br>
                                            <input readonly type="text" placeholder=""><br>

                                            <label id="">Buyer</label><br>
                                            <input readonly type="text" placeholder=""><br>

                                            <label id="">Seller</label><br>
                                            <input readonly type="text" placeholder=""><br>

                                        </div>


                                        <div class="col-sm-4 mb-3">

                                            <label id="">Amount</label><br>
                                            <input id="status" readonly type="text" placeholder=""><br>

                                            <label id="" style="font-size: 18px;">Status</label>
                                            <select value="" name="status" id="status">
                                                <option disabled selected value> -- select status --</option>
                                                <option value="claimed">Claimed</option>
                                                <option value="intransit">In-Transit</option>
                                                <option value="pullout">Pull-Out</option>
                                                <option value="ready">Ready</option>
                                                <option value="transfered">Transfered</option>
                                            </select><br>

                                            <label id="" style="font-size: 18px;margin-top: 19px;"> Claimed Date</label><br>
                                            <input type="date" placeholder=""><br>

                                        </div>

                                        <div class="col-sm-4 mb-3">

                                            <label id="" style="font-size: 18px;margin-top: 19px;"> Released
                                                Date</label><br>
                                            <input type="date" placeholder=""><br>

                                            <label id="" style="font-size: 18px; ">Paid</label>
                                            <select value="" name="paid" id="paid">
                                                <option disabled selected value> -- paid/unpaid --</option>
                                                <option value="paid">Paid</option>
                                                <option value="unpaid">Unpaid</option>
                                            </select>


                                            <label id="" style="font-size: 18px; margin-top: 19px;">Approval</label><br>

                                            <select value="" name="approval" id="approval">
                                                <option disabled selected value> -- approved/pending --</option>
                                                <option value="approved">Approved</option>
                                                <option value="pending">Pending</option>
                                            </select>

                                        </div>

                                    </div>


                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Discard
                                        </button>

                                        <button type="button" class="btn btn-success" data-bs-dismiss="modal">Update
                                        </button>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
        @endif
        <!---------------------- GENERATE QR MODAL------------------------->
            <div class="modal" id="generateQr">
                <div class="modal-dialog  modal-lg">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-dismiss="modal"></button>
                        </div>

                        <!-- Modal body -->
                        <img id="modalImage" src="" style="width: 100%;
  height: auto;">


                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <a id="downloadQr" class="btn btn-success" href="" download>Download</a>
                            {{--                                <button id="downloadQr" data-code="" type="button" class="btn btn-success" data-dismiss="modal">Download</button>--}}
                        </div>

                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>

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
                        <th scope="col" width="5%">Origin</th>
                        <th scope="col" width="5%">Destination</th>
                        <th scope="col" width="3%">TH/HF</th>
                        <th scope="col" width="5%">Amount</th>
                        <th scope="col" width="7%">Payment</th>
                        <th scope="col" width="5%">Status</th>
                        <th scope="col" width="5%">Current Location</th>
                        <th scope="col" width="5%">Claimed Date</th>
                        <th scope="col" width="5%">Released Date</th>
                        <th scope="col" width="5%">Approval</th>
                        <th scope="col" width="27%">Action</th>
                    </tr>
                    </thead>

                    <tbody id="myTable">
                    @foreach($items as $item)
                        <tr>
                            <td>
                                @if($item->code)
                                    {{$item->code}}
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>
                                @if($item->drop_date)
                                    {{$item->drop_date}}
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>
                                @if($item->seller)
                                    {{$item->seller}}
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>
                                @if($item->buyer)
                                    {{$item->buyer}}
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>
                                @if($item->origin)
                                    {{$item->origin}}
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>
                                @if($item->destination)
                                    {{$item->destination}}
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>
                                @if($item->fee)
                                    {{$item->fee}}
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>
                                @if($item->amount)
                                    {{$item->amount}}
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>
                                @if($item->payment_status)
                                    {{$item->payment_status}}
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>
                                @if($item->status)
                                    {{$item->status}}
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>
                                @if($item->current_location)
                                    {{$item->current_location}}
                                @else
                                    In-Transit
                                @endif
                            </td>
                            <td>
                                @if($item->claimed_date)
                                    {{$item->claimed_date}}
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>
                                @if($item->release_date)
                                    {{$item->release_date}}
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>
                                @if($item->approval_status)
                                    {{$item->approval_status}}
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>
                                @if($item->approval_status_id == 2) {{--if item status is pending show approve button--}}
                                {{--approve item--}}
                                <form method="post" action="{{route('update-item-status')}}">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$item->id}}">
                                    <input type="hidden" name="status" value="1">
                                    <button type="submit" class='fas fa-thumbs-up' style="font-size: 24px;"
                                            data-toggle="tooltip" data-placement="top" title="approveitem"
                                    ></button>
                                </form>
                                @elseif($item->status_id!==3) {{--if item status is not pull out show buttons--}}
                                @if(is_null($item->status_id) && $da_loc!==$item->destination_id){{--if item status is null show ready and intransit button--}}
                                {{--transfer item--}}
                                <form method="post" action="{{route('update-item-status')}}">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$item->id}}">
                                    <input type="hidden" name="status" value="2">
                                    <button type="submit" class='fas fa-truck' style="font-size: 24px;"
                                            data-toggle="tooltip" data-placement="top" title="transfer item"
                                    ></button>
                                </form>
                                @endif
                                @if(is_null($item->status_id) || $item->status_id==5){{--if item status is not pull or item status is transffered--}}
                                {{--ready item--}}
                                <form method="post" action="{{route('update-item-status')}}">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$item->id}}">
                                    <input type="hidden" name="status" value="3">
                                    <button type="submit" class='fas fa-clipboard-check' style="font-size: 24px;"
                                            data-toggle="tooltip" data-placement="top" title="ready item"
                                    ></button>
                                </form>
                                @else
                                    @if($item->status_id==2 && is_null($item->current_location_id) &&  $da_loc==$item->destination_id)
                                        {{--transferred item--}}
                                        <form method="post" action="{{route('update-item-status')}}">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$item->id}}">
                                            <input type="hidden" name="status" value="4">
                                            <button type="submit" class='fas fa-arrow-down' style="font-size: 24px;"
                                                    data-toggle="tooltip" data-placement="top" title="receive item"
                                            ></button>
                                        </form>
                                    @elseif($item->status_id==4)
                                        @if($item->payment_status_id ==2)
                                            {{--paid item--}}
                                            <form method="post" action="{{route('update-item-status')}}">
                                                @csrf
                                                <input type="hidden" name="id" value="{{$item->id}}">
                                                <input type="hidden" name="status" value="5">
                                                <button type="submit" class='fas fa-file-invoice-dollar'
                                                        style="font-size: 24px;"
                                                        data-toggle="tooltip" data-placement="top" title="Pay item"
                                                ></button>
                                            </form>
                                        @else
                                            {{--claim item--}}
                                            <form method="post" action="{{route('update-item-status')}}">
                                                @csrf
                                                <input type="hidden" name="id" value="{{$item->id}}">
                                                <input type="hidden" name="status" value="6">
                                                <button type="submit" class='fas fa-box-check'
                                                        style="font-size: 24px;"
                                                        data-toggle="tooltip" data-placement="top" title="Claim item"
                                                ></i></button>
                                            </form>
                                        @endif
                                    @elseif($item->status_id == 1)
                                        {{--release item--}}
                                        <form method="post" action="{{route('update-item-status')}}">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$item->id}}">
                                            <input type="hidden" name="status" value="8">
                                            <button type="submit" class='fas fa-inbox-out'
                                                    style="font-size: 24px;"
                                                    data-toggle="tooltip" data-placement="top" title="Release item"
                                            ></button>
                                        </form>
                                    @endif
                                @endif
                                @if($item->status_id !== 3 && $item->status_id !== 6)
                                    {{--pull out item--}}
                                    <form method="post" action="{{route('update-item-status')}}">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$item->id}}">
                                        <input type="hidden" name="status" value="7">
                                        <button type="submit" class='fas fa-arrow-right-from-bracket'
                                                style="font-size: 24px;"
                                                data-toggle="tooltip" data-placement="top" title="Pull Out item"
                                        ></button>
                                    </form>
                                @if(auth()->user()->hasPermissionTo('item-show-qr'))
                                    <a class='fas fa-qrcode'
                                       style="font-size: 24px;"
                                       data-toggle="modal"
                                       data-target="#generateQr"
                                       data-code="{{$item->code}}"
                                       data-toggle="tooltip" data-placement="top" title="Show item QR code"
                                    ></a>
                                @endif
                                @endif
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
@section('javascript')
    <script>
        $(document).ready(function () {
            $("#myInput").on("keyup", function () {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });

            $('#editItem').on('shown.bs.modal', function (e) {
                let link = e.relatedTarget,
                    modal = $(this),
                    id = $(link).data("id"),
                    amount = $(link).data("amount"),
                    status = $(link).data("status");
                modal.find("#status").val(status);
            });

            $('#generateQr').on('shown.bs.modal', function (e) {
                let link = e.relatedTarget,
                    modal = $(this),
                    code = $(link).data("code");
                img = "{{asset('storage/qr_codes/')}}" + '/' + code + '.png';
                $('#downloadQr').attr("href", img);
                document.getElementById('modalImage').src = img;
            });
        });

    </script>
    @parent
@endsection