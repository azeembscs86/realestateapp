@extends('admin.layouts.default.start')
@section('heading')
<h1>
  Dashboard
  <small>Control Panel</small>
</h1>
<ol class="breadcrumb">
  <li><a href="{{url()}}"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Dashboard</li>
</ol>
@endsection
@section('contents')
<section>
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Newest Properties</h3>
      <div class="box-tools pull-right">
        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
      </div>
    </div>
    <div class="box-body">
      <table class="table table-responsive table-bordered table-striped">
        <thead>
          <tr>
            <th scope="col">Title</th>
            <th scope="col">Address</th>
            <th scope="col">Bedrooms</th>
            <th scope="col">Bathrooms</th>
            <th scope="col">Date Created</th>
          </tr>
        </thead>
        <tbody>
          @foreach($all_properties as $single)
          <tr>
            <td data-label="Title"><p class="margin-left">{{$single->title}}</p></td>
            <td data-label="Address"><p class="margin-left">{{$single->address}}<br>{{$single->city}},{{$single->zip}}</p></td>
            <td data-label="Bedrooms"><p class="margin-left">{{$single->bedrooms}}</p></td>
            <td data-label="Bathrooms"><p class="margin-left">{{$single->bathrooms}}</p></td>
            <td data-label="Date Created"><p class="margin-left"><?=date('m/d/Y h:i a',strtotime($single->created_at))?></p></td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- PAGE BODY ENDS -->
</section>
@endsection
