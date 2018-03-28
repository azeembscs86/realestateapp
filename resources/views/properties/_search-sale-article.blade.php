<!-- Search Result Items: Included as partial file on search page. -->
<?php
$filter_keys = '"all", ';
foreach( $property->classez as $class ) { $filter_keys .= '"'.$class->theclass->slug . '", '; }
?>
<div class="col-md-12 col-sm-6 col-xs-12 row-equal-height" data-groups='[<?php echo rtrim($filter_keys,', '); ?>]'>

  
  <div class="col-sm-12 col-md-4" > 
  @if($property->is_featured=='1')
  <span class="for-sale">Featured</span>
  @endif    
  @if($property->is_sold=='1')
    <span class="for-sale sold"><img class="img-responsive" src="{{asset('pictures/puppy-sold-new.png')}}" alt="Sold"></span> 
  @endif
    <a href="{{url('show/'.$property->slug)}}"> 
    <!-- Future: where is_main==1 -->
    @if(isset($property->images->first()->image))
            <img class="img-responsive img-hover {{$property->images->first()->image_class}}" src="{{asset($property->images->first()->image)}}" alt="{{$property->title}}">
          @else
            <img class="img-responsive img-hover" src="{{asset('pictures/placeholder.png')}}" alt="No Image Available">
          @endif  
    </a>
  </div>
  <div class="col-sm-12 col-md-5 property-type-article-description" >  
  <h5 class="pull-right">
      {!!$property->category->title!!}
      </h5>
      <h3>
    {{$property->title}} 
  </h3> 
  
  <!-- <p><i class="fa fa-map-marker"></i> {{$property->city}}, {{$property->zip}}, {{@$property->location->title}}</p> -->
  
  <p>
    {!!$property->summary!!}
  </p>
  <p>
    @foreach($property->amenities as $amenity)
      @if($amenity->value=='Yes')
      <div class="col-md-6"><i class="fa fa-check"></i>&nbsp;{{$amenity->amenity->title}}&nbsp;&nbsp;</div>
      @endif
    @endforeach
  </p>
  
  </div>
  <div class="col-sm-12 col-md-3 text-center property-type-article-price info-cell">
       <!-- @if($property->sale_price!='')
        <h3>${{number_format($property->sale_price,2)}}</h3>
        @else
        <h3>Price not mentioned</h3>
        @endif -->
        <h5><i class="fa fa-map-marker"></i> {{$property->city}}, {{$property->zip}}, {{@$property->location->title}}</h5>
        <p>
        Bedrooms <span>{{$property->bedrooms}}</span>
        </p>
        <p>
        Bathroom <span>{{$property->bathrooms}}</span>
        </p>

<style type="text/css">
  
</style>
      <a class="btn" href="{{url('show/'.$property->slug)}}">
      <i class="fa fa-th"></i> View Detail 
      </a>


      
  </div>


</div>