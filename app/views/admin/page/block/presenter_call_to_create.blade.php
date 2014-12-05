<p class="text-center">
@foreach(Cachr::getCache('DB_AdminBlockTypes') as $block)
<a href="#" class="btn btn-primary"><span class="{{$block->icon}}"></span> | {{{ Lang::get($block->lang . '_add')}}}</a>
@endforeach
</p>