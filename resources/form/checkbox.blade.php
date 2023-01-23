<div class="row form-group mt-3">
    <label class="col-sm-3 form-control-label">
        {{ @$attributes['label'] }}
        <span class="text-danger">
            {{ (@$attributes['required'])?'*':'' }}
        </span>
    </label>
    <div class="col-sm-9">
        <label class="ckbox">
            {!! Form::checkbox($name,1,(@$value)?:NULL,$attributes) !!}
            <span>{{ @$attributes['placeholder'] }} </span>
        </label>
        @if(@$errors)
        @foreach($errors->get($name) as $message)
        <span class='help-inline text-danger'>{{ $message }}</span>
        @endforeach
        @endif
    </div>
</div>
