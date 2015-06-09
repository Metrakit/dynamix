<form class="form-horizontal" method="post" action="{{ URL::route('rerouter') }}"  autocomplete="off">
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
        <button type="submit" class="btn btn-primary btn-submit-external"><span class="glyphicon glyphicon-{{$glyphicon}}"></span></button>
        <!-- ./ form actions -->
    </div>
    <div class="clearfix">
    </fieldset>

</form>