@extends('layouts.default.start')
<!-- Goes to html>head>title -->
<?php $page_metas = \App\Pages::where('id', 33)->where('is_active', 1)->first(); ?>
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
Privacy Policy - {{$settings->site_title}}
@endsection
<!-- Yields body of the page inside the template -->
@section('contents')
	<div class="breadcrumbs-area bread-bg-privacy bg-opacity-black-70">    
		<div class="container">         
			<div class="row">        
				<div class="col-xs-12">     
					<div class="breadcrumbs">        
						<h2 class="breadcrumbs-title">Privacy Policy</h2>  
						<ul class="breadcrumbs-list">           	
							<li><a href="{{url()}}">Home</a></li>   
							<li>Privacy Policy</li>        
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
					<h3 class="privacy-main">How we use your personal data</h3>
					<p>Our primary purpose in collecting your personal data is to provide you 
with the services you request and those which we believe will optimize 
your use of the Site. You agree that we may use your personal data for 
the following purposes:</p>

				
				<ul>
			<li>For the services or to support your request;</li>
			<li>To contact you from time to time with user or service updates;</li>
			<li>To send other messages that help us provide our services on the 
Site;</li>
			<li>To assist people you have done (or have agreed to do) business 
with. For example if you are an owner and a traveler who has 
booked or inquired with you needs your details we may pass them 
on; if you are a traveler and an owner you have booked with needs 
to contact you we may give them your details;</li>
			<li>To customize, measure, report on and improve our services, 
content and advertising;</li>
			<li>To promote services related to the Site or those of the 
MatchPropertyDirect group and/or our affiliates;</li>
			<li>To compare information for accuracy, and verify it with third 
parties;</li>
			<li>To prevent, investigate or prosecute activity we think may be 
potentially illegal, unlawful or harmful and</li>
			<li>To enforce our Privacy Policy and/or our Terms or any other purpose 
referenced herein or therein.</li>
				    
				  
				    
				</ul>
				
	<p>We collate statistics about site traffic, sales and other commercial 
information which we pass onto third parties to assist us in improving 
the services we provide to you. We also use demographic information to 
tailor the Site and we share that information with third parties so that 
they can build up a better picture of our customer base and general 
consumer trends.</p>			  
				
<p>If you are a member, we may also display your phone number on the 
listing itself so that buyers and guests may contact you and to restrict 
fraudulent behavior. We may also contact you about your account and 
your use of our services.</p>				
				  
						<h3 class="privacy-main">How We May Disclose Your Personal Data</h3>
			    <p>We may disclose your personal data to enforce our policies, or where we 
are permitted to do so by applicable law, such as in response to a request 
by a law enforcement or governmental authority, or in connection with 
actual or proposed litigation, or to protect our property, people and other 
rights or interests.</p>
				    
				    <p>We may also share your personal data with:</p>
				    
				    
				   <ul>
				       <li>One of our partners if you've requested their services or if you’ve 
requested to be provided</li>
				   </ul> 
				    
				    
				    <p>with information by them;</p>
				    
				    
				    <ul>
				    <li>Another member if you have done business with them;</li>
				    <li>A third party performing services on our behalf;</li>
				    <li>Companies in the MatchPropertyDirect group and/or affiliates; or</li>
				    <li>Other companies or business entities, for example if we are 
thinking of a merger with or sale to that company or business 
entity;</li>
				    <li>Other companies we work with to feature all or part of our member's 
property listings or otherwise provide promotional or other services 
related to our or MatchPropertyDirect group’s business. This might include 
featuring your listings and photographs on other websites;</li>
				    <li>Any third party you have asked us to share your personal data with – 
such as Facebook if you have asked us to connect with your Facebook 
account; or</li>
				    <li>Any legal or governmental entity pursuant to a subpoena or other legal 
request.</li>
				        
				        
				    </ul>
				    
				    
				    <p>You may have accessed our website through a hyperlink from the 
website of one of our trading partners. If so, you consent to your 
personal details and purchase information, including behavioral patterns, 
being shared with that trading partner in accordance with our contractual 
relationship with them.</p>
				    
				    <p>In the unlikely event that we or MatchPropertyDirect Com, LLC. or any part of 
the MatchPropertyDirect group is sold, or some of its assets transferred to a 
third party, your personal information, as a valuable asset, may also be 
transferred. Potential purchasers and their advisors may have access to 
data as part of the sale process. However, use of your personal 
information will remain subject to this Privacy Policy. Similarly, your 
personal information may be passed on to a successor in interest in the 
unlikely event of a liquidation, bankruptcy, or administration. Our 
customer database could be sold separately from the rest of the business, 
in whole or in a number of parts. It could be that the purchaser's business 
is different from ours, too.</p>
				    
				    
				    
				    
				    						<h3 class="privacy-main">Newsletters</h3>

				    <p>If you sign up as a member on the Site, you may receive our Owner 
newsletter, which is an integral part of the services we provide. Traveler 
users of the Site will be given the option to receive our Traveler 
newsletter when they register with us. We and the MatchPropertyDirect group 
may offer different newsletters from time to time intended to enhance 
the services we or they offer. Users may cancel their subscription to 
these newsletters at any time, although it may take a short while for the 
changes in your preferences to become effective.</p>


				    						<h3 class="privacy-main">Surveys</h3>
<p>We also use surveys to collect information about our users. From time to 
time, we request users' input in order to evaluate potential features and 
services. The decision to answer a survey is completely yours. We use information gathered from surveys to improve 
our services.</p>


				    						<h3 class="privacy-main">Games</h3>
<p>From time to time we may provide games on the Site. These games may 
allow for connectivity with other users or third parties. If that is the case 
you consent to your personal data being transferred accordingly. </p>

				    						<h3 class="privacy-main">Mobile Applications</h3>
<p>When you download or use apps relating to our websites, we may 
receive information about your location and your mobile device, 
including a unique identifier for your device. We may use this 
information to provide you with location-based services, such as 
advertising, search results, and other personalized content. Most mobile 
devices allow you to turn off location services. If you have questions 
about how to disable your device's location services, we recommend you 
contact your mobile service carrier or your device manufacturer.</p>


				    						<h3 class="privacy-main">Telephone Calls</h3>

				    <p>As well as collecting data online and from correspondence we may also 
speak with you face to face (for example at an Owner’s meeting) or by 
telephone. We frequently record telephone conversations. This Privacy 
Policy also governs those recordings and we keep this data in the same 
way that we keep other data. Recordings of calls may also be transferred 
to locations or processed worldwide.</p>

				    						<h3 class="privacy-main">Inquiries and other Electronic Communications</h3>
<p>Buyers may send inquiries to members via clickable links on the listings 
on a Site. Further, buyers and members may communicate with each 
other via tools on a Site. If you choose to send an inquiry through these 
links, your personal information, including your email address and any 
other information you supply (unless the Site specifies otherwise), will 
be visible to the member in question so that they might reply directly to 
you. Your details may also be sent to us and we have access to those 
communications even if you contact the member directly. If members 
and buyers further engage in communications through a Site, we also 
have access to those communications, which we monitor for trust and 
security purposes. Additionally those inquiries and messages may be 
hosted on, be processed by or transmit through our servers. If you 
engage in such communications and call the other party, you may be 
asked to leave a return telephone number. Do not share information in 
the e-mail or phone call that you are not prepared to allow such person 
and MatchPropertyDirect group to have, including, but not limited to, credit 
card and bank account information. In addition inquiries and messages 
can be sent to the individual member you selected and to our system. 
Our customer service team may share such communications with 
members. We may also from time to time, use third party e-mail servers 
to send and track receipt of such communications, and analyze the 
pattern of such communications for trust and security purposes as well 
as to gather data, such as inquiry and booking data (on an anonymous 
basis), to assist us in better understanding our business.</p>



				    						<h3 class="privacy-main">How Do We Protect Your Personal Information Once We Have It?</h3>
<p>We take reasonable technical and organizational measures to guard 
against unauthorized or unlawful processing of your personal data and 
against accidental loss or destruction of, or damage to, your personal 
data. While no system is completely secure, we believe the measures 
implemented by the Site reduce our vulnerability to security problems to 
a level appropriate to the type of data involved. We have security 
measures in place to protect our user database and access to this 
database is restricted internally. However, it remains your responsibility:</p>
				
				
				<ul>
				    <li>To protect against unauthorized access to your use of the Site;</li>
				    <li>To ensure no-one else uses the Site while your machine is logged 
on to the Site (including by logging on to your machine through a 
mobile, Wi-Fi or shared access connection you are using);</li>
				    <li>To log off or exit from the Site when not using it;</li>
				    <li>Where relevant, to keep your password or other access information 
secret. Your password and log in details are personal to you and 
should not be given to anyone else or used to provide shared access 
for example over a network; and </li>
				    <li>To maintain good internet security. For example if your email account 
or Facebook account is compromised this could allow access to your 
account with us if you have given us those details and/or permitted 
access through those accounts. If your email account is compromised it 
could be used to ask us to reset a password and gain access to your 
account with us. You should keep all of your account details secure. If 
you think that any of your accounts has been compromised you should 
change your account credentials with us, and in particular make sure any 
compromised account does not allow access to your account with us. 
You should also tell us as soon as you can, so that we can try to help you 
keep your account secure and if necessary warn anyone else who could 
be affected.<br>
If you have asked us to share data with third party sites, however (such 
as Facebook) their servers may not be secure. Credit card information is 
generally stored by our credit card processing partners and we ask them 
to keep that data secure. We also use third parties to help us optimize our 
website flow, content and advertising (see below).</li>
				    
				    
				    
				    
			
				</ul>
			
			
			
			<p>Note that, despite the measures taken by us and the third parties we 
engage, the Internet is not secure. As a result others may nevertheless 
unlawfully intercept or access private transmissions or data.</p>
			
			
			
							    						<h3 class="privacy-main">What are Cookies, Web Beacons and Clear GIFs and Why Do We 
Use Them?</h3>

	<p>A "cookie" is a small file placed on your hard drive by some of our web 
pages. We, or third parties we do business with, may use cookies to help 
us analyze our web page flow, customize our services, content and 
advertising, measure promotional effectiveness and promote trust and 
safety. Cookies are commonly used at most major transactional websites 
in much the same way we use them here at our Site.</p>		
			
			<p>You may delete and block all cookies from this site, but parts of the site 
will not work. We want to be open about our cookie use. Even if you are 
only browsing the Site certain information (including computer and 
connection information, browser type and version, operating system and 
platform details, and the time of accessing the Site) is automatically 
collected about you. This information will be collected every time you 
access the Site and it will be used for the purposes outlined in this 
Privacy Policy.</p>
			
			
			<p>You can reduce the information cookies collect from your device. An 
easy way of doing this is often to change the settings in your browser. If 
you do that you should know that (a) your use of the Site may be 
adversely affected (and possibly entirely prevented), (b) your experience 
of this and other sites that use cookies to enhance or personalize your 
experience may be adversely affected, and (c) you may not be presented 
with advertising that reflects the way that you use our and other, sites. 
You find out how to make these changes to your browser at this site: 
www.allaboutcookies.org/manage-cookies/. Unless you have adjusted 
your browser setting so that it will refuse cookies, our system will send 
cookies as soon as you visit our site. By using the site you consent to 
this, unless you change your browser settings. </p>	
				
				
				<p>We gather and share information concerning the use of the Site by 
members and buyers with one or more third-party tracking companies 
for the purpose of reporting statistics. To do this, some of the pages you 
visit on our Site use electronic images placed in the web page code, 
called pixel tags (also called "clear GIFs" or "web beacons") that can 
serve many of the same purposes as cookies.</p>
				
				
<p>Web beacons may be used to track the traffic patterns of users from one page to another in order to maximize web traffic flow. Our third-party advertising service providers may also use web beacons to recognize you when you visit the Site and to help determine how you found the Site. If you would like more information about this and to know your choices about not having this information used by these companies, click here: <a href="http://networkadvertising.org/consumer/opt_out.asp" style="word-break: break-word;">http://networkadvertising.org/consumer/opt_out.asp</a> </p>
<h3 class="privacy-main">Phishing or False emails</h3> 

				
				<p>If you receive an unsolicited email that appears to be from us or one of 
our members that requests personal information (such as your credit 
card, login, or password), or that asks you to verify or confirm your 
account or other personal information by clicking on a link, that email 
was likely to have been sent by someone trying to unlawfully obtain 
your information, sometimes referred to as a "phisher" or "spoofer." We 
do not ask for this type of information in an email. Do not provide the 
information or click on the link. Please contact us at Customer Support if 
you get an email like this.</p>
				
				
															    						<h3 class="privacy-main">How do I correct or update my information?</h3> 
<p>You can see any personal information processed by us. The best way of 
seeing this if you are a property owner is to log on to your account by 
using the ‘Owner Login’ tab at the top of the screen. You can see your 
basic details and correct or update them there at any time to suit you. 
Clients can ask to see any information we have on file for the user you 
by contacting us by email at support@matchpropertydirect.com and we have 
72 hours to respond.</p>

											    						<h3 class="privacy-main">How do I opt-out of receiving marketing communications from you?</h3> 
<p>We will contact you from time to time for marketing purposes. Unless 
you have opted out, this could include contacting you by phone or email.
You may opt-out of receiving marketing communications from us by the 
following means:</p>
				
				<p>1. Contact us at support@matchpropertydirect.com; <br>
2. Follow the instructions included in each communication or 
newsletter;<br>
3. Use the Unsubscribe function; or<br>
4. Mail the request to us at PO Box 2761 Palm Beach FL 33480</p>
				
				
				<p>Please remember that if you change your preferences it may take a short 
time for those preferences to become effective.</p>
				
				
				
																			    						<h3 class="privacy-main">How long will we keep your personal data?</h3> 

<p>Client personal data only as long as is necessary for the purposes to 
which you consent under the Terms and Conditions and this Privacy 
Policy.</p>

															    						<h3 class="privacy-main">How do I contact you?</h3> 
<p>If you have any questions about this Privacy Policy, the practices of this 
Site, or your dealings with this Site, we encourage you to contact us at 
1-833-628-2473 or support@matchpropertydirect.com</p>
				
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

