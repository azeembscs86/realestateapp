<!-- Brief data of property detail. -->
<div class="row">
  <div class="col-md-3 info-cell"> Bedrooms
    <span class="pull-right">
    {{$property->bedrooms}}
    </span>
  </div>
  <div class="col-md-3 info-cell"> Bathrooms
    <span class="pull-right">
    {{$property->bathrooms}}
    </span>
  </div>
  <div class="col-md-3 info-cell"> Sleeps
    <span class="pull-right">
    {{$property->sleeps}}
    </span>
  </div>
  <div class="col-md-3 info-cell"> Garages
    <span class="pull-right">
    {{$property->garages}}
    </span>
  </div>

  <br/>
  <br/>
</div>
<div class="row">
  <div class="text-center"> 
    @foreach($property->classez as $class)
      <div class="col-md-3">
        <i class="glyphicon glyphicon-ok"></i>
        {{$class->theclass->title}}
      </div>
    @endforeach
  </div>

</div>