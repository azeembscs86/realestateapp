@extends('admin.layouts.default.start')

@section('heading')

<h1>

  Email Templates

  <small>Optional description</small>

</h1>

<ol class="breadcrumb">

  <li><a href="{{url('/admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>

  <li class="active">Email Templates</li>

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
    
  <div class="box-body">

    <table class="table table-responsive table-bordered table-striped datatable-first-column-asc">

      <thead>

        <tr>

          <th scope="col">Subject</th>

          <th scope="col">Action</th>

        </tr>

      </thead>

      <tbody>

        @foreach( $emailtemplates as $emailtemplate )

        <tr>

          <td data-label="Subject"><p class="margin-left">{{$emailtemplate->email_subject}}</p></td>

          <td class="margin-left">

            <a href="#" rel="{{url('admin/email-templates/edit/'.$emailtemplate->id)}}" 

              class="iframe-form-open make-modal-large btn btn-default" 

              data-toggle="modal" data-target="#iframeModal" 

              title="Edit Email Template: {{$emailtemplate->email_subject}}">

            <span class="glyphicon glyphicon-pencil"></span>

            </a>

          </td>

        </tr>

        @endforeach

      </tbody>

    <!--  <tfoot>

        <tr>

          <th>Subject</th>

          <th>Action</th>

        </tr>

      </tfoot> -->

    </table>

  </div>

  <!-- /.box-body -->

</div>

@endsection

