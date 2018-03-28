@extends('owner.layouts.default.start')
@section('heading')
<link rel="stylesheet" href="http://fontawesome.io/assets/font-awesome/css/font-awesome.css" />
<link rel="stylesheet" href="https://cssgram-cssgram.netdna-ssl.com/cssgram.min.css">
<style>
h4{margin:0 0 5px 0;}
.form-control { margin-bottom: 0 !important;}

</style>

<h1>
  Properties/Listings
  <small>Your properties to be displayed for booking,<br/> sale and/or other purposes.</small>
</h1>
<ol class="breadcrumb">
  <?php if(Auth::user()->role=='owner') {  ?>
  <li><a href="{{url('/owner/dashboard')}}"><i class="fa fa-dashboard"></i> Seller Maintenance</a></li>
  <?php }else{ ?>
  <li><a href="{{url('/owner/dashboard')}}"><i class="fa fa-dashboard"></i> Buyer Options</a></li>
  <?php } ?>
  <li class="active">Properties</li>
</ol>
<br/>
@endsection
@section('contents')
<form action="{{ url('/owner/properties/create') }}" method="post" id="myCreateForm" role="form" data-toggle="validator">

  @include('owner.properties._form')
<div class="modal-footer">

        <button type="submit" class="btn btn-primary btn-iframe-submit" id="myButtonId"><span class="glyphicon glyphicon-ok"></span> Save</button>
      </div>
</form>
@endsection

