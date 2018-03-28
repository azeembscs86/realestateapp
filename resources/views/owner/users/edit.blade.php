@extends('owner.layouts.default.start')

@section('heading')
<h1>
  Profile Edit
</h1>
<ol class="breadcrumb">
  <?php if(Auth::user()->role=='owner') {  ?>
  <li><a href="{{url('/owner/dashboard')}}"><i class="fa fa-dashboard"></i> Seller Maintenance</a></li>
  <?php }else{ ?>
  <li><a href="{{url('/owner/dashboard')}}"><i class="fa fa-dashboard"></i> Buyer Options</a></li>
  <?php } ?>
  <li class="active">Profile Edit</li>
</ol>
<br/>
@endsection
@section('contents')
<div class="box">
  <div class="box-body">
    <form action="{{ url('/owner/users/update') }}" method="post">
      @include('owner.users._form')
      <div class="form-group">
        <div class="col-sm-12 col-xs-12">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" name="id" value="{{ $user->id }}">
          <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok"></span> Update</button>
        </div>
      </div>
    </form>
  </div>
  <!-- /.box-body -->
</div>
@endsection
