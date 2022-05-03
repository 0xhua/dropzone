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
        <h2 style="font-size: 32px;  margin-bottom: 16px;">
        @if(auth()->user()->hasRole('Admin'))
            Admin Updates
        @else
                Dropping Area Updates

        @endif
        </h2>
        <p style="margin-bottom: 16px;">Post Updates on this page</p>
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
        <h2 style="font-size: 32px; margin-bottom: 16px;">Updates and Announcements</h2>
        <p style="margin-bottom: 16px;">Check updates on this page</p>
        <div class="row">
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
</body>
@endsection
