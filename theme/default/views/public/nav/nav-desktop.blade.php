<div class="navbar navbar-default navbar-inverse hidden-xs" role="navigation">
    <div class="container-fluid">
        <div class="navbar-collapse navbar-top collapse">
            <ul class="nav navbar-nav">
                @include('theme::public.nav.nav')
            </ul>
            @if(Auth::check())
            <ul class="nav navbar-nav navbar-right">
                <li><a href="{{URL::to('admin')}}">Tableau de bord</a></li>
            </ul>
            @endif
        </div>
    </div>
</div>