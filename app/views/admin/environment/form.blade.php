@foreach( $langs as $lang )
	<label class="label-list">
		<span class="lang-label">
		    <img height="19px" src="{{$lang['flag']}}" alt="{{$lang['id']}}"/>
		    {{$lang['name_locale']}} ({{$lang['name_en']}})
		</span>
		<input type="checkbox" name="{{$lang['id']}}" value="{{$lang['id']}}" class="ios-switch" {{( $lang['enable'] == 1 ? ' checked="checked"' : '' )}}>
		<div class="clearfix"></div>
	</label>
@endforeach
