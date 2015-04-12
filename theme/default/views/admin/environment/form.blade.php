@foreach( $langs as $lang )
	<div class="switch">
        <div class="text-capitalize switch-label">
            <img height="19px" src="{{$lang['flag']}}" alt="{{$lang['id']}}"/>{{$lang['name_locale']}} ({{$lang['name_en']}})
        </div>
        <div class="switch-button">
        Is Publish
			<input type="checkbox" id="{{$lang['id']}}is_publish_switch" name="is_publish_{{$lang['id']}}" value="is_publish_{{$lang['id']}}" class="cmn-toggle cmn-toggle-round-flat" {{( $lang['is_publish'] == 1 ? ' checked="checked"' : '' )}}>
			<label for="{{$lang['id']}}is_publish_switch" class="label-list"></label>
        </div>
        <div class="switch-button">
        Enable
			<input type="checkbox" id="{{$lang['id']}}switch" name="{{$lang['id']}}" value="{{$lang['id']}}" class="input-is_enable cmn-toggle cmn-toggle-round-flat" {{( $lang['enable'] == 1 ? ' checked="checked"' : '' )}}>
			<label for="{{$lang['id']}}switch" class="label-list"></label>
        </div>
		<div class="clearfix"></div>
	</div>
@endforeach
