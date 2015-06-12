<div class="navbar navbar-default navbar-inverse navbar-fixed-top visible-xs" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-top">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">{{ Option::translate('site_name') }}</a>
        </div>
        <div class="navbar-collapse navbar-top collapse">
            <ul class="nav navbar-nav">
                @include('theme::public.nav.nav')
            </ul>
        </div>
    </div>
</div>