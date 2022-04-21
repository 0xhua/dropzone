@extends('layouts.home')
@section('title')
    Dropzone | Transfer Schedule
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('css/transfer.css')}}">
    @parent
@endsection
@section('content')
<!------------------------------------- FOR TRANSFER TABLE ---------------------------------------->
<div class="content">
	<br>
	<h1> Transfer Schedules and Rates </h1>
    <h3> Remit same as errand day! </h3><br>
	<center>
	<div style="overflow-x:auto;">
  <table>
    <tr class="tHead" style="text-align: center;">
      <th>DESTINATION</th>
      <th>CUTOFF DAY</th>
      <th>ERRAND DAY</th>
      <th>RATE</th>
      <th>PARTNER D.A.</th>
    </tr>

    <tr>
      <td>San Fernando</td>
      <td>Wed & Sat</td>
      <td>Wed & Sat</td>
      <td>10</td>
      <td> Tiffy Shop </td>
    </tr>

    <tr>
      <td>Bauang</td>
      <td>Wed & Sat</td>
      <td>Wed & Sat</td>
      <td>10</td>
      <td> Tiffy Shop </td>
    </tr>

    <tr>
      <td>Bacnotan</td>
      <td>Wed & Sat</td>
      <td>Wed & Sat</td>
      <td>10</td>
      <td> Tiffy Shop </td>
    </tr>

    <tr>
      <td>Agoo</td>
      <td>Wed & Sat</td>
      <td>Wed & Sat</td>
      <td>10</td>
      <td> Tiffy Shop </td>
    </tr>

    <tr>
      <td>Naguilian</td>
      <td>Wed & Sat</td>
      <td>Wed & Sat</td>
      <td>10</td>
      <td> SMM </td>
    </tr>

    <tr>
      <td>Caba</td>
      <td>Wed & Sat</td>
      <td>Wed & Sat</td>
      <td>10</td>
      <td> Choline Fashion Hub </td>
    </tr>

    <tr>
      <td>Aringay</td>
      <td>Wed & Sat</td>
      <td>Wed & Sat</td>
      <td>10</td>
      <td> Your Trends </td>
    </tr>

    <tr>
      <td>San Juan </td>
      <td>Wed & Sat</td>
      <td>Wed & Sat</td>
      <td>10</td>
      <td> Awra Elyu </td>
    </tr>

    <tr>
      <td>Balaoan</td>
      <td>Friday</td>
      <td> Saturday</td>
      <td>10</td>
      <td> Michaella Gen Mdse</td>
    </tr>

    <tr>
      <td>Luna</td>
      <td>Friday</td>
      <td> Saturday</td>
      <td>10</td>
      <td>Dropping Hub</td>
    </tr>

    <tr>
      <td>Bangar</td>
      <td>Friday</td>
      <td> Saturday</td>
      <td>10</td>
      <td>Macolit</td>
    </tr>

    <tr>
      <td>Santo Tomas</td>
      <td>Friday</td>
      <td> Saturday</td>
      <td>10</td>
      <td>Lay Z</td>
    </tr>

    <tr>
      <td>Pugo</td>
      <td>Friday</td>
      <td> Saturday</td>
      <td>10</td>
      <td>Mimi's Food Hub</td>
    </tr>

    <tr>
      <td>Tubao</td>
      <td>Friday</td>
      <td> Saturday</td>
      <td>10</td>
      <td>Marlden Olshoppe</td>
    </tr>

    <tr>
      <td>Damortis</td>
      <td>Friday</td>
      <td> Saturday</td>
      <td>10</td>
      <td>Susie's Dress Shop</td>
    </tr>

    <tr>
      <td>Rosario</td>
      <td>Friday</td>
      <td> Saturday</td>
      <td>10</td>
      <td>Your Trends</td>
    </tr>

    <tr>
      <td>San Gabriel</td>
      <td>Friday</td>
      <td> Saturday</td>
      <td>10</td>
      <td>Chelton Clothing</td>
    </tr>

    <tr>
      <td>Baguio</td>
      <td>Friday</td>
      <td> Saturday</td>
      <td>50</td>
      <td>Viado's</td>
    </tr>

    <tr>
      <td>Pangasinan</td>
      <td>Friday</td>
      <td> Saturday</td>
      <td>40</td>
      <td>Samgyup Dropping Area</td>
    </tr>

    <tr>
      <td>Candon</td>
      <td>No Fix Date</td>
      <td> No Fix Date</td>
      <td>10</td>
      <td>Bella Shop</td>
    </tr>
  </table>
</div>
    <br>
	<p> Note: Schedule may vary depending on special events and holidays.<br>
        TF may also vary if items are bulky, fragile and/or heavy. </p><br>
</div>
@endsection
