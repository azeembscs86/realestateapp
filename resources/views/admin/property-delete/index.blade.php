@extends('admin.layouts.default.start')
@section('heading')
<link rel="stylesheet" href="http://fontawesome.io/assets/font-awesome/css/font-awesome.css" />
<link rel="stylesheet" href="https://cssgram-cssgram.netdna-ssl.com/cssgram.min.css">
<style>
h4{margin:0 0 5px 0;}
.form-control { margin-bottom: 0;}
.status-msg{text-align: left;}
</style>
<h1>
  Properties/Listings
  <small>Your properties to be displayed for booking, sale and/or other purposes.</small>
</h1>
<ol class="breadcrumb">
  <li><a href="{{url('/admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
  <li class="active">Properties</li>
</ol>
<br/>
@endsection
@section('contents')
@include('admin.layouts.objects.iframe-modal')
<div class="box asa">
  <style type="text/css">
  i.fa.fa-info-circle {
    font-size: 22px;
    color: #3b9dcc;
}
</style>
  <!-- /.box-header -->
  <?php $i = 1; ?>
  <div class="box-body">
    <table class="table table-responsive table-bordered table-striped datatable-first-column-asc">
      <thead>
        <tr>
          <th scope="col">Order#</th>
          <th scope="col">Image</th>
          <th scope="col">Name</th>
          <th scope="col" class="owner-width">Owner</th>
          <th scope="col" class="action-width">Action</th>
        </tr>
      </thead>
      <tbody>
        
       @foreach( $properties as $property )
       <tr>
       <td data-label="Order#">{{$i}}</td>
       <td>
         @if(isset($property->images->first()->image_small))
          <div class="{{$property->images->first()->image_class}}">
            <img class="image-100 img-responsive" src="{{asset($property->images->first()->image)}}" alt="{{$property->title}}">
           </div> 
            @endif<br/>
       </td>
       <td data-label="Name">
            <h4 class="margin-left">
              {{$property->title}} <!--<small>#{{$property->code}}</small>-->
            </h4>
            <p class="margin-left"> <div class="margin-left"><i class="fa fa-bed"></i> Bedrooms:
              <?= $property->bedrooms ?>
              </div> <div class="margin-left"><i class="fa fa-bath"></i>  Bathrooms:
              <?= $property->bathrooms ?>
              </div>
            </p>
       </td>
       <td data-label="Status" class="status-msg" style="display: none">
              @if($property->is_active=='1')
              <p>Active</p>
              @endif
              @if($property->is_featured=='1')
              <p>Featured</p>
              @endif
              <!--@if($property->is_new=='1')
              <li>New</li>
              @endif
              @if($property->is_sale=='1')
              <li>Sale</li>
              @endif-->
       </td>
       <td data-label="Owner">
         <?php 
           $owner_id = $property->user_id;
           //echo $owner_id;
           //$owner_details = DB::table('users')->where('id',$owner_id)->first();
           $owner_details = DB::table('users')->where('id',$owner_id)->get();
            //echo '<pre>'; print_r($owner_details).'<br>';
            foreach ($owner_details as $key => $object) {
                echo '<div class="margin-left">'.$object->firstname.' '.$object->lastname.'</div><div class="margin-left owner-email">'.$object->email.'</div>';
            }
          // echo $owner_details->firstname.' '.$owner_details->lastname.'<br>'.$owner_details->email;
          ?>
       </td>
       <td class="margin-left mobile-action-buttons">
            <a href="javascript:properticonfirmDelete('{{url('/admin/deleteproperties/delete/'.$property->id.'?_token='.csrf_token())}}')" class="btn buttons-padding btn-danger" title="Delete Property">
            <i class="glyphicon glyphicon-remove"></i> <span>Delete Property</span>
            </a>
       </td>
       </tr>
       <?php $i++; ?>
       @endforeach
      </tbody>
      <!--<tfoot>
        <tr>
          <th scope="col">Order#</th>
          <th scope="col">Image</th>
          <th scope="col">Name</th>
          <th scope="col">Owner</th>
          <th scope="col">Action</th>
        </tr>
      </tfoot>-->
    </table>
  </div>
  <!-- /.box-body -->
  <br><br>
  <p>Match Property Direct wants our subscribers to be completely happy with their listing on our site. If for whatever reason you feel like you want to delete your property please push the delete button.</p>

<p>Please be aware that there are no refunds and by deleting this property you will have to start all over again with the site if you choose re-list.</p>

Sincerely,<br>
<strong>Match Property Direct Management.</strong>
</div>
@endsection
