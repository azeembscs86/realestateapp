@extends('admin.layouts.default.start')
@section('heading')
<link rel="stylesheet" href="http://fontawesome.io/assets/font-awesome/css/font-awesome.css" />
<link rel="stylesheet" href="https://cssgram-cssgram.netdna-ssl.com/cssgram.min.css">
<script type="text/javascript">
  $('.modal').css({
    width: 'auto',
    height: 'auto',
    'max-height': '100%'
}).modal({
    backdrop: 'static'
});
</script>
<style type="text/css">
    .skin-green.sidebar-mini.modal-open{position:fixed !important;}
</style>
<style>
h4{margin:0 0 5px 0;}
.form-control { margin-bottom: 0;}
.status-msg{text-align: left;}
</style>
<h1>
  Properties/Listings
  <small>Your properties to be displayed for booking,<br/> sale and/or other purposes.</small>
</h1>
<ol class="breadcrumb">
  <li><a href="{{url('/admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
  <li class="active">Properties</li>
</ol>
<br/>
@endsection

@section('contents')
<div class="main-property-pop">
@include('admin.layouts.objects.iframe-modal')
<div class="box">
  <div class="box-header">
    <!-- <button rel="{{url('admin/properties/create')}}" type="button" 
      class="btn btn-info make-modal-large iframe-form-open tst" 
      data-toggle="modal" data-target="#iframeModal" title="Add Property">
    <span class="glyphicon glyphicon-plus"></span>Add
    </button> -->
    <a class="btn btn-info make-modal-large iframe-form-open tst" href="{{url('admin/properties/create')}}">Add Property</a>
    <button class="btn btn-success reload-page">
    <span class="glyphicon glyphicon-refresh"></span>
    </button>
    <?php 
      $counter = 0;
      foreach( $properties as $property ){
        $items['id'][$counter] = $property->id;
        $items['display_order'][$counter] = $property->display_order;
        $items['image'][$counter] = @$property->images->first()->image;
        $items['title'][$counter] = $property->title;
        $counter++;
      }
      ?>
    @if(isset($items))
    <?php
      session(['model'=>'Properties']);
      session(['counter' => $counter]);
      session(['items' => http_build_query($items, '$item_')]);
      ?>
    <!-- <button rel="{{url('admin/sortable')}}" type="button" 
      class="btn btn-default make-modal-large iframe-form-open" 
      data-toggle="modal" data-target="#iframeModal" title="Update Display Order">
    <span class="glyphicon glyphicon-sort"></span>Sort
    </button> -->
    <span style="margin-left: 10px;font-size: 16px;"><i class="fa fa-info-circle"></i><a href="{{url('')}}/pages/image-upload-process" target="_blank"> click here to see instructions of how to upload photos of your properties</a></span>
    @endif
  </div>
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
          <th scope="col">Status</th>
          <th scope="col">Owner</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        
       @foreach( $properties as $property )
       <tr>
       <td data-label="Order#"><p class="margin-left">{{$i}}</p></td>
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
       <td data-label="Status" class="status-msg">
              @if($property->is_active=='1')
              <p class="margin-left">Active</p>
              @endif
              @if($property->is_featured=='1')
              <p class="margin-left">Featured</p>
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
       <td data-label=" " class="margin-left mobile-action-buttons">
         <?php //if($property->is_sold=='0') { ?>
          <!-- <a onclick="return confirm('Are you sure want to mark it as sold?');" href="{{url('/admin/properties/sold/'.$property->id.'?_token='.csrf_token())}}" class="btn btn-success buttons-padding" title="Mark as Sold">
            <i class="fa fa-check"></i> <span>Mark as Sold</span>
            </a> -->
            <?php //} else { ?>
            <!-- <button disabled class="btn btn-success buttons-padding">SOLD</button> -->
            <?php //} ?>
            <a href="{{url('admin/properties/edit/'.$property->id)}}" 
              class="buttons-padding iframe-form-open make-modal-large btn btn-default ediprop" 
              title="Edit Property: {{$property->title}}">
            <i class="glyphicon glyphicon-pencil"></i> <span>Edit Property<span>
            </a>
            <!-- <a href="#" rel="{{url('admin/properties/edit/'.$property->id)}}" 
              class="buttons-padding iframe-form-open make-modal-large btn btn-default ediprop" 
              data-toggle="modal" data-target="#iframeModal" 
              title="Edit Property: {{$property->title}}">
            <i class="glyphicon glyphicon-pencil"></i> <span>Edit Property<span>
            </a> -->
            <!-- <a href="javascript:properticonfirmDelete('{{url('/admin/properties/delete/'.$property->id.'?_token='.csrf_token())}}')" class="btn buttons-padding btn-danger" title="Delete Property">
            <i class="glyphicon glyphicon-remove"></i> <span>Delete Property</span>
            </a> -->
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
          <th scope="col">Status</th>
          <th scope="col">Owner</th>
          <th scope="col">Action</th>
        </tr>
      </tfoot>-->
    </table>
    <span class="bg-danger">Note:</span> Maximum 6 featured properties can show on the home page.<br/>
    Only active properties will be available for frontend use.
  </div>
  <!-- /.box-body -->
</div>
</div>
@endsection