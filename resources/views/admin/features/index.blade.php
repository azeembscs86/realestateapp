@extends('admin.layouts.default.start')

@section('heading')

<h1>

  Features

  <small>Attributes to make your property prominent. Can show, dimentions, area, etc.</small>

</h1>

<ol class="breadcrumb">

  <li><a href="{{url('/admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>

  <li class="active">Features</li>

</ol>

<br/>

@endsection

@section('contents')

@include('admin.layouts.objects.iframe-modal')

<div class="box">

  <div class="box-header">

    <button rel="{{url('admin/features/create')}}" type="button" 

      class="btn btn-info make-modal-large iframe-form-open" 

      data-toggle="modal" data-target="#iframeModal" title="Add Feature">

    <span class="glyphicon glyphicon-plus"></span>Add

    </button>

    <button class="btn btn-success reload-page">

    <span class="glyphicon glyphicon-refresh"></span>

    </button>

    <?php 

      $counter = 0;

      foreach( $features as $feature ){

        $items['id'][$counter] = $feature->id;

        $items['display_order'][$counter] = $feature->display_order;

        $items['image'][$counter] = $feature->image;

        $items['title'][$counter] = $feature->title;

        $counter++;

      }

      ?>

    @if(isset($items))

    <?php

      session(['model'=>'Features']);

      session(['counter' => $counter]);

      session(['items' => http_build_query($items, '$item_')]);

      ?>

    <button rel="{{url('admin/sortable')}}" type="button" 

      class="btn btn-default make-modal-large iframe-form-open" 

      data-toggle="modal" data-target="#iframeModal" title="Update Display Order">

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

          <th scope="col" >Title</th>

          <th scope="col" >Action</th>

        </tr>

      </thead>

      <tbody>

        @foreach( $features as $feature )

        <tr>

          <td data-label="Order#" class="display-none">{{$feature->display_order}}</td>

          <td data-label="Title"><p class="margin-left">{{$feature->title}}</p></td>

          <td class="margin-left">

            <a href="#" rel="{{url('admin/features/edit/'.$feature->id)}}" 

              class="iframe-form-open make-modal-large btn btn-default" 

              data-toggle="modal" data-target="#iframeModal" 

              title="Edit Feature: {{$feature->title}}">

            <span class="glyphicon glyphicon-pencil"></span> Edit

            </a>

            <a href="javascript:confirmDelete('{{url('/admin/features/delete/'.$feature->id.'?_token='.csrf_token())}}')" class="btn btn-danger">

            <span class="glyphicon glyphicon-remove"></span> Delete

            </a>

          </td>

        </tr>

        @endforeach

      </tbody>

      <!--<tfoot>

        <tr>

          <th>Order#</th>

          <th>Title</th>

          <th></th>

        </tr>

      </tfoot>-->

    </table>

  </div>

  <!-- /.box-body -->

</div>

@endsection

