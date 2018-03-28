@extends('layouts.default.start')

<!-- Goes to html>head>title -->
<?php $page_metas = \App\Pages::where('id', 42)->where('is_active', 1)->first(); ?>
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
	Pricing - {{$settings->site_title}}
@endsection

<!-- Yields body of the page inside the template -->

@section('contents')
<style type="text/css">

a#disab1 ,a#disab1:hover, a#disab2, a#disab2:hover, a#disab3, a#disab3:hover {
    background-color: #d7d7d7;
    border: 2px solid #d7d7d7;
    cursor: auto;
    color: #fff;
}
.stripe-button-el, .stripe-button-el:not(:disabled):active span, .stripe-button-el.active span, .stripe-button-el:not(:disabled):active, .stripe-button-el.active{
	background-image: none; 
	background: transparent; */
    /* background-image: -webkit-linear-gradient(#7dc5ee,#008cdd 85%,#30a2e4); */
    background-image: -moz-linear-gradient(none);
    background-image: -ms-linear-gradient(none);
    background-image: -o-linear-gradient(none);
    background-image: -webkit-linear-gradient(none);
    background-image: -moz-linear-gradient(none);
    background-image: -ms-linear-gradient(none);
    background-image: -o-linear-gradient(none);
    background-image: linear-gradient(none);
    -webkit-box-shadow: 0 0 rgba(0,0,0,0);
    -moz-box-shadow: 0 0 rgba(0,0,0,0);
    -ms-box-shadow: 0 0 rgba(0,0,0,0);
    -o-box-shadow: 0 0 rgba(0,0,0,0);
    box-shadow: 0 0 rgba(0,0,0,0);
	font-family: 'Montserrat', sans-serif;
}
.stripe-button-el span{
	font-weight: 500;
	padding: 1.3px !important;
	text-transform: uppercase;
    display: table;
    width: 150px;
    margin: 0 auto;
    background-color: #ff6c2c;
    color: #fff;
    padding: 4px;
    border-radius: 50px;
    border: 2px solid #ff6c2c;
	height: auto;
	font-family: 'Montserrat', sans-serif;
    background-image: none; 
    /* background-image: -webkit-linear-gradient(#7dc5ee,#008cdd 85%,#30a2e4); */
    background-image: -moz-linear-gradient(none);
    background-image: -ms-linear-gradient(none);
    background-image: -o-linear-gradient(none);
    background-image: -webkit-linear-gradient(none);
    background-image: -moz-linear-gradient(none);
    background-image: -ms-linear-gradient(none);
    background-image: -o-linear-gradient(none);
    background-image: linear-gradient(none);
}
.stripe-button-el span:hover{
	color: #ff6c2c;
    background-color: #fff;
}
.check-box{
	font-size: 11px;
    line-height: 15px;
}
.check-box-text{
	float: left;
    margin-top: 5px;
}
input.form-check-input.chkbx {
    width: 15px;
    height: 20px;
    text-align: left;
    float: left;
}
</style>
	<div class="breadcrumbs-area bread-bg-pricing bg-opacity-black-70">    
		<div class="container">         
			<div class="row">        
				<div class="col-xs-12">     
					<div class="breadcrumbs">        
						<h2 class="breadcrumbs-title">Pricing</h2>  
						<ul class="breadcrumbs-list">           	
							<li><a href="{{url()}}">Home</a></li>   
							<li>Pricing</li>        
						</ul>                  
					</div>         
				</div>         
			</div>
        </div>
    </div>
	<section id="page-content" class="page-wrapper">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 pt-80 pb-80 pricing-content">
					<h3>Pricing Plans tailored for your needs</h3>
					<p>We would like to invite you to use MatchPropertyDirect™. This site introduces buyer and seller together for direct communication, No Commission ! You choose your own attorney, You set the price of your property, You are in charge of your sale. You will have the ability through email and on line chat to work out showings, describe your property the way only you can do ! You can fill in information about your favorite pets, your hobbies, and why you love where you live ! That way when you connect you will be in contact with each other and then start the conversation reaching a worldwide audience ! Simple and easy to use. Created for anyone buying a property or selling a property ! Signup below $59 per month per property, $159 for 6 month per property, $259 per year per property.</p>
					<div class="pricingArea">
						<div class="pricingWrap">
							<div class="duration"><p>1 Month</p></div>
							<div class="aboutPackage">
								<p class="pricing">$59</p>
								<p class="duration">/ month per listing</p>
								<!-- <p class="trialDuration">30 DAYS TRIAL</p> -->
								<?php 
								if (Auth::check() && Auth::user()->role=='owner') { 
									if (isset($_GET['pid'])){
								?>
								<div class="form-check">
		  							  <label class="form-check-label check-box">
		      								<input type="checkbox" name="terms1" class="form-check-input chkbx" value="firstform" rel="1">
		      								<span class="check-box-text">Subscriber agrees to no refunds and <br>accepts all terms and conditions for <br>purchasing a subscription to <br>Match Property Direct</span>
		    							</label>
		  						</div>
								<form action="{{url()}}/stripe/charge.php" method="POST" id="firstform" style="display: none;">
									<input type="hidden" name="pid" id="pid" value="<?php if (isset($_GET['pid'])){ echo $_GET['pid']; } ?>">
									<input type="hidden" name="pckg_amount" id="pckg_amount" value="6315">
									<input type="hidden" name="pckg_month" id="pckg_month" value="1month">
									<input type="hidden" name="pckg_decp" id="pckg_decp" value="/ Month per listing + taxes ($4.15)">
								  <script
								    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
								    data-key="pk_live_iZpQyPmqoLJMWm4Egewp3PX8"
								    data-image="{{url()}}/img/site-logo-default-dark.png"
								    data-name="MatchPropertyDirect™"
								    data-description="/ Month per listing + taxes ($4.15)"
								    data-amount="6315">
								  </script>
								</form>
								<a id="disab1" href="javascript:void(0);" class="pricingBtn">Pay with Card</a>
								<?php }else{ ?>
								
								<a href="{{url()}}/owner/properties" class="pricingBtn">Select Property</a>
								<?php } }else{ ?>
								<a href="{{url()}}/register" class="pricingBtn">Sign Up</a>
								<?php } ?>
							</div>
						</div>
						<div class="pricingWrap">
							<div class="duration"><p>6 Months</p></div>
							<div class="aboutPackage">
								<p class="pricing">$159</p>
								<p class="duration">/ 6 month per listing</p>
								<!-- <p class="trialDuration">30 DAYS TRIAL</p> -->
								<?php 
								if (Auth::check() && Auth::user()->role=='owner') { 
									if (isset($_GET['pid'])){
								?>
								<div class="form-check">
		  							  <label class="form-check-label check-box">
		      								<input type="checkbox" name="terms2" class="form-check-input chkbx" value="secondform" rel="2">
		      								<span class="check-box-text">Subscriber agrees to no refunds and <br>accepts all terms and conditions for <br>purchasing a subscription to <br>Match Property Direct</span>
		    							</label>
		  						</div>
								<form action="{{url()}}/stripe/charge.php" method="POST" id="secondform" style="display: none;">
									<input type="hidden" name="pid" id="pid" value="<?php if (isset($_GET['pid'])){ echo $_GET['pid']; } ?>">
									<input type="hidden" name="pckg_amount" id="pckg_amount" value="17015">
									<input type="hidden" name="pckg_month" id="pckg_month" value="6month">
									<input type="hidden" name="pckg_decp" id="pckg_decp" value="/ 6 month per listing + taxes ($11.15)">
								  <script
								    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
								    data-key="pk_live_iZpQyPmqoLJMWm4Egewp3PX8"
								    data-image="{{url()}}/img/site-logo-default-dark.png"
								    data-name="MatchPropertyDirect™"
								    data-description="/ 6 month per listing + taxes ($11.15)"
								    data-amount="17015">
								  </script>
								</form>
								<a id="disab2" href="javascript:void(0);" class="pricingBtn">Pay with Card</a>
								<?php }else{ ?>
								
								<a href="{{url()}}/owner/properties" class="pricingBtn">Select Property</a>
								<?php } }else{ ?>
								<a href="{{url()}}/register" class="pricingBtn">Sign Up</a>
								<?php } ?>
							</div>
						</div>
						<div class="pricingWrap">
							<div class="duration"><p>1 Year</p></div>
							<div class="aboutPackage">
								<p class="pricing">$259</p>
								<p class="duration">/ year per listing</p>
								<!-- <p class="trialDuration">30 DAYS TRIAL</p> -->
								<?php 
								if (Auth::check() && Auth::user()->role=='owner') { 
									if (isset($_GET['pid'])){
								?>

								<div class="form-check">
		  							  <label class="form-check-label check-box">
		      								<input type="checkbox" name="terms3" class="form-check-input chkbx" value="thirdform" rel="3">
		      								<span class="check-box-text">Subscriber agrees to no refunds and <br>accepts all terms and conditions for <br>purchasing a subscription to <br>Match Property Direct</span>
		    							</label>
		  						</div>
								<form action="{{url()}}/stripe/charge.php" method="POST" id="thirdform" style="display: none;">
									<input type="hidden" name="pid" id="pid" value="<?php if (isset($_GET['pid'])){ echo $_GET['pid']; } ?>">
									<input type="hidden" name="pckg_amount" id="pckg_amount" value="27715">
									<input type="hidden" name="pckg_month" id="pckg_month" value="12month">
									<input type="hidden" name="pckg_decp" id="pckg_decp" value="/ Year per listing + taxes ($18.15)">
								  <script
								    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
								    data-key="pk_live_iZpQyPmqoLJMWm4Egewp3PX8"
								    data-image="{{url()}}/img/site-logo-default-dark.png"
								    data-name="MatchPropertyDirect™"
								    data-description="/ Year per listing + taxes ($18.15)"
								    data-amount="27715">
								  </script>
								</form>
								<a id="disab3" href="javascript:void(0);" class="pricingBtn">Pay with Card</a>
								<?php }else{ ?>
								
								<a href="{{url()}}/owner/properties" class="pricingBtn">Select Property</a>
								<?php } }else{ ?>
								<a href="{{url()}}/register" class="pricingBtn">Sign Up</a>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection

@section('javascript')
	<script type="text/javascript">
	  $(document).ready(function() {
	    $('#light-gallery').lightGallery({
	      selector: '.light-gallery-item'
	    });
	  });
	  jQuery(document).on("click", ".chkbx", function () {
	  	var rel = $(this).attr("rel");
	  	var formid = $(this).attr("value");
	  	var result = jQuery('input[name="terms'+rel+'"]:checked');
	  	if ($('input[name="terms'+rel+'"]').prop('checked')) {
	  		$("#"+formid).css({ 'display': "block" });
	  		$("#disab"+rel).css({ 'display': "none" });
	  	}else{
	  		$("#"+formid).css({ 'display': "none" });
	  		$("#disab"+rel).css({ 'display': "block" });
	  	}
	  });	
	</script>
	<!-- Picture Gallery -->
    <!-- jQuery already included @ jquery-2.1.0.js -->
    <link type="text/css" rel="stylesheet" href="{{ asset('resources/plugins/lightGallery-master/dist/css/lightgallery.css')}}" />
    <!-- /. Picture Gallery -->
@endsection