<head>
	<title> Dropzone </title>
	 <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('css/style.css')}}" >
	<link rel="stylesheet" href="{{asset('css/scan.css')}}">
	<link rel="stylesheet" href="{{asset('css/track.css')}}">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
	<script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
</head>

<!-----NAV BAR----->
<body id="bootstrap-overrides">
	<header class="header">	<nav class="navbar navbar-style">
		<div class="container">
			<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#micon">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				<img class="logo" src="images/logo.png">
			</div>
			<div class="collapse navbar-collapse" id="micon">
			    <ul class="nav navbar-nav navbar-right">
					<li><a class="active" href="front.html">Home</a></li>
					<li><a href="branches.html">Branches</a></li>
					<li><a href="transfer.html">Transfer Schedule</a></li>
					<li><a href="rules.html">Rules</a></li>
					<li><a href="contact.html">Contact Us </a> </li>
				</ul>
				</div>
		</div>
	</nav>
<!-----TRACKING YOUR ITEM----->
		<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="scan">
					<h1>SCAN</h1>
				</div>

				<div class="point">
					<p><i>Point your camera at the QR code</i></p>
				</div>

				<div>
					<center>
						<video class="scanner" id="preview"></video>
					</center>
				</div>

				<div class="input">
					<p><i>Dont have QR code? Input Reference No.</i></p>
				</div>

                <div class="content">
                    <form id="track">
                        {{@csrf_field()}}
                        <input type="text" name="code" id="searchID" placeholder="ITEM CODE" required/>
                        <button type="submit" class="track btn btn-outline-warning" style="color: white;">TRACK
                        </button>
                    </form>
                </div>
                <!------------TRACK ITEM MODAL--------->
                <div class="modal" id="trackItem">
                    <div class="modal-dialog  modal-md">
                        <div class="modal-content" style="background-color: #222222;">
                            <!-- Modal body -->
                            <div class="modal-body" style="color: white;">
                                <h5>ITEM CODE:</h5>
                                <p id="tCode"></p>
                                <h5>SELLER:</h5>
                                <p id="tSeller"></p>
                                <h5>BUYER:</h5>
                                <p id="tBuyer"></p>
                                <h5>AMOUNT:</h5>
                                <p id="tAmount"></p>
                                <h5>STATUS:</h5>
                                <p id="tStatus"></p>
                            </div>

                        </div>
                    </div>
                </div>


				<div class="back">
					<button onclick="backbtn()"type="button">BACK TO HOMEPAGE</button>
				</div>
			</div>
			</div>
		</div>

<!-- SCRIPT FOR QR SCANNER -->
<script>
    let scanner = new Instascan.Scanner(
        {
            video: document.getElementById('preview'),
            mirror: false
        }
    );
    scanner.addListener('scan', function (content) {
        $.ajax({
            url: "{{route('scan-public')}}",
            type:"POST",
            data:{
                _token: "{{ csrf_token() }}",
                code:content,
            },
            success:function(response){
                if (response.status !== 'error') {
                    $('#tCode').text(response.data.code);
                    $('#tSeller').text(response.data.seller);
                    $('#tBuyer').text(response.data.buyer);
                    $('#tAmount').text(response.data.amount);
                    $('#tStatus').text(response.data.status);
                    $('#trackItem').modal('show');
                }else{
                    alert('Item Not found')
                }
            },
            error: function(error) {
                console.log(error);
            }
        });
    });
           Instascan.Camera.getCameras().then(function(cameras){
               if (cameras.length > 0) {
                   var selectedCam = cameras[0];
                   $.each(cameras, (i, c) => {
                       if (c.name.indexOf('back') !== -1) {
                           selectedCam = c;
                           return false;
                       }
                   });

                   scanner.start(selectedCam);
               } else{
                   alert('No cameras found');
               }

           }).catch(function(e) {
               console.error(e);
           });

           scanner.addListener('scan',function(c){
               document.getElementById('searchID').value=c;

           });
</script>
        <script>
            var request;
            $("#track").submit(function (event) {
                event.preventDefault();
                if (request) {
                    request.abort();
                }
                var $form = $(this);
                var $inputs = $form.find("input, select, button, textarea");
                var serializedData = $form.serialize();
                $inputs.prop("disabled", true);
                // Fire off the request to /form.php
                request = $.ajax({
                    url: "http://192.168.50.5:8080/scan-public",
                    type: "post",
                    data: serializedData,
                });
                // Callback handler that will be called on success
                request.done(function (response, textStatus, jqXHR) {
                    console.log(response)
                    if (response.status !== 'error') {
                    $('#tCode').text(response.data.code);
                    $('#tSeller').text(response.data.seller);
                    $('#tBuyer').text(response.data.buyer);
                    $('#tAmount').text(response.data.amount);
                    $('#tStatus').text(response.data.status);
                    $('#trackItem').modal('show');
                    }else{
                        alert('Item Not found')
                    }
                });

                // Callback handler that will be called on failure
                request.fail(function (jqXHR, textStatus, errorThrown) {
                    alert(errorThrown)
                });

                // Callback handler that will be called regardless
                // if the request failed or succeeded
                request.always(function () {
                    // Reenable the inputs
                    $inputs.prop("disabled", false);
                });
            });
        </script>
</header>
</body>
</html>
