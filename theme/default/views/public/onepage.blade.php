@extends('theme::public.layout.onepage')


@include('theme::public.includes.meta', array( 'object' => $onepage ))

@include('theme::public.includes.ariane', array( 'object' => $onepage ))


@section('container')
	@include('theme::public.session.session-message')
	<?php
		$parts = $onepage->parts()->get();
		$parts_count = count($parts->toArray())-1;
	?>

	@foreach($parts as $key => $part)
		{{--Select DOM Node (header, footer, section for sémantqiue--}}
		<?php
			$dom_node = 'section';
			if($key == 0) {
				$dom_node = 'header';
			} else if ($key == $parts_count) {
				$dom_node = 'footer';
			}
		?>
		
		{{-- Select background type --}}
		
		@if(gettype($part->background) != 'object' || ($part->background->background_type_id == null || $part->background->background_position_id == null)) 
			<{{$dom_node}}>
				<div class="container">
		@else
			<?php
				$in_style = $part->background->is_image();//boolean
			?>
			<{{$dom_node}} {{$in_style?'style="background: url(\''.$part->background->url.'\') '.($part->background->is_fixed()?' fixed':'').' no-repeat center center '.$part->background->background_color.'; background-size: cover;"':''}}>
				<div class="container">

					{{$in_style?'':'<video autoplay loop class="background-video'.($part->background->is_fixed()?' background-video-fixed':'').'"><source src="'.URL::to($part->background->url).'" type="video/mp4"></video>'}}
		@endif
					{{$part->render()}}
				</div>
			</{{$dom_node}}>
	@endforeach



	

@stop




