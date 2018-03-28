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
@include('owner.layouts.objects.iframe-modal')
<div class="box">
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
        <?php if($property->pay_subscription=='1' && $property->days_counter=='1') { ?>
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
          <?php if($property->is_sold=='0') { ?>
          <a onclick="return confirm('Are you sure want to mark it as sold?');" href="{{url('/owner/marksoldproperties/sold/'.$property->id.'?_token='.csrf_token())}}" class="btn btn-success buttons-padding" title="Mark as Sold">
            <i class="fa fa-check"></i> <span>Mark as Sold</span>
            </a>
            <?php } else { ?>
            <button disabled class="btn btn-success buttons-padding">SOLD</button>
            <?php } ?>
          </td>
        </tr>
        <?php }else{} ?>
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
