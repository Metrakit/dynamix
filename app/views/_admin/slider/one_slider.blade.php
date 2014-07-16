@if(!empty($slider->href))
<a href="{{ $slider->href }}">
@endif

<div class="slide-with-description">
@if(!empty($slider->title))
    <div class="slide-title">
        {{ $slider->title }}
    </div>
@endif
@if(!empty($slider->description))
    <div class="slide-description">
        {{ $slider->description }}
    </div>
@endif

    <img src="{{ asset( $slider->img ) }}" width="100%" alt="{{ $slider->img_alt }}"/>

@if(!empty($slider->description))
</div>
@endif

@if(!empty($slider->href))
</a>
@endif