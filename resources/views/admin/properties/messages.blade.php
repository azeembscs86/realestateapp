@extends('admin.layouts.default.start')

@section('heading')

<link rel="stylesheet" href="http://fontawesome.io/assets/font-awesome/css/font-awesome.css" />

<style>

h4{margin:0 0 5px 0;}

.form-control { margin-bottom: 0;}

</style>

<h1>

  

{{$page_title}}  

</h1>

<ol class="breadcrumb">

  <li><a href="{{url('/admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>

  <li class="active">

{{$page_title}}</li>

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

          <th scope="col" class="display-none">Order#</th>

          <th scope="col">From</th>

          <th scope="col">To</th>

          <th scope="col">Message</th>

          <th scope="col">Time</th>

          <th scope="col">Status</th>

          <th scope="col">View</th>

        </tr>

      </thead>

      <tbody>

        @foreach( $messages as $single )

        <tr>

          <td data-label="Order#" class="display-none">

            {{$single->message_id}}

          </td>

          <td data-label="From">

           <p class="margin-left">{{$single->from_uname}}</p>

          </td>

          <td data-label="To">

            <p class="margin-left">{{$single->to_uname}}</p>

          </td>

          <td data-label="Message">

            <p class="margin-left">{{$single->message_content}}</p>

          </td>

          <td data-label="Time">
            <p class="margin-left">
              <?php echo date('M dS g:iA', strtotime($single->message_date)); ?>
            </p>
          </td>

          <td data-label="Status">

          <p class="margin-left"> <?php $btns = ["<span class='label label-info'>Unread</span>","<span class='label label-success'>Read</span>"]; echo $btns[$single->recd] ?></p>

          </td>

          <td data-label="View">
          <p class="margin-left">
          <a href="{{url('admin/properties/messages')}}/<?php echo $single->from_uname.'/'.$single->to_uname ?>" data-toggle="tooltip" data-original-title="Filter <?php echo $single->from_uname ?> and <?php echo $single->to_uname ?> Conversation"> <i class="fa fa-eye font-bold"></i></a>  
          </p>


          </td>

        </tr>

        @endforeach

      </tbody>

    </table>

  </div>

  <!-- /.box-body -->

</div>

@endsection

