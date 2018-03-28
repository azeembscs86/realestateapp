@extends('admin.layouts.default.start')

@section('heading')

<h1>

  Lifestyle Categories

  <!-- <small>The available facilities at your property. For example, Internet, Air Conditioning, Washers &amp; Dryer.</small> -->

</h1>

<ol class="breadcrumb">

  <li><a href="{{url('/admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>

  <li class="active">Lifestyle Categories</li>

</ol>

<br/>

@endsection

@section('contents')

@include('admin.layouts.objects.iframe-modal')

<div class="box">

  <div class="box-header">

    <button rel="{{url('admin/lifestyle/create')}}" type="button" 

      class="btn btn-info make-modal-large iframe-form-open" 

      data-toggle="modal" data-target="#iframeModal" title="Add Lifestyle Category">

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

          <th scope="col" class="display-none">Order#</th>

          <th scope="col">Title</th>

          <td scope="col">Action</td>

        </tr>

      </thead>

      <tbody>

        <?php $sr=1; ?>

        @foreach( $lifestyle as $single )

        <tr>

          <td data-label="Order#" class="display-none">{{$sr++}}</td>

          <td data-label="Title"><p class="margin-left">{{$single->title}}</p></td>

          <td class="margin-left">

            <a href="#" rel="{{url('admin/lifestyle/edit/'.$single->id)}}" 

              class="iframe-form-open make-modal-large btn btn-default" 

              data-toggle="modal" data-target="#iframeModal" 

              title="Edit Lifestyle Category: {{$single->title}}">

            <span class="glyphicon glyphicon-pencil"></span> Edit

            </a>

            <a href="javascript:confirmDelete('{{url('/admin/lifestyle/delete/'.$single->id.'?_token='.csrf_token())}}')" class="btn btn-danger">

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

