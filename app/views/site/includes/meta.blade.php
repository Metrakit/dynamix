@section('meta_title')
{{ $object->i18n_meta_title() }} | @parent
@stop


@section('meta_description')
{{ $object->i18n_meta_description() }}
@stop