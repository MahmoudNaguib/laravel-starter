<div class="row form-group mt-3">
    <label class="col-sm-3 form-control-label">
        {{ @$attributes['label'] }}
        <span class="text-danger">
            {{ (@$attributes['required'])?'*':'' }}
        </span>
    </label>
    <div class="col-sm-9">
        <div class="custom-file">
            {!! Form::file($name,$attributes)!!}
            @if(!$errors->isEmpty())
                @foreach($errors->get($name) as $message)
                    <span class='help-inline text-danger'>{{ $message }}</span>
                @endforeach
                <br>
            @endif
            @php
                $value=(@$attributes['value'])?:@$row->$name;
            @endphp
            @if(!@$attributes['disable_file_preview'])
                <span class="preview">
                @if(@$attributes['file_type'] == 'attachment')
                        @if($value)
                            {!! fileRender($value) !!}
                        @else

                        @endif
                    @elseif(@$attributes['file_type'] == 'video')
                        @if($value)
                            {!! video($value) !!}
                        @else

                        @endif
                    @else
                        {!! image($value,'small',['width'=>50]) !!}
                    @endif

            </span>
            @endif
        </div>
    </div>
</div>
