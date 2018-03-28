<!--this file is part of properties.php-->
<table class="table table-striped table-bordered text-center">
  @foreach($amenities as $amenity)
  <tr valign="top">
    <th width="50%" bgcolor="#efefef" class="text-center" scope="row">
      {!!$amenity->title!!}
    </th>
    <td width="50%">
      <input name="amenity_value_{{$amenity->id}}" type="checkbox" value="Yes"
      @if(old('amenity_value_'.$amenity->id)){{'checked="checked"'}}
      @elseif(isset($amenity->value) and ($amenity->value=='Yes')){{'checked="checked"'}}@endif
      />
    </td>
  </tr>
  @endforeach
</table>