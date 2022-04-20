<head>
	<title> Dropzone </title>
	 <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('css/style.css')}}" >
	<link rel="stylesheet" href="{{asset('css/scan.css')}}">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"> </script>
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
				<form>
					<input type="text" name="search_ID" id="searchID" placeholder="ITEM CODE" />

					<button type="button" id="myBtn" value="searchit">TRACK</button>
					<center>
					<!-- MODAL -->
					<div id="myModal" class="modal">
						<!-- MODAL CONTENT -->
						<div class="content-modal">
							<span class="close" style="white">&times;</span>
							<div class="text">
								<p>ITEM CODE:</p>
								<p>SELLER:</p>
								<p>BUYER:</p>
								<p>AMOUNT:</p>
								<p>STATUS:</p>
							</div>
						</div>

					</div>

					<!-- SCRIPT FOR MODAL -->
					<script>
						var modal = document.getElementById("myModal");

						var btn = document.getElementById("myBtn");

						var span = document.getElementsByClassName("close")[0];

						btn.onclick = function() {
						  modal.style.display = "block";
						}

						span.onclick = function() {
						  modal.style.display = "none";
						}

						window.onclick = function(event) {
						  if (event.target == modal) {
							modal.style.display = "none";
						  }
						}



					</script>
				</form>
				</div>

				<div class="back">
					<button onclick="backbtn()"type="button">BACK TO HOMEPAGE</button>
				</div>
			</div>
			</div>
		</div>

<!-- SCRIPT FOR QR SCANNER -->
<script>
    let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
    scanner.addListener('scan', function (content) {
        $.ajax({
            url: "{{route('scan-item')}}",
            type:"POST",
            data:{
                _token: "{{ csrf_token() }}",
                code:content,
            },
            success:function(response){
                console.log(response);
                if(response) {
                    $('.success').text(response.success);
                    $("#ajaxform")[0].reset();
                }
            },
            error: function(error) {
                console.log(error);
            }
        });
    });
           Instascan.Camera.getCameras().then(function(cameras){
               if(cameras.length > 0 ){
                   scanner.start(cameras[0]);
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
</header>
</body>
</html>
