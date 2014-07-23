@section('meta_title')
{{ $object->meta_title() }} | @parent
@stop


@section('meta_description')
{{ $object->meta_description() }}
@stop