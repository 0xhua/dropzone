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
        <h2 style="font-size: 32px;">
            @if(auth()->user()->hasRole('Admin'))
                ADMIN SELLER'S ITEM LIST
            @elseif(auth()->user()->hasRole('da'))
                Dropping area SELLER'S ITEM LIST
            @else
                SELLER'S ITEM LIST
            @endif
        </h2>
        <div class="row" style=" margin-top: 40px;">
            <div class="col-sm-3">
                <form action="{{route('itemlist')}}" method="get">
                    <div class="input-group mb-3">
                        {{@csrf_field()}}
                        <input name="search" type="text" class="form-control input-text" id="myInput"
                               placeholder="Search....">
                        <button class="addNew btn btn-outline-warning" type="submit">Search
                        </button>
                    </div>
                </form>
            </div>

            <!------ ADD NEW BUTTON ------------------>
            <div class="col-sm-5 mb-3" style="padding-top: 0px;">
                @if(auth()->user()->hasRole('seller'))
                    <button class="addNew btn btn-outline-warning" id="addNew" style="color: white;" data-toggle="modal"
                            data-target="#addNewItem">Add Item
                    </button>
                @endif
                <form action="{{route('itemlist')}}" method="get">
                    {{@csrf_field()}}
                    @if(!$show_released)
                        <input name="released" type="hidden" value="1">
                        <button class="addNew btn btn-outline-warning" id="addNew" style="color: white;">Show released
                        </button>
                    @else
                        <button class="addNew btn btn-outline-warning" id="addNew" style="color: white;">Show all
                        </button>
                    @endif

                </form>

            </div>

            <div class="col-sm-4 mb-3">
                <form action="{{route('export_excel.itemlist')}}" method="get">
                    <button type="submit" class="printBtn" id="printBtn" style="color: white;" data-bs-toggle="modal"
                            data-bs-target="#printInfo">
                        <i class="bx bxs-cloud-download"></i>
                    </button>
                </form>
            </div>

            <!---------------------- ADD ITEM MODAL------------------->
            <div class="modal" id="addNewItem">
                <div class="modal-dialog  modal-md">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        @if(!auth()->user()->hasRole('seller'))
                            <div class="modal-header">
                                <h4 class="modal-title" style="color:#222222;">Add Item</h4>
                                <button type="button" class="btn-close" data-dismiss="modal"></button>
                            </div>
                    @endif
                    <!-- Modal body -->
                        <form method="post" action="{{route('add-item')}}">
                            <div class="modal-body">
                                <div class="row" style="margin-left: 5px;">
                                    <div class="col-sm-6 mb-3">
                                        {{csrf_field()}}
                                        @if(!auth()->user()->hasRole('seller'))
                                            <label id="">Seller</label>


                                            <select value="" name="seller_id" id="paid" required>
                                                <option disabled selected value> -- seller --</option>
                                                @foreach($sellers as $seller)
                                                    <option value="{{$seller->id}}">{{$seller->name}}</option>
                                                @endforeach
                                            </select>
                                        @endif
                                        <label id="">Buyer</label>
                                        <select value="" name="buyer_id" id="paid" required>
                                            <option disabled selected value> -- buyer --</option>
                                            @foreach($buyers as $buyer)
                                                <option value="{{$buyer->id}}">{{$buyer->name}}</option>
                                            @endforeach
                                        </select>

                                        <label id="">Paid</label>
                                        <select value="" name="payment_status_id" id="paid" required>
                                            <option disabled selected value> -- paid/unpaid --</option>
                                            @foreach($paid_statuses as $status)
                                                <option value="{{$status->id}}">{{$status->status}}</option>
                                            @endforeach
                                        </select>
                                    </div>


                                    <div class="col-sm-6 mb-3">
                                        {{--                                        @if(auth()->user()->hasRole('Admin') || auth()->user()->hasRole('seller'))--}}
                                        {{--                                            <label id="">Origin</label><br>--}}
                                        {{--                                            <select value="" name="origin_id" id="itemOrigin" required>--}}
                                        {{--                                                <option disabled selected value> -- select origin --</option>--}}
                                        {{--                                                @foreach($location as $area)--}}
                                        {{--                                                    <option value="{{$area->id}}">{{$area->area}}</option>--}}
                                        {{--                                                @endforeach--}}
                                        {{--                                            </select> <br>--}}
                                        {{--                                        @endif--}}

                                        <label id="" style="margin-top: 20px;">Destination </label><br>
                                        <select value="" name="destination_id" id="itemDesti" required>
                                            <option disabled selected value> -- select destination --</option>
                                            @foreach($location as $area)
                                                <option value="{{$area->id}}">{{$area->area}}</option>
                                            @endforeach
                                        </select> <br>

                                        <label id="" style="margin-top: 20px;">Item Size</label><br>
                                        <select value="" name="itemSize" id="itemSize" required>
                                            <option disabled selected value> -- select size --</option>
                                            @foreach($sizes as $size)
                                                <option value="{{$size->id}}">{{$size->size}}</option>
                                            @endforeach
                                        </select>
                                        <br>

                                        <label id="" style="margin-top: 20px;"> Item Amount</label><br>
                                        <input style="color:#222222;" type="text" placeholder="₱100.00" name="amount"
                                               required>
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
        @if(auth()->user()->hasRole('seller'))

            <!---------------------- UPDATE/EDIT ITEM MODAL------------------------->
                <div class="modal" id="editItem">
                    <div class="modal-dialog  modal-lg">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title" style="color:#222222;">Update Item</h4>
                                <button type="hidden" class="btn-close" data-dismiss="modal"></button>
                            </div>

                            <!-- Modal body -->
                            <form action="{{route('update-item')}}" method="post">
                                {{csrf_field()}}
                                <input type="hidden" name="id" id="id" value="">
                                <div class="modal-body">
                                    <div class="row" style="margin-left: 5px;">
                                        <div class="col-sm-6 mb-3">
                                            <label id="">Buyer</label>
                                            <select value="" name="buyer_id" id="paid">
                                                <option disabled selected value> -- buyer --</option>
                                                @foreach($buyers as $buyer)
                                                    <option value="{{$buyer->id}}">{{$buyer->name}}</option>
                                                @endforeach
                                            </select>
                                            <label id="">Destination</label><br>
                                            <select value="" name="destination_id" id="itemDesti">
                                                <option disabled selected value> -- select destination --</option>
                                                @foreach($location as $area)
                                                    <option value="{{$area->id}}">{{$area->area}}</option>
                                                @endforeach
                                            </select>
                                            <br>
                                        </div>
                                        <div class="col-sm-6 mb-3">
                                            <label id="">Amount</label><br>
                                            <input style="color:#222222;" type="text" placeholder="" id="amount"
                                                   name="amount"><br>
                                            <label id="">Payment Status</label><br>
                                            <select value="" name="payment_status_id" id="paid">
                                                <option disabled selected value> -- paid/unpaid --</option>
                                                @foreach($paid_statuses as $status)
                                                    <option value="{{$status->id}}">{{$status->status}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>


                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Discard
                                        </button>

                                        <button type="submit" class="btn btn-success" data-bs-dismiss="modal">Update
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
                        <th scope="col" width="8%">DropDate</th>
                        <th scope="col" width="10%">Seller</th>
                        <th scope="col" width="10%">Buyer</th>
                        <th scope="col" width="5%">Origin</th>
                        <th scope="col" width="5%">Destination</th>
                        {{--                        <th scope="col" width="3%">TH/HF</th>--}}
                        <th scope="col" width="3%">DF</th>
                        <th scope="col" width="3%">TF</th>
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
                        @if($item->status_id !== 6 || $show_released)
                            {{--                            @if(auth()->user()->location_id ==)--}}
                            <tr>
                                <td>
                                    @if($item->code)
                                        {{$item->code}}
                                    @else
                                        - - -
                                    @endif
                                </td>
                                <td>
                                    @if($item->drop_date)
                                        {{$item->drop_date}}
                                    @else
                                        - - -
                                    @endif
                                </td>
                                <td>
                                    @if($item->seller)
                                        {{$item->seller}}
                                    @else
                                        - - -
                                    @endif
                                </td>
                                <td>
                                    @if($item->buyer)
                                        {{$item->buyer}}
                                    @else
                                        - - -
                                    @endif
                                </td>
                                <td>
                                    @if($item->origin)
                                        {{$item->origin}}
                                    @else
                                        - - -
                                    @endif
                                </td>
                                <td>
                                    @if($item->destination)
                                        {{$item->destination}}
                                    @else
                                        - - -
                                    @endif
                                </td>
                                {{--                                <td>--}}
                                {{--                                    @if($item->fee)--}}
                                {{--                                        {{$item->fee}}--}}
                                {{--                                    @else--}}
                                {{--                                        - - ---}}
                                {{--                                    @endif--}}
                                {{--                                </td>--}}
                                <td>
                                    @if($item->df)
                                        {{$item->df}}
                                    @else
                                        - - -
                                    @endif
                                </td>
                                <td>
                                    @if($item->tf)
                                        {{$item->tf}}
                                    @else
                                        0
                                    @endif
                                </td>
                                <td>
                                    @if($item->amount)
                                        {{$item->amount}}
                                    @else
                                        0
                                    @endif
                                </td>
                                <td>
                                    @if($item->payment_status)
                                        {{$item->payment_status}}
                                    @else
                                        - - -
                                    @endif
                                </td>
                                <td>
                                    @if($item->status)
                                        {{$item->status}}
                                    @else
                                        - - -
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
                                        - - -
                                    @endif
                                </td>
                                <td>
                                    @if($item->release_date)
                                        {{$item->release_date}}
                                    @else
                                        - - -
                                    @endif
                                </td>
                                <td>
                                    @if($item->approval_status)
                                        {{$item->approval_status}}
                                    @else
                                        - - -
                                    @endif
                                </td>
                                <td>
                                    @if(auth()->user()->hasRole('seller'))
                                        @if(is_null($item->status_id))
                                            <button class='fas fa-pen-to-square tooltip' style="font-size: 24px;"
                                                    data-id="{{$item->id}}"
                                                    data-buyer="{{$item->buyer}}"
                                                    data-d="{{$item->destination}}"
                                                    data-amount="{{$item->amount}}"
                                                    data-p_id="{{$item->payment_status_id}}"
                                                    data-toggle="modal"
                                                    data-target="#editItem"
                                            >  <span class="tooltiptext">Edit Item</span></button>
                                        @endif
                                        @if($item->payment_status_id==2 && $item->approval_status_id == 1 && $item->status_id !== 3)
                                                <form method="post" action="{{route('update-item-status')}}">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{$item->id}}">
                                                    <input type="hidden" name="status" value="11">
                                                    <button type="submit" class='fas fa-g tooltip tooltip' style="font-size: 24px;"
                                                            data-toggle="tooltip" data-placement="top" title="Pay item via gcash"
                                                    ><span class="tooltiptext">Pay item via gcash</span></button>
                                                </form>
                                        @endif
                                    @endif
                                    @if(auth()->user()->hasRole(['Admin','da']))
                                        @if($item->approval_status_id == 2 && $item->origin_id == $da_loc) {{--if item status is pending show approve button--}}
                                        {{--approve item--}}
                                        <form method="post" action="{{route('update-item-status')}}">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$item->id}}">
                                            <input type="hidden" name="status" value="1">
                                            <button type="submit" class='fas fa-thumbs-up tooltip' style="font-size: 24px;"
                                                    data-toggle="tooltip" data-placement="top" title="approveitem"
                                            ><span class="tooltiptext">Approve Item</span></button>
                                        </form>
                                        @elseif($item->status_id!==3) {{--if item status is not pull out show buttons--}}
                                        @if((is_null($item->status_id)
                                            && $da_loc!==$item->destination_id)
                                            || ($item->status_id == 8 && $item->origin_id != $item->destination_id)
                                            ){{--if item status is null show ready and intransit button--}}
                                        {{--transfer item--}}
                                        <form method="post" action="{{route('update-item-status')}}">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$item->id}}">
                                            <input type="hidden" name="status" value="2">
                                            <button type="submit" class='fas fa-truck tooltip' style="font-size: 24px;"
                                                    data-toggle="tooltip" data-placement="top" title="transfer item"
                                            ><span class="tooltiptext">Transfer item</span></button>
                                        </form>
                                        @endif
                                        @if($item->approval_status_id == 1
                                            && in_array($item->status_id,array(5,null))
                                            && $item->destination_id == $da_loc
                                            && $item->current_location_id == $da_loc
                                            ){{--if item status is not pull or item status is transffered--}}
                                        {{--ready item--}}
                                        <form method="post" action="{{route('update-item-status')}}">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$item->id}}">
                                            <input type="hidden" name="status" value="3">
                                            <button type="submit" class='fas fa-clipboard-check tooltip'
                                                    style="font-size: 24px;"
                                                    data-toggle="tooltip" data-placement="top" title="ready item"
                                            ><span class="tooltiptext">Ready Item</span></button>
                                        </form>
                                        @else
                                            @if(($item->status_id==2 && $da_loc==$item->destination_id && is_null($item->pull_out_status_id)) || ($item->status_id==2 && !is_null($item->pull_out_status_id) && $da_loc==$item->origin_id))
                                                {{--transferred item--}}
                                                <form method="post" action="{{route('update-item-status')}}">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{$item->id}}">
                                                    <input type="hidden" name="status" value="4">
                                                    <button type="submit" class='fas fa-arrow-down tooltip'
                                                            style="font-size: 24px;"
                                                            data-toggle="tooltip" data-placement="top"
                                                            title="receive item"
                                                    ><span class="tooltiptext">Receive item</span></button>
                                                </form>
                                            @elseif($item->status_id==4 && $item->destination_id == $da_loc)
                                                @if($item->payment_status_id ==2)
                                                    {{--paid item--}}
                                                    <form method="post" action="{{route('update-item-status')}}">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{$item->id}}">
                                                        <input type="hidden" name="status" value="5">
                                                        <button type="submit" class='fas fa-file-invoice-dollar tooltip'
                                                                style="font-size: 24px;"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Pay item"
                                                        ><span class="tooltiptext">Pay item</span></button>
                                                    </form>
                                                @else
                                                    {{--claim item--}}
                                                    <form method="post" action="{{route('update-item-status')}}">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{$item->id}}">
                                                        <input type="hidden" name="status" value="6">
                                                        <button type="submit" class='fas fa-box-check tooltip'
                                                                style="font-size: 24px;"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Claim item"
                                                        ></i><span class="tooltiptext">Claim item</span></button>
                                                    </form>
                                                @endif
                                            @elseif($item->status_id == 1)
                                                {{--release item--}}
                                                <form method="post" action="{{route('update-item-status')}}">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{$item->id}}">
                                                    <input type="hidden" name="status" value="8">
                                                    <button type="submit" class='fas fa-inbox-out tooltip'
                                                            style="font-size: 24px;"
                                                            data-toggle="tooltip" data-placement="top"
                                                            title="Release item"
                                                    ><span class="tooltiptext">Release item</span></button>
                                                </form>
                                            @endif
                                        @endif
                                        @if($item->approval_status_id == 1
                                            && !in_array($item->status_id,[3,6,1,NULL])
                                            && $item->destination_id == $da_loc
                                            && $item->current_location_id == $da_loc
                                            && is_null($item->pull_out_status_id)
                                            )
                                            {{--pull out item--}}
                                            <form method="post" action="{{route('update-item-status')}}">
                                                @csrf
                                                <input type="hidden" name="id" value="{{$item->id}}">
                                                <input type="hidden" name="status" value="7">
                                                <button type="submit" class='fas fa-arrow-right-from-bracket tooltip'
                                                        style="font-size: 24px;"
                                                        data-toggle="tooltip" data-placement="top" title="Pull Out item"
                                                ><span class="tooltiptext">Pull Out item</span></button>
                                            </form>
                                        @endif
                                        @if($item->pull_out_status_id ==3 ||($item->pull_out_status_id ==1 && $item->destination_id == $item->origin_id))
                                            <form method="post" action="{{route('update-item-status')}}">
                                                @csrf
                                                <input type="hidden" name="id" value="{{$item->id}}">
                                                <input type="hidden" name="status" value="9">
                                                <button type="submit" class='fa-solid fa-right-from-bracket tooltip'
                                                        style="font-size: 24px;"
                                                        data-toggle="tooltip" data-placement="top" title="Pull Out item"
                                                ><span class="tooltiptext">Pull Out item</span></button>
                                            </form>
                                        @endif
                                        @endif
                                    @endif
                                    @if(auth()->user()->hasPermissionTo('item-show-qr') && $item->approval_status_id == 1)
                                        <a class='fas fa-qrcode tooltip'
                                           style="font-size: 24px;"
                                           data-toggle="modal"
                                           data-target="#generateQr"
                                           data-code="{{$item->code}}"
                                           data-toggle="tooltip" data-placement="top" title="Show item QR code"
                                        ><span class="tooltiptext">Show item QR code</span></a>
                                    @endif
                                </td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </center>
            </table>
        </div>
    </div>

    {!! $items->render() !!}
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
                    buyer = $(link).data("buyer"),
                    amount = $(link).data("amount"),
                    d = $(link).data("d"),
                    p_id = $(link).data("p_id"),
                    status = $(link).data("status");
                modal.find("#amount").val(amount);
                modal.find("#id").val(id);
            });

            $('#generateQr').on('shown.bs.modal', function (e) {
                let link = e.relatedTarget,
                    modal = $(this),
                    code = $(link).data("code");
                img = "{{asset('storage/qr_codes/')}}" + '/' + code + '.jpeg';
                $('#downloadQr').attr("href", img);
                document.getElementById('modalImage').src = img;
            });
        });

    </script>
    @parent
@endsection
