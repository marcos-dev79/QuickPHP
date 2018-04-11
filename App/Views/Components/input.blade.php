<div class="form-group">
    <label for="{{ $field->Field }}" class="col-sm-3 control-label">{{ $info->display_name }}</label>
    <div class="col-sm-9">
        <input type="text" class="form-control @if(isset($info->class)){{ $info->class }}@endif"
               @if(isset($queryObj) && $queryObj->{$field->Field} != '' )
               value="@if($info->class=='datepicker'){{ \Library\Dates\Dates::DateBRsm($queryObj->{$field->Field}) }}@else{{ $queryObj->{$field->Field} }}@endif"
               @else value="" @endif id="{{ $field->Field }}" name="{{ $field->Field }}" placeholder=""
                @if($info->readonly != false) readonly @endif
                @if($info->required) required @endif >
    </div>
</div>