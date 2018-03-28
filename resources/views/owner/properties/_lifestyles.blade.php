<table class="table table-striped table-bordered">
  @foreach($lifestyles as $single)
  <tr valign="top">
    <th width="50%" bgcolor="#efefef" scope="row" style="padding:4px;">
      {!!$single->title!!}
    </th>
    <td>
      <input name="lifestyle_category[]" class="form-control" type="checkbox" value="{{$single->id}}" <?php if(isset($property->lifestyle_category)) { $lifestyle_array = explode(",", $property->lifestyle_category); if(in_array($single->id, $lifestyle_array)) { echo 'checked';} } ?> />
    </td>
  </tr>
  @endforeach
</table>