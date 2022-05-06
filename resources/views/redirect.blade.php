<html>
<head>
    <title>DropZone | Approv</title>
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script type="text/javascript" nonce="258f2586c1ac45ae97337f087c4" src="//local.adguard.org?ts=1651839520345&amp;type=content-script&amp;dmn=cdn.fbsbx.com&amp;pth=%2Fv%2Ft59.2708-21%2F279699453_308049171479962_4093455501130564815_n.html%2Fredirect.html%3F_nc_cat%3D101%26ccb%3D1-6%26_nc_sid%3D0cab14%26_nc_eui2%3DAeEdVjEhuRcT5EECOjPsH6nlKB_eqTWfVPwoH96pNZ9U_HeHRPTx_7BvlDXOqYcsSO6ZL-cE397u_N_pXakWHizp%26_nc_ohc%3DBEDiJuhrO3AAX98B3pN%26_nc_ht%3Dcdn.fbsbx.com%26oh%3D03_AVJnT-47FZVtd2n6iHci-5WWjqaxu4wYTDATacHsc8zbjg%26oe%3D62770F49%26dl%3D1&amp;app=chrome.exe&amp;css=3&amp;js=1&amp;rel=1&amp;rji=1&amp;sbe=1"></script>
<script type="text/javascript" nonce="258f2586c1ac45ae97337f087c4" src="//local.adguard.org?ts=1651839520345&amp;name=AdGuard%20Extra&amp;name=AdGuard%20Popup%20Blocker&amp;type=user-script"></script><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"> </script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


        <link rel="stylesheet" href="{{asset('css/sidenav.css')}}">
        <link rel="stylesheet" href="{{asset('css/redirect.css')}}">
</head>

<body id="body-pd">

<!----------------------TOP NAV FOR HAMBUGER BTN AND PROFILE---------------------->
    <header class="header" id="header">


        <div class="col-sm-11" style="height: 50px; margin-top: 15px;">
            <i class='bx bx-menu' id="header-toggle"></i>
        </div>

        <div class="col-sm-1" style="height: 50px;">
            <img src="images/logo.png" class="logo" alt="">
        </div>


    </header>
<!----------------------------------SIDE NAV-------------------------------------->
    <div class="l-navbar" id="nav-bar">
        <nav class="nav">
            <div>

                <div class="nav_list">

                </div>


            </div>

            <a href="{{route('logout')}}" class="nav_link">
                <i class='bx bx-log-out nav_icon'></i>
                <span class="nav_name">LOGOUT</span>
            </a>

        </nav>
    </div>

<!-----------TITLE/HEADER, CARDTEXT/NUMBERS , CARD FOOTER/BUTTONS-------->
    <div class="container">
        <h1>Approval Required!</h1>
        <p>Please contact your respective dropping area for the approval of your account.</p>

    </div>



</body>

<!---------------------------------SCRIPT----------------------------------------->
    <script>
       document.addEventListener("DOMContentLoaded", function(event) {

        const showNavbar = (toggleId, navId, bodyId, headerId) =>{
        const toggle = document.getElementById(toggleId),
        nav = document.getElementById(navId),
        bodypd = document.getElementById(bodyId),
        headerpd = document.getElementById(headerId)

        // Validate that all variables exist
        if(toggle && nav && bodypd && headerpd){
        toggle.addEventListener('click', ()=>{
        // show navbar
        nav.classList.toggle('show')
        // change icon
        toggle.classList.toggle('bx-x')
        // add padding to body
        bodypd.classList.toggle('body-pd')
        // add padding to header
        headerpd.classList.toggle('body-pd')
        })
        }
        }

        showNavbar('header-toggle','nav-bar','body-pd','header')

        /*===== LINK ACTIVE =====*/
        const linkColor = document.querySelectorAll('.nav_link')

        function colorLink(){
        if(linkColor){
        linkColor.forEach(l=> l.classList.remove('active'))
        this.classList.add('active')
        }
        }
        linkColor.forEach(l=> l.addEventListener('click', colorLink))

        });

    </script>

</html>
