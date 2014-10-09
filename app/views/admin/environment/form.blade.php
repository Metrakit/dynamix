@foreach( $langs as $lang )
<div class="form-group">
    <div class="checkbox checkbox-button">
      <label>
        <input type="checkbox" name="{{$lang['id']}}" value="{{$lang['id']}}"{{( $lang['enable'] == 1 ? ' checked="checked" class="enable"' : ' class="disable"' )}}>
        <span>
            <img height="19px" src="{{$lang['flag']}}" alt="{{$lang['id']}}"/>
            {{$lang['name_locale']}} ({{$lang['name_en']}})
        </span>
      </label>
    </div>
</div>
@endforeach
