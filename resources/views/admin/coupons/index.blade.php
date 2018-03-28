@extends('admin.layouts.default.start')
@section('heading')
<h1>
    Coupons    
</h1>
<ol class="breadcrumb">
    <li><a href="{{url('/admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Coupons</li>
</ol>
<br/>
@endsection
@section('contents')
@include('admin.layouts.objects.iframe-modal')
<div class="box">
    <div class="box-header">
        <button rel="{{url('admin/coupons/create')}}" type="button" 
                class="btn btn-info make-modal-large iframe-form-open" 
                data-toggle="modal" data-target="#iframeModal" title="Add Coupon">
            <span class="glyphicon glyphicon-plus"></span>Add
        </button>
        <button class="btn btn-success reload-page">
            <span class="glyphicon glyphicon-refresh"></span>
        </button>
        <?php
        $counter = 0;
        foreach ($coupons as $coupon) {
            $items['id'][$counter] = $coupon->coupon_code_id;
            $items['display_order'][$counter] = $coupon->display_order;
            $items['title'][$counter] = $coupon->title;
            $counter++;
        }
        ?>
        @if(isset($items))
        <?php
        session(['model' => 'Coupons']);
        session(['counter' => $counter]);
        session(['items' => http_build_query($items, '$item_')]);
        ?>

        @endif
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <table class="table table-responsive table-bordered table-striped datatable-first-column-asc">
            <thead>
                <tr>
                    <th scope="col" class="display-none">Order#</th>
                    <th scope="col">Coupon Code</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>

            </thead>

            <tbody>
                @foreach( $coupons as $coupon )
                <tr>
                    <td data-label="Order#" class="display-none">{{$coupon->display_order}}</td>
                    <td data-label="Title"><p class="margin-left">{{$coupon->coupon_code}}</p></td>
                    <td data-label="Title"><p class="margin-left">{{$coupon->coupon_amount}}</p></td>
                    <td data-label="Title"><p class="margin-left">@if ($coupon->is_active==0)
                            Used
                            @else
                            Not used
                            @endif</p></td>
                    <td class="margin-left"><a href="#" rel="{{url('admin/coupons/edit/'.$coupon->coupon_code_id)}}" 

              class="iframe-form-open make-modal-large btn btn-default" 

              data-toggle="modal" data-target="#iframeModal" 

              title="Edit Coupon: {{$coupon->coupon_code}}">

            <span class="glyphicon glyphicon-pencil"></span> Edit

            </a>
                        <a rel="{{url('admin/coupons/deletecoupon/'.$coupon->coupon_code_id)}}" type="button" 
                class="btn btn-danger make-modal-large iframe-form-open" 
                data-toggle="modal" data-target="#iframeModal" title="Delete Coupon">
                            <span class="glyphicon glyphicon-remove"></span> Delete
                        </a>
                    </td>
                </tr>

            
            @endforeach
            </tbody>

      <!--<tfoot>

        <tr>

          <th>Order#</th>

          <th>Title</th>

          <th></th>

        </tr>

      </tfoot>-->

        </table>

    </div>

    <!-- /.box-body -->

</div>


@endsection

