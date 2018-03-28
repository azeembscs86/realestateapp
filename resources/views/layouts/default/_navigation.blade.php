<!-- Menu coming from database -->
<button aria-controls="main-menu" aria-expanded="false" class="collapsed navbar-toggle visible-xs" data-target="#menu-custm" data-toggle="collapse" type="button"> 	
	<span class="icon-bar" style="background:#000"></span> 	
	<span class="icon-bar" style="background:#000"></span> 	
	<span class="icon-bar" style="background:#000"></span> 
</button>
<nav class="main-menu pull-right collapse" role="navigation" id="menu-custm" >
	{!! html_entity_decode(html_entity_decode($menu_top)) !!}
</nav>
