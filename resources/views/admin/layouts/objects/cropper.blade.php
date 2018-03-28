<?php

  $preview_image = str_replace('|', '/', $preview_image);
  $tmp_img_path = str_replace('|', '/', $tmp_img_path);

  function gcd($a,$b) {
      $a = abs($a); $b = abs($b);
      if( $a < $b) list($b,$a) = Array($a,$b);
      if( $b == 0) return $a;
      $r = $a % $b;
      while($r > 0) {
          $a = $b;
          $b = $r;
          $r = $a % $b;
      }
      return $b;
  }

  function simplify($num,$den) {
      $g = gcd($num,$den);
      return Array($num/$g,$den/$g);
  }
  list ($ratioW,$ratioH) = simplify($width,$height);
  $ratio = $ratioW.'x'.$ratioH;

  ?>
  
<article class="col-md-4" id="crop-pictuer-{{$number}}">
  <input type="hidden" class="crop-width" value="{{$width}}" >
  <input type="hidden" class="crop-height" value="{{$height}}" >
  <input name="image_db_id_{{$number}}" type="hidden" value="{{$db_id}}" >
  <input name="image_data_{{$number}}" type="hidden" class="image-data" >
  <input name="tmp_img_path_{{$number}}" type="hidden" class="img-path" value="{{$tmp_img_path}}">
  <input type="hidden" class="site-url" value="{{url()}}" >
  <input type="hidden" class="csrf_token" value="{{ csrf_token() }}">
  <input type="hidden" class="image-src">
  <!-- Current image -->
  <div class="col-lg-12 image-view-{{$number}}">
  <div id="{{$number}}" class="image-view image-view-{{$ratio}} crop-initiate">
    @if(is_file($preview_image))
    <img src="{{asset($preview_image)}}">
    @else
    <img src="https://www.matchpropertydirect.com/pictures/image-avatar.jpg" />
    @endif
  </div>
  @if($deletable=='Y') 
  @if( is_numeric($db_id)) 
  <div class="checkbox"><label><input type="checkbox" name="image_delete_{{$number}}" value="{{$db_id}}" >Delete</label></div>
  <br/>
  @else
  <div class="checkbox visibilty-hidden" style="
"><label><input type="checkbox" name="image_delete_5" value="142">Delete</label></div>
  <a class="checkbox image_remove_instantly" href="#"><span class="fa fa-times"></span></a><br/>
  @endif
  @endif
</div>
  <!-- Cropping modal -->
  <div class="modal fade image-modal modal-fullscreen force-fullscreen" aria-hidden="true" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <!-- Loading state -->
        <div class="image-loading" aria-label="Loading" role="img" tabindex="-1"></div>
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" >Add New Picture</h4>
        </div>
        <div class="modal-body">
          <div class="image-body">
            <!-- Crop and preview -->
            <div class="row">
              <div class="col-md-12">
                <div class="image-wrapper"></div>
              </div>
              <div class="col-xs-12 image-btns">
              <div class="col-md-4">
                <label class="btn btn-primary btn-block" for="inputImage-{{$number}}" title="Select image file">
                <input class="image-input sr-only" id="inputImage-{{$number}}" name="file_{{$number}}" type="file" accept="image/*">
                <span class="docs-tooltip" data-toggle="tooltip" title="" data-original-title="Select image file">
                <i class="fa fa-camera"></i> Select image
                </span>
                </label>
              </div>
                
                <div class="col-md-4 text-center">
                   <button type="button" class="btn btn-primary btn-block" data-method="rotate" data-option="-90" title="Rotate -90 degrees"><i class="fa fa-undo"></i> Rotate Left</button>
                </div>
                <div class="col-md-4 text-center">
                   <button type="button" class="btn btn-primary btn-block " data-method="rotate" data-option="90" title="Rotate 90 degrees"><i class="fa fa-repeat"></i> Rotate Right</button>
                </div>
             
                
              </div>
              <div class="col-xs-12">
                <div class="col-md-6 text-center">
                  <button type="button" class="btn btn-primary color-success btn-block image-save">
                  <i class="glyphicon glyphicon-upload"></i> Upload</button>
                </div>
                  
                  <div class="col-md-6">
                  <button type="button" class="btn btn-danger btn-block" data-dismiss="modal">
                  <i class="glyphicon glyphicon-ban-circle"></i> Cancel
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div><!-- /.modal -->
  
</article>