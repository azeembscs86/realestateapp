@if(isset($coupon->coupon_code_id))
<input type="hidden" name="coupon_code_id" value="{{ $coupon->coupon_code_id }}">
@endif
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<div class="form-group">
  <label class="col-sm-3 col-xs-12 control-label">Title/Coupon Code<font color="#FF0000">*</font></label>
  <div class="col-sm-9 col-xs-12">
    <input 
      type="text"
      name = "coupon_code"
      placeholder="Enter Coupon code here"
      value="@if(old('coupon_code')){!! old('coupon_code') !!}@elseif(isset($coupon->coupon_code)){!!$coupon->coupon_code!!}@endif"
      class="form-control"
       required=""
      />
  </div>
  <div class="form-group">
  <label class="col-sm-3 col-xs-12 control-label">Coupon Amount<font color="#FF0000">*</font></label>
  <div class="col-sm-9 col-xs-12">
    <input 
      type="text"
      name = "coupon_amount"
      placeholder="Enter Coupon amount here"
      value="@if(old('coupon_amount')){!! old('coupon_amount') !!}@elseif(isset($coupon->coupon_amount)){!!$coupon->coupon_amount!!}@endif"
      class="form-control"
       required=""/>
  </div>

</div>

