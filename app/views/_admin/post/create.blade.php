@extends('admin.layout.master')

{{-- Web site Title --}}
@section('title')
{{{ Lang::get('admin/blogs/blog.create_post') }}} |
@parent
@stop

{{-- Ariane --}}
@section('ariane')
@parent
&nbsp;<span class="icon-custom chevron-right"></span>&nbsp;<a href="{{ URL::to('admin/post/create') }}">Création d'article</a>
@stop

{{-- Content --}}
@section('content')
<div class="page-header">
	<h3>{{{Lang::get('admin/blogs/blog.create_post')}}}</h3>
</div>

@if ( Session::get('error') )
<div class="alert alert-danger alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    {{ Session::get('error') }}
</div>
@endif
@if ( Session::get('notice') )
<div class="alert alert-warning alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    {{ Session::get('notice') }}
</div>
@endif
@if ( Session::get('success') )
<div class="alert alert-success alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    {{ Session::get('success') }}
</div>
@endif

<section class="post-create">
{{ Form::open(array('method' => 'POST', 'files' => true, 'id' => 'postForm', 'url' => URL::to('admin/post') , 'class' => 'form-horizontal', 'autocomplete' => 'off' ) ) }}
        <!-- CSRF Token -->
        <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
        <!-- ./ csrf token -->

        @include('admin.post.post-form', array('post', ( !empty($post) ? $post : null ) ) )
        <button type="submit" class="btn btn-primary">Save changes</button>
        <button type="button" id="cancel" class="btn">Cancel</button>
        <!-- ./ form actions -->
    </form>
</section>
@stop

@section('scriptOnReady')
console.log('SummerNooooote');
$('#summernote-content').summernote({
  height: 150   //set editable area's height
});
$('#summernote-footer').summernote();
@stop