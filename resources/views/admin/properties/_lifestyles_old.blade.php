<table class="table table-striped table-bordered text-center">
  @foreach($lifestyles as $single)
  <tr valign="top">
    <th width="50%" bgcolor="#efefef" class="text-center" scope="row">
      {!!$single->title!!}
    </th>
    <td width="50%">
      <input name="lifestyle_category[]" 
         type="checkbox" value="{{$single->id}}" <?php if(isset($property->lifestyle_category)) { $lifestyle_array = explode(",", $property->lifestyle_category); if(in_array($single->id, $lifestyle_array)) { echo 'checked';} } ?> />
    </td>
  </tr>
  @endforeach
</table>
