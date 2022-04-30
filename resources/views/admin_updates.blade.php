@extends("layouts.master")
@section("title")

    Drop Zone | updates
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('css/admin_update.css')}}">
    <link rel="stylesheet" href="{{asset('css/seller_updates.css')}}">
    @parent
@endsection
@section("content")

<!--------------------------CONTAINER MAIN START---------------------------------->
    <div class="container">
        @if(auth()->user()->hasRole('Admin'))
            <h2>Admin Updates</h2>
        @else
            <h2>Dropping Area Updates</h2>
        @endif
        <p>Post Updates on this page</p>
        <div class="row">
            <div class="col-sm-12" id="form_div">
                <form action="{{route('add-announcement')}}" method="post">
                    {{@csrf_field()}}
                    <input type="text" class="updates" id="updates" name="announcement">
                    <center>
                        <button type="submit" class="post" value="submit" id="submit">POST</button>
                        <button type="delete" class="discard" value="delete" id="delete">DISCARD</button>
                    </center>
                </form>
            </div>
        </div>
    </div>

         <div class="container">
        <h2>Updates and Announcements</h2>
        <p>Check updates on this page</p>
        <div class="row">
            <div class="table-responsive">
                <table class="table table-responsive table-borderless" >
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
</body>
@endsection
