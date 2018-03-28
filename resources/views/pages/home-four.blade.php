@extends('layouts.004.start')

<!-- Goes to html>head>title -->

@section('title')

Welcome to our website - {{$settings->site_title}}

@endsection

<!-- Yields body of the page inside the template -->

@section('contents')

<!-- Navigation: Top-bar -->
    <section style="z-index:2000">
    @include('layouts.default._navigation')
    </section>

@include('include.googlemap')
<div class="col-md-12">
@include('include.search-form-horizontal')
</div>
<section id="welcome-index">
  <div class="container page-body">

    <!-- Welcome Contents Section -->

    <article class="col-md-12">

      <div class="col-md-6 col-sm-6"> 

      <h1 class="page-header">{{$page_home->title}}</h1>

        {!!$page_home->summary!!}   

        <br/>

        <br/>

        <a href="{{url($page_home->category->slug.'/'.$page_home->slug)}}"><span aria-hidden="true">&#8594;</span> Read More</a>

        <br/>

        <br/>

      </div>

      <div class="col-md-6 col-sm-6"> 

        <img class="img-responsive" src="{{asset(@$page_home->images->first()->image)}}" alt="{{@$page_home->title}}"> 

      </div>

    </article>



    <!-- /.row -->


    <!-- /.row -->

  </div>
</section>


<!-- Featured Properties Section -->

<section class="featured-items-section">
  <div class="container">
    <div class="col-sm-12">

      <div class=" caption-slide-up">

        @foreach($properties as $property)

        <div class="col-lg-4 col-sm-6 col-md-6 featured-item">

          <div class="labels">

            @if($property->is_new==1)

            <div class="label-new"></div>

            @endif

            @if($property->is_vacation==1)

            <div class="label-rent"></div>

            @endif

            @if($property->is_sale==1)

            <div class="label-sale"></div>

            @endif

          </div>

          <div class="category">

            {!!$property->category->title!!}

          </div>



          <ul class="list-inline featured-item-header text-center">

            <li><strong>

              {{$property->bedrooms}}              - </strong><small>Bedrooms</small>

            </li>

            <li><strong>

              {{$property->bathrooms}}              - </strong><small>Bathrooms</small>

            </li>

            <li><strong>

              {{$property->sleeps}}              - </strong><small>Sleeps</small>

            </li>

          </ul>

          <figure>

            @if(isset($property->images->first()->image))

            <img class="img-responsive" src="{{asset($property->images->first()->image)}}" alt="{{$property->title}}">

            @else

            <img class="img-responsive" src="{{asset('pictures/placeholder.png')}}" alt="No Image Available">

            @endif

            <figcaption>

              <h3>

                {{$property->title}}              

              </h3>

              <p>

                {{$property->city}}                <br>

                {{@$property->location->title}}                ,

                {{$property->zip}}              

              </p>

              <a href="{{url('show/'.$property->slug)}}" class="button high_device_link"><span>&#10004;</span>View Detail</a> 

              <a href="{{url('show/'.$property->slug)}}" class="small_device_link" >View Detail</a> 

            </figcaption>

          </figure>

        </div>

        @endforeach

      </div>

    </div>
  </div>
</section>

<!-- /.row -->

<!-- Featured Section -->

<section class="intro_paddding">
 <div class="container">
   <div class="col-lg-12">
    <h2 class="page-header"> Explore More </h2>
  </div>
  @foreach($pages_featured as $page)
  <!-- Featured Contents -->
  @if(isset($page->images->first()->image) and is_file($page->images->first()->image))
  <div class="col-md-4">
    <div class="content">
      <div class="grid">
        <figure class="effect-sarah">
          <img src="{{asset($page->images->first()->image)}}" alt="{{$page->title}}"/>
          <figcaption>
            <h2>{{$page->title}}</h2>
            <p><?= $page->summary ?></p>
            <a href="{{url($page->category->slug.'/'.$page->slug)}}">View more</a>
          </figcaption>     
        </figure>          
      </div>
    </div>
  </div>
  @endif
  <!-- /.Featured Contents -->
  @endforeach
</div>

</section>
<!-- /.Featured Section -->
@endsection
