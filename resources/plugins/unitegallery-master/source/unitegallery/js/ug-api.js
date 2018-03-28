function UG_API(gallery){var t=this,g_objThis=jQuery(t);var g_gallery=new UniteGalleryMain(),g_objGallery;g_gallery=gallery;g_objGallery=jQuery(gallery);this.events={API_INIT_FUNCTIONS:"api_init",API_ON_EVENT:"api_on_event"}
function convertItemDataForOutput(item){var output={index:item.index,title:item.title,description:item.description,urlImage:item.urlImage,urlThumb:item.urlThumb};var addData=item.objThumbImage.data();for(var key in addData){switch(key){case"image":case"description":continue;break;}output[key]=addData[key];}return(output);}this.on=function(event,handlerFunction){switch(event){case"item_change":g_objGallery.on(g_gallery.events.ITEM_CHANGE,function(){var currentItem=g_gallery.getSelectedItem();var output=convertItemDataForOutput(currentItem);handlerFunction(output.index,output);});break;case"resize":g_objGallery.on(g_gallery.events.SIZE_CHANGE,handlerFunction);break;case"enter_fullscreen":g_objGallery.on(g_gallery.events.ENTER_FULLSCREEN,handlerFunction);break;case"exit_fullscreen":g_objGallery.on(g_gallery.events.EXIT_FULLSCREEN,handlerFunction);break;case"play":g_objGallery.on(g_gallery.events.START_PLAY,handlerFunction);break;case"stop":g_objGallery.on(g_gallery.events.STOP_PLAY,handlerFunction);break;case"pause":g_objGallery.on(g_gallery.events.PAUSE_PLAYING,handlerFunction);break;case"continue":g_objGallery.on(g_gallery.events.CONTINUE_PLAYING,handlerFunction);break;default:if(console)console.log("wrong api event: "+event);break;}g_objGallery.trigger(t.events.API_ON_EVENT,[event,handlerFunction]);}
this.play=function(){g_gallery.startPlayMode();}
this.stop=function(){g_gallery.stopPlayMode();}
this.togglePlay=function(){g_gallery.togglePlayMode();}
this.enterFullscreen=function(){g_gallery.toFullScreen();}
this.exitFullscreen=function(){g_gallery.exitFullScreen();}
this.toggleFullscreen=function(){g_gallery.toggleFullscreen();}
this.resetZoom=function(){var objSlider=g_gallery.getObjSlider();if(!objSlider)return(false);objSlider.zoomBack();}
this.zoomIn=function(){var objSlider=g_gallery.getObjSlider();if(!objSlider)return(false);objSlider.zoomIn();}
this.zoomOut=function(){var objSlider=g_gallery.getObjSlider();if(!objSlider)return(false);objSlider.zoomOut();}
this.nextItem=function(){g_gallery.nextItem();}
this.prevItem=function(){g_gallery.prevItem();}
this.selectItem=function(numItem){g_gallery.selectItem(numItem);}
this.resize=function(width,height){if(height)g_gallery.resize(width,height);else
g_gallery.resize(width);}
this.getItem=function(numItem){var data=g_gallery.getItem(numItem);var output=convertItemDataForOutput(data);return(output);}
this.getNumItems=function(){var numItems=g_gallery.getNumItems();return(numItems);}
this.reloadGallery=function(customOptions){if(!customOptions)var customOptions={};g_gallery.run(null,customOptions);}
this.destroy=function(){g_gallery.destroy();}
g_objGallery.trigger(t.events.API_INIT_FUNCTIONS,t);}