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
        <h2>Updates and Announcements</h2>
        <p>Check updates on this page</p>
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
                    <tbody id="data"></tbody>
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
    @parent
@endsection
