<div class="l-navbar" id="nav-bar">
    <nav class="nav">
        <div>
            <a href="#" class="nav_logo">
                <img src="{{asset('images/profile.png')}}" class="header_img" alt="profile">
                <lable id="uname">{{ auth()->user()->name }}</lable>
                <br>
                <lable id="role">Seller's Location</lable>
            </a>


            <div class="nav_list">
                <a href="{{route('dashboard')}}"
                   class="nav_link {{request()->is('dashboard')?'active':''}}">
                    <i class='bx bxs-dashboard nav_icon'></i>
                    <span class="nav_name">Dashboard</span>
                </a>

                <a href="{{route('itemlist')}}"
                   class="nav_link {{request()->is('itemlist')?'active':''}}">
                    <i class='bx bx-list-ul nav_icon'></i>
                    <span class="nav_name">Item List</span>
                </a>
                @if(auth()->user()->hasRole(['Admin','seller']))
                <a href="{{route('user-list')}}" class="nav_link {{request()->is('user-list')?'active':''}}">
                    <i class="bx bxs-user-plus nav_icon"></i>
                    <span class="nav_name">Buyer List</span>
                </a>
                @endif
                <a href="{{route('itemrequest')}}"
                   class="nav_link {{request()->is('itemrequest')?'active':''}}">
                    <i class="bx bxs-message-alt-add nav_icon"></i>
                    <span class="nav_name">Request</span>
                </a>

                <a href="{{route('cashout')}}" class="nav_link {{request()->is('cashout')?'active':''}}">
                    <i class='bx bxs-wallet nav_icon'></i>
                    <span class="nav_name">Pay-out List</span>
                </a>

                <a href="{{route('updates')}}"
                   class="nav_link {{request()->is('updates')?'active':''}}">
                    <i class='bx bxs-message-alt-check nav_icon'></i>
                    <span class="nav_name">Updates Tab</span>
                </a>

                <a href="{{route('tutor.1')}}"
                   class="nav_link {{request()->is('tutor.1')?'active':''}}">
                    <i class='bx bx-book-bookmark nav_icon '></i>
                    <span class="nav_name">Tutorial</span>
                </a>

                <a href="{{route('settings')}}"
                   class="nav_link {{request()->is('settings')?'active':''}}">
                    <i class='bx bxs-cog nav_icon'></i>
                    <span class="nav_name">Account Setting</span>
                </a>
            </div>


        </div>

        <a href="{{route('logout')}}" class="nav_link">
            <i class='bx bx-log-out nav_icon'></i>
            <span class="nav_name">LOGOUT</span>
        </a>

    </nav>
</div>
