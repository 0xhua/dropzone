@extends("layouts.master")
@section('css')
    <link rel="stylesheet" href="{{asset('css/seller_updates.css')}}">
    @parent
@endsection
@section("title")
    Drop Zone | Seller Tutorial
@endsection

@section("content")
    <div class="container">
        <h2 style="font-size: 32px; margin-bottom: 10px;">Updates and Announcements</h2>
        <p style="margin-bottom: 10px;">Check updates on this page</p>
        <div class="row">
            <div class="table-responsive">
                <table class="table table-responsive table-borderless">
                    <thead>
                    <tr class="tHead">
                        <th scope="col" width="15%">Branch</th>
                        <th scope="col" width="30%">Updates</th>
                        <th scope="col" width="15%">Date</th>
                    </tr>
                    </thead>
                    <tbody id="data">
                    @foreach($announcements as $announcement)
                        <tr>
                            <td>
                                @if($announcement->area)
                                    {{$announcement->area}}
                                @else
                                    All
                                @endif
                            </td>
                            <td>
                                {{$announcement->announcement}}
                            </td>
                            <td> {{$announcement->created_at}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
{{--    <div class="container">--}}
{{--        <h2 style="font-size: 32px;">--}}
{{--        <p>Check updates on this page</p>--}}
{{--        <div class="row">--}}
{{--            <div class="table-responsive">--}}
{{--                <table class="table table-responsive table-borderless">--}}
{{--                    <thead>--}}
{{--                    <tr class="tHead">--}}
{{--                        <th scope="col" width="15%">Branch</th>--}}
{{--                        <th scope="col" width="30%">Updates</th>--}}
{{--                        <th scope="col" width="15%">Date</th>--}}
{{--                    </tr>--}}
{{--                    </thead>--}}
{{--                    <tbody id="data">--}}
{{--                    @foreach($announcements as $announcement)--}}
{{--                        <tr>--}}
{{--                            <td>--}}
{{--                                @if($announcement->area)--}}
{{--                                    {{$announcement->area}}--}}
{{--                                @else--}}
{{--                                    All--}}
{{--                                @endif--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                {{$announcement->announcement}}--}}
{{--                            </td>--}}
{{--                            <td> {{$announcement->created_at}}</td>--}}
{{--                        </tr>--}}
{{--                    @endforeach--}}
{{--                    </tbody>--}}
{{--                </table>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

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
