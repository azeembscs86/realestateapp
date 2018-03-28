@extends('admin.layouts.default.start')
@section('heading')
<h1>
  Sellers
  <small>Sellers of Properties</small>
</h1>
<ol class="breadcrumb">
  <li><a href="{{url('/admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
  <li class="active">Sellers</li>
</ol>
<br/>
@endsection
@section('contents')
@include('admin.layouts.objects.iframe-modal')
<div class="box">
  <div class="box-header">
    <button rel="{{url('admin/owners/create')}}" type="button" class="btn btn-info make-modal-large iframe-form-open" data-toggle="modal" data-target="#iframeModal" title="Add Seller">
    <span class="glyphicon glyphicon-plus"></span>Add
    </button>
    <button class="btn btn-success reload-page">
    <span class="glyphicon glyphicon-refresh"></span>
    </button>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <table class="table table-responsive table-bordered table-striped datatable-first-column-asc">
      <thead>
        <tr>
          <th scope="col">First Name</th>
          <th scope="col">Last Name</th>
          <th scope="col">Email</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach( $owners as $owner )
        <tr>
          <td data-label="First Name"><p class="margin-left">{{$owner->firstname}}</p></td>
          <td data-label="Last Name"><p class="margin-left">{{$owner->lastname}}</p></td>
          <td data-label="Email"><p class="margin-left">{{$owner->email}}</p></td>
          <td class="margin-left">
            <a href="#" rel="{{url('admin/owners/edit/'.$owner->id)}}" class="iframe-form-open make-modal-large btn btn-default" data-toggle="modal" data-target="#iframeModal" 
              title="Edit Seller: {{$owner->firstname}} {{$owner->lastname}}">
            <span class="glyphicon glyphicon-pencil"></span> Edit
            </a>
            <a href="javascript:confirmDelete('{{url('/admin/owners/delete/'.$owner->id.'?_token='.csrf_token())}}')" class="btn btn-danger" title="Delete Seller">
            <span class="glyphicon glyphicon-remove"></span> Delete
            </a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    <small>Display order by first name.</small>
  </div>
  <!-- /.box-body -->
</div>
@endsection
