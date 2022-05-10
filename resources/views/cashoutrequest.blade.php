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

        <h2 style="font-size: 32px;">PAY-OUT LIST</h2>

        <div class="row" style=" margin-top: 40px;">
            <div class="col-sm-3">
                <form action="{{route('cashout')}}" method="get">
                    <div class="input-group mb-3">
                        {{@csrf_field()}}
                        <input name="search" type="text" class="form-control input-text" id="myInput"
                               placeholder="Search....">
                        <button class="addNew btn btn-outline-warning" type="submit">Search
                        </button>
                    </div>
                </form>
            </div>
            <div class="col-sm-3">
                <form style="display: inline">
                    <div class="input-group mb-3">
                        <select name="filter" type="text" class="form-control input-text filter" id="myInput">
                            <option {{ empty(app('request')->input('filter') )?'selected':''}} value="all">All </option>
                            <option {{ app('request')->input('filter')=='done'?'selected':''}} value="done"> Done </option>
                            <option {{ app('request')->input('filter')=='rejected'?'selected':''}} value="rejected"> Rejected</option>
                        </select>
                        <button class="addNew btn btn-outline-warning" type="submit">Filter
                        </button>

                        <div style="margin-left: 10px">
                            @if(auth()->user()->hasRole('seller'))
                                <form method="post" action="{{route('request_cashout')}}">
                                    @csrf
                                    <button type="submit" class="addNew btn btn-outline-warning" id="addNew" style="color: white;"
                                            data-bs-toggle="modal" data-bs-target="#addNewItem">Request
                                    </button>

                                    {{--                <button type="submit" class='fas fa-arrow-right-from-bracket'--}}
                                    {{--                        style="font-size: 24px;"--}}
                                    {{--                        data-toggle="tooltip" data-placement="top" title="Pull Out item"--}}
                                    {{--                ></button>--}}
                                </form>
                            @endif
                        </div>

                    </div>
                </form>
            </div>
            <div class="col-sm-4">
                <form action="{{route('export_excel.cashoutlist')}}" method="get">
                    <button type="submit" class="printBtn" id="printBtn" style="color: white;" data-bs-toggle="modal"
                            data-bs-target="#printInfo">
                        <i class="bx bxs-cloud-download"></i>
                    </button>
                </form>
            </div>


            <!------ ADD NEW BUTTON ------------------>

{{--            <div class="col-sm-5 mb-3" style="padding-top: 0px;">--}}
{{--                @if(auth()->user()->hasRole('seller'))--}}
{{--                    <form method="post" action="{{route('request_cashout')}}">--}}
{{--                        @csrf--}}
{{--                        <button type="submit" class="addNew btn btn-outline-warning" id="addNew" style="color: white;"--}}
{{--                                data-bs-toggle="modal" data-bs-target="#addNewItem">Request--}}
{{--                        </button>--}}

{{--                        --}}{{--                <button type="submit" class='fas fa-arrow-right-from-bracket'--}}
{{--                        --}}{{--                        style="font-size: 24px;"--}}
{{--                        --}}{{--                        data-toggle="tooltip" data-placement="top" title="Pull Out item"--}}
{{--                        --}}{{--                ></button>--}}
{{--                    </form>--}}
{{--                @endif--}}



{{--                @if(!$show_done)--}}
{{--                    <form action="{{route('cashout')}}" method="get">--}}
{{--                        {{@csrf_field()}}--}}
{{--                        <input name="done" type="hidden" value="1">--}}
{{--                        <button class="addNew btn btn-outline-warning" id="addNew" style="color: white;">Show done--}}
{{--                        </button>--}}
{{--                    </form>--}}
{{--                @endif--}}
{{--                @if(!$show_rejected)--}}
{{--                    <form action="{{route('cashout')}}" method="get">--}}
{{--                        {{@csrf_field()}}--}}
{{--                        <input name="rejected" type="hidden" value="1">--}}
{{--                        <button class="addNew btn btn-outline-warning" id="addNew" style="color: white;">Show rejected--}}
{{--                        </button>--}}
{{--                    </form>--}}
{{--                    @endif--}}
{{--                @if($show_done || $show_rejected)--}}
{{--                    <form action="{{route('cashout')}}" method="get">--}}
{{--                        {{@csrf_field()}}--}}
{{--                        <button class="addNew btn btn-outline-warning" id="addNew" style="color: white;">Show all--}}
{{--                        </button>--}}
{{--                    </form>--}}
{{--                    @endif--}}

{{--            </div>--}}


            <!------ DOWNLOAD AND PRINT BUTTON ------------------>
        {{--            <div class="col-sm-4 mb-3">--}}

        {{--                <a class="downloadBtn" id="downloadBtn" style="color: white; margin-right: 3.5%;">--}}
        {{--                    <i class="bx bxs-cloud-download"></i>--}}
        {{--                </a>--}}

        {{--                <a class="printBtn" id="printBtn" style="color: white;">--}}
        {{--                    <i class="bx bx-printer"></i>--}}
        {{--                </a>--}}

        {{--            </div>--}}


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

                                        <label id="">Date</label><br>
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
        <div class="modal" id="verifyCashout">
            <div class="modal-dialog  modal-sm">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title" style="color:#222222;">Verify Cashout</h4>
                        <button type="button" class="btn-close" data-dismiss="modal"></button>
                    </div>

                    <!-- Modal body -->
                    <form method="post" action="{{route('update-cr-status')}}">
                        @csrf
                        <input id="vid" type="hidden" name="id" value="">
                        <input type="hidden" name="status" value="2">
                        <label id="" style="font-size: 18px;">Verification code</label>
                        <input style="color:#222222;" type="text" name="verfication_code" value="">


                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Discard</button>
                            <button type="submit" class="btn btn-success" data-bs-dismiss="modal">Update</button>
                        </div>

                </div>
                </form>
            </div>
        </div>
    </div>


    <!------------------------ TABLE / This must be sorted by date.  ------------------------>
    <div class="row" style="margin-top: 2%; color: white;">
        <div class="table-responsive">
            <table class="table table-responsive table-border">
                <center>
                    <thead>
                    <tr class="tHead">

                        <th scope="col">Pay-out Code</th>
                        <th scope="col">Date</th>
                        <th scope="col">Seller</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Status</th>
                        @if(auth()->user()->hasRole(['Admin','da']))
                            <th scope="col">Action</th>
                        @endif
                    </tr>
                    </thead>

                    <tbody id="myTable">
                    @foreach($items as $cashout)
                        @if($cashout->status !== 'Released' || app('request')->input('filter')=="done")
                            <tr>

                                <td>
                                    @if($cashout->code)
                                        {{$cashout->code}}
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>
                                    @if($cashout->date)
                                        {{$cashout->date}}
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>
                                    @if($cashout->name)
                                        {{$cashout->name}}
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>
                                    @if($cashout->amount)
                                        {{$cashout->amount}}
                                    @else
                                        N/A
                                    @endif
                                </td>

                                <td>
                                    @if($cashout->status)
                                        {{$cashout->status}}
                                    @else
                                        Pending
                                    @endif
                                </td>
                                @if(auth()->user()->hasRole(['Admin','da']))
                                    <td>
                                        @if(is_null($cashout->status))
                                            <form method="post" action="{{route('update-cr-status')}}">
                                                @csrf
                                                <input type="hidden" name="id" value="{{$cashout->id}}">
                                                <input type="hidden" name="status" value="1">
                                                <button type="submit" class='fas fa-thumbs-up' style="font-size: 24px;"
                                                        data-toggle="tooltip" data-placement="top" title="approveitem"
                                                ></button>
                                            </form>
                                            <form method="post" action="{{route('update-cr-status')}}">
                                                @csrf
                                                <input type="hidden" name="id" value="{{$cashout->id}}">
                                                <input type="hidden" name="status" value="3">
                                                <button type="submit" class='fas fa-xmark-to-slot'
                                                        style="font-size: 24px;"
                                                        data-toggle="tooltip" data-placement="top" title="Release item"
                                                ></button>
                                            </form>
                                        @elseif($cashout->status_id == 1)
                                            <button class='fas fa-hand-holding-dollar' style="font-size: 24px;"
                                                    data-id="{{$cashout->id}}"
                                                    data-toggle="modal"
                                                    data-target="#verifyCashout"
                                                    title="Release Cashout"
                                            ></button>
                                        @endif
                                    </td>
                                @endif
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
@endsection
@section('javascript')
    <script>
        $(document).ready(function () {

            $('#verifyCashout').on('shown.bs.modal', function (e) {

                let link = e.relatedTarget,
                    modal = $(this),
                    id = $(link).data("id");
                modal.find("#vid").val(id);
            });
        })
    </script>
    @parent
@endsection
