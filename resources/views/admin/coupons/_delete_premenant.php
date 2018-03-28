@if(isset($coupons->coupon_code_id))
<input type="hidden" name="coupon_code_id" value="{{ $coupons->coupon_code_id }}">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<p>Are you sure you want to delete this coupon <b>{{$coupons->coupon_code}}?</b></p>    
@endif