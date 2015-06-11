@if(isset($reroute))
<form class="form-horizontal" method="post" action="{{ URL::route('rerouter-update', $reroute->id) }}"  autocomplete="off">
@else
<form class="form-horizontal" method="post" action="{{ URL::route('rerouter-store') }}"  autocomplete="off">
@endif
    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
    <fieldset>
        <!-- url_referer -->
        <div class="col-md-6">
        <div class="form-group {{{ $errors->has('url_referer') ? 'error' : '' }}}">
            <input class="form-control" type="text" name="url_referer" id="url_referer" value="{{{ Input::old('url_referer', (isset($reroute)?$reroute->url_referer:null)) }}}" />
            {{ $errors->first('url_referer', '<div class="alert alert-danger">:message</div>') }}
        </div>
        </div>
        <!-- ./ url_referer -->

        <!-- url_redirect -->
        <div class="col-md-6">
        <div class="form-group {{{ $errors->has('url_redirect') ? 'error' : '' }}} ">
            <input class="form-control" type="text" name="url_redirect" id="url_redirect" value="{{{ Input::old('url_redirect', (isset($reroute)?$reroute->url_redirect:null)) }}}" />
            {{ $errors->first('url_redirect', '<div class="alert alert-danger">:message</div>') }}
        </div>
        </div>
        <!-- ./ url_redirect -->

        <!-- Form Actions -->
        <div class="btn-submit-external">
            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-{{$glyphicon}}"></span></button>
            @if(isset($reroute))
                <a href="{{URL::route('rerouter-delete', $reroute->id)}}" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></a>
            @endif
        </div>
        <!-- ./ form actions -->
    </div>
    <div class="clearfix">
    </fieldset>

</form>