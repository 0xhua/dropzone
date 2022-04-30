@extends("layouts.master")
@section('css')
    <link rel="stylesheet" href="{{asset('css/seller_setting.css')}}">
    @parent
@endsection
@section("title")
    Drop Zone | Settings
@endsection

@section("content")
    <!--------------------------ACCOUNT SETTING PAGE---------------------------------->
    <div class="container mt-3">
        <h1>Account Setting</h1>
        <p style="line-height: 1px; font-size: 15px;">Update and Edit your information here.</p>
{{--        <h3 style="color:white; font-size:20px; padding-top: 5px;">Log in Email </h3>--}}
{{--        <p style="line-height: 1px; font-size: 15px; padding-bottom: 15px;"> example@gmail.com</p>--}}

        <form action="{{route('update-setting')}}" method="post">
{{--            <div class="row">--}}
{{--                <div class="col">--}}
{{--                    <h6> Seller name </h6>--}}
{{--                    <input type="text" class="form-control" name="sname">--}}
{{--                </div>--}}

{{--                <div class="col">--}}
{{--                    <h6> Facebook name </h6>--}}
{{--                    <input type="text" class="form-control" name="fbname">--}}
{{--                </div>--}}
{{--            </div>--}}
            {{csrf_field()}}
            <div class="row" style="padding-top:20px;">
                <div class="col">
                    <h6> Full Name </h6>
                    <input type="text" class="form-control" name="name" value="{{$user->name}}">
                </div>

                <div class="col">
                    <h6> Phone Number </h6>
                    <input type="text" class="form-control" name="phone_no" value="{{$user->phone_number}}">
                </div>
            </div>


            <div class="row" style="padding-top:20px;">
                <div class="col">
                    <h6> Email Account </h6>
                    <input type="text" class="form-control" name="email" value="{{$user->email}}">
                </div>
                <div class="col">
                    <h6> Password</h6>
                    <input type="password" class="form-control" name="password">
                </div>
            </div>

            <div class="row" style="padding-top:20px;">


                <div class="col" id="btn_col" style="padding-top:30px;">
                    <button type="submit" class="post" value="submit" id="submit">UPDATE</button>
{{--                    <button type="delete" class="discard" value="delete" id="delete">DISCARD</button>--}}
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
