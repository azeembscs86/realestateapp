<style type="text/css">
  .slow-spin {
  -webkit-animation: fa-spin 6s infinite linear;
  animation: fa-spin 6s infinite linear;
  }
  #settings-button {
  right:-60px; top:30px;
  position: absolute;
  background-color: #ddd;
  border: solid 1px #ccc;
  color:#222;
  }
  #theme-options-panel {
  float: left;
  height:350px;
  width:250px;
  z-index:2;
  position:fixed;
  top:55px;
  left:-250px;
  background:#ddd; border: solid 1px #ccc;
  color:#000;
  z-index: 1400;
  }
  #theme-options-panel > .box {
  width: 25px;
  height: 25px;
  margin: 5px;
  cursor: pointer;
  float: left;
  }
  #theme-options-panel > .themebutton001 {
  border-top: #1d5134 solid 7px;
  background-color: #48a942;
  }
  #theme-options-panel > .themebutton002 {
  border-top: #511D3A solid 7px;
  background-color: #A342A9;
  }
  #theme-options-panel > .themebutton003 {
  border-top: #2F1D51 solid 7px;
  background-color: #4252A9;
  }
  #theme-options-panel > .themebutton004 {
  border-top: #1D3E51 solid 7px;
  background-color: #42A99A;
  }
  #theme-options-panel > .themebutton005 {
  border-top: #51391D solid 7px;
  background-color: #A94642;
  }
</style>
<div id="theme-options-panel">
  <a href="#" id="settings-button"><i class="fa fa-cog  fa-spin fa-3x fa-fw slow-spin"></i></a>
  <center>
    <h4>Theme Colors!</h4>
  </center>
  <div class="box themebutton001" data-themefile="{{ asset('/css/property-theme-001.css') }}"></div>
  <div class="box themebutton002" data-themefile="{{ asset('/css/property-theme-002.css') }}"></div>
  <div class="box themebutton003" data-themefile="{{ asset('/css/property-theme-003.css') }}"></div>
  <div class="box themebutton004" data-themefile="{{ asset('/css/property-theme-004.css') }}"></div>
  <div class="box themebutton005" data-themefile="{{ asset('/css/property-theme-005.css') }}"></div>
</div>
<script>
  function setCookie(cname,cvalue,exdays) {
      var d = new Date();
      d.setTime(d.getTime() + (exdays*24*60*60*1000));
      var expires = "expires=" + d.toGMTString();
      document.cookie = cname+"="+cvalue+"; "+expires;
  }
  
  function getCookie(cname) {
      var name = cname + "=";
      var ca = document.cookie.split(';');
      for(var i=0; i<ca.length; i++) {
          var c = ca[i];
          while (c.charAt(0)==' ') c = c.substring(1);
          if (c.indexOf(name) == 0) {
              return c.substring(name.length, c.length);
          }
      }
      return "";
  }
  
  $(function() {
      $('#theme-options-panel > .box').click(function (){
      var themefile = $(this).data('themefile');
      $('#themefile').attr('href',themefile);
      setCookie("themefile", themefile, 30);
  });
  });
  
  
  $(document).ready(function(){
  $('#settings-button').click(function(){
  var hidden = $('#theme-options-panel');
  var settingsbutton = $('#settings-button');
  if (hidden.hasClass('visible')){
    hidden.animate({"left":"-250px"}, "slow").removeClass('visible');
    //settingsbutton.animate({"left":"200px"}, "slow");
  } else {
    //settingsbutton.animate({"left":"400px"}, "slow");
    hidden.animate({"left":"0px"}, "slow").addClass('visible');
  }
  });
  });
</script>