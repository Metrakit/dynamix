@foreach( $langs as $lang )
<div class="form-group">
    <div class="checkbox">
      <label>
        <input type="checkbox" name="{{$lang['id']}}" value="{{$lang['id']}}"{{( $lang['enable'] == 1 ? 'checked="checked"' : '' )}}>
        <span style="display:inline-block; min-width:40px; text-align:center;"><img height="19px" src="{{$lang['flag']}}" alt="{{$lang['id']}}"/></span> {{$lang['name_locale']}} ({{$lang['name_en']}})
      </label>
    </div>
</div>
@endforeach
