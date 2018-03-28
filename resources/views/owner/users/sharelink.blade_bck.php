@extends('owner.layouts.default.start')
@section('contents')
<div class="box">
  <div class="box-body">
    <form action="{{ url('/owner/users/signuplink') }}" method="post">
      @include('owner.users._form_sharelink')
      
      <div class="form-group">
        <div class="col-sm-12 col-xs-12">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" name="id" value="{{ $user->id }}">
          <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok"></span> Send</button>
        </div>
      </div>
    </form>
    <div class="col-sm-12 col-xs-12">
    	<br>
    <strong>Note!</strong>
    <p>This referral program will only for three months.</p>
  </div>
  </div>
  <!-- /.box-body -->
</div>
@endsection
