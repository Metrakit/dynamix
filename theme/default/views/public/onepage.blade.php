@extends('theme::public.layout.onepage')


@include('theme::public.includes.meta', array( 'object' => $onepage ))

@include('theme::public.includes.ariane', array( 'object' => $onepage ))


@section('container')
	@include('theme::public.session.session-message')
	@for($i = 0, $parts = $onepage->parts, $parts_count = count($parts->count()) ; $i <= $parts_count ; $i++)
		{{--Select DOM Node (header, footer, section for sémantqiue--}}
		<?php
			$dom_node = 'section';
		?>
		@if($i == 0)
		<?php
			$dom_node = 'header';
		?>
		@elseif($i = $parts_count)
		<?php
			$dom_node = 'footer';
		?>
		@endif
		
		{{-- Select background type --}}
		@if($parts[$i]->background->background_type_id == null || $parts[$i]->background->background_position_id == null) 
			<{{$dom_node}}>
				<div class="container">
		@else
			<?php
				$in_style = $parts[$i]->background->is_image();//boolean
			?>
			<{{$dom_node}} {{$in_style?'style="background: url(\''.$parts[$i]->background->url.'\') '.($parts[$i]->background->is_fixed()?' fixed':'').' no-repeat center center '.$parts[$i]->background->background_color.'; background-size: cover;"':''}}>
				<div class="container">

					{{$in_style?'':'<video autoplay loop class="video'.($parts[$i]->background->is_fixed()?' video-fixed':'').'"><source src="'.URL::to($parts[$i]->background->url).'" type="video/mp4"></video>'}}
		@endif
					{{$parts[$i]->render()}}
				</div>
			</{{$dom_node}}>
	@endfor

@stop




