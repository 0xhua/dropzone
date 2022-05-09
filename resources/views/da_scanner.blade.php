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


        <div id="scanner" class="row" style="margin-left: 10px; margin-top: 3%;">
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
                <div class="col-sm-2" style=" font-size: 15px; margin-top: -15px;">
                    <label style="margin-top: 13px;"> Item Code: </label><br>
                    <p id="sCode"></p> <br>

                    <label style="margin-top: 13px;"> Date: </label><br>
                    <p id="sDate"></p> <br>

                    <label style="margin-top: 13px;"> Seller: </label><br>
                    <p id="sSeller"></p> <br>

                    <label style="margin-top: 13px; "> Buyer: </label><br>
                    <p id="sBuyer"></p> <br>
                </div>

                <div class="col-sm-2" style=" font-size: 15px; margin-top: -15px;">
                    <label style="margin-top: 13px;"> Origin: </label><br>
                    <p id="sOrigin"></p> <br>

                    <label style="margin-top: 13px;"> Destination: </label><br>
                    <p id="sDestination"></p> <br>

                    <label style="margin-top: 13px;"> TH/HF: </label><br>
                    <p id="sFee"></p> <br>

                    <label style="margin-top: 13px;"> Amount: </label><br>
                    <p id="sAmount"></p> <br>
                </div>

                <div class="col-sm-2" style=" font-size: 15px; margin-top: -15px;">
                    <label style="margin-top: 13px;"> Payment: </label><br>
                    <p id="sPayment"></p> <br>

                    <label style="margin-top: 13px;"> Status: </label><br>
                    <p id="sStatus"></p> <br>

                </div>

                <style> input {
                        width: 100%;
                    }</style>


                <div class="col-sm-4 mb-3" style="font-size: 18px; margin-top: 40px; text-align: center;">
                    <div style="display: none;" id="payBtn">
                    <form method="post" action="{{route('update-item-status')}}">
                        @csrf
                        <input type="hidden" name="id" value="" id="citemId">
                        <input type="hidden" name="status" value="10">
                        <button type="submit" class='btn btn-outline-warning btn-lg'
                                style="font-size: 24px;"
                                data-toggle="tooltip" data-placement="top" title="Pull Out item"
                        >Pay & Claim Item
                        </button>
                    </form>

                        </div>
                    <br>
                    <div style="display: none;"  id="claimBtn">
                    <form method="post" action="{{route('update-item-status')}}">
                        @csrf
                        <input type="hidden" name="id" value="" id="citemId">
                        <input type="hidden" name="status" value="6">
                        <button type="submit" class='btn btn-outline-warning btn-lg'
                                style="font-size: 24px;"
                                data-toggle="tooltip" data-placement="top" title="Pull Out item"
                        >Claim
                        </button>
                    </form>
                        </div>
                    <br>
                    <div style="display: none;"  id="pullOutBtn">
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


    </div>
    </body>
@endsection
@section('javascript')
    <script>
        let scanner = new Instascan.Scanner({video: document.getElementById('preview')});
        scanner.addListener('scan', function (content) {
            $.ajax({
                url: "{{route('scan-item')}}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    code: content,
                },
                success: function (response) {
                    if (response.status !== 'error') {
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
                        $('#sPayment').text(response.data.payment_status);
                        $('#sStatus').text(response.data.status);
                        if(response.data.status_id == '4'){
                            $('#pullOutBtn').show();
                            $('#scanner').hide();

                            if(response.data.payment_status_id =='2'){
                                $('#payBtn').show();
                            }else{
                                $('#claimBtn').show();

                            }
                        }
                    } else {
                        alert('Item Not found')
                    }
                },
                error: function (error) {
                    alert(error)
                }
            });
        });
        Instascan.Camera.getCameras().then(function (cameras) {
            if (cameras.length > 0) {
                scanner.start(cameras[0]);
            } else {
                alert('No cameras found');
            }

        }).catch(function (e) {
            console.error(e);
        });

    </script>
@endsection
