@if(isset($lifestyle->id))

<input type="hidden" name="id" value="{{ $lifestyle->id }}">

@endif

<input type="hidden" name="_token" value="{{ csrf_token() }}">

<div class="form-group">

  <label class="col-sm-3 col-xs-12 control-label">Title/Name<font color="#FF0000">*</font></label>

  <div class="col-sm-9 col-xs-12">

    <input type="text" name = "title" placeholder="Enter title here" value="@if(old('title')){!! old('title') !!}@elseif(isset($lifestyle->title)){!!$lifestyle->title!!}@endif" class="form-control" />

  </div>

</div>

<div class="form-group">

  <div class="col-sm-3 col-xs-12"></div>

  <div class="col-sm-9 col-xs-12">

    <label>

    <input name="is_active" type="checkbox" value="1"

    @if(old('is_active')){{'checked="checked"'}}

    @elseif(isset($lifestyle->is_active) and ($lifestyle->is_active=='1')){{'checked="checked"'}}@endif />

    Active</label>

  </div>

</div>

