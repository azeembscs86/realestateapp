@if ($errors->any())

<div class="alert alert-danger alert-dismissable">

  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

  <h4><i class="icon fa fa-ban"></i> Error!</h4>

  @foreach ( $errors->all() as $error )

  {!! $error !!}

  @endforeach

</div>

@endif

@if (Session::has('message'))

<div class="alert alert-success alert-dismissable">

  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

  <!--<h4 class="delete">  <i class="icon fa fa-check"></i> Congratulations!</h4>-->

  <!-- {!! Session::get('message') !!} -->
  <?php if(Session::get('message') == 'Propertysaved'){ ?>
  <script type="text/javascript">
  $( document ).ready(function() {
     window.top.location.href = "https://www.matchpropertydirect.com/admin/properties";
  });
  </script>
  <?php }else{ ?>
  {!! Session::get('message') !!}
  <?php } ?>

</div>

@endif

@if (isset($message))

<div class="alert alert-success alert-dismissable">

  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

  <!--<h4 class="delete">  <i class="icon fa fa-check"></i> Congratulations!</h4>-->

  {!! $message !!}

</div>

@endif

