@extends("layouts.master")
@section('css')
    <link rel="stylesheet" href="{{asset('css/seller_itemList.css')}}">
    @parent
@endsection
@section("title")
    Drop Zone | UserList
@endsection
@section('content')
    <div class="container-fluid">

        <h2>
            @if(auth()->user()->hasRole('Admin'))
                User List
            @elseif(auth()->user()->hasRole('seller'))
                Buyer List
            @endif
        </h2>

        <div class="row" style=" margin-top: 40px;">
            <div class="col-sm-3">
                <div class="input-group mb-3">
                    <input type="text" class="form-control input-text" id="myInput" placeholder="Search....">

                    <div class="input-group-append">
                        <button class="searchIcon btn btn-outline-warning btn-lg" style="color: white;">
                            <i class="bx bx-search"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!------ ADD NEW BUTTON ------------------>
            <div class="col-sm-5 mb-3" style="padding-top: 0px;">

                @if(auth()->user()->hasRole('Admin'))
                    <button class="addNew btn btn-outline-warning" id="addNew" style="color: white;" data-toggle="modal"
                            data-target="#addNewDA">
                        Add New DA
                    </button>
                @elseif(auth()->user()->hasRole('seller'))
                    <button class="addNew btn btn-outline-warning" id="addNew" style="color: white;" data-toggle="modal"
                            data-target="#addNewBuyer">
                        Add New Buyer
                    </button>
                @endif

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


            @if(auth()->user()->hasRole('Admin'))
                <div class="modal" id="addNewDA">
                    <div class="modal-dialog  modal-md">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title" style="color:#222222;">Add New DA</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <!-- Modal body -->
                            <form method="post" action="{{route('register-da')}}">
                                {{@csrf_field()}}
                                <div class="modal-body">
                                    <div class="row" style="margin-left: 5px;">

                                        <div class="col-sm-6 mb-3">
                                            <label id="">Name</label><br>
                                            <input style="color:#222222;" name="name" type="text" placeholder="" required><br>

                                            <label id="">Email</label><br>
                                            <input style="color:#222222;" name="email" type="text" placeholder="" required><br>

                                            <label id="">Password</label><br>
                                            <input style="color:#222222;" name="password" type="password" placeholder="" required><br>


                                        </div>


                                        <div class="col-sm-6 mb-3">
                                            <label id="">Contact Number</label><br>
                                            <input type="text" placeholder="" name="phone_number"><br>

                                            <label id="">Dropping Area</label>
                                            <select value="" name="location_id" id="paid" required>
                                                <option disabled selected value> -- Location --</option>
                                                @foreach($locations as $location)
                                                    <option value="{{$location->id}}">{{$location->area}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>

                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Discard
                                        </button>

                                        <button type="submit" class="btn btn-success" data-bs-dismiss="modal">Create
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @else
                <div class="modal" id="addNewBuyer">
                    <div class="modal-dialog  modal-md">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title" style="color:#222222;">Add New Buyer</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <!-- Modal body -->
                            <form method="post" action="{{route('register-buyer')}}">
                                {{csrf_field()}}
                                <div class="modal-body">
                                    <div class="row" style="margin-left: 5px;">

                                        <div class="col-sm-6 mb-3">
                                            <label id="">Name</label><br>
                                            <input style="color:#222222;" name="name" type="text" placeholder=""><br>

                                            <label id="">Location</label>
                                            <select value="" name="location_id" id="paid" required>
                                                <option disabled selected value> -- Location --</option>
                                                @foreach($locations as $location)
                                                    <option value="{{$location->id}}">{{$location->area}}</option>
                                                @endforeach
                                            </select>
                                        </div>


                                        <div class="col-sm-6 mb-3">
                                            <label id="">Contact Number</label><br>
                                            <input style="color:#222222;" type="text" placeholder="" name="phone_number"><br>

                                            <label id="">Email</label><br>
                                            <input style="color:#222222;" type="text" placeholder="" name="email"><br>
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
            {{--EDIT BUYER--}}
                <div class="modal" id="editBuyer">
                    <div class="modal-dialog  modal-md">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title" style="color:#222222;">Edit user</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <!-- Modal body -->
                            <form method="post" action="{{route('update-buyer')}}">
                                {{csrf_field()}}
                                <input type="hidden" name="id" id="id" value="">
                                <div class="modal-body">
                                    <div class="row" style="margin-left: 5px;">

                                        <div class="col-sm-6 mb-3">
                                            <label id="">Email</label><br>
                                            <input style="color:#222222;" id="email" name="email" type="text" placeholder="" value=""><br>

{{--                                            <label id="">Destination</label><br>--}}
{{--                                            <select value="" name="destination_id" id="itemDesti" >--}}
{{--                                                <option disabled selected value> -- select destination --</option>--}}
{{--                                                @foreach($location as $area)--}}
{{--                                                    <option value="{{$area->id}}">{{$area->area}}</option>--}}
{{--                                                @endforeach--}}
{{--                                            </select>--}}
                                        </div>


                                        <div class="col-sm-6 mb-3">
                                            <label id="">Phone Number</label><br>
                                            <input style="color:#222222;" id="phone" name="phone_no" type="text" placeholder=""><br>
                                        </div>

                                    </div>

                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Discard
                                        </button>

                                        <button type="submit" class="btn btn-success">Update
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endif

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


        <div class="row" style="margin-top: 2%; color: white;">
            <div class="table-responsive">
                <table class="table table-responsive table-border">
                    <center>

                        @if(auth()->user()->hasRole('Admin'))
                            <thead>
                            <tr class="tHead">
                                <th scope="col" width="5%">Name</th>
                                <th scope="col" width="5%">Email</th>
                                <th scope="col" width="5%">Contact No.</th>
                                <th scope="col" width="5%">Role</th>
                                <th scope="col" width="5%">Da ID</th>
                                <th scope="col" width="5%">Da Location</th>
                                <th scope="col" width="5%">Action</th>
                            </tr>
                            </thead>
                            <tbody id="myTable">
                            @foreach ($data as $key => $user)
                                <tr>
                                    <td>
                                        @if($user->name)
                                            {{$user->name}}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>
                                        @if($user->email)
                                            {{$user->email}}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>
                                        @if($user->phone_number)
                                            {{$user->phone_number}}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>
                                        @if(!empty($user->getRoleNames()))
                                            @foreach($user->getRoleNames() as $v)
                                                {{ $v }}
                                            @endforeach
                                        @endif</td>

                                    <td>
                                        @if($user->da_id)
                                            {{$user->da_id}}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>
                                        @if($user->code)
                                            {{$user->code}}
                                        @else
                                            N/A
                                        @endif</td>
                                    <td></td>
                                </tr>
                            @endforeach
                            </tbody>
                        @elseif(auth()->user()->hasRole('seller'))
                            <thead>
                            <tr class="tHead">
                                <th scope="col" width="10%">Buyer Name</th>
                                <th scope="col" width="10%">Email</th>
                                <th scope="col" width="10%">Location</th>
                                <th scope="col" width="10%">Contact No.</th>
                                <th scope="col" width="7%">Action</th>
                            </tr>
                            </thead>
                            <tbody id="myTable">
                            @foreach ($data as $key => $user)
                                <tr>
                                    <td>
                                        @if($user->name)
                                            {{$user->name}}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>
                                        @if($user->email)
                                            {{$user->email}}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>
                                        @if($user->ucode)
                                            {{$user->ucode}}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>
                                        @if($user->phone_number)
                                            {{$user->phone_number}}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>
                                        <button class='fas fa-pen-to-square' style="font-size: 24px;"
                                                data-id="{{$user->id}}"
                                                data-email="{{$user->email}}"
                                                data-phone="{{$user->phone_number}}"
                                                data-toggle="modal"
                                                data-target="#editBuyer"
                                        ></button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        @endif
                    </center>
                </table>
            </div>
        </div>

        {!! $data->render() !!}
    </div>

    </body>

@endsection
@section('javascript')
    <script>
        $(document).ready(function () {
            $('#editBuyer').on('shown.bs.modal', function (e) {
                let link = e.relatedTarget,
                    modal = $(this),
                    id = $(link).data("id"),
                    email = $(link).data("email"),
                    phone = $(link).data("phone");
                console.log(phone)
                modal.find("#id").val(id);
                modal.find("#email").val(email);
                modal.find("#phone").val(phone);
            });
        });

    </script>
    @parent
@endsection