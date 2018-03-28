@if(isset($coupon->coupon_code_id))
<input type="hidden" name="coupon_code_id" value="{{ $coupon->coupon_code_id }}">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<p>Are you sure you want to delete this coupon <b>{{$coupon->coupon_code}}?</b></p>    
@endif