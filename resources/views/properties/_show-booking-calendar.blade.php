<!-- Calendar for showing property availability and clicking and booking the desired dates of reservation -->

<style>
.form-horizontal .form-group {
  margin-left: 0;
  margin-right: 0;
}
.submit-btn-1 { padding: 5px 20px 6px; text-align: right;}
</style>
<div class="row">
	<h3 class="text-left self-modify">Select dates of your stay!</h3>
	<form id="select-the-dates-form" class="form-horizontal" role="form" action="{{url('reserve/'.$property->slug)}}/redirect" method="get">
		<div class="col-md-12">
			<div class="form-group"> 
				<span id="property-calendar-select-dates">	
					<p>Loading availability calendar...</p><i class="fa fa-refresh fa-spin"></i>
				</span> 
			</div>
			<div class="form-group" >
				<span class="pull-right">
					<mark>
						Minimum Stay: {{$property->minimum_stay_nights}} @if($property->minimum_stay_nights==1) Night @else Nights @endif
					</mark>
				</span>
			</div>
			<!-- upgrade - 12/10/2016 - minimum_nights -->

			<input type="hidden" name="dates_searched" id="dates-searched" value="<?= @implode(',',\Session::get('dates_searched')) ?>">
			<div class="form-group" id="booking-availability-message">
				<!-- AJAX PRICE RESULT SHOWN HERE FOR SELECTED DATES -->
			</div>
			<div class="form-group">
				<span id="calculated-lodging-price">
					<!-- calculated-lodging-price -->
				</span>
			</div>
			<div class="form-group hidden" id="calculation-error-container">
				<div class="alert alert-danger">
					<span id="calculation-error-message">
						<!-- Calculation Error Message -->
					</span>
				</div>
			</div>
		</div>
		<!--Let the user fill the form and start booking a reservation-->
		<div class="col-md-12">
			<div class="set-form-layout">
				<div class="form-group">
					<label for="firstname">First Name:</label>
					<input class="form-control" type="text" id="firstname" name="firstname" value="@if(old('firstname')){!! old('firstname') !!}@endif" placeholder="Enter your first name" required />
				</div>
				<div class="form-group">
					<label for="firstname">Last Name:</label>
					<input class="form-control" type="text" id="lastname" name="lastname" value="@if(old('lastname')){!! old('lastname') !!}@endif" placeholder="Enter your last name" required />
				</div>
				<div class="form-group">
					<label for="firstname">Email:</label>
					<input class="form-control" type="email" id="email" name="email" value="@if(old('email')){!! old('email') !!}@endif" placeholder="Enter your email" required />
				</div>
				<div class="pull-right">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<button type="submit" class="submit-btn-1"> Reserve <span class="glyphicon glyphicon-chevron-right"></span> </button>
				</div>
			</div>
		</div>
	</form>
</div>


