@extends('admin.layout.master')


@section('meta_title')
Galerie [{{{ $gallery->title }}}] |
@parent
@stop

@section('classBody')
admin-gallery
@endsection

@section('ariane')
@parent
&nbsp;<a href="{{URL::to('admin')}}">{{{ Lang::get('admin/admin.dashboard') }}}</a>&nbsp;
<span class="glyphicon glyphicon-chevron-right"></span>&nbsp;<a href="{{URL::to('admin/gallery')}}">{{{ Lang::get('admin/admin.gallery') }}}</a>
<span class="glyphicon glyphicon-chevron-right"></span>&nbsp;<a href="{{URL::to('admin/gallery/create')}}">Galerie [{{{ $gallery->title }}}]</a>
@if ( Session::get('error') )
<span class="text-danger">
    <span class="glyphicon glyphicon-remove"></span> {{ Session::get('error') }}
</span>
@endif
@if ( Session::get('notice') )
<span class="text-warning">
    <span class="glyphicon glyphicon-info"></span> {{ Session::get('notice') }}
</span>
@endif
@if ( Session::get('success') )
<span class="text-success">
    <span class="glyphicon glyphicon-ok"></span> {{ Session::get('success') }}
</span>
@endif
@stop


@section('scriptOnReady')
    $( '#cbp-fwslider' ).cbpFWSlider();

    $('.admin-gallery .iframe-btn').fancybox({
        width   : 880,
        height  : '750px',
        type    : 'iframe',
        autoScale   : false
    });
@stop

@section('beforeWrapper')
<div class="loading"></div>
@stop

@section('content')
    <div class="imageloading"><p><span>Chargement de la galerie...</span></p></div>

    <div id="form-cbp-fwaddbefore" class="hidden">
        {{ Form::open(array('url' => 'admin/gallery/add-image', 'id' => 'form-cdp-before', 'method' => 'POST')) }}
            {{ Form::hidden('where', 'before' )}}
            {{ Form::hidden('gallery_id', $gallery->id )}}
            <input type="hidden" id="url_image_before" name="url_image" onChange="this.parentNode.submit()">
            <a href="{{asset('/filemanager/dialog.php?type=1&amp;field_id=url_image_before')}}" class="cbp-fwaddbefore btn btn-lg btn-default btn-rounded iframe-btn" ><i class="glyphicon glyphicon-plus"></i></a>
        {{ Form::close() }}
    </div>
    <div id="form-cbp-fwaddafter" class="hidden">
        {{ Form::open(array('url' => 'admin/gallery/add-image', 'id' => 'form-cdp-after', 'method' => 'POST')) }}
            {{ Form::hidden('where', 'after' )}}
            {{ Form::hidden('gallery_id', $gallery->id )}}
            <input type="hidden" id="url_image_after" name="url_image" onChange="this.parentNode.submit()">
            <a href="{{asset('/filemanager/dialog.php?type=1&amp;field_id=url_image_after')}}" class="cbp-fwaddafter btn btn-lg btn-default btn-rounded iframe-btn"><i class="glyphicon glyphicon-plus"></i></a>
        {{ Form::close() }}
    </div>

    <div id="form-cbp-fwmoveright" class="hidden">
        {{ Form::open(array('url' => 'admin/gallery/' . $gallery->id . '/move')) }}
            {{ Form::hidden('direction', 'right' ) }}
            {{ Form::hidden('gallery_id', $gallery->id )}}
            <button type="submit"><span class="glyphicon glyphicon-chevron-right"></span></button>
        {{ Form::close() }}
    </div>

    <div id="form-cbp-fwmoveleft" class="hidden">
        {{ Form::open(array('url' => 'admin/gallery/' . $gallery->id . '/move')) }}
            {{ Form::hidden('direction', 'left' ) }}
            {{ Form::hidden('gallery_id', $gallery->id )}}
            <button type="submit"><span class="glyphicon glyphicon-chevron-left"></span></button>
        {{ Form::close() }}
    </div>

    <div id="form-cbp-fwbuttons" class="hidden">
        <div class="buttons">
            {{ Form::open(array('url' => 'admin/gallery/' . $gallery->id, 'class' => 'pull-right')) }}
                {{ Form::hidden('_method', 'DELETE') }}
                {{ Form::hidden('gallery_id', $gallery->id )}}
                <button type="submit" class="btn btn-danger btn-xs remove"><span class="glyphicon glyphicon-remove"></span></button>
            {{ Form::close() }}
            <div class="clearfix"></div>
        </div>
    </div>

    <div id="baseURL" class="hidden">{{asset('')}}</div>

    <div id="cbp-fwslider" class="cbp-fwslider">
    	<div class="cbp-fwslider-info">
	    	<h3>{{$gallery->title}}</h3>
	    	<p>
	    		{{$gallery->description}}
	    		<br class="hidden-sm hidden-xs"><br class="hidden-sm hidden-xs"><span class="link hidden-sm hidden-xs"><a href="{{URL::to('/')}}">Accueil</a>&nbsp;>&nbsp;<a href="{{URL::to($gallery->mosaique->url)}}">Galerie {{$gallery->mosaique->title}}</a></span>
	    	</p>
    	</div>
        <ul>
        @foreach($images as $image)
            <li data-thumb="{{ $image->getThumb() }}"><a href="#"><img u="image" src="{{$image->getImage() }}" /></a></li>
        @endforeach
        </ul>
    </div>
@stop