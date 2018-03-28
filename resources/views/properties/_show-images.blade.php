<div class="row">

<!-- <div id="unite-gallery" style="display:none;">

    @foreach ($property->images as $image)

      @if (is_file($image->image))

      <img alt="{{$property->title}}"

       src="{{asset( $image->image )}}"

       data-image="{{asset( $image->image )}}"

       data-description="{{$property->title}}">

      @endif

    @endforeach

  </div>

  <br/> -->
<div class="bxslider">
  @foreach ($property->images as $image)
  @if (is_file($image->image))
  <div class="{{$image->image_class}}"><img src="{{asset( $image->image )}}" width="800px" height="400px"></div>
  @endif
  @endforeach
</div>
<script>
  $('.bxslider').bxSlider({
  auto: true,
  slideWidth: 800,
  pager: false
});
</script>
</div>