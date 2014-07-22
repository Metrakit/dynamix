@section('ariane')
@parent
&nbsp;<a href="{{ asset( $object->i18n_url() ) }}">{{ $object->i18n_title() }}</a>
@stop