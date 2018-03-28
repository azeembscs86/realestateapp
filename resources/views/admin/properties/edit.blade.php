@extends('admin.layouts.default.start')
@section('heading')
<link rel="stylesheet" href="http://fontawesome.io/assets/font-awesome/css/font-awesome.css" />
<link rel="stylesheet" href="https://cssgram-cssgram.netdna-ssl.com/cssgram.min.css">
<script type="text/javascript">
  $('.modal').css({
    width: 'auto',
    height: 'auto',
    'max-height': '100%'
}).modal({
    backdrop: 'static'
});
</script>
<style type="text/css">
    .skin-green.sidebar-mini.modal-open{position:fixed !important;}
</style>
<style>
h4{margin:0 0 5px 0;}
.form-control { margin-bottom: 0;}
.status-msg{text-align: left;}
</style>
<h1>
  Properties/Listings
  <small>Your properties to be displayed for booking,<br/> sale and/or other purposes.</small>
</h1>
<ol class="breadcrumb">
  <li><a href="{{url('/admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
  <li class="active">Properties</li>
</ol>
<br/>
@endsection
@section('contents')
<form action="{{ url('/admin/properties/update') }}" method="post">
  @include('admin.properties._form')
</form>
@endsection
