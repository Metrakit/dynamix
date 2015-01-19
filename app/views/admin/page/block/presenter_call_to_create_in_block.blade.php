<div class="text-center action-in-block">
@foreach(Cachr::getCache('DB_AdminBlockTypes') as $block)
<div class="block-type">
	<a href="{{URL::to('admin/page/block-type/' . $block->name)}}" title="{{{ Lang::get($block->lang . '_add')}}}" data-block-type-name="{{$block->name}}" class="btn btn-default">
		<span class="{{$block->icon}}"></span>
	</a><br>
	<small>{{{Lang::get($block->lang)}}}</small>
</div>
@endforeach
</div>