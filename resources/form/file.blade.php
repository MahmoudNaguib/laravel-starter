<div class="row form-group mt-3">
    <label class="col-sm-3 form-control-label">
        {{ @$attributes['label'] }}
        <span class="text-danger">
            {{ (@$attributes['required'])?'*':'' }}
        </span>
    </label>
    <div class="col-sm-9">
        {!! Form::File($name)!!}
        @if(@$errors)
            @foreach($errors->get($name) as $message)
                <span class='help-inline text-danger'>{{ $message }}</span>
            @endforeach
        @endif
        @if(isset($attributes['text']))
            <span class='help-inline'>{{$attributes['text']}}</span>
        @endif
    </div>
</div>





