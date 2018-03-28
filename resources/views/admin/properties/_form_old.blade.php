<style type="text/css">

a.checkbox.image_remove_instantly{

    text-align: center;

    width: 25px;

    height: 25px;

    border-radius: 50%;

    background: black;

    color: #fff;

    position: absolute;

    z-index: 1;

    text-decoration: none;

}

a.checkbox.image_remove_instantly span{

    vertical-align: middle;

  }

.adjustment .row span.action-buttons{

    margin-bottom: 10px;

}

@media (min-width:210px){

  a.checkbox.image_remove_instantly{

    top: -6px;

    right: 5px;

  }

  .image-view-4x3 {

    width: 100%;

    height: 100%;

  }

  a.checkbox.image_remove_instantly span {

    font-size: 13px;

  }

}

@media (min-width:520px){

  .image-view-4x3 {

    width: 100%;

  }

  a.checkbox.image_remove_instantly span{

    font-size: 16px;

    vertical-align: middle;

  }

}

@media (min-width:768px){

  a.checkbox.image_remove_instantly{

    right: 20px;

  }

  .image-view-4x3 {

    width: 220px;

    height: 165px;

  }

}

.tc { text-align: center; }

.attorney-fee{padding-left: 15px;}

.col-xs-12.image-btns .btn.btn-primary {

  margin-bottom: 10px;

}

.buttons-gap{

    text-align: center;

    background: #fff;

    height: 76px;

    z-index: 0;

    position: sticky;

    bottom: 0;

    padding: 14px 0;

    border-top: 1px solid #cccccc;

    border-bottom: 1px solid #cccccc;

}

.buttons-gap button.btn.btn-primary.btn-lg {

    width: 25%;

}

</style>

<script type="text/javascript">

  (function(factory){

    if (typeof define === 'function' && define.amd) {

        define(['jquery'], factory);

    } else {

        factory(jQuery);

    }

}(function($){

        

    function BoxLayout(obj){

        

        this.x = obj.offset().left;

        this.y = obj.offset().top;

        this.width = obj.width(); 

        this.height = obj.height();

        this.left = obj.position().left;

        this.top = obj.position().top;

    }

    var vmousedown = "mousedown",

        vmousemove = "mousemove", 

        vmouseup = "mouseup";

    if("ontouchend" in document){

        vmousedown = "touchstart";

        vmousemove = "touchmove";

        vmouseup = "touchend";

    }

    /**

     * CanvasCrop canvas

     */

    

    $.CanvasCrop = function(options){

        

        var opts = $.extend({},{

                limitOver: 1,

                isMoveOver: false

            },options),

            el = $(options.cropBox)||$(".cropBox"),

            rot = 0,

            ratio = 1,

            innerRatio = 1,

            warpBox = new BoxLayout(el),

            thumb = options.thumbBox? $(options.thumbBox) : el.find(".thumbBox"),

            thumbBox = new BoxLayout(thumb),

            ImgSrc = options.imgSrc,

            img = new Image(),

            drawArgument = {},

            clipArgument = {

                dx : thumbBox.x - warpBox.x,

                dy : thumbBox.y - warpBox.y,

            },

            visbleCanvas,visbleContext,

            visbleCanvasBox = {

                left: 0,

                top: 0

            },

            CanvasCropInit = function(){

                if(ImgSrc){

                    canvasInit();

                    img.src = ImgSrc;

                    //thumbBoxInit();

                    

                    el.off(".CropDown").on(vmousedown+".CropDown",backgroudMove);

                }else{

                    throw "image src is not defined";

                }

                

            },

            canvasInit = function(){

                img.onload = function(){

                    visbleCanvas = document.createElement("canvas");

                    limitOver();

                    getScale();

                    visbleCanvas.id="visbleCanvas";

                    visbleCanvas.style.position = "absolute";

                    visbleContext = visbleCanvas.getContext("2d");

                    drawImage();

                    setPosition({x:(warpBox.width-visbleCanvas.width)/2,y:(warpBox.height-visbleCanvas.height)/2});

                    el.find("#visbleCanvas").remove();

                    el.prepend(visbleCanvas);

                    img.onload = img.onerror = null;

                }

                img.onerror = function(){

                }

            },

            limitOver = function(){

                var w = img.width,

                    h = img.height,

                    imgRatio = w/h;

                if(imgRatio<1){

                    if(opts.limitOver == 1){

                        h = warpBox.height;

                    }else if(opts.limitOver == 2){

                        w = thumbBox.width;

                        h = w/imgRatio;

                    }

                }else{

                    if(opts.limitOver == 1){

                        w = warpBox.width;

                        h = w/imgRatio;

                    }else if(opts.limitOver == 2){

                        h = thumbBox.height;

                    }

                }

                innerRatio = h/img.height;

            },

            thumbBoxInit = function(){

                var thumb = el.find(".thumbBox");

                var pointList = "<div class='cropPoint' style='left:-4px;top:-4px;' id='leftTopPoint'></div>"+

                                "<div class='cropPoint' style='right:-4px;top:-4px;' id='rightTopPoint'></div>"+

                                "<div class='cropPoint' style='left:-4px;bottom:-4px;' id='leftBottomPoint'></div>"+

                                "<div class='cropPoint' style='right:-4px;bottom:-4px;' id='rightBottomPoint'></div>";

                

                thumb.append(pointList);

                

            },

            backgroudMove = function(e){

                e.preventDefault();

                if(!visbleCanvas){

                    return false;

                }

                var oldBox = new BoxLayout($(visbleCanvas)),

                    pagesite =  getPagePos(e),

                    oldPointer = {

                        x: pagesite.pageX,

                        y: pagesite.pageY

                    };

                this.onselectstart = function(){

                    return false;

                }

                $(document).on(vmousemove+".CropMove",function(e){

                    e.preventDefault();

                    var pagesite =  getPagePos(e),

                        disX = pagesite.pageX - oldPointer.x,

                        disY = pagesite.pageY - oldPointer.y;

                        imgDis = {

                            x: oldBox.left + disX,

                            y: oldBox.top + disY

                        };

                    setPosition(imgDis);



                });

                $(document).on(vmouseup+".CropLeave",function(e){

                    e.preventDefault();

                    $(document).off(".CropMove").off(".CropLeave");

                });

            },

            getPagePos = function(evt){

                return {

                    pageX : hasTouch()? evt.originalEvent.touches[0].pageX : evt.pageX,

                    pageY : hasTouch()? evt.originalEvent.touches[0].pageY : evt.pageY

                }

            }

            innerRotate = function(){

                var w = visbleCanvas.width,

                    h = visbleCanvas.height,

                    rotation = Math.PI * rot / 180,

                    c = Math.round(Math.cos(rotation) * 1000) / 1000,

                    s = Math.round(Math.sin(rotation) * 1000) / 1000;

                

                visbleCanvas.height = Math.abs(c*h) + Math.abs(s*w);

                visbleCanvas.width = Math.abs(c*w) + Math.abs(s*h);



                

                if (rotation <= Math.PI/2) {

                    visbleContext.translate(s*h,0);

                } else if (rotation <= Math.PI) {

                    visbleContext.translate(visbleCanvas.width,-c*h);

                } else if (rotation <= 1.5*Math.PI) {

                    visbleContext.translate(-c*w,visbleCanvas.height);

                } else {

                    visbleContext.translate(0,-s*w);

                }

                visbleContext.rotate(rotation);

                

            },

            hasTouch = function(){

                return "ontouchend" in document;

            }

            getScale = function(){

                drawArgument.w = visbleCanvas.width = img.width*innerRatio*ratio;

                drawArgument.h = visbleCanvas.height = img.height*innerRatio*ratio;

            },

            drawImage = function(){

                visbleContext.clearRect(0,0,visbleCanvas.width,visbleCanvas.height);

                visbleContext.drawImage(img, 0, 0, drawArgument.w, drawArgument.h);

            },

            getPosition = function(oldWidth,oldHeight){

                return {

                    x: visbleCanvasBox.left + (oldWidth-visbleCanvas.width)/2,

                    y: visbleCanvasBox.top + (oldHeight-visbleCanvas.height)/2

                }

            },

            setPosition = function(imgDis){

                var thumbBoxPos = {

                    left: thumbBox.x-warpBox.x,

                    top: thumbBox.y-warpBox.y,

                    right: thumbBox.x-warpBox.x + thumbBox.width,

                    bottom: thumbBox.y-warpBox.y + thumbBox.height

                }

                if(opts.isMoveOver){

                    if(thumbBoxPos.left-imgDis.x<0){

                        imgDis.x = thumbBoxPos.left;

                    }else if(thumbBoxPos.right > imgDis.x + visbleCanvas.width){

                        imgDis.x = thumbBoxPos.right - visbleCanvas.width;

                    }

                    if(thumbBoxPos.top-imgDis.y<0){

                        imgDis.y = thumbBoxPos.top;

                    }else if(thumbBoxPos.bottom > imgDis.y + visbleCanvas.height){

                        imgDis.y = thumbBoxPos.bottom - visbleCanvas.height;

                    }

                }



                $(visbleCanvas).css({

                    left: imgDis.x,

                    top: imgDis.y

                });

                visbleCanvasBox = {

                    left: imgDis.x,

                    top: imgDis.y

                };

                clipArgument = {

                    dx: imgDis.x - thumbBoxPos.left,

                    dy: imgDis.y - thumbBoxPos.top

                };  

                

            },

            canvasTransform = function(options){

                if(!visbleCanvas){

                    return false;

                }

                var oldWidth = visbleCanvas.width,

                    oldHeight = visbleCanvas.height;

                

                ratio = typeof options.ratio === "undefined"? ratio : options.ratio;

                rot = typeof options.rot === "undefined"? rot : options.rot;

                

                

                visbleContext.save();

                

                getScale(); 

                

                innerRotate();

                drawImage();

                

                visbleContext.restore();

                

                var pos = getPosition(oldWidth,oldHeight);

                setPosition(pos);

            };

        

        var returnObj = {

            rotate : function(deg){

                canvasTransform({

                    rot: deg

                });

            },

            scale: function(ratio){

                canvasTransform({

                    ratio: ratio

                });

            },

            getDataURL: function(type){

                var type = type||"png",

                    width = thumbBox.width,

                    height = thumbBox.height,

                    hiddenCanvas = document.createElement("canvas"),

                    hiddenContext = hiddenCanvas.getContext("2d");

                

                hiddenCanvas.width = width;

                hiddenCanvas.height = height;

                //hiddenContext.drawImage(visbleCanvas, clipArgument.sx, clipArgument.sy, width, height, 0, 0, width, height);

                hiddenContext.drawImage(visbleCanvas, clipArgument.dx, clipArgument.dy, visbleCanvas.width,visbleCanvas.height);

                return hiddenCanvas.toDataURL('image/'+type);

            }

        }

        

        CanvasCropInit();

        

        return returnObj;

    }

}));

</script>

<div class="stepwizard">

    <div class="stepwizard-row setup-panel">

        <div class="stepwizard-step btn-primary">

            <a href="#step-1" type="button" class="hidden first navButton">Step 1</a>

            <span class="btn btn-circle">Step 1</span>

        </div>

        <div class="stepwizard-step">

            <a href="#step-2" type="button" class="hidden navButton" disabled="disabled">Step 2</a>

            <span class="btn btn-circle">Step 2</span>

        </div>

        <div class="stepwizard-step">

            <a href="#step-3" type="button" class="hidden navButton" disabled="disabled">Step 3</a>

            <span class="btn btn-circle">Step 3</span>

        </div>

        <div class="stepwizard-step">

            <a href="#step-4" type="button" class="hidden navButton" disabled="disabled">Step 4</a>

            <span class="btn btn-circle">Step 4</span>

        </div>

        <div class="stepwizard-step">

            <a href="#step-5" type="button" class="hidden navButton" disabled="disabled">Step 5</a>

            <span class="btn btn-circle">Step 5</span>

        </div>

        <div class="stepwizard-step">

            <a href="#step-6" type="button" class="hidden navButton" disabled="disabled">Step 6</a>

            <span class="btn btn-circle">Step 6</span>

        </div>

        <div class="stepwizard-step">

            <a href="#step-7" type="button" class="hidden navButton" disabled="disabled">Step 7</a>

            <span class="btn btn-circle">Step 7</span>

        </div>

        <div class="stepwizard-step">

            <a href="#step-8" type="button" class="hidden navButton" disabled="disabled">Step 8</a>

            <span class="btn btn-circle">Step 8</span>

        </div>

        <div class="stepwizard-step">

            <a href="#step-9" type="button" class="hidden navButton" disabled="disabled">Step 9</a>

            <span class="btn btn-circle">Step 9</span>

        </div>

    </div>

</div>



<input type="hidden" name="_token" value="{{ csrf_token() }}">

@if(isset($property->id))

<input type="hidden" name="id" value="{{ $property->id }}">

@endif

<input name="citylatitude" type="hidden" id="citylatitude" class="form-control2"    value="

       @if(old('latitude')){!! old('latitude') !!}@elseif(isset($property->latitude)){!!$property->latitude!!}@endif"/>

<input name="citylongitude" type="hidden" id="citylongitude" class="form-control2"  value="@if(old('longitude')){!! old('longitude') !!}@elseif(isset($property->longitude)){!!$property->longitude!!}@endif"/>





    <!-- Select2 Css -->

    <link href="{{asset('/admin/plugins/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />

    <script type="text/javascript" src="{{asset('/admin/plugins/select2/select2.full.min.js')}}"></script>



<div class="row setup-content" id="step-1" style="display: block !important;">    

<div class="col-md-12">

  <fieldset>

    <legend>General Detail</legend>

    <div class="col-md-6">

      <div class="form-group">

        <label class="col-sm-4 col-xs-12 control-label">Title/Name<font color="#FF0000">*</font></label>

        <div class="col-sm-8 col-xs-12">

          <input 

            type="text"

            name = "title"

            placeholder="Enter title here"

            value="@if(old('title')){!! old('title') !!}@elseif(isset($property->title)){!!$property->title!!}@endif"

            class="form-control2"

            required="required"

            onblur="createslug(this.value);" 

            maxlength="22"

            />

        </div>

      </div>

      <div class="form-group" style="display: none;">

        <label class="col-sm-4 col-xs-12 control-label">Slug<font color="#FF0000">*</font></label>

        <div class="col-sm-8 col-xs-12">

          <input name="slug" type="text" id="slug" class="form-control2" 

            value="@if(old('slug')){!! old('slug') !!}@elseif(isset($property->slug)){!!$property->slug!!}@endif"

            />

        </div>

      </div>

      <div class="form-group" style="display: none;">

        <label class="col-sm-4 col-xs-12 control-label">Code/SKU<font color="#FF0000">*</font></label>

        <div class="col-sm-8 col-xs-12">

          <input name="code" type="text" id="code" class="form-control2" 

            value="123456"

            />

        </div>

      </div>

      

      <div class="form-group">

        <label class="col-sm-4 col-xs-12 control-label">Category<font color="#FF0000">*</font></label>

        <div class="col-sm-8 col-xs-12">

          <select name="category" class="form-control2">

          @foreach ($categories as $category)

          <option value="{{ $category->id }}"

          @if (old('category') == $category->id) {!!'selected="selected"'!!} 

          @elseif (isset($property->category_id) and $property->category_id == $category->id) {!!'selected="selected"'!!} 

          @endif

          >{!!$category->title!!}</option>

          @endforeach

          </select>

        </div>

      </div>

     <!--  <div class="form-group">

      <?php

        $classes_selected = array();

        if(@$property){

        foreach ($property->classez as $class) {

          array_push($classes_selected, $class->class_id);

        }

      

      }

      ?>

        <label class="col-sm-4 col-xs-12 control-label">Classes<font color="#FF0000">*</font></label>

        <div class="col-sm-8 col-xs-12">

          <select name="classes[]" class="form-control2 property-classes" multiple="multiple">

          @foreach ($classes as $class)

          <option value="{{ $class->id }}" 

          <?php if(in_array($class->id, $classes_selected)){

          echo 'selected="selected"';

          }

          ?>

          >{!!$class->title!!}</option>

          @endforeach

          </select>

          <script type="text/javascript">

            $(".property-classes").select2();

          </script>

        </div>

      </div> -->

      <div class="form-group" style="display: none;">

        <label class="col-sm-4 col-xs-12 control-label">Minimum stay<font color="#FF0000">*</font></label>

        <div class="col-sm-8 col-xs-12">

          <div class="input-group"> 

          <input name="minimum_stay_nights" type="text" class="form-control2" 

            value="@if(old('minimum_stay_nights')){!! old('minimum_stay_nights') !!}@elseif(isset($property->minimum_stay_nights)){!!$property->minimum_stay_nights!!}@endif"

            /><span class="input-group-addon">nights</span></div>

        </div>

      </div><!-- upgrade - 12/10/2016 - minimum_nights -->

      <div class="form-group">

        <label class="col-sm-4 col-xs-12 control-label">Bedrooms<font color="#FF0000">*</font></label>

        <div class="col-sm-8 col-xs-12">

          <input name="bedrooms" type="number" required="required" min="1" max="20" class="form-control2" 

            value="@if(old('bedrooms')){!! old('bedrooms') !!}@elseif(isset($property->bedrooms)){!!$property->bedrooms!!}@endif"

            />

        </div>



      </div>

      <div class="form-group">

        <label class="col-sm-4 col-xs-12 control-label">Bathrooms<font color="#FF0000">*</font></label>

        <div class="col-sm-8 col-xs-12">

          <input name="bathrooms" type="number" required="required" min="1" max="20" class="form-control2" 

            value="@if(old('bathrooms')){!! old('bathrooms') !!}@elseif(isset($property->bathrooms)){!!$property->bathrooms!!}@endif"

            />

        </div>

      </div>

      <div class="form-group" style="display: none;">

        <label class="col-sm-4 col-xs-12 control-label">Sleeps<font color="#FF0000">*</font></label>

        <div class="col-sm-8 col-xs-12">

          <input name="sleeps" type="text" class="form-control2" 

            value="2"

            />

        </div>

      </div>

      <div class="form-group">

        <label class="col-sm-4 col-xs-12 control-label">Garages<!--<font color="#FF0000">*</font>--></label>

        <div class="col-sm-8 col-xs-12">

          <select name="garages" id="garages" class="form-control2">

          <option value="0">None</option>

          <option value="1" @if (old('garages') == '1') {!!'selected="selected"'!!} 

          @elseif (isset($property->garages) and $property->garages == '1') {!!'selected="selected"'!!} 

          @endif >1 Car</option>

          <option value="2" @if (old('garages') == '2') {!!'selected="selected"'!!} 

          @elseif (isset($property->garages) and $property->garages == '2') {!!'selected="selected"'!!} 

          @endif >2 Car</option>

          <option value="3" @if (old('garages') == '3') {!!'selected="selected"'!!} 

          @elseif (isset($property->garages) and $property->garages == '3') {!!'selected="selected"'!!} 

          @endif >3 Car</option>

          <option value="4" @if (old('garages') == '4') {!!'selected="selected"'!!} 

          @elseif (isset($property->garages) and $property->garages == '4') {!!'selected="selected"'!!} 

          @endif >4 Car</option>

          </select>

        </div>

      </div>

      <div class="form-group">

        <label class="col-sm-4 col-xs-12 control-label">Address<font color="#FF0000">*</font></label>

        <div class="col-sm-8 col-xs-12">

          <input name="address" type="text" required="required" id="address" class="form-control2" 

            value="@if(old('address')){!! old('address') !!}@elseif(isset($property->address)){!!$property->address!!}@endif"

            />

        </div>

      </div>

      <div class="form-group">

        <label class="col-sm-4 col-xs-12 control-label">Area (Sq. Feet) <font color="#FF0000">*</font></label>

        <div class="col-sm-8 col-xs-12">

          <input name="area" type="number" required="required" min="100" max="60000" id="zip" class="form-control2" 

            value="@if(old('area')){!! old('area') !!}@elseif(isset($property->area)){!!$property->area!!}@endif"

            />

        </div>

      </div>

    </div>

    <div class="col-md-6">

      <div class="form-group">

        <label class="col-sm-4 col-xs-12 control-label">Enter a Location</label>

        <div class="col-sm-8 col-xs-12">

          <input type="text" name="city" id="city" class="form-control2" placeholder="Enter a Location" value="@if(old('city')){!! old('city') !!}@elseif(isset($property->city)){!!$property->city!!}@endif">

        </div>

      </div>

      <div class="form-group" style="display: none;">

        <label class="col-sm-4 col-xs-12 control-label">State<font color="#FF0000">*</font></label>

        <div class="col-sm-8 col-xs-12">

          <select name="state" class="form-control2">

          @foreach ($states as $state)

          <option value="{{ $state->id }}"

          @if (old('state') == $state->id) {!!'selected="selected"'!!} 

          @elseif (isset($property->state_id) and $property->state_id == $state->id) {!!'selected="selected"'!!} 

          @endif

          >{!!$state->title!!}</option>

          @endforeach

          </select>

        </div>

      </div>

      <div class="form-group">

        <label class="col-sm-4 col-xs-12 control-label">Zip Code<font color="#FF0000">*</font></label>

        <div class="col-sm-8 col-xs-12">

          <input name="zip" type="text" required="required" id="zip" class="form-control2" 

            value="@if(old('zip')){!! old('zip') !!}@elseif(isset($property->zip)){!!$property->zip!!}@endif"

            />

        </div>

      </div>

      <div class="form-group">

        <label class="col-sm-4 col-xs-12 control-label">Map</label>

        <div class="col-sm-8 col-xs-12">

          <div class="input-group">

            <input name="latitude" type="hidden" id="latitude" class="form-control2" 

              value="@if(old('latitude')){!! old('latitude') !!}@elseif(isset($property->latitude)){!!$property->latitude!!}@endif"

              />

            <input name="longitude" type="hidden" id="longitude" class="form-control2" 

              value="@if(old('longitude')){!! old('longitude') !!}@elseif(isset($property->longitude)){!!$property->longitude!!}@endif"

              />

            <span class="input-group-addon" style="border-left: 1px solid #ccc;border-radius: 4px;">

            <a href="#myMapModal" data-toggle="modal" id="open_map">Open Map</a>

            </span> 

          </div>

        </div>

      </div>

      <div class="form-group" style="display: none;">

        <label class="col-sm-4 col-xs-12 control-label">Display Order</label>

        <div class="col-sm-8 col-xs-12">

          <input name="display_order" type="text" class="form-control2" 

            value="@if(old('display_order')){!! old('display_order') !!}@elseif(isset($property->display_order)){!!$property->display_order!!}@endif"

            />

        </div>

      </div>

       <div class="form-group">

        <label class="col-sm-4 col-xs-12 control-label">Year Built <font color="#FF0000">*</font></label>

        <div class="col-sm-8 col-xs-12">

          <?php $from_year = date("Y",strtotime("-318 year")); ?>

          @for($i=$from_year;$i<=date('Y');$i++)

          <?php $sorting_arr[] = $i; rsort($sorting_arr); ?>

          @endfor

          <select name="year_built" class="form-control2">

          <?php for($j=0;$j<count($sorting_arr);$j++){ ?>

          <option value="<?php echo $sorting_arr[$j]; ?>" <?php if(isset($property->year_built) && $property->year_built == $sorting_arr[$j]){ echo 'selected="selected"'; }else{} ?> ><?php echo $sorting_arr[$j]; ?></option>

          <?php } ?>

          </select>

          <?php //rsort($sorting_arr); print_r($sorting_arr); ?>

        </div>

      </div>

      <div class="form-group">

        <label class="col-sm-4 col-xs-12 control-label">Master Bedroom <!--<font color="#FF0000">*</font>--></label>

        <div class="col-sm-8 col-xs-12">

          <select name="master_bedroom" class="form-control2">

          <option value="0" >None</option>

          @for($i=1;$i<=10;$i++)

          <option value="{{$i}}" <?php if(isset($property->master_bedroom) and $property->master_bedroom == $i){ echo 'selected="selected"'; }else{} ?>>{{$i}}</option>

          @endfor

          </select>

        </div>

      </div>

    <div class="form-group">

        <label class="col-sm-4 col-xs-12 control-label">Waterfrontage <!--<font color="#FF0000">*</font>--></label>

        <div class="col-sm-8 col-xs-12">

         <select name="waterfrontage" id="waterfrontage" class="form-control2">

          <option value="None">None</option>

          <option value="Ocean" @if (old('waterfrontage') == 'Ocean') {!!'selected="selected"'!!} 

          @elseif (isset($property->waterfrontage) and $property->waterfrontage == 'Ocean') {!!'selected="selected"'!!} 

          @endif >Ocean</option>

          <option value="Lake" @if (old('waterfrontage') == 'Lake') {!!'selected="selected"'!!} 

          @elseif (isset($property->waterfrontage) and $property->waterfrontage == 'Lake') {!!'selected="selected"'!!} 

          @endif >Lake</option>

          <option value="Bay" @if (old('waterfrontage') == 'Bay') {!!'selected="selected"'!!} 

          @elseif (isset($property->waterfrontage) and $property->waterfrontage == 'Bay') {!!'selected="selected"'!!} 

          @endif >Bay</option>

          <option value="River" @if (old('waterfrontage') == 'River') {!!'selected="selected"'!!} 

          @elseif (isset($property->waterfrontage) and $property->waterfrontage == 'River') {!!'selected="selected"'!!} 

          @endif >River</option>

          <option value="Canal" @if (old('waterfrontage') == 'Canal') {!!'selected="selected"'!!} 

          @elseif (isset($property->waterfrontage) and $property->waterfrontage == 'Canal') {!!'selected="selected"'!!} 

          @endif >Canal</option>

          <option value="Harbor/Marina" @if (old('waterfrontage') == 'Harbor/Marina') {!!'selected="selected"'!!} 

          @elseif (isset($property->waterfrontage) and $property->waterfrontage == 'Harbor/Marina') {!!'selected="selected"'!!} 

          @endif >Harbor/Marina</option>

          </select>

        </div>

      </div>

  </fieldset>

  <br/><br/>

</div>

<div class="col-md-12">

  <fieldset class="checkbox">

    <legend>Indexing Control</legend>

    <div class="row">

      <div class="col-md-12">

        <div class="col-xs-12 index-control">

          <label>

          <input name="is_active" type="checkbox" value="1"

          @if(old('is_active')){{'checked="checked"'}}

          @elseif(isset($property->is_active) and ($property->is_active=='1')){{'checked="checked"'}}@endif />

          Property is Active</label>

        </div>

        <div class="col-md-4 col-sm-6 col-xs-12 index-control">

          <label>

          <input name="is_featured" type="checkbox" value="1"

          @if(old('is_featured')){{'checked="checked"'}}

          @elseif(isset($property->is_featured) and ($property->is_featured=='1')){{'checked="checked"'}}@endif />

          Featured Property</label>

        </div>

        <!-- <div class="col-md-4 col-xs-6">

          <label>

          <input name="is_new" type="checkbox" value="1"

          @if(old('is_new')){{'checked="checked"'}}

          @elseif(isset($property->is_new) and ($property->is_new=='1')){{'checked="checked"'}}@endif />

          Mark as New</label>

        </div> -->

        <!-- <div class="col-md-4 col-xs-6">

          <label>

          <input name="is_vacation" type="checkbox" value="1"

          @if(old('is_vacation')){{'checked="checked"'}}

          @elseif(isset($property->is_vacation) and ($property->is_vacation=='1')){{'checked="checked"'}}@endif />

          Available for Vacation Rental</label>

        </div> -->

        <!-- <div class="col-md-4 col-xs-6">

          <label>

          <input name="is_sale" type="checkbox" value="1"

          @if(old('is_sale')){{'checked="checked"'}}

          @elseif(isset($property->is_sale) and ($property->is_sale=='1')){{'checked="checked"'}}@endif />

          Displaying for Sale</label>

        </div> -->

        <!-- <div class="col-md-4 col-xs-6">

          <label>

          <input name="is_long_term" type="checkbox" value="1"

          @if(old('is_long_term')){{'checked="checked"'}}

          @elseif(isset($property->is_long_term) and ($property->is_long_term=='1')){{'checked="checked"'}}@endif />

          Available for Long Term Rental</label>

          </div> -->

        <!-- <div class="col-md-4 col-xs-6">

          <label>

          <input name="is_calendar" type="checkbox" value="1"

          @if(old('is_calendar')){{'checked="checked"'}}

          @elseif(isset($property->is_calendar) and ($property->is_calendar=='1')){{'checked="checked"'}}@endif />

          User can see Availability Calendar</label>

          </div> -->

        <!-- <div class="col-md-4 col-xs-6">

          <label>

          <input name="is_rates" type="checkbox" value="1"

          @if(old('is_rates')){{'checked="checked"'}}

          @elseif(isset($property->is_rates) and ($property->is_rates=='1')){{'checked="checked"'}}@endif />

          User can see Rental Rates </label>

        </div> -->

      </div>

    </div>

  </fieldset>

</div>

<div class="col-md-12 buttons-gap">

<button class="btn btn-primary nextBtn btn-lg" type="button" >Next</button>

</div>

</div>

<!---POPUP BUTTONS-->

<div class="row setup-content" id="step-2" style="display: block !important;">

<div class="col-md-12">

  <fieldset>

    <legend>Description</legend>

     <div class="form-group">

            <div class="col-xs-12">

              <textarea name="description" class="form-control2 mceEditor"

                placeholder="Enter property detail here."

                >@if(old('description')){!! old('description') !!}@elseif(isset($property->description)){!!$property->description!!}@endif</textarea>

            </div>

          </div>

  </fieldset>

</div>

<div class="col-md-12 buttons-gap">

  <button class="btn btn-primary prevBtn btn-lg" type="button" >Previous</button>

  <button class="btn btn-primary nextBtn btn-lg" type="button" >Next</button>

</div>



</div>

<div class="row setup-content" id="step-3" style="display: block !important;">

<div class="col-md-12">

  <fieldset>

    <legend>Pictures</legend>

     <div class="form-group">

            <div class="col-sm-12 col-xs-12">

              @include('admin.layouts.objects.images')

              <h3>Helpful Hints:</h3>

              <ul>

                <li>Subscribers must have all necessary rights to use the photos to post on the site and to grant Match Property Direct, LLC rights to use the photo on the site. All photos and images must conform to Match Property Direct, LLC contents guidelines</li>

                <li>Please upload 800x400 picture of your property</li>

                <li><a href="http://107.6.184.93/MatchPropertyDirect/pages/image-upload-process" target="_blank"> Click here to see instructions of how to upload photos of your properties</a></li>

              </ul>

            </div>

          </div>

  </fieldset>

</div>

<div class="col-md-12 buttons-gap">

  <button class="btn btn-primary prevBtn btn-lg" type="button" >Previous</button>

  <button class="btn btn-primary nextBtn btn-lg" type="button" >Next</button>

</div>

</div>

<div class="row setup-content" id="step-4" style="display: block !important;">

<div class="col-md-12">

  <fieldset>

    <legend>Price</legend>

     <div class="form-group">

            <label class="col-sm-2 col-xs-12 control-label">Price</label>

            <div class="form-group">

            <div class="col-md-4 col-sm-6 col-xs-12">

              <div class="input-group"><!-- <span class="input-group-addon">$</span> -->

                <select name="currency" id="currency">

                <option value="USD" <?php if(isset($property->currency_code) and ($property->currency_code == 'USD')){ echo 'selected="selected"'; }else{} ?>>US Dollar ($)</option>

                <option value="GBP" <?php if(isset($property->currency_code) and ($property->currency_code == 'GBP') ){ echo 'selected="selected"'; }else{} ?>>United Kingdom (GBP)</option>

                <option value="EUR" <?php if(isset($property->currency_code) and ($property->currency_code == 'EUR')){ echo 'selected="selected"'; }else{} ?>> Euro (EUR)</option>

                <option value="AED" <?php if(isset($property->currency_code) and ($property->currency_code == 'AED')){ echo 'selected="selected"'; }else{} ?>>United Arab Emirates (AED)</option>

                <option value="AUD" <?php if(isset($property->currency_code) and  ($property->currency_code == 'AUD')){ echo 'selected="selected"'; }else{} ?>>Australian Dollar (AUD)</option>

                <option value="CAD" <?php if(isset($property->currency_code) and ($property->currency_code == 'CAD')){ echo 'selected="selected"'; }else{} ?>>Canadian Dollar (CAD)</option>

                <option value="JPY" <?php if(isset($property->currency_code) and ($property->currency_code == 'JPY')){ echo 'selected="selected"'; }else{} ?>>Japanese Yen (JPY)</option>

                <option value="SAR" <?php if(isset($property->currency_code) and ($property->currency_code== 'SAR')){ echo 'selected="selected"'; }else{} ?>>Saudi Riyal (SAR)</option>

                <option value="ZAR" <?php if(isset($property->currency_code) and ($property->currency_code== 'ZAR')){ echo 'selected="selected"'; }else{} ?>>South African Rand (ZAR)</option>

                </select>

              <input name="sale_price" type="text" id="sale_price" class="form-control2" 

                value="@if(old('sale_price')){!! old('sale_price') !!}@elseif(isset($property->sale_price)){!!$property->sale_price!!}@endif"

                />

                </div>

            </div>

          </div>

          </div>

  </fieldset>

</div>

<div class="col-md-12 buttons-gap">

  <button class="btn btn-primary prevBtn btn-lg" type="button" >Previous</button>

  <button class="btn btn-primary nextBtn btn-lg" type="button" >Next</button>

</div>

</div>

<div class="row setup-content" id="step-5" style="display: block !important;">

<div class="col-md-12">

  <fieldset>

    <legend>LifeStyle Category</legend>

     <div class="form-group">

            <div class="form-group">

            <div class="col-xs-12">

              @include ('admin.properties._lifestyles')

            </div>

          </div>

          </div>

  </fieldset>

</div>

<div class="col-md-12 buttons-gap">

  <button class="btn btn-primary prevBtn btn-lg" type="button" >Previous</button>

  <button class="btn btn-primary nextBtn btn-lg" type="button" >Next</button>

</div>

</div>

<div class="row setup-content" id="step-5" style="display:none">

<div class="col-md-12">

  <fieldset>

    <legend>Nearby</legend>

     <div class="form-group">

            <label class="col-sm-2 col-xs-12 control-label">Nearby</label>

            <div class="form-group">

            <div class="col-md-4 col-sm-6 col-xs-12">

              @include ('admin.properties._features')

            </div>

          </div>

          </div>

  </fieldset>      

  <button class="btn btn-primary prevBtn btn-lg" type="button" >Previous</button>

  <button class="btn btn-primary nextBtn btn-lg" type="button" >Next</button>

</div>

</div>

<div class="row setup-content" id="step-6" style="display: block !important;">

<div class="col-md-12">

  <fieldset>

    <legend>Features</legend>

     <div class="form-group">

            <div class="form-group">

            <div class="col-xs-12">

              @include ('admin.properties._amenities')

            </div>

          </div>

          </div>

  </fieldset>

</div>

<div class="col-md-12 buttons-gap">

  <button class="btn btn-primary prevBtn btn-lg" type="button" >Previous</button>

  <button class="btn btn-primary nextBtn btn-lg" type="button" >Next</button>

</div>

</div>



<!--END OF POPUP BUTTONS-->

<!-- <div class="col-md-12">

  <fieldset>

    <legend>Accounts/Office</legend>

    <div class="col-md-6">

      <div class="form-group">

        <label class="col-sm-4 col-xs-12 control-label">Commission</label>

        <div class="col-sm-8 col-xs-12">

          <div class="input-group"> <span class="input-group-addon">%</span>

            <input name="commission_value" type="text" class="form-control2" placeholder="##" maxlength="2" 

              value="@if(old('commission_value')){!! old('commission_value') !!}@elseif(isset($property->commission_value)){!!$property->commission_value!!}@endif" 

              />

            <span class="input-group-addon">

            <input name="is_commission" type="checkbox" value="1"

            @if(old('is_commission')){{'checked="checked"'}}

            @elseif(isset($property->is_commission) and ($property->is_commission=='1')){{'checked="checked"'}}@endif />

            Active </span> 

          </div>

        </div>

      </div>

      <div class="form-group">

        <label class="col-sm-4 col-xs-12 control-label">Admin Notes</label>

        <div class="col-sm-8 col-xs-12">

          <textarea name="notes_admin" class="form-control2" style="min-height:100px;" 

            placeholder="Enter hidden notes only for admin."

            >@if(old('notes_admin')){!! old('notes_admin') !!}@elseif(isset($property->notes_admin)){!!$property->notes_admin!!}@endif</textarea>

        </div>

      </div>

    </div>

    <div class="col-md-6">

      <div class="form-group">

        <label class="col-sm-4 col-xs-12 control-label">Housekeeper</label>

        <div class="col-sm-8 col-xs-12">

          <select name="housekeeper_id" class="form-control2">

          <option value="0"

          @if (!isset($property->housekeeper_id)) {{ 'selected="selected"' }} @endif

          > - select - </option>

          @foreach ($housekeepers as $housekeeper)

          <option value="{{ $housekeeper->id }}"

          @if (old('housekeeper_id') == $housekeeper->id) {!!'selected="selected"'!!} 

          @elseif (isset($property->housekeeper_id) and $property->housekeeper_id == $housekeeper->id) {!!'selected="selected"'!!} 

          @endif

          >{!!$housekeeper->firstname!!} {!!$housekeeper->lastname!!}</option>

          @endforeach

          </select>

        </div>

      </div>

      <div class="form-group">

        <label class="col-sm-4 col-xs-12 control-label">Vendor</label>

        <div class="col-sm-8 col-xs-12">

          <select name="vendor_id" class="form-control2">

          <option value="0"

          @if (!isset($property->vendor_id)) {{ 'selected="selected"' }} @endif

          > - select - </option>

          @foreach ($vendors as $vendor)

          <option value="{{ $vendor->id }}"

          @if (old('vendor_id') == $vendor->id) {!!'selected="selected"'!!} 

          @elseif (isset($property->vendor_id) and $property->vendor_id == $vendor->id) {!!'selected="selected"'!!} 

          @endif

          >{!!$vendor->firstname!!} {!!$vendor->lastname!!}</option>

          @endforeach

          </select>

        </div>

      </div>

      <div class="form-group">

        <label class="col-sm-4 col-xs-12 control-label">User(Owner/Agent)</label>

        <div class="col-sm-8 col-xs-12">

          <select name="user_id" class="form-control2">

          <option value="0"

          @if (!isset($property->user_id)) {{ 'selected="selected"' }} @endif

          > - select - </option>

          @foreach ($owners as $owner)

          <option value="{{ $owner->id }}"

          @if (old('user_id') == $owner->id) {!!'selected="selected"'!!} 

          @elseif (isset($property->user_id) and $property->user_id == $owner->id) {!!'selected="selected"'!!} 

          @endif

          >{!!$owner->firstname!!} {!!$owner->lastname!!}</option>

          @endforeach

          </select>

        </div>

      </div>

    </div>

  </fieldset>

  <br/><br/>

</div> -->



<div class="row setup-content" id="step-7" style="display: block !important;">

<div class="col-md-12">

  <fieldset>

    <legend>Other Information</legend>

  <div class="row">

    <div class="col-md-8">

      <div class="form-group">

      <label class="col-sm-4 col-xs-12 control-label">Beach Access</label>

        <div class="col-sm-8 col-xs-12">

        <label class="radio-inline">

          <input type="radio" name="beach_right" value="1" @if(old('beach_right')=='1'){{'checked="checked"'}}

          @elseif(isset($property->beach_right) and ($property->beach_right=='1')){{'checked="checked"'}}@endif> Yes

        </label>

        <label class="radio-inline">

          <input type="radio" name="beach_right" value="0" <?php if(isset($property->beach_right) == 0){ echo 'checked="checked"'; }else{} ?>> No

        </label>

        </div>

      </div>



      <div class="form-group" style="display: none;">

      <label class="col-sm-4 col-xs-12 control-label">Staff Accomodation</label>

        <div class="col-sm-8 col-xs-12">

        <label class="radio-inline">

          <input type="radio" name="staff_accomodation" value="1" @if(old('staff_accomodation')=='1'){{'checked="checked"'}}

          @elseif(isset($property->staff_accomodation) and ($property->staff_accomodation=='1')){{'checked="checked"'}}@endif> Yes

        </label>

        <label class="radio-inline">

          <input type="radio" name="staff_accomodation" value="0" <?php if(isset($property->staff_accomodation) == 0){ echo 'checked="checked"'; }else{} ?>> No

        </label>

        </div>

      </div>



      <div class="form-group">

      <label class="col-sm-4 col-xs-12 control-label">One Story</label>

        <div class="col-sm-8 col-xs-12">

        <label class="radio-inline">

          <input type="radio" name="one_storey" value="1" @if(old('one_storey')=='1'){{'checked="checked"'}}

          @elseif(isset($property->one_storey) and ($property->one_storey=='1')){{'checked="checked"'}}@endif> Yes

        </label>

        <label class="radio-inline">

          <input type="radio" name="one_storey" value="0" <?php if(isset($property->one_storey) == 0){ echo 'checked="checked"'; }else{} ?>> No

        </label>

        </div>

      </div>



      <div class="form-group">

      <label class="col-sm-4 col-xs-12 control-label">Two Story</label>

        <div class="col-sm-8 col-xs-12">

        <label class="radio-inline">

          <input type="radio" name="two_storey" value="1" @if(old('two_storey')=='1'){{'checked="checked"'}}

          @elseif(isset($property->two_storey) and ($property->two_storey=='1')){{'checked="checked"'}}@endif> Yes

        </label>

        <label class="radio-inline">

          <input type="radio" name="two_storey" value="0" <?php if(isset($property->two_storey) == 0){ echo 'checked="checked"'; }else{} ?>> No

        </label>

        </div>

      </div>



      <div class="form-group">

      <label class="col-sm-4 col-xs-12 control-label">Hot Tub</label>

        <div class="col-sm-8 col-xs-12">

        <label class="radio-inline">

          <input type="radio" name="hot_tub" value="1" @if(old('hot_tub')=='1'){{'checked="checked"'}}

          @elseif(isset($property->hot_tub) and ($property->hot_tub=='1')){{'checked="checked"'}}@endif> Yes

        </label>

        <label class="radio-inline">

          <input type="radio" name="hot_tub" value="0" <?php if(isset($property->hot_tub) == 0){ echo 'checked="checked"'; }else{} ?>> No

        </label>

        </div>

      </div>



      <div class="form-group">

      <label class="col-sm-4 col-xs-12 control-label">Hurricane Impact Windows</label>

        <div class="col-sm-8 col-xs-12">

        <label class="radio-inline">

          <input type="radio" name="hurrican_impact" value="1" @if(old('hurrican_impact')=='1'){{'checked="checked"'}}

          @elseif(isset($property->hurrican_impact) and ($property->hurrican_impact=='1')){{'checked="checked"'}}@endif> Yes

        </label>

        <label class="radio-inline">

          <input type="radio" name="hurrican_impact" value="0" <?php if(isset($property->hurrican_impact) == 0){ echo 'checked="checked"'; }else{} ?>> No

        </label>

        </div>

      </div>



      <div class="form-group">

      <label class="col-sm-4 col-xs-12 control-label">Hurricane Impact Panel</label>

        <div class="col-sm-8 col-xs-12">

        <label class="radio-inline">

          <input type="radio" name="hurrican_impact_panel" value="1" @if(old('hurrican_impact_panel')=='1'){{'checked="checked"'}}

          @elseif(isset($property->hurrican_impact_panel) and ($property->hurrican_impact_panel=='1')){{'checked="checked"'}}@endif> Yes

        </label>

        <label class="radio-inline">

          <input type="radio" name="hurrican_impact_panel" value="0" <?php if(isset($property->hurrican_impact_panel) == 0){ echo 'checked="checked"'; }else{} ?>> No

        </label>

        </div>

      </div>

<!--

      <div class="form-group">

      <label class="col-sm-4 col-xs-12 control-label">Heat Type</label>

        <div class="col-sm-8 col-xs-12">

        <label class="radio-inline">

          <input type="radio" name="heat_type" value="1" @if(old('heat_type')=='1'){{'checked="checked"'}}

          @elseif(isset($property->heat_type) and ($property->heat_type=='1')){{'checked="checked"'}}@endif> Yes

        </label>

        <label class="radio-inline">

          <input type="radio" name="heat_type" value="0" <?php if(isset($property->heat_type) == 0){ echo 'checked="checked"'; }else{} ?>> No

        </label>

        </div>

      </div>

-->

      <div class="form-group">

      <label class="col-sm-4 col-xs-12 control-label">Gated Property</label>

        <div class="col-sm-8 col-xs-12">

        <label class="radio-inline">

          <input type="radio" name="gated_property" value="1" @if(old('gated_property')=='1'){{'checked="checked"'}}

          @elseif(isset($property->gated_property) and ($property->gated_property=='1')){{'checked="checked"'}}@endif> Yes

        </label>

        <label class="radio-inline">

          <input type="radio" name="gated_property" value="0" <?php if(isset($property->gated_property) == 0){ echo 'checked="checked"'; }else{} ?>> No

        </label>

        </div>

      </div>



      <div class="form-group">

      <label class="col-sm-4 col-xs-12 control-label">Tennis Court</label>

        <div class="col-sm-8 col-xs-12">

        <label class="radio-inline">

          <input type="radio" name="tennis_court" value="1" @if(old('tennis_court')=='1'){{'checked="checked"'}}

          @elseif(isset($property->tennis_court) and ($property->tennis_court=='1')){{'checked="checked"'}}@endif> Yes

        </label>

        <label class="radio-inline">

          <input type="radio" name="tennis_court" value="0" <?php if(isset($property->tennis_court) == 0){ echo 'checked="checked"'; }else{} ?>> No

        </label>

        </div>

      </div>



      <div class="form-group">

      <label class="col-sm-4 col-xs-12 control-label">Central Air Conditioning</label>

        <div class="col-sm-8 col-xs-12">

        <label class="radio-inline">

          <input type="radio" name="central_air_conditioning" value="1" @if(old('central_air_conditioning')=='1'){{'checked="checked"'}}

          @elseif(isset($property->central_air_conditioning) and ($property->central_air_conditioning=='1')){{'checked="checked"'}}@endif> Yes

        </label>

        <label class="radio-inline">

          <input type="radio" name="central_air_conditioning" value="0" <?php if(isset($property->central_air_conditioning) == 0){ echo 'checked="checked"'; }else{} ?>> No

        </label>

        </div>

      </div>



      <div class="form-group">

      <label class="col-sm-4 col-xs-12 control-label">Fireplace</label>

        <div class="col-sm-8 col-xs-12">

        <label class="radio-inline">

          <input type="radio" name="fireplace" value="1" @if(old('fireplace')=='1'){{'checked="checked"'}}

          @elseif(isset($property->fireplace) and ($property->fireplace=='1')){{'checked="checked"'}}@endif> Yes

        </label>

        <label class="radio-inline">

          <input type="radio" name="fireplace" value="0" <?php if(isset($property->fireplace) == 0){ echo 'checked="checked"'; }else{} ?>> No

        </label>

        </div>

      </div>

      

      <div class="form-group">

      <label class="col-sm-4 col-xs-12 control-label">Docking Rights</label>

        <div class="col-sm-8 col-xs-12">

        <label class="radio-inline">

          <input type="radio" name="docking" value="1" @if(old('docking')=='1'){{'checked="checked"'}}

          @elseif(isset($property->docking) and ($property->docking=='1')){{'checked="checked"'}}@endif> Yes

        </label>

        <label class="radio-inline">

          <input type="radio" name="docking" value="0" <?php if(isset($property->docking) == 0){ echo 'checked="checked"'; }else{} ?>> No

        </label>

        </div>

      </div>



      <div class="form-group">

      <label class="col-sm-4 col-xs-12 control-label">Pool</label>

        <div class="col-sm-8 col-xs-12">

        <label class="radio-inline">

          <input type="radio" name="pool" value="1" @if(old('pool')=='1'){{'checked="checked"'}}

          @elseif(isset($property->pool) and ($property->pool=='1')){{'checked="checked"'}}@endif> Yes

        </label>

        <label class="radio-inline">

          <input type="radio" name="pool" value="0" <?php if(isset($property->pool) == 0){ echo 'checked="checked"'; }else{} ?>> No

        </label>

        </div>

      </div>



      <div class="form-group">

      <label class="col-sm-4 col-xs-12 control-label">1st Floor Master Bedroom</label>

        <div class="col-sm-8 col-xs-12">

        <label class="radio-inline">

          <input type="radio" name="masterbedroom1st" value="1" @if(old('masterbedroom1st')=='1'){{'checked="checked"'}}

          @elseif(isset($property->masterbedroom1st) and ($property->masterbedroom1st=='1')){{'checked="checked"'}}@endif> Yes

        </label>

        <label class="radio-inline">

          <input type="radio" name="masterbedroom1st" value="0" <?php if(isset($property->masterbedroom1st) == 0){ echo 'checked="checked"'; }else{} ?>> No

        </label>

        </div>

      </div>



    </div>

    <div class="col-md-4">
     <h4>Energy Efficent</h4>
     <div class="form-group">
        <div class="checkbox">
          <label>
          <input id="" type="checkbox" name="geo_thermal_heat" value="1"
          @if(old('geo_thermal_heat')){{'checked="checked"'}}
          @elseif(isset($property->geo_thermal_heat) and ($property->geo_thermal_heat=='1')){{'checked="checked"'}}@endif/>
            Geo Thermal Heat
          </label>
        </div>
      </div>
      <div class="form-group">
        <div class="checkbox">
          <label>
          <input id="" type="checkbox" name="solar_panels" value="1"
          @if(old('solar_panels')){{'checked="checked"'}}
          @elseif(isset($property->solar_panels) and ($property->solar_panels=='1')){{'checked="checked"'}}@endif/>
           Solar Panels
          </label>
        </div>
      </div>
      <div class="form-group">
        <div class="checkbox">
          <label>
          <input id="" type="checkbox" name="solar_water_heater" value="1"
          @if(old('solar_water_heater')){{'checked="checked"'}}
          @elseif(isset($property->solar_water_heater) and ($property->solar_water_heater=='1')){{'checked="checked"'}}@endif/>
           Solar Water Heater
          </label>
        </div>
      </div>
      <div class="form-group">
        <div class="checkbox">
          <label>
          <input id="" type="checkbox" name="windmill" value="1"
          @if(old('windmill')){{'checked="checked"'}}
          @elseif(isset($property->windmill) and ($property->windmill=='1')){{'checked="checked"'}}@endif/>
           Windmill
          </label>
        </div>
      </div>
      <div class="form-group">
        <div class="checkbox">
          <label>
          <input id="" type="checkbox" name="energy_star_appliances" value="1"
          @if(old('energy_star_appliances')){{'checked="checked"'}}
          @elseif(isset($property->energy_star_appliances) and ($property->energy_star_appliances=='1')){{'checked="checked"'}}@endif/>
           Energy Star Appliances
         </label>
       </div>
     </div>
     
     
     
     <div class="form-group">
        <div class="checkbox">
          <label>
          <input id="" type="checkbox" name="gas_heater" value="1"
          @if(old('gas_heater')){{'checked="checked"'}}
          @elseif(isset($property->gas_heater) and ($property->gas_heater=='1')){{'checked="checked"'}}@endif/>
            Gas heater
          </label>
        </div>
      </div>
     
     <div class="form-group">
        <div class="checkbox">
          <label>
          <input id="" type="checkbox" name="electric_heater" value="1"
          @if(old('electric_heater')){{'checked="checked"'}}
          @elseif(isset($property->electric_heater) and ($property->electric_heater=='1')){{'checked="checked"'}}@endif/>
            Electric heater
          </label>
        </div>
      </div>
     
     <div class="form-group">
        <div class="checkbox">
          <label>
          <input id="" type="checkbox" name="trash_drop_off" value="1"
          @if(old('trash_drop_off')){{'checked="checked"'}}
          @elseif(isset($property->trash_drop_off) and ($property->trash_drop_off=='1')){{'checked="checked"'}}@endif/>
            Trash drop off
          </label>
        </div>
      </div>
     
     <div class="form-group">
        <div class="checkbox">
          <label>
          <input id="" type="checkbox" name="city_trash_removal" value="1"
          @if(old('city_trash_removal')){{'checked="checked"'}}
          @elseif(isset($property->city_trash_removal) and ($property->city_trash_removal=='1')){{'checked="checked"'}}@endif/>
            City Trash removal
          </label>
        </div>
      </div>
     
     <div class="form-group">
        <div class="checkbox">
          <label>
          <input id="" type="checkbox" name="sepic_tank" value="1"
          @if(old('sepic_tank')){{'checked="checked"'}}
          @elseif(isset($property->sepic_tank) and ($property->sepic_tank=='1')){{'checked="checked"'}}@endif/>
            Sepic Tank
          </label>
        </div>
      </div>
     
     <div class="form-group">
        <div class="checkbox">
          <label>
          <input id="" type="checkbox" name="city_sewer" value="1"
          @if(old('city_sewer')){{'checked="checked"'}}
          @elseif(isset($property->city_sewer) and ($property->city_sewer=='1')){{'checked="checked"'}}@endif/>
            City sewer
          </label>
        </div>
      </div>
     
     <div class="form-group">
        <div class="checkbox">
          <label>
          <input id="" type="checkbox" name="city_water" value="1"
          @if(old('city_water')){{'checked="checked"'}}
          @elseif(isset($property->city_water) and ($property->city_water=='1')){{'checked="checked"'}}@endif/>
           City Water
          </label>
        </div>
      </div>
     
     <div class="form-group">
        <div class="checkbox">
          <label>
          <input id="" type="checkbox" name="well_water" value="1"
          @if(old('well_water')){{'checked="checked"'}}
          @elseif(isset($property->well_water) and ($property->well_water=='1')){{'checked="checked"'}}@endif/>
            Well Water
          </label>
        </div>
      </div>
     
     <div class="form-group">
        <div class="checkbox">
          <label>
          <input id="" type="checkbox" name="ac_central" value="1"
          @if(old('ac_central')){{'checked="checked"'}}
          @elseif(isset($property->ac_central) and ($property->ac_central=='1')){{'checked="checked"'}}@endif/>
           Ac central
          </label>
        </div>
      </div>
     
     <div class="form-group">
        <div class="checkbox">
          <label>
          <input id="" type="checkbox" name="ac_window_units" value="1"
          @if(old('ac_window_units')){{'checked="checked"'}}
          @elseif(isset($property->ac_window_units) and ($property->ac_window_units=='1')){{'checked="checked"'}}@endif/>
           Ac window units
          </label>
        </div>
      </div>
     
     <div class="form-group">
        <div class="checkbox">
          <label>
          <input id="" type="checkbox" name="ac_european_room_unit" value="1"
          @if(old('ac_european_room_unit')){{'checked="checked"'}}
          @elseif(isset($property->ac_european_room_unit) and ($property->ac_european_room_unit=='1')){{'checked="checked"'}}@endif/>
            Geo Thermal Heat
          </label>
        </div>
      </div>
     
    </div>

    </div>

  </fieldset>



</div>

<div class="col-md-12 buttons-gap">

    <button class="btn btn-primary prevBtn btn-lg" type="button" >Previous</button>

    <button class="btn btn-primary nextBtn btn-lg" type="button" >Next</button>

</div>

</div>

<div class="row setup-content" id="step-8" style="display: block !important;">

<div class="col-md-12">

  <fieldset>

    <legend>Attorney's Information</legend>

    <div class="col-md-6">

      <div class="form-group">

        <label class="col-sm-4 col-xs-12 control-label">Name</label>

        <div class="col-sm-8 col-xs-12">

          <input name="att_name" type="text" class="form-control2" 

            value="@if(old('att_name')){!! old('att_name') !!}@elseif(isset($property->att_name)){!!$property->att_name!!}@endif"

            />

        </div>

      </div>

      <div class="form-group">

        <label class="col-sm-4 col-xs-12 control-label">Email</label>

        <div class="col-sm-8 col-xs-12">

          <input name="att_email" type="text" class="form-control2" 

            value="@if(old('att_email')){!! old('att_email') !!}@elseif(isset($property->att_email)){!!$property->att_email!!}@endif"

            />

        </div>

      </div>

      <div class="form-group">

        <label class="col-sm-4 col-xs-12 control-label">Phone</label>

        <div class="col-sm-8 col-xs-12">

          <input name="att_phone" type="text" class="form-control2" 

            value="@if(old('att_phone')){!! old('att_phone') !!}@elseif(isset($property->att_phone)){!!$property->att_phone!!}@endif"

            />

        </div>

      </div>

      <div class="form-group">

        <label class="col-sm-4 col-xs-12 control-label">Street Address</label>

        <div class="col-sm-8 col-xs-12">

          <input name="att_address" type="text" class="form-control2" 

            value="@if(old('att_address')){!! old('att_address') !!}@elseif(isset($property->att_address)){!!$property->att_address!!}@endif"

            />

        </div>

      </div>

    </div>

    <div class="col-md-6">

      <div class="form-group">

        <label class="col-sm-4 col-xs-12 control-label">PO Box</label>

        <div class="col-sm-8 col-xs-12">

          <input name="att_pobox" type="text" class="form-control2" 

            value="@if(old('att_pobox')){!! old('att_pobox') !!}@elseif(isset($property->att_pobox)){!!$property->att_pobox!!}@endif"

            />

        </div>

      </div>

      <div class="form-group">

        <label class="col-sm-4 col-xs-12 control-label">City</label>

        <div class="col-sm-8 col-xs-12">

          <input name="att_city" type="text" class="form-control2" 

            value="@if(old('att_city')){!! old('att_city') !!}@elseif(isset($property->att_city)){!!$property->att_city!!}@endif"

            />

        </div>

      </div>

      <div class="form-group">

        <label class="col-sm-4 col-xs-12 control-label">State</label>

        <div class="col-sm-8 col-xs-12">

          <input name="att_state" type="text" class="form-control2" 

            value="@if(old('att_state')){!! old('att_state') !!}@elseif(isset($property->att_state)){!!$property->att_state!!}@endif"

            />

        </div>

      </div>

      <div class="form-group">

        <label class="col-sm-4 col-xs-12 control-label">Zip Code</label>

        <div class="col-sm-8 col-xs-12">

          <input name="att_zipcode" type="text" class="form-control2" 

            value="@if(old('att_zipcode')){!! old('att_zipcode') !!}@elseif(isset($property->att_zipcode)){!!$property->att_zipcode!!}@endif"

            />

        </div>

      </div>

    </div>

    <div class="col-md-12">

      <div class="form-group attorney-fee">

        <div class="checkbox">

          <label>

            <input type="checkbox" name="att_fee" id="att_fee" value="1" @if(old('att_fee')){{'checked="checked"'}}

          @elseif(isset($property->att_fee) and ($property->att_fee=='1')){{'checked="checked"'}}@endif> Subscribers (seller) pays for closing attorneys fees

          </label>

        </div>

      </div>

    </div>

  </fieldset>

</div>

<div class="col-md-12 buttons-gap">

    <button class="btn btn-primary prevBtn btn-lg" type="button">Previous</button>

    <button class="btn btn-primary nextBtn btn-lg" type="button">Next</button>

</div>

</div>

<!-- <div class="col-md-12">

  <fieldset>

    <div class="form-group text-center">

      @if (isset($edit))

      <div class="checkbox">

        <label>

        <input id="generate-duplicate" type="checkbox" />

        Generate Duplicate

        </label>

      </div>

      @endif 

    </div>

  </fieldset>

</div> -->

<div class="row setup-content" id="step-9" style="display: block !important;">

<div class="col-md-12">

  <fieldset>

    <legend>Seo Information</legend>

    <div class="col-md-6">

      <div class="form-group">

        <label class="col-sm-4 col-xs-12 control-label">Meta title</label>

        <div class="col-sm-8 col-xs-12">

          <input name="meta_title" type="text" class="form-control2" 

            value="@if(old('meta_title')){!! old('meta_title') !!}@elseif(isset($property->meta_title)){!!$property->meta_title!!}@endif"

            />

        </div>

      </div>

      <div class="form-group">

        <label class="col-sm-4 col-xs-12 control-label">Meta Keyword</label>

        <div class="col-sm-8 col-xs-12">

          <input name="meta_keyword" type="text" class="form-control2" 

            value="@if(old('meta_keyword')){!! old('meta_keyword') !!}@elseif(isset($property->meta_keyword)){!!$property->meta_keyword!!}@endif"

            />

        </div>

      </div>

    </div>

    <div class="col-md-6">

      <div class="form-group">

        <label class="col-sm-4 col-xs-12 control-label">Meta Description</label>

        <div class="col-sm-8 col-xs-12">

          <input name="meta_descript" type="text" class="form-control2" 

            value="@if(old('meta_descript')){!! old('meta_descript') !!}@elseif(isset($property->meta_descript)){!!$property->meta_descript!!}@endif"

            />

        </div>

      </div>

    </div>

  </fieldset>

</div>

<div class="col-md-12 buttons-gap">

    <button class="btn btn-primary prevBtn btn-lg" type="button" >Previous</button>

    <button class="btn btn-primary btn-lg" type="submit">Save</button>

</div>

</div>

<!-- Google Map Modal -->

<div class="modal fade modal-fullscreen force-fullscreen" id="myMapModal">

  <div class="modal-dialog">

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

        <h4 class="modal-title">Google Map</h4>

      </div>

      <div class="modal-body">



        <div class="container-fluid">

        <div class="row">

          <div id="google-map-canvas" class=""></div>

        </div>

        <div class="row">

          <div class="col-md-12 white">

            <div class="col-md-12">

              <div id="markerStatus">Select the red pin onto the map, then drag and drop it on the location where your property is located and click Apply and then Close.</div>

            </div>

          </div>

          <div class="col-md-12 white">

            <div class="col-md-4" style="display: none;"><b>Current position:</b></div>

            <div class="col-md-6" style="display: none;">

              <div id="marker-latlng"></div>

            </div>

            <div class="col-md-12 buttons-gap">

              <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>

              <button type="button" class="btn btn-success pull-right applyLatLong">Apply</button>

            </div>

          </div>

          <!-- <div class="col-md-12 white">

            <div class="col-md-4"><b>Nearest address:</b></div>

            <div class="col-md-6">

              <div id="address"></div>

            </div>

            <div class="col-md-2"></div>

          </div> -->

        </div>

      </div>

      </div>

    </div>

    <!-- /.modal-content -->

  </div>

  <!-- /.modal-dialog -->

</div>

<!-- End of Google Map Modal -->





<!-- Change action of the form if you want to dulicate the data -->

<script>



  function validateNumber(event) {

    var key = window.event ? event.keyCode : event.which;

    if (event.keyCode === 8 || event.keyCode === 46) {

        return true;

    } else if ( key < 48 || key > 57 ) {

        return false;

    } else {

      return true;

    }

  }



  $('#generate-duplicate').on('change', function(){

      if ($(this).is(':checked')) {

          $('form').attr('action', "{{ url('/admin/properties/create') }}");

      } else {

          $('form').attr('action', "{{ url('/admin/properties/update') }}");

      }

  });



  $(document).ready(function(){

    $('[id^=sale_price]').keypress(validateNumber);

  });



  function createslug(slug){

    var slug = slug;

    document.getElementById('slug').value = slug.replace(/\s/g,'-');

  }

</script>





<!-- jQuery: Customization for Google Map  -->



<script>

    function initMap() {

    var input = document.getElementById('city');

    var autocomplete = new google.maps.places.Autocomplete(input);

    autocomplete.addListener('place_changed', function() {

    var place   = autocomplete.getPlace();    

    var citylatitude = place.geometry.location.lat();

    var citylongitude = place.geometry.location.lng();

    

    $("#location").val(place.formatted_address);

    $("#citylatitude").val(citylatitude);

    $("#citylongitude").val(citylongitude);  

    $("#latitude").val(citylatitude);

    $("#longitude").val(citylongitude);  

    

    if (!place.geometry) {

    window.alert("Autocomplete's returned place contains no geometry");

    return;

    }

    });

    }

</script>















<script type='text/javascript'>

$(document).on('click', '.applyLatLong', function() {

    var latlong = $('#marker-latlng').html();

    latlongsplit = latlong.split(',');

    $('#latitude').val(latlongsplit[0]);

    $('#longitude').val(latlongsplit[1]);

    $('.applyLatLong').prop('disabled', true);

    $('.applyLatLong').html('Applied');

  });

 $('#open_map').click(function() {

    var citylatitude=$('#citylatitude').val();

    var citylongitude=$('#citylongitude').val();

    var geocoder=new google.maps.Geocoder(); 

    var map;

    

    var  latLng = new google.maps.LatLng(citylatitude,citylongitude);

    var marker=new google.maps.Marker({

        position:latLng,

        map: map,

        draggable: true

  });

  initialize();

  function geocodePosition(pos) {

    geocoder.geocode({

      latLng: pos

    }, function(responses) {

      if (responses && responses.length > 0) {

        updateMarkerAddress(responses[0].formatted_address);

      } else {

        updateMarkerAddress('Cannot determine address at this location.');

      }

    });

  }

  

  function updateMarkerStatus(str) {

    document.getElementById('markerStatus').innerHTML = str;

  }

  

  function updateMarkerPosition(latLng) {

    document.getElementById('marker-latlng').innerHTML = [

    latLng.lat().toFixed(5),

    latLng.lng().toFixed(5)

    ].join(', ');

    $('.applyLatLong').prop('disabled', false);

    $('.applyLatLong').html('Apply');

  }

  

  function updateMarkerAddress(str) {

    document.getElementById('address').innerHTML = str;

  }

  

  function initialize() {

    var mapProp = {

      center:latLng,

      zoom: 5,

      draggable: true,

      scrollwheel: true,

      mapTypeId:google.maps.MapTypeId.ROADMAP

    };



  // Update current position info.

  

  map=new google.maps.Map(document.getElementById("google-map-canvas"),mapProp);

  marker.setMap(map);

  google.maps.event.addListener(marker, 'click', function() {

    infowindow.setContent(contentString);

    infowindow.open(map, marker);

  });

  

  // Add dragging event listeners.

  google.maps.event.addListener(marker, 'dragstart', function() {

    updateMarkerAddress('Dragging...');

  });

  updateMarkerPosition(latLng);

  geocodePosition(latLng);

  

  google.maps.event.addListener(marker, 'drag', function() {

    updateMarkerStatus('Dragging...');

    updateMarkerPosition(marker.getPosition());

  });

  

  google.maps.event.addListener(marker, 'dragend', function() {

    updateMarkerStatus('Drag ended');

    geocodePosition(marker.getPosition());

  });

  

};

google.maps.event.addDomListener(window, 'load', initialize);



google.maps.event.addDomListener(window, "resize", resizingMap());



$('#myMapModal').on('shown.bs.modal', function() {

  //Must wait until the render of the modal appear, thats why we use the resizeMap and NOT resizingMap!! ;-)

resizeMap();

})



function resizeMap() {

  if(typeof map =="undefined") return;

  setTimeout( function(){resizingMap();} , 400);

}



function resizingMap() {

  if(typeof map =="undefined") return;

  var center = map.getCenter();

  google.maps.event.trigger(map, "resize");

  map.setCenter(center); 

}

});





$(document).ready(function () {



    var navListItems = $('div.setup-panel div .navButton'),

            allWells = $('.setup-content'),

            allNextBtn = $('.nextBtn');

            allPrevBtn = $('.prevBtn');



    allWells.hide();



    navListItems.click(function (e) {

        e.preventDefault();

        var $target = $($(this).attr('href')),

                $item = $(this);



        if (!$item.hasClass('disabled')) {

            navListItems.closest(".stepwizard-step").removeClass('btn-primary');

            $item.closest(".stepwizard-step").addClass('btn-primary');

            allWells.hide();

            $target.show();

            $target.find('input:eq(0)').focus();

        }

    });



    allNextBtn.click(function(){

        var curStep = $(this).closest(".setup-content"),

            curStepBtn = curStep.attr("id"),

            nextStepWizard = $('div.setup-panel div a.navButton[href="#' + curStepBtn + '"]').parent().next().children("a"),

            curInputs = curStep.find("input[type='text'],input[type='url'],input[type='number'],input[type='email']"),

            isValid = true;



        $(".form-group").removeClass("has-error");

        for(var i=0; i<curInputs.length; i++){

            if (!curInputs[i].validity.valid){

                isValid = false;

                $(curInputs[i]).closest(".form-group").addClass("has-error");

            }

        }



        if (isValid)

            nextStepWizard.removeAttr('disabled').trigger('click');

    });



    allPrevBtn.click(function(){

        var curStep = $(this).closest(".setup-content"),

            curStepBtn = curStep.attr("id"),

            prevStepWizard = $('div.setup-panel div a.navButton[href="#' + curStepBtn + '"]').parent().prev().children("a"),

            curInputs = curStep.find("input[type='text'],input[type='url'],input[type='number'],input[type='email']"),

            isValid = true;



            prevStepWizard.removeAttr('disabled').trigger('click');

    });



    $('div.setup-panel div .navButton.first').trigger('click');

});

</script>



<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyAGzCcxLqVTlfq7ktS6EKycZxIoBAoOhm0&amp;sensor=false&amp;libraries=places&callback=initMap"></script>

<!--<script type="text/javascript">

    $(document).ready(function($){

    $("#iframeModal").click(function(){

        $("#iframeModal").modal("show");

    });

    $("#iframeModal").on('.skin-green.sidebar-mini.modal-open', function () {

        $('body').addClass('body-fixed');

    });

    $("#iframeModal").on('.skin-green.sidebar-mini', function () {

        $('body').removeClass('body-fixed');

    });

});

</script>-->

<style type="text/css">

/*.modal{

    position: absolute !important;

}

.row.setup-content{

    position: absolute !important;

}

</style>