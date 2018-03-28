@extends('layouts.default.start')

<!-- Goes to html>head>title -->
<?php $page_metas = \App\Pages::where('id', 44)->where('is_active', 1)->first(); ?>
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

Login - {{$settings->site_title}}

@endsection

<!-- Yields body of the page inside the template -->

@section('contents')
	<div class="breadcrumbs-area bread-bg-buyerlogin bg-opacity-black-70">    
		<div class="container">         
			<div class="row">        
				<div class="col-xs-12">     
					<div class="breadcrumbs">        
						<h2 class="breadcrumbs-title">Login</h2>  
						<ul class="breadcrumbs-list">           	
							<li><a href="{{url()}}">Home</a></li>   
							<li>Login</li>        
						</ul>                  
					</div>         
				</div>         
			</div>
        </div>
    </div>
	<div class="login-section checkbox-custom pt-115 pb-70">           
		<div class="container">                 
			<div class="row">           
				<div class="col-md-6 col-md-offset-3 col-xs-12 ">         
					<div class="registered-customers mb-50">    
	@if(session('message') == 'Congratulations! Your account is verified.')
	  <div class="alert alert-success">{{session('message')}}</div>
	@endif 
    @if(session('message') == 'Invalid Username/Password..')
	  <div class="alert alert-danger">{{session('message')}}</div>
	@endif 
						<h5 class="mb-10">LOGIN</h5>   		 
						<form action="{{ url('/sendlogin') }}" method="post">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<div class="login-account p-30">    
								<p class="mb-30">If you have an account with us, Please log in.</p>  
								<div class="form-group  login-icon  m-b-0">
									<i class="fa fa-user"></i>
									<input type="email" name="email" placeholder="Email" type="text"  required="">  
								</div>
								<div class="form-group login-icon m-b-0">
									<i class="fa fa-lock"></i>
									<input type="password" name="password" placeholder="Password" required=""> 
								</div>
								<div class="col-md-6">
									<div class="row">
										<div class="checkbox text-left">
											<input id="drop-remove2" type="checkbox" name="remember">
											<label for="drop-remove2"> Remember	</label>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="row">
										<p class="text-right">
											<a href="{{url('forgot')}}">Forgot your password?</a>
										</p>
									</div>
								</div>  
								<div class="col-md-12 text-center">
									<div class="row"> 
										<button class="submit-btn-1" type="submit">login</button>  
									</div>
								</div>  
								<div class="col-md-12 text-center">
									<div class="row">
										<p class=" m-b-0  mt-10">Don't have an account ? <a href="{{url('/register')}}">Signup</a></p>  
									</div>
								</div>  
								<div class="clearfix"></div>	
							</div>               
						</form>      
					</div>    
				</div>  
			</div>  
		</div>  
	</div>
@endsection