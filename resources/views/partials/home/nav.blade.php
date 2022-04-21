<header class="header">
    <nav class="navbar navbar-style">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#micon">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <img class="logo" src="{{asset('images/logo.png')}}">
            </div>
            <div class="collapse navbar-collapse" id="micon">
                <ul class="nav navbar-nav navbar-right">
                    <li><a class="{{request()->is('home')?'active':''}}" href="{{route('home')}}">Home</a></li>
                    <li><a class="{{request()->is('branches')?'active':''}}" href="{{route('branches')}}">Branches</a></li>
                    <li><a class="{{request()->is('trasnfer-schedule')?'active':''}}" href="{{route('trasnfer-schedule')}}">Transfer Schedule</a></li>
                    <li><a class="{{request()->is('rules')?'active':''}}" href="{{route('rules')}}">Rules</a></li>
                    <li><a class="{{request()->is('contact-us')?'active':''}}" href="{{route('contact-us')}}">Contact Us </a> </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
