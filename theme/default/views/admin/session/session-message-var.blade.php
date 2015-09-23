@if ( Session::get('error_'.$var) )
<div class="alert alert-danger alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    {{ Session::get('error_'.$var) }}
</div>
@endif
@if ( Session::get('notice_'.$var) )
<div class="alert alert-warning alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    {{ Session::get('notice_'.$var) }}
</div>
@endif
@if ( Session::get('success_'.$var) )
<div class="alert alert-success alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    {{ Session::get('success_'.$var) }}
</div>
@endif