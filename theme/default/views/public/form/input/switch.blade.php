    @if($form->type != 'inline')
        <label class="@if($form->type == 'horizontal') col-sm-2 @endif control-label">{{ $input->label }}</label>
    @endif

    @if($form->type == 'horizontal') 
        <div class="col-sm-6"> 
    @endif

    <input type="checkbox" id="{{ $input->name }}" name="{{ $input->name }}" class="input-is_enable cmn-toggle cmn-toggle-round-flat" @if($input->value) checked @endif>
    <label for="{{ $input->name }}" class="label-list" style="margin-top:10px;"></label>

    <div class="clearfix"></div>


@if($form->type != 'inline')
    <p class="help-block"> 
        @if($errors->has($input->name)) 
            {{ $errors->first($input->name) }}
        @else
            @if(isset($input->helper))
                {{ $input->helper }} 
            @endif
        @endif
    </p>
@endif

@if($form->type == 'horizontal' && $input->label) 

    </div> 
    <div class="clearfix"></div>

@endif
