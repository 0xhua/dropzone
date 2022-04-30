@extends("layouts.master")
@section("title")

    Drop Zone | updates
@endsection
@section('css')
    <link rel="stylesheet" href="css/da_scanner.css">
    @parent
@endsection
@section('js')
    <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
@endsection
@section("content")

    <div class="container-fluid">


        <div class="row" style="margin-left: 10px; margin-top: 3%;">
            <center>
                <h3 style="color:#ffbf00;">QR SCANNER</h3>
                <p> Note:<i> Align the image on the camera.</i></p>
                <div>
                        <center>
                            <video class="scanner" id="preview"></video>
                        </center>

                </div>
            </center>
        </div>


        <div class="container" style="padding-top: 30px;">
            <div class="row" style="padding: 20px; background-color:#2E2E2E; border-radius: 25px;">
                <h3>Item Details</h3>
                <div class="col-sm-4" style=" font-size: 15px; margin-top: -15px;">
                    <label style="margin-top: 13px;"> Item Code: </label><br>
                    <p id="sCode"></p> <br>

                    <label style="margin-top: 13px;"> Date: </label><br>
                    <p id="sDate"></p> <br>

                    <label style="margin-top: 13px;"> Seller: </label><br>
                    <p id="sSeller"></p> <br>

                    <label style="margin-top: 13px; "> Buyer: </label><br>
                    <p id="sBuyer"></p> <br>
                </div>

                <div class="col-sm-4" style=" font-size: 15px; margin-top: -15px;">
                    <label style="margin-top: 13px;"> Origin: </label><br>
                    <p id="sOrigin"></p> <br>

                    <label style="margin-top: 13px;"> Destination: </label><br>
                    <p id="sDestination"></p> <br>

                    <label style="margin-top: 13px;"> TH/HF: </label><br>
                    <p id="sFee"></p> <br>

                    <label style="margin-top: 13px;"> Amount: </label><br>
                    <p id="sAmount"></p> <br>
                </div>

                <style> input {
                        width: 100%;
                    }</style>

                <div class="col-sm-4 mb-3" style="font-size: 18px; margin-top: 40px; text-align: center;">
                    <form method="post" action="{{route('update-item-status')}}">
                        @csrf
                        <input type="hidden" name="id" value="" id="citemId">
                        <input type="hidden" name="status" value="6">
                        <button type="submit" class='btn btn-outline-warning btn-lg'
                                style="font-size: 24px;"
                                data-toggle="tooltip" data-placement="top" title="Pull Out item"
                        >Claimed
                        </button>
                    </form>
                    <br>
                    <form method="post" action="{{route('update-item-status')}}">
                        @csrf
                        <input type="hidden" name="id" value="" id="pitemId">
                        <input type="hidden" name="status" value="7">
                        <button type="submit" class='btn btn-outline-warning btn-lg'
                                style="font-size: 24px;"
                                data-toggle="tooltip" data-placement="top" title="Pull Out item"
                        >Pull Out
                        </button>
                    </form>
                </div>


            </div>

        </div>


    </div>
    </body>
@endsection
@section('javascript')
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
                        $('#sCode').text(response.data.code);
                        $('#sDate').text(response.data.drop_date);
                        $('#sSeller').text(response.data.seller);
                        $('#sBuyer').text(response.data.buyer);
                        $('#sOrigin').text(response.data.origin);
                        $('#sDestination').text(response.data.destination);
                        $('#sFee').text(response.data.fee);
                        $('#sAmount').text(response.data.amount);
                        $('#pitemId').val(response.data.id);
                        $('#citemId').val(response.data.id);
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
@endsection
