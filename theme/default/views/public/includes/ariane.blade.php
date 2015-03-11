@section('ariane')
@parent
&nbsp;<a href="{{ asset( $object->url() ) }}">{{ $object->title() }}</a>
@stop