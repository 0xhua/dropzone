@extends('layouts.home')
@section("title")
    Drop Zone | Rules
@endsection
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/rules.css')}}">
@endsection
@section('js')
            <script type="text/javascript" src="js/modal.js"></script>
@endsection
@section('content')
        <div class="container">
            <div class="row " style="text-align: left; ">
                <h1 style="color:#ffbf00; text-align:center;">Dropping Area Rules & Policies</h1>
                <div class="col-sm-12" style="padding:10px 50px 50px 50px;  text-align: justify;">

                    <h2 style="color:#ffbf00">UNCLAIMED ITEMS</h2>
                    <ul>
                        <li><p>⦿ <b> Dropped Items - </b> All unclaimed items by receivers after thirty (30) days upon
                                dropping shall be subjected to pull-out and shall incur a pull-out fee of Php10 per
                                month.</p></li>

                        <li><p>⦿ <b> Transferred Items - </b> All unclaimed transferred items shall be returned to Dropping Area
                                after thirty (30) days. Droppers shall be given another thirty (30) days to pull-out the
                                returned items. All Transfer Fees shall be paid by the dropper upon pull-out. </p></li>

                        <li><p style="color:ffbf00;"> Note: The dropping area shall no longer be liable for items still
                                unclaimed after sixty (60) days and shall dispose of the items in a manner it sees
                                fit.</p></li>
                    </ul>

                    <h2 style="color:#ffbf00">PENALTIES</h2>
                    <ul>
                        <li><p>⦿ Item reservation for receivers shall be limited to one (1) week ONLY. Unclaimed items
                                exceeding reservation shall incur a penalty of Php10 per week. Penalties are paid by the
                                receiver upon claiming the items.</p></li>
                    </ul>

                    <h2 style="color:#ffbf00">CASH-OUT</h2>
                    <ul>
                        <li><p>⦿ <b> Dropped Items - </b> Cash-out shall be immediately available for items directly
                                dropped at your respective dropping area.</p></li>

                        <li><p>⦿ <b>Transferred Items -</b> Cash-out shall only be available at the dropping area upon
                                remittance of its Branches and Partners. The dropping area shall not be liable for any
                                unsettled payments from its Dropping Area Partners.</p></li>

                        <li><p> Note: Droppers must always present his/her Dropper Card or any valid ID upon
                                Cash-out.</p></li>
                    </ul>

                    <h2 style="color:#ffbf00">UNCLAIMED FUNDS</h2>
                    <ul>
                        <li><p>⦿ If funds remain unclaimed after sixty (60) days from the date of transaction, the
                                dropper agrees that an administrative fee of Php100 or two (2%) percent of the fund,
                                whichever is higher, per month shall be deducted from the total of unclaimed funds.</p>
                        </li>

                        <li><p>The dropping area shall not be liable for loss, damage, or delay arising from fortuitous
                                events, and acts of government authority.</p></li>

                        <li><p> By transacting with Dropzone partners and branches, dropper warrants that he/she has
                                read, understood and fully agreed to these terms and conditions.</p></li>
                    </ul>


                </div>
            </div>
        </div>
@endsection
