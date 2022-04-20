<html lang="en">

<head>
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Dropzone | User List </title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"> </script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

        <link rel="stylesheet" href="{{asset('css/tablelist.css')}}">
        <link rel="stylesheet" href="{{asset('css/da_itemList.css')}}">
        <link rel="stylesheet" type="text/css" href="css/sidenav.css">

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
                <a href="#" class="nav_logo">
                    <img src="images/profile.png" class="header_img" alt="">
                    <lable id="uname">Username</lable> <br>
                    <lable id="role">Admin</lable>
                </a>


                <div class="nav_list">
                    <a href="admin_dashboard.html" class="nav_link ">
                        <i class='bx bxs-dashboard nav_icon'></i>
                        <span class="nav_name">Dashboard</span>
                    </a>

                    <a href="admin_itemList.html" class="nav_link ">
                        <i class='bx bx-list-ul nav_icon'></i>
                        <span class="nav_name">Item List</span>
                    </a>

                    <a href="accounts.blade.php" class="nav_link active ">
                        <i class='bx bxs-user-detail nav_icon'></i>
                        <span class="nav_name">View Accounts</span>
                    </a>

                    <a href="admin_approval.html" class="nav_link">
                        <i class='bx bxs-message-alt-check nav_icon'></i>
                        <span class="nav_name">Approval List</span>
                    </a>

                    <a href="admin_updates.html" class="nav_link">
                        <i class='bx bx-calendar-exclamation nav_icon'></i>
                        <span class="nav_name">Updates Tab</span>
                    </a>
                </div>


            </div>

            <a href="#" class="nav_link">
                <i class='bx bx-log-out nav_icon'></i>
                <span class="nav_name">LOGOUT</span>
            </a>
        </nav>
    </div>


<!--------------------------CONTAINER MAIN START---------------------------------->
    <div class="container-fluid">

        <h2>USERS LIST</h2>

        <div class="row" style=" margin-top: 40px;">
            <div class="col-sm-3">
                <div class="input-group mb-3">
                    <input type="text" class="form-control input-text"  id="myInput" placeholder="Search....">

                    <div class="input-group-append">
                        <button class="searchIcon btn btn-outline-warning btn-lg" style="color: white;">
                            <i class="bx bx-search"></i>
                        </button>
                    </div>
                </div>
            </div>



<!------ ADD NEW BUTTON ------------------>
            <div class="col-sm-5 mb-3" style="padding-top: 0px;">
                <button class="addNew btn btn-outline-warning" id="addNew" style="color: white;" data-bs-toggle="modal" data-bs-target="#addNewItem">Create</button>

                <!------ DELETE BUTTON ------------------>
                 <button class="delete btn btn-outline-warning" id="delete" style="color: white;" data-bs-toggle="modal" data-bs-target="#deleteItem">Delete</button>
            </div>

             <!------ DOWNLOAD AND PRINT BUTTON ------------------>
            <div class="col-sm-4 mb-3">

                <a class="downloadBtn" id="downloadBtn" style="color: white; margin-right: 3.5%;">
                    <i class="bx bxs-cloud-download"></i>
                </a>

                <a class="printBtn" id="printBtn" style="color: white;">
                    <i class="bx bx-printer"></i>
                </a>

            </div>


<!---------------------- CREATE ACCOUNT MODAL------------------->
            <div class="modal" id="addNewItem">
                <div class="modal-dialog  modal-xl">
                    <div class="modal-content">

                    <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title" style="color:#222222;">Create New Account</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                    <!-- Modal body -->
                    <form>
                        <div class="modal-body">
                            <div class="row" style="margin-left: 5px;">
                            <div class="col-sm-4 mb-3">
                                <label  style="font-size: 18px;">ID</label><br>
                                <input type="text" placeholder=""><br>

                                <label  >Seller Name</label><br>
                                <input type="text" placeholder=""><br>

                                <label >User Name</label><br>
                                <input type="text" placeholder=""><br>

                                <label >Contact No.</label><br>
                                <input type="text" placeholder=""><br>
                            </div>


                            <div class="col-sm-4 mb-3">
                                <label >First Name</label><br>
                                <input type="text" placeholder=""><br>

                                <label >Last Name</label><br>
                                <input type="text" placeholder=""><br>

                                <label >Location</label><br>
                                <input type="text" placeholder=""><br>

                                <label >Email</label><br>
                                <input type="text" placeholder=""><br>
                            </div>


                            <div class="col-sm-4 mb-3">
                                <label >Password</label><br>
                                <input type="text" placeholder=""><br>

                                <label  >User Type</label>
                                    <select value="" name="userType">
                                        <option value="Dropping Area">Dropping Area</option>
                                    </select>

                                 <label  >Status</label>
                                    <select value="" name="status" >
                                        <option disabled selected value> -- select status -- </option>
                                        <option value="claimed">Activated</option>
                                        <option value="intransit">Not Activated</option>
                                    </select>

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


<!---------------------- UPDATE ACCOUNT MODAL------------------------->
            <div class="modal" id="editItem">
                <div class="modal-dialog  modal-xl">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title" style="color:#222222;">Update Dropper's Info.</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <!-- Modal body -->
                    <form>
                        <div class="modal-body">
                            <div class="row" style="margin-left: 5px;">
                            <div class="col-sm-4 mb-3">
                                <label  style="font-size: 18px;">ID</label><br>
                                <input type="text" placeholder=""><br>

                                <label  >Seller Name</label><br>
                                <input type="text" placeholder=""><br>

                                <label >User Name</label><br>
                                <input type="text" placeholder=""><br>

                                <label >Contact No.</label><br>
                                <input type="text" placeholder=""><br>
                            </div>


                            <div class="col-sm-4 mb-3">
                                <label >First Name</label><br>
                                <input type="text" placeholder=""><br>

                                <label >Last Name</label><br>
                                <input type="text" placeholder=""><br>

                                <label >Location</label><br>
                                <input type="text" placeholder=""><br>

                                <label >Email</label><br>
                                <input type="text" placeholder=""><br>
                            </div>


                            <div class="col-sm-4 mb-3">

                                <label  >User Type</label>
                                    <select value="" name="userType" >
                                        <option disabled selected value> -- select user type -- </option>
                                        <option value="Seller">Seller</option>
                                        <option value="Dropping Area">Dropping Area</option>
                                    </select>

                                 <label  >Status</label>
                                    <select value="" name="status" >
                                        <option disabled selected value> -- select status -- </option>
                                        <option value="claimed">Activated</option>
                                        <option value="intransit">Not Activated</option>
                                    </select>

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



<!------------------------ DELETE ACCOUNT MODAL ------------------------>
            <div class="modal" id="deleteItem">
                <div class="modal-dialog  modal-md">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title" style="color:black">
                                Delete Confirmation
                            </h4>

                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body" style="color: #222222;">
                            Do you really want to delete this item? <br> This process cannot be undone.
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Discard</button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Delete</button>
                        </div>

                        </div>
                </div>
            </div>
        </div>



<!------------------------ TABLE ------------------------>
        <div class="row" style="margin-top: 2%; color: white;">
            <div class="table-responsive">
            <table class="table table-responsive table-border" >
                <center>
                <thead>
                    <tr class="tHead">
                        <th scope="col" width="2%"></th>
                        <th scope="col" width="10%">ID</th>
                        <th scope="col" width="10%">Category</th>
                        <th scope="col" width="10%">Seller Name</th>
                        <th scope="col" width="10%">User Name</th>
                        <th scope="col" width="13%">First Name</th>
                        <th scope="col" width="13%">Last Name</th>
                        <th scope="col" width="10%">Contact No.</th>
                        <th scope="col" width="10">Email</th>
                        <th scope="col" width="10%">Location</th>
                        <th scope="col" width="8%">Status</th>
                        <th scope="col" width="5%">Action</th>
                    </tr>
                </thead>

                <tbody id="myTable">
                    <tr>
                        <td><input class="defaultCheckbox" type="checkbox"></td>
                        <td>KDS-253</td>
                        <td>Seller</td>
                        <td>Juana Olshope</td>
                        <td>juana01</td>
                        <td>Juana</td>
                        <td>Rimando</td>
                        <td>09281366014</td>
                        <td>juana01@gmail.com</td>
                        <td>Naguilian</td>
                        <td>Activated</td>
                        <td>
                            <i class="bx bx-edit" type="button" data-bs-toggle="modal" data-bs-target="#editItem"></i>
                        </td>
                    </tr>

                       <tr>
                        <td><input class="defaultCheckbox" type="checkbox"></td>
                        <td>DA-253</td>
                        <td>Dropping Area</td>
                        <td>Tiffy BAUANG</td>
                        <td>DA</td>
                        <td>DA</td>
                        <td>DA</td>
                        <td>09105436325</td>
                        <td>tiffybauang@gmail.com</td>
                        <td>Bauang</td>
                        <td>Activated</td>
                        <td>
                            <i class="bx bx-edit" type="button" data-bs-toggle="modal" data-bs-target="#editItem"></i>
                        </td>
                    </tr>
                </tbody>
                </center>
                </table>
            </div>
        </div>


</div>

</body>






<!---------------------------------SCRIPT----------------------------------------->
        <script>
        $(document).ready(function(){
          $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
              $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
          });
        });
        </script>



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
