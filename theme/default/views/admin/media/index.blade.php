@extends('theme::admin.layout.master')


@section('meta_title')
{{{ Lang::get('admin.medias') }}} |
@parent
@stop


@section('filemanager')
<div class="filemanager-container">
<iframe width="100%" height="100%" src="{{URL::to('filemanager/dialog.php?type=2&akey='.Config::get('app.key'))}}"></iframe>
</div>
@stop

@section('scriptOnReady')
	//Fix #section-filemanager
	var sectionFilemanager = document.getElementById('section-filemanager');
	if (sectionFilemanager) {
	  sectionFilemanager.style.height = "100%";
	}
@endsection