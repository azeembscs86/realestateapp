@extends('admin.layouts.default.start-minified')
@section('contents')
<form action="{{ url('/admin/coupons/destroy') }}" method="post">
  @include('admin.coupons._delete_coupon')
</form>
@endsection
