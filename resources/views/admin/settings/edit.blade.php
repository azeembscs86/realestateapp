@extends('admin.layouts.default.start')

@section('heading')
<h1>
  Profile Edit
</h1>
<ol class="breadcrumb">
  <li><a href="{{url('/admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
  <li class="active">Profile Edit</li>
</ol>
<br/>
@endsection
@section('contents')
<div class="box">
  <div class="box-body">
    <form action="{{ url('/admin/settings/update') }}" method="post" enctype="multipart/form-data">
      @include('admin.settings._form')
     
      <div class="form-group">
        <div class="col-sm-3 col-xs-12"></div>
        <div class="col-sm-9 col-xs-12">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" name="id" value="{{ $setting->id }}">
          <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok"></span> Update</button>
          <button type="reset" class="btn btn-default"><span class="glyphicon glyphicon-repeat"></span> Reset</button>
        </div>
      </div>
    </form>
  </div>
  <!-- /.box-body -->
</div>
@endsection
