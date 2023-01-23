<div class="row form-group mt-3">
    <label class="col-sm-3">
        <b>{{ @$attributes['label'] }}</b>
    </label>
    <div class="col-sm-9">
        @if(isset($attributes['type']))
            @if(@$attributes['type'] == 'image' )
                {!! image(@$attributes['value'],'small') !!}
            @else
               {!! file(@$attributes['value']) !!}
            @endif
        @else
        {{@$attributes['value']}}
        @endif
    </div>
</div>
