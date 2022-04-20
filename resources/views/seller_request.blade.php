@extends("layouts.master")
@section('css')
    <link rel="stylesheet" href="{{asset('css/seller_itemList.css')}}">
    @parent
@endsection
@section("title")
    Drop Zone | SELLER REQUEST
@endsection

@section("content")
    <div class="container-fluid">

        <h2>REQUESTS LIST</h2>

        <div class="row" style=" margin-top: 40px;">
            <div class="col-sm-3">
                <div class="input-group mb-3">
                    <input type="text" class="form-control input-text" id="myInput" placeholder="Search....">
                </div>
            </div>


            <!------ REQUEST BUTTON ------------------>
            <div class="col-sm-5 mb-3" style="padding-top: 0px;">
                <button class="addNew btn btn-outline-warning" id="addNew" style="color: white;" data-toggle="modal"
                        data-target="#request">REQUEST
                </button>
            </div>

            <!---------------------- REQUEST MODAL------------------------->
            <div class="modal" id="request">
                <div class="modal-dialog  modal-xl">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title" style="color:#222222;">Write a Request</h4>
                            <button type="button" class="btn-close" data-dismiss="modal"></button>
                        </div>

                        <!-- Modal body -->
                        <form method="post" action="{{route('add-request')}}">
                            <div class="modal-body">

                                <div class="row" style="margin-left: 5px;">
                                    <div class="col-sm-6 mb-3">
                                        {{csrf_field()}}
                                        <label id="">Category</label><br>
                                        <select value="" name="category" id="category">
                                            <option disabled selected value> -- select category --</option>
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select><br>

                                        <label id="">Seller</label><br>
                                        <select value="" name="seller_id" id="paid">
                                            <option disabled selected value> -- buyer --</option>
                                            @foreach($sellers as $seller)
                                                <option value="{{$seller->id}}">{{$seller->name}}</option>
                                            @endforeach
                                        </select>

                                        <label id="">ContactNo.</label><br>
                                        <input type="text" placeholder="" name="contact_no"><br>
                                    </div>


                                    <div class="col-sm-6 mb-3">
                                        <label id="">Request</label><br>
                                        <input type="text" placeholder="" name="itemRequest">

                                        <label id="">Location</label><br>
                                        <select value="" name="location" id="itemOrigin">
                                            <option disabled selected value> -- select location --</option>
                                            @foreach($location as $area)
                                                <option value="{{$area->id}}">{{$area->area}}</option>
                                            @endforeach
                                        </select> <br>
                                    </div>


                                </div>


                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Discard</button>

                                    <button type="submit" class="btn btn-success">Request</button>
                                </div>
                        </form>
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
                            <th scope="col" width="8%">ReqID</th>
                            <th scope="col" width="8%">Date</th>
                            <th scope="col" width="7%">Category</th>
                            <th scope="col" width="10%">Seller</th>
                            <th scope="col" width="10%">ContactNo</th>
                            <th scope="col" width="14%">Request</th>
                            <th scope="col" width="14%">Location</th>
                            <th scope="col" width="3%">Fee</th>
                            <th scope="col" width="5%">Status</th>
                        </tr>
                        </thead>

                        <tbody id="myTable">
                        @foreach($request_lists as $request)
                            <tr>
                                <td>
                                    @if($request->id)
                                        {{$request->id}}
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>
                                    @if($request->date)
                                        {{$request->date}}
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>
                                    @if($request->category)
                                        {{$request->category}}
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>
                                    @if($request->name)
                                        {{$request->name}}
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>
                                    @if($request->contact_no)
                                        {{$request->contact_no}}
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>
                                    @if($request->request)
                                        {{$request->request}}
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>
                                    @if($request->location)
                                        {{$request->location}}
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>
                                    @if($request->fee)
                                        {{$request->fee}}
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>
                                    @if($request->status)
                                        {{$request->status}}
                                    @else
                                        N/A
                                    @endif
                                </td>
                            </tr>
                        @endforeach


                        <tr>
                            <td>KDS-253</td>
                            <td>03-18-2022</td>
                            <td>Pick-up</td>
                            <td>Gracie</td>
                            <td>09****</td>
                            <td>Pick up 24 items.</td>
                            <td>SFC</td>
                            <td>20</td>
                            <td>Approved</td>
                        </tr>
                        </tbody>
                    </center>
                </table>
            </div>
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
    @parent
@endsection
