@extends('admin.layouts.default.start')
@section('heading')
<link rel="stylesheet" href="http://fontawesome.io/assets/font-awesome/css/font-awesome.css" />
<style>
h4{margin:0 0 5px 0;}
.form-control { margin-bottom: 0;}
</style>
<h1>
  Inquiries Listings
  <!-- <small>Your properties to be displayed for booking, sale and/or other purposes.</small> -->
</h1>
<ol class="breadcrumb">
  <li><a href="{{url('/admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
  <li class="active">Inquiries</li>
</ol>
<br/>
@endsection
@section('contents')
@include('admin.layouts.objects.iframe-modal')
<div class="box">
  <div class="box-header">
   
  </div>
  <!-- /.box-header -->
  <div class="box-body table-responsive">
    <table class="table table-responsive table-bordered table-striped datatable-first-column-asc">
      <thead>
        <tr>
          <th>#</th>
          <th>Name</th>
          <th>Email</th>
          <th>Property</th>
          <th>Message</th>
          <!-- <td></td> -->
        </tr>
      </thead>
      <tbody>
      <?php $sr=1; ?>
        @foreach( $inquiries as $single )
        <tr>
          <td>
            {{$sr++}}
          </td>
          <td>
           {{$single->firstname}} {{$single->lastname}}
          </td>
          <td>
            {{$single->email}}
          </td>
          <td>
            {{$single->title}}<br>{{$single->address}} , {{$single->city}}
          </td>
          <td>
          {{$single->message}}
          </td>
         <!--  <td>
            --
          </td> -->
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <!-- /.box-body -->
</div>
@endsection
