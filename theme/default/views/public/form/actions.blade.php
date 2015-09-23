<!-- EN COURS DE DEV - #DOMALARRACHEFORTHEMOMENT -->

<span class="pull-right">
	@if($input->order > 1)
		<a href="{{ URL::route('move-input', array($form->id, $input->id, 'up')) }}"><i class="glyphicon glyphicon-chevron-up"></i></a>
	 @endif
	<br />
	@if(!$input->isLast)
		<a href="{{ URL::route('move-input', array($form->id, $input->id, 'down')) }}"><i class="glyphicon glyphicon-chevron-down"></i></a>
	@endif
</span>