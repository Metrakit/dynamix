<h2>{{{ Lang::get('admin.resource_over') }}}</h2>
<p>{{{ Lang::get('admin.resource_all_allowed') }}}</p>
@foreach(Cachr::getCache('DB_AdminResourceNavigable') as $resource)
<a href="{{URL::to('admin/'. strtolower($resource->model) .'/create')}}" class="btn btn-lg btn-primary"><span class="glyphicon glyphicon-plus"></span> {{{ Lang::get('admin.rsc'.$resource->model) }}}</a>
@endforeach