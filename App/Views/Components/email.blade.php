<div class="form-group">
    <label for="{{ $field->Field }}" class="col-sm-2 control-label">{{ $info->display_name }}</label>
    <div class="col-sm-10">
        <input type="email" @if(isset($queryObj) && $queryObj->{$field->Field} != '' ) value="{{ $queryObj->{$field->Field} }}" @else value="" @endif
        @if(isset($queryObj) && $queryObj->{$field->Field} == 1) checked @endif
        class="form-control {{ $info->class }}"
               id="{{ $field->Field }}"
               name="{{ $field->Field }}" placeholder=""
                @if($info->readonly) readonly @endif
                @if($info->required) required @endif >
    </div>
</div>