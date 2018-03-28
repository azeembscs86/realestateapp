@extends('layouts.default.start')

<!-- Goes to html>head>title -->
<?php $page_metas = \App\Pages::where('id', 38)->where('is_active', 1)->first(); ?>
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

PM Content Guidelines - {{$settings->site_title}}

@endsection

<!-- Yields body of the page inside the template -->

@section('contents')





	<div class="breadcrumbs-area bread-bg-pmcontent bg-opacity-black-70">    

		<div class="container">         

			<div class="row">        

				<div class="col-xs-12">     

					<div class="breadcrumbs">        

						<h2 class="breadcrumbs-title">Content Guidelines</h2>  

						<ul class="breadcrumbs-list">           	

							<li><a href="{{url()}}">Home</a></li>   

							<li>Content Guidelines</li>        

						</ul>                  

					</div>         

				</div>         

			</div>

        </div>

    </div>





	<section id="page-content" class="page-wrapper">          

		<div class="container">

			<div class="row">

				<div class="col-sm-12 pt-80 pb-80">

					<p class="privacy-policy2 text-style">We reserve the right to remove any content contributed to a MatchPropertyDirect&trade; website by members, buyers or any other user of the website (each a "user") which does not meet the following guidelines. Reviews, review responses, forum posts and any other content submitted by a user (collectively the "contributed content") are the subjective opinions of the user who posted the content (the "user" or "publisher"). Such content is not the opinion of MatchPropertyDirect&trade; and is not endorsed by us.</p>

		<p class="privacy-policy2 text-style">While we encourage all users to post only information that is truthful and accurate, MatchPropertyDirect&trade; is not a fact finder and cannot be put in a position to determine the legitimacy of contributed content. All users should know that their contributed content could subject them to misrepresentation or defamation claims, which MatchPropertyDirect&trade; will not moderate or arbitrate.</p>
		
		<h3 class="privacy-main">Content Guidelines</h3>


<p class="privacy-policy2 text-style">Contributed content must adhere to the (including, but not limited to property listings, reviews and responses) Terms and Conditions of the MatchPropertyDirect&trade; website in which such contributed content is posted on as well as the following guidelines:</p>

	<ul>
<li>Users who post content must have all legal rights to post the content.</li>
<li>The content must be directly related to its purpose. Examples include:</li>
<li>
<ul>
<li>Property listing descriptions must relate to the property.</li>
<li>Property listings should not direct buyers to third-party websites.</li>
</ul>
</li>
<li>All members have the ability to change or negotiate the price accepted for a property.</li>
</ul>

<h3 class="privacy-main">Additional Information:</h3>

<p class="privacy-policy2 text-style">In the event of legal action pertaining to contributed content, we will remove the relevant contributed content only upon receipt of a final Court Order demanding removal. These Content Guidelines were last updated on July 18, 2017.</p>



				</div>  

            </div>

        </div>

	</section>

	

	

	

	

@endsection

@section('javascript')

<script type="text/javascript">

  $(document).ready(function() {

    $('#light-gallery').lightGallery({

      selector: '.light-gallery-item'

    });

  });

</script>



<!-- Picture Gallery -->



    <!-- jQuery already included @ jquery-2.1.0.js -->



    <link type="text/css" rel="stylesheet" href="{{ asset('resources/plugins/lightGallery-master/dist/css/lightgallery.css')}}" />



    <!-- /. Picture Gallery -->

<!-- Picture Gallery/lightGallery -->



    <!-- jQuery required >= 1.8.0  | jQuery already included in the head jquery-2.1.0.js -->



    <script src="{{ asset('resources/plugins/lightGallery-master/dist/js/lightgallery.js')}}"></script>



    <!-- A jQuery plugin that adds cross-browser mouse wheel support. (Optional) -->



    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-mousewheel/3.1.13/jquery.mousewheel.min.js"></script>



    <!-- lightgallery plugins -->



    <script src="https://cdn.jsdelivr.net/picturefill/2.3.1/picturefill.min.js"></script>



    <script src="{{ asset('resources/plugins/lightGallery-master/dist/js/lg-fullscreen.js')}}"></script>



    <script src="{{ asset('resources/plugins/lightGallery-master/dist/js/lg-thumbnail.js')}}"></script>



    <script src="{{ asset('resources/plugins/lightGallery-master/dist/js/lg-video.js')}}"></script>



    <script src="{{ asset('resources/plugins/lightGallery-master/dist/js/lg-autoplay.js')}}"></script>



    <script src="{{ asset('resources/plugins/lightGallery-master/dist/js/lg-zoom.js')}}"></script>



    <script src="{{ asset('resources/plugins/lightGallery-master/dist/js/lg-hash.js')}}"></script>



    <script src="{{ asset('resources/plugins/lightGallery-master/dist/js/lg-pager.js')}}"></script>



    <!-- End of Picture Gallery/lightGallery -->



@endsection

