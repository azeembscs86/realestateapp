<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
  <!-- Sidebar Menu -->
  <ul class="sidebar-menu">
    <?php
    $get_chat_user = DB::table('chat_userdata')->where('session_id',Auth::user()->id)->first();
    $user_log_id = $get_chat_user->id;
    $count_chat = DB::table('chat_messages')->where('to_id',$user_log_id)->where('recd','0')->count();
    ?>
    <?php if(Auth::user()->role=='owner') {  ?>
    <li class="treeview" id="treeview-settings">
      <a href="{{url('/owner/dashboard')}}"><i class="fa fa-tachometer"></i> <span>Seller Maintenance</span></a>
    </li>
    <?php } else {  ?>
    <li class="treeview" id="treeview-settings">
      <a href="{{url('/owner/dashboard')}}"><i class="fa fa-tachometer"></i> <span>Buyers Options</span></a>
    </li>
    <?php } ?>    
    <?php if(Auth::user()->role=='owner') {  ?>
      <li class="treeview" id="treeview-settings">
      <a href="#"><i class="fa fa-home"></i> <span>Properties</span> <i class="fa fa-angle-left pull-right"></i></a>

      <ul class="treeview-menu">
        <li><a href="{{url('/owner/properties')}}"><i class="fa fa-home"></i> <span>Upload/Edit</span></a></li>
        <li><a href="{{url('/owner/marksoldproperties')}}"><i class="fa fa-check"></i> <span>Sold Properties</span></a></li>
       <li><a href="{{url('/owner/deleteproperties')}}"><i class="fa fa-trash"></i> <span>Delete Properties</span></a></li>
      </ul>

    </li>
    <!-- <li class="treeview" id="treeview-settings">
      <a href="{{url('/owner/inquiries')}}"><i class="fa fa-pencil"></i> <span>Inquiries</span></a>
    </li> -->
    <li class="treeview" id="treeview-settings">
      <a href="{{url('/chat')}}/{{Auth::user()->id}}/0"><i class="fa fa-commenting-o"></i> <span>Chat&nbsp;</span><?php if($count_chat>0) { ?>
      <span class="chat_bubble">{{$count_chat}}</span> 
      <?php } ?></a>
    </li>
    <li class="treeview" id="treeview-settings">
	   <a href="{{url('/owner/users/amazon-referral-program')}}"><i class="fa fa-user-plus"></i> <span>Amazon 20$</span><br><span style="margin-left: 25px;">Referral Program</span></a>
	</li>
	<li class="treeview" id="treeview-settings">
	   <a href="{{url('/pages/helpful-hints-for-taking-photos')}}" target="_blank"><i class="fa fa-plus"></i> <span>Helpful Hints For</span><br><span style="margin-left: 25px;">Taking Photos</span></a>
	</li>
    <?php } else { ?>
    <!-- <li class="treeview" id="treeview-settings">
      <a href="{{url('/owner/inquiries')}}"><i class="fa fa-pencil"></i> <span>My Inquiries</span></a>
    </li> -->
     <li class="treeview" id="treeview-settings">
      <a href="{{url('/chat')}}/{{Auth::user()->id}}/2"><i class="fa fa-commenting-o"></i> <span>Chat&nbsp;</span><?php if($count_chat>0) { ?>
      <span class="chat_bubble">{{$count_chat}}</span> 
      <?php } ?></a>
    </li>
    
    <li class="treeview" id="treeview-settings">
    	<a href="{{url('/pages/closing-with-local-attorney')}}" target="_blank"><i class="fa fa-sitemap"></i> <span>Closing Attorney</span></a>
    </li>
    <?php } ?>
    <li class="treeview" id="treeview-settings">
      <a href="#"><i class='fa fa-gears'></i> <span>Settings</span> <i class="fa fa-angle-left pull-right"></i></a>
      <ul class="treeview-menu">
        <li><a href="{{url('/owner/users')}}"><i class='fa fa-user'></i> <span>My Profile</span></a></li>
      </ul>
    </li>
	<li class="treeview" id="treeview-settings">
		<a href="{{url('/auth/logout')}}"><i class="fa fa-sign-out"></i> <span>Sign out</span></a>
	</li>
  </ul>
  <!-- /.sidebar-menu -->
</section>
<!-- /.sidebar -->