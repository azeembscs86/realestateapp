<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
  <!-- Sidebar Menu -->
  <ul class="sidebar-menu">
    
     <?php
    $get_chat_user = DB::table('chat_userdata')->where('session_id',Auth::user()->id)->first();
    $user_log_id = $get_chat_user->id;
    $count_chat = DB::table('chat_messages')->where('to_id',$user_log_id)->where('recd','0')->count();
    ?>
    <?php if(Auth::user()->role=='admin') { ?>
    <li class="treeview" id="treeview-settings">
      <a href="{{url('/admin/dashboard')}}"><i class="fa fa-tachometer"></i> <span>Dashboard</span></a>
    </li>

    <li class="treeview" id="treeview-properties">
      <a href="#"><i class='fa fa-building-o'></i> <span>Properties</span> <i class="fa fa-angle-left pull-right"></i></a>
      <ul class="treeview-menu">
        <li><a href="{{url('/admin/properties')}}"><i class='fa fa-home'></i> <span>Upload/Edit</span></a></li>
        <li><a href="{{url('/admin/marksoldproperties')}}"><i class='fa fa-check'></i> <span>Sold Properties</span></a></li>
        <li><a href="{{url('/admin/deleteproperties')}}"><i class='fa fa-trash'></i> <span>Delete Properties</span></a></li>
        <li><a href="{{url('/admin/amenities')}}"><i class='fa fa-adjust'></i> <span>Features</span></a></li>
        <li><a href="{{url('/admin/lifestyle')}}"><i class='fa fa-adjust'></i> <span>Lifestyle Category</span></a></li>
        <li style="display: none"><a href="{{url('/admin/features')}}"><i class='fa fa-bolt'></i> <span>Features</span></a></li>
        <li><a href="{{url('/admin/property-types')}}"><i class='fa fa-filter'></i> <span>Types</span></a></li>
        
      </ul>
    </li>
    <li class="treeview" id="treeview-settings">
      <a href="{{url('/chat')}}/{{Auth::user()->id}}/0"><i class="fa fa-commenting-o"></i> <span>Chat&nbsp;</span><?php if($count_chat>0) { ?>
      <span class="chat_bubble">{{$count_chat}}</span> 
      <?php } ?></a>
    </li>
    <li class="treeview" id="treeview-settings">
      <a href="{{url('/admin/properties/messages')}}"><i class="fa fa-commenting-o"></i> <span>Messages</span></a>
    </li>
    <li class="treeview" id="treeview-people">
      <a href="#"><i class='fa fa-group'></i> <span>People</span> <i class="fa fa-angle-left pull-right"></i></a>
      <ul class="treeview-menu">
        <li><a href="{{url('/admin/owners')}}"><i class='fa fa-user-secret'></i> <span>Seller</span></a></li>
        <li><a href="{{url('/admin/owners/userlist')}}"><i class='fa fa-users'></i> <span>Buyer</span></a></li>
        <li><a href="{{url('/admin/owners/user-reference')}}"><i class='fa fa-users'></i> <span>Reference Users</span></a></li>
      </ul>
    </li>
    <li class="treeview" id="treeview-website">
      <a href="#"><i class='fa fa-laptop'></i> <span>Website</span> <i class="fa fa-angle-left pull-right"></i></a>
      <ul class="treeview-menu">
        <li><a href="{{url('/admin/sliders')}}"><i class='fa fa-image'></i> <span>Sliders</span></a></li>
        <li><a href="{{url('/admin/pages/index')}}"><i class='fa fa-file-text'></i> <span>Pages</span></a></li>
      </ul>
    </li>
    <li class="treeview" id="treeview-settings">
      <a href="#"><i class='fa fa-gears'></i> <span>Settings</span> <i class="fa fa-angle-left pull-right"></i></a>
      <ul class="treeview-menu">
        <li><a href="{{url('/admin/users')}}"><i class='fa fa-user'></i> <span>Admin Profile</span></a></li>
        <li><a href="{{url('/admin/settings')}}"><i class='fa fa-laptop'></i> <span>Site Settings</span></a></li>
        <li><a href="{{url('/admin/navigation/top-bar')}}"><i class='fa fa-sitemap'></i> <span>Navigation</span></a></li>
        <li><a href="{{url('/admin/coupons')}}"><i class="fa fa-gift" aria-hidden="true"></i><span>Coupons</span></a></li>
      </ul>
    </li>
    <li class="treeview" id="treeview-settings">
		<a href="{{url('/auth/logout')}}"><i class="fa fa-sign-out"></i> <span>Sign out</span></a>
	</li>
  <?php } else { ?>
    <li class="treeview" id="treeview-settings">
      <a href="{{url('/owner/dashboard')}}"><i class="fa fa-tachometer"></i> <span>Dashboard</span></a>
    </li>
    <?php if(Auth::user()->role=='owner') {  ?>
      <li class="treeview" id="treeview-settings">
      <a href="{{url('/owner/properties')}}"><i class="fa fa-home"></i> <span>Properties</span></a>
    </li>
    <li class="treeview" id="treeview-settings">
      <a href="{{url('/chat')}}/{{Auth::user()->id}}/0"><i class="fa fa-commenting-o"></i> <span>Chat&nbsp;</span><?php if($count_chat>0) { ?>
      <span class="chat_bubble">{{$count_chat}}</span> 
      <?php } ?></a>
    </li>
    <?php } else { ?>
     <li class="treeview" id="treeview-settings">
      <a href="{{url('/chat')}}/{{Auth::user()->id}}/2"><i class="fa fa-commenting-o"></i> <span>Chat&nbsp;</span><?php if($count_chat>0) { ?>
      <span class="chat_bubble">{{$count_chat}}</span> 
      <?php } ?></a>
    </li>
    <?php } ?>
    <li class="treeview" id="treeview-settings">
      <a href="#"><i class='fa fa-gears'></i> <span>Settings</span> <i class="fa fa-angle-left pull-right"></i></a>
      <ul class="treeview-menu">
        <li><a href="{{url('/owner/users')}}"><i class='fa fa-user'></i> <span>My Profile</span></a></li>
        <?php if(Auth::user()->role=='owner') {  ?>
        <li><a href="{{url('/owner/users/sharelink')}}"><i class="fa fa-share"></i> <span>Share Link</span></a>
        <?php
        }
        ?>
      </ul>
    </li>
  <li class="treeview" id="treeview-settings">
    <a href="{{url('/auth/logout')}}"><i class="fa fa-sign-out"></i> <span>Sign out</span></a>
  </li>
  <?php } ?> 
  </ul>
  <!-- /.sidebar-menu -->
</section>
<!-- /.sidebar -->


