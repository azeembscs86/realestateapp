@extends('layouts.default.start')

<!-- Goes to html>head>title -->
<?php $page_metas = \App\Pages::where('id', 49)->where('is_active', 1)->first(); ?>
@section('metatits')
{{$page_metas->meta_title}}
@endsection
@section('metadesc')
{{$page_metas->meta_descript}}
@endsection
@section('metakeys')
{{$page_metas->meta_keyword}}
@endsection
@section('title')
	How It Works - {{$settings->site_title}}
@endsection

<!-- Yields body of the page inside the template -->

@section('contents')

	<div class="breadcrumbs-area bread-bg-showproperties bg-opacity-black-70">    
		<div class="container">         
			<div class="row">        
				<div class="col-xs-12">     
					<div class="breadcrumbs">        
						<h2 class="breadcrumbs-title">Show Properties</h2>  
						<ul class="breadcrumbs-list">           	
							<li><a href="{{url()}}">Home</a></li>   
							<li>Show Properties</li>        
						</ul>                  
					</div>         
				</div>         
			</div>
        </div>
    </div>
	<section id="page-content" class="featured-flat-area pb-80 pt-115">
		<div class="container">
			<div class="featured-flat">
			<div class="row">   
				<div id="paging_container7" class="container">
				
				<ul class="content">
				@foreach($footer_properties as $property)	
				<li>
				<div class="col-md-4 col-sm-6 col-xs-12">
				<div class="flat-item">
				<div class="flat-item-image">
				@if($property->is_featured=='1')
				<span class="for-sale">Featured</span>
				@endif	  
				@if($property->is_sold=='1')
<span class="for-sale sold"><img class="img-responsive" src="{{asset('pictures/puppy-sold-new.png')}}" alt="Sold"></span> 
@endif
					
					@if(isset($property->images->first()->image))
						<img class="img-responsive {{$property->images->first()->image_class}}" src="{{asset($property->images->first()->image)}}" alt="{{$property->title}}">
					@else
						<img class="img-responsive" src="{{asset('pictures/placeholder.png')}}" alt="No Image Available">
					@endif       
					
					<div class="flat-link"> 
						<a href="{{url('show/'.$property->slug)}}">More Details</a>     
					</div>
					<ul class="flat-desc">
						<li><img src="{{ asset('resources/images/icons/4.png ')}}" alt=""><span>{{$property->area ? $property->area : '0'}}</span></li>
						<li><img src="{{ asset('resources/images/icons/5.png ')}}" alt=""><span> {{$property->bedrooms}} </span></li>
						<li><img src="{{ asset('resources/images/icons/6.png ')}}" alt=""><span> {{$property->bathrooms}} </span> </li>
					</ul>
				</div>
				<div class="flat-item-info">
							<div class="flat-title-price">
								<h5><a href="{{url('show/'.$property->slug)}}">{{$property->title}}  </a></h5>
								<?php if(isset($_COOKIE['user_currency'])){ ?>
								<span class="price"><?php echo $_COOKIE['currency_symbol'].' '.EnvatoUser::calculateCurrency($property->currency_code,$_COOKIE['user_currency'],$property->sale_price); ?></span>
								<?php }else{ ?>	
								<span class="price">{{$property->currency_code}}-{{$property->sale_price}}<!-- ${{number_format($property->sale_price,2)}} --></span>
								<?php } ?>
								<!-- @if($property->sale_price!='')
								<span class="price">${{number_format($property->sale_price,2)}}</span>
								@else
						        <span class="price">$0</span>
						        @endif                               -->          
							</div>
							<p>
								<img src="{{ asset('resources/images/icons/location.png')}}" alt="">
								{{$property->city}}, {{$property->zip}}  
							</p>
						</div>
				</div>
				</div>
				</li>
				@endforeach
				</ul>
				<script type="text/javascript" src="{{ asset('resources/plugins/unitegallery-master/source/unitegallery/js/jquery.pajinate.js')}}"></script>
	<script type="text/javascript">
			jQuery(document).ready(function(){
				jQuery('#paging_container7').pajinate({
					num_page_links_to_display : 3,
					items_per_page : 6	
				});
			});	
		</script>
				<div class="page_navigation"></div>
			</div>
			</div>
		</div>
		</div>
	</section>
@endsection