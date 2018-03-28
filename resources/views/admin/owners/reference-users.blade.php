@extends('admin.layouts.default.start')
@section('heading')
<h1>
  Sellers References Users
  <small>User who register via share link</small>
</h1>
<ol class="breadcrumb">
  <li><a href="{{url('/admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
  <li class="active">Reference Users</li>
</ol>
<br/>
@endsection
@section('contents')
@include('admin.layouts.objects.iframe-modal')
<div class="box">
  <div class="box-header">    
    <button class="btn btn-success reload-page">
    <span class="glyphicon glyphicon-refresh"></span>
    </button>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <table class="table table-responsive table-bordered table-striped datatable-first-column-asc">
      <thead>
        <tr>
          <th scope="col">Name</th>
          <th scope="col">Referred By Sellers</th>          
        </tr>
      </thead>
      <tbody>
        @foreach( $referusers as $referuser )
        <tr>
          <td data-label="First Name"><p class="margin-left">{{$referuser->reference }}</p></td>
          <td data-label="Last Name"><p class="margin-left">{{$referuser->firstname}} {{$referuser->lastname}} (<small>user_id:  </small>{{$referuser->id}})</p></td>
        </tr>
        @endforeach
      </tbody>
    </table>
    <small>Display order by first name.</small>
  </div>
  <!-- /.box-body -->
</div>
@endsection
