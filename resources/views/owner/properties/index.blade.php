@extends('owner.layouts.default.start')
@section('heading')
<link rel="stylesheet" href="http://fontawesome.io/assets/font-awesome/css/font-awesome.css" />
<link rel="stylesheet" href="https://cssgram-cssgram.netdna-ssl.com/cssgram.min.css">
<style>
h4{margin:0 0 5px 0;}
.form-control { margin-bottom: 0 !important;}

</style>

<h1>
  Properties/Listings
  <small>Your properties to be displayed for booking,<br/> sale and/or other purposes.</small>
</h1>
<ol class="breadcrumb">
  <?php if(Auth::user()->role=='owner') {  ?>
  <li><a href="{{url('/owner/dashboard')}}"><i class="fa fa-dashboard"></i> Seller Maintenance</a></li>
  <?php }else{ ?>
  <li><a href="{{url('/owner/dashboard')}}"><i class="fa fa-dashboard"></i> Buyer Options</a></li>
  <?php } ?>
  <li class="active">Properties</li>
</ol>
<br/>
@endsection
@section('contents')
<br>
<p>YOU ARE NOT DONE YET ! Property will not be live until you click "Pay Now" and purchase a subscription for each listing.</p>
<br>
@include('owner.layouts.objects.iframe-modal')
<div class="box">
  <div class="box-header">
    <!-- <button rel="{{url('owner/properties/create')}}" type="button" 
      class="btn btn-info make-modal-large iframe-form-open tst" 
      data-toggle="modal" data-target="#iframeModal" title="Add Property">
    <span class="glyphicon glyphicon-plus"></span>Add
    </button> -->
    <a href="{{url('owner/properties/create')}}" class="btn btn-info make-modal-large iframe-form-open tst"><span class="glyphicon glyphicon-plus"></span>Add Property</a>
    <button class="btn btn-success reload-page">
    <span class="glyphicon glyphicon-refresh"></span>
    </button>
<span style="margin-left: 10px;font-size: 16px;"><i class="fa fa-info-circle"></i><a href="{{url('')}}/pages/image-upload-process" target="_blank"> click here to see instructions of how to upload photos of your properties</a></span>
  <style type="text/css">
  i.fa.fa-info-circle {
    font-size: 22px;
    color: #3b9dcc;
}
</style>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <table class="table table-bordered table-striped datatable-first-column-asc seller-properties-list">
      <thead>
        <tr>
          <th scope="col">Order#</th>
          <th scope="col">Image</th>
          <th scope="col">Name</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php $i = 1; ?>
        @foreach( $properties as $property )
        <tr>
          <td data-label="Order#">{{$i}}</td>
          <td>
            @if(isset($property->images->first()->image))
            <div class="{{$property->images->first()->image_class}}">
            <img class="image-100 img-responsive" src="{{asset($property->images->first()->image)}}" alt="{{$property->title}}">
            </div>
            @endif<br/>
          </td>
          <td data-label="Name">
            <h4 class="margin-left">
              {{$property->title}}
            </h4>
            <p  class="margin-left">{{$property->category->title}}</p>
              <div class="margin-left"><i class="fa fa-bed"></i> Bedrooms:
              <?= $property->bedrooms ?>
              </div> <div class="margin-left"><i class="fa fa-bath"></i> Bathrooms:
              <?= $property->bathrooms ?>
              </div> 
          </td>
                    
          <td class="margin-left mobile-action-buttons">
            <?php if($property->monthly_subscription=='0' && $property->pay_subscription=='0' && $property->days_counter=='0') { ?>
            <button class="btn btn-default buttons-padding" onclick="location.href='{{url()}}/pricing?pid={{$property->id}}';"><i class="fa fa-money" aria-hidden="true"></i> Pay Now</button>
            <?php }else if($property->pay_subscription=='0' && $property->days_counter=='0'){ ?>
            <button class="btn btn-default buttons-padding" onclick="location.href='{{url()}}/pricing?pid={{$property->id}}';"><i class="fa fa-money" aria-hidden="true"></i> Pay Now</button>
            <?php }else{} ?>
            <a href="{{url('owner/properties/edit/'.$property->id)}}"
              class="iframe-form-open make-modal-large buttons-padding btn btn-default ediprop" 
              title="Edit Property: {{$property->title}}">
            <i class="glyphicon glyphicon-pencil"></i> <span>Edit Property<span>
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
          <th scope="col">Action</th>
        </tr>
      </tfoot>-->
    </table>
  </div>
  <!-- /.box-body -->
</div>
@endsection
