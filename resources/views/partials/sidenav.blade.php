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
                <a href="{{route('seller_dashboard')}}"
                   class="nav_link {{request()->is('seller_dashboard')?'active':''}}">
                    <i class='bx bxs-dashboard nav_icon'></i>
                    <span class="nav_name">Dashboard</span>
                </a>

                <a href="{{route('seller_itemlist')}}"
                   class="nav_link {{request()->is('seller_itemlist')?'active':''}}">
                    <i class='bx bx-list-ul nav_icon'></i>
                    <span class="nav_name">Item List</span>
                </a>

                <a href="seller_request.html" class="nav_link">
                    <i class="bx bxs-message-alt-add nav_icon"></i>
                    <span class="nav_name">Request</span>
                </a>

                <a href="seller_updates.html" class="nav_link">
                    <i class='bx bxs-message-alt-check nav_icon'></i>
                    <span class="nav_name">Updates Tab</span>
                </a>

                <a href="{{route('tutor.1')}}" class="nav_link {{request()->is('seller_itemlist')?'active':''}}">
                    <i class='bx bx-book-bookmark nav_icon '></i>
                    <span class="nav_name">Tutorial</span>
                </a>

                <a href="seller_setting.html" class="nav_link">
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
