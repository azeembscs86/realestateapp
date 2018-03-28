@extends('admin.layouts.default.start-minified')
@section('contents')
<form action="{{ url('/admin/coupons/update') }}" method="post">
  @include('admin.coupons._form')
</form>
@endsection