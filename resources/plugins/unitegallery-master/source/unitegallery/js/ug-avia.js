function UGAviaControl(){var g_parent,g_gallery,g_objects,g_objStrip,g_objStripInner,g_options;var g_isVertical;var g_temp={touchEnabled:false,isMouseInsideStrip:false,strip_finalPos:0,handle_timeout:"",isStripMoving:false,isControlEnabled:true};this.enable=function(){g_temp.isControlEnabled=true;}
this.disable=function(){g_temp.isControlEnabled=false;}
this.init=function(objParent){g_parent=objParent;g_objects=objParent.getObjects();g_gallery=g_objects.g_gallery;g_objStrip=g_objects.g_objStrip;g_objStripInner=g_objects.g_objStripInner;g_options=g_objects.g_options;g_isVertical=g_objects.isVertical;initEvents();}
function getMousePos(event){if(g_isVertical==false)return(event.pageX);return(event.pageY);}function initEvents(event){jQuery("body").on("touchstart",function(event){if(g_temp.isControlEnabled==false)return(true);g_temp.touchEnabled=true;});jQuery("body").mousemove(function(event){if(g_temp.isControlEnabled==false)return(true);if(g_temp.touchEnabled==true){jQuery("body").off("mousemove");return(true);}g_temp.isMouseInsideStrip=g_objStrip.ismouseover();var strip_touch_active=g_parent.isTouchMotionActive();if(g_temp.isMouseInsideStrip==true&&strip_touch_active==false){var mousePos=getMousePos(event);moveStripToMousePosition(mousePos);}else{stopStripMovingLoop();}});}this.destroy=function(){jQuery("body").off("touchstart");jQuery("body").off("mousemove");}
function getInnerPosY(mouseY){var innerOffsetTop=g_options.strip_padding_top;var innerOffsetBottom=g_options.strip_padding_bottom;var stripHeight=g_objStrip.height();var innerHeight=g_objStripInner.height();if(stripHeight>innerHeight)return(null);var stripOffset=g_objStrip.offset();var offsetY=stripOffset.top;var posy=mouseY-offsetY-innerOffsetTop;if(posy<0)return(null);var mlineStart=g_options.thumb_height;var mlineEnd=stripHeight-g_options.thumb_height;var mLineSize=mlineEnd-mlineStart;if(posy<mlineStart)posy=mlineStart;if(posy>mlineEnd)posy=mlineEnd;var ratio=(posy-mlineStart)/mLineSize;var innerPosY=(innerHeight-stripHeight)*ratio;innerPosY=Math.round(innerPosY)*-1+innerOffsetTop;return(innerPosY);}function getInnerPosX(mouseX){var innerOffsetLeft=g_options.strip_padding_left;var innerOffsetRight=g_options.strip_padding_right;var stripWidth=g_objStrip.width()-innerOffsetLeft-innerOffsetRight;var innerWidth=g_objStripInner.width();if(stripWidth>innerWidth)return(null);var stripOffset=g_objStrip.offset();var offsetX=stripOffset.left;var posx=mouseX-offsetX-innerOffsetLeft;var mlineStart=g_options.thumb_width;var mlineEnd=stripWidth-g_options.thumb_width;var mLineSize=mlineEnd-mlineStart;if(posx<mlineStart)posx=mlineStart;if(posx>mlineEnd)posx=mlineEnd;var ratio=(posx-mlineStart)/mLineSize;var innerPosX=(innerWidth-stripWidth)*ratio;innerPosX=Math.round(innerPosX)*-1+innerOffsetLeft;return(innerPosX);}function moveStripStep(){if(g_temp.is_strip_moving==false){return(false);}var innerPos=g_parent.getInnerStripPos();if(Math.floor(innerPos)==Math.floor(g_temp.strip_finalPos)){stopStripMovingLoop();}var diff=Math.abs(g_temp.strip_finalPos-innerPos);var dpos;if(diff<1){dpos=diff;}else{dpos=diff/4;if(dpos>0&&dpos<1)dpos=1;}if(g_temp.strip_finalPos<innerPos)dpos=dpos*-1;var newPos=innerPos+dpos;g_parent.positionInnerStrip(newPos);}function startStripMovingLoop(){if(g_temp.isStripMoving==true)return(false);g_temp.isStripMoving=true;g_temp.handle_timeout=setInterval(moveStripStep,10);}function stopStripMovingLoop(){if(g_temp.isStripMoving==false)return(false);g_temp.isStripMoving=false;g_temp.handle_timeout=clearInterval(g_temp.handle_timeout);}function getInnerPos(mousePos){if(g_isVertical==false)return getInnerPosX(mousePos);else
return getInnerPosY(mousePos);}function moveStripToMousePosition(mousePos){var innerPos=getInnerPos(mousePos);if(innerPos===null)return(false);g_temp.is_strip_moving=true;g_temp.strip_finalPos=innerPos;startStripMovingLoop();}}