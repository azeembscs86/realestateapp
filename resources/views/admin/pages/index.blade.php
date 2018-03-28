@extends('admin.layouts.default.start')
@section('heading')
<style>
.status-msg{text-align: center;}
</style>
<h1>
  Pages
  <small>Site contents; pages</small>
</h1>
<ol class="breadcrumb">
  <li><a href="{{url('/admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
  <li class="active">Pages</li>
</ol>
<br/>
@endsection
@section('contents')
@include('admin.layouts.objects.iframe-modal')
@include('admin.layouts.objects.iframe-modal-simple')
<div class="box">
  <div class="box-header">
    <button rel="{{url('admin/pages/create')}}" type="button" 
      class="btn btn-info make-modal-large iframe-form-open" 
      data-toggle="modal" data-target="#iframeModal" title="Add Page">
    <span class="glyphicon glyphicon-plus"></span>Add
    </button>
    <button class="btn btn-success reload-page">
    <span class="glyphicon glyphicon-refresh"></span>
    </button>
    <?php 
      $counter = 0;
      ?>
    @if(isset($items))
    <?php
      session(['model'=>'Pages']);
      session(['counter' => $counter]);
      session(['items' => http_build_query($items, '$item_')]);
      ?>
    <button rel="{{url('admin/sortable')}}" type="button" 
      class="btn btn-default make-modal-large iframe-form-open" 
      data-toggle="modal" data-target="#iframeModalSimple" title="Update Display Order">
    <span class="glyphicon glyphicon-sort"></span>Sort
    </button>
    @endif
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <table class="table table-responsive table-bordered table-striped datatable-first-column-asc">
      <thead>
        <tr>
          <th scope="col" class="display-none">Order#</th>
          <th scope="col">Image</th>
          <th scope="col">Name</th>
          <th scope="col">Status</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach( $pages as $page )
        <tr>
          <td data-label="Order#" class="display-none">{{$page->display_order}}</td>
          <td>
            @if(isset($page->images->first()->image))
            <img class="image-100 img-responsive" src="{{asset($page->images->first()->image)}}" alt="{{$page->title}}">
            <!--({{count($page->images)}})-->
            @endif
          </td>
          <td data-label="Name">
            <h4 class="margin-left">{{$page->title}}</h4>
            <p class="margin-left">{{@$page->category->title}}</p>
          </td>
          <td data-label="Status" class="status-msg">
              @if($page->is_active=='1')
              <p>Active</p>
              @endif
              <!-- @if($page->is_featured=='1')
              <li>Featured</li>
              @endif
              @if($page->is_new=='1')
              <li>New</li>
              @endif
              @if($page->is_home=='1')
              <li>Home page</li>
              @endif -->
          </td>
          <td class="margin-left">
            <a href="#" rel="{{url('admin/pages/edit/'.$page->id)}}" 
              class="iframe-form-open make-modal-large btn btn-default" 
              data-toggle="modal" data-target="#iframeModal" 
              title="Edit Property: {{$page->title}}">
            <span class="glyphicon glyphicon-pencil"></span> Edit
            </a>
            <a href="javascript:confirmDelete('{{url('/admin/pages/delete/'.$page->id.'?_token='.csrf_token())}}')" class="btn btn-danger">
            <span class="glyphicon glyphicon-remove"></span> Delete
            </a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <!-- /.box-body -->
</div>
@endsection