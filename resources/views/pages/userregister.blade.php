<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
@extends('layouts.default.start')
<!-- Goes to html>head>title -->
<?php $page_metas = \App\Pages::where('id', 45)->where('is_active', 1)->first(); ?>
@section('metatits')
{{$page_metas->meta_title}}
@endsection
@section('metadesc')
{{$page_metas->meta_descript}}
@endsection
@section('metakeys')
{{$page_metas->meta_keyword}}
@endsection
@section('title')
Register - {{$settings->site_title}}
@endsection
<!-- Yields body of the page inside the template -->
@section('contents')
<div class="breadcrumbs-area bread-bg-signup bg-opacity-black-70">    
    <div class="container">         
        <div class="row">        
            <div class="col-xs-12">     
                <div class="breadcrumbs">
                    <h2 class="breadcrumbs-title">Register</h2>  
                    <ul class="breadcrumbs-list">           	
                        <li><a href="{{url()}}">Home</a></li>   
                        <li>Register </li>        
                    </ul>                  
                </div>    
            </div>        
        </div>
    </div>
</div>
<div class="login-section pt-115 pb-70">           
    <div class="container">                 
        <div class="row">           
            <div class="col-md-6 col-md-offset-3 col-xs-12 ">         
                <div class="registered-customers mb-50">    
                    @if(session('message'))
                    <div class="alert alert-danger">{{session('message')}}</div>
                    @endif  
                    <h5 class="mb-50">Signup </h5>    
                    <form id="register_frm" action="{{url('/senduserregister')}}" method="post">
                       
                        <input type="hidden" name="user_id" value=" {{ $user_id }}">                           
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">   
                        <div class="login-account p-30 checkbox-custom">    
                            <p>New to the site? Sign up</p>  
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group  login-icon  m-b-0">
                                        <i class="fa fa-user"></i>
                                        <input name="first_name" type="text" placeholder="First Name" required="">  
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group  login-icon  m-b-0">
                                        <i class="fa fa-user"></i>
                                        <input name="last_name" type="text" placeholder="Last Name" required="">  
                                    </div>
                                </div>
                            </div>
                            <div class="form-group  login-icon  m-b-0">
                                <i class="fa fa-envelope-o"></i>
                                <input name="email" type="email" placeholder="Email Address" required="">  
                            </div>
                            <div class="form-group">
                                <select name="role" required="" class="form-control">                                    
                                    <option value="owner" selected="selected">Seller</option>                                    
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group login-icon m-b-0">
                                        <i class="fa fa-lock"></i>
                                        <input name="password" id="password" type="password" placeholder="Password" minlength="7" required=""> 
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group login-icon m-b-0">
                                        <i class="fa fa-lock"></i>
                                        <input type="password" id="confirm_password" placeholder="Re-Type Password" minlength="7" required=""> 
                                    </div>
                                </div>
                            </div>
                            <div class="checkbox">
                                <input id="drop-remove2" type="checkbox" required="">
                                <label for="drop-remove2">
                                    I have agree with all <a href="{{url('pages/term-of-use')}}">terms &amp; conditions</a>
                                </label>
                            </div>
                            <button class="submit-btn-1 register_btn" type="submit">Signup</button>  
                        </div>               
                    </form>      
                   <div class="preloader" style="display: none;">
                        <img src="{{ url('img') }}/preloader.gif">
                    </div>	
               </div>    
            </div>  
        </div>  
    </div>  
</div>
@endsection
@section('javascript')
<!-- jQuery library -->
<script type="text/javascript">
$("#register_frm").submit(function (e) {
    e.preventDefault();
    var password = $("#password").val();
    var confirm_password = $("#confirm_password").val();
    if (password != confirm_password) {
        alert("Passwords do not match.")
        return false;
    }
    $(".preloader").show();
    $(".register_btn").attr('disabled', 'disabled');
    var url = $(this).attr('action');
    $.ajax({
        type: "POST",
        url: url,
        data: $("#register_frm").serialize(), // serializes the form's elements.
        success: function (data)
        {
            if ($.trim(data) == 1)
            {
                $(".preloader").hide();
                alert("Your account is created successfully. Please check your email address and verify your account.");
                $('#register_frm')[0].reset();
                location.reload();
            } else if ($.trim(data) == 2)
            {
                $(".preloader").hide();
                alert("Email address already exists.");
                $(".register_btn").removeAttr('disabled', 'disabled');
            } else
            {
                $(".preloader").hide();
                $(".register_btn").removeAttr('disabled', 'disabled');
                alert("Error while processing your request.Please try after some time.");
            }
        }
    });
});
</script>
@endsection

