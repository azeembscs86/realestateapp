@extends('admin.layouts.default.start-minified')
@section('contents')
<form action="{{ url('/admin/lifestyle/create') }}" method="post">
  @include('admin.lifestyle._form')
</form>
@endsection
