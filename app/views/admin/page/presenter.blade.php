
<div class="panel panel-info panel-page">
  <div class="panel-heading text-center">
      @if(isset($showButton))
      <div class="buttons">
        {{ Form::open(array('url' => 'admin/page/' . $page->id, 'class' => 'inlineImportant' )) }}
            {{ Form::hidden('_method', 'DELETE') }}
            <div class="btn-group">
            <a href="{{ URL::to('admin/page/' . $page->id . '/edit') }}" class="btn btn-transparent" title="Modifier la page">
                <span class="glyphicon glyphicon-pencil"></span>
            </a>
        @if($page->isDeletable())
            <button type="submit" class="btn btn-transparent remove"><span class="glyphicon glyphicon-trash"></span></button>
        @endif
            </div>
        {{ Form::close() }}
      </div>
      @endif
    <i class="fa fa-file-text-o"></i>
    <span class="help-block">{{ URL::to($page->url() ) }}</span>
  </div>
  <div class="panel-body">
    <h3>{{ $page->title() }}</h3>
    {{ $page->meta_description() }}
  </div>
</div>
