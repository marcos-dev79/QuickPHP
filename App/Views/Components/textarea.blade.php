<div class="form-group">
    <label for="{{ $field->Field }}" class="col-sm-2 control-label">{{ $info->display_name }}</label>
    <div class="col-sm-10">
      <textarea class="form-control {{ $info->class }}" id="{{ $field->Field }}" name="{{ $field->Field }}" placeholder=""
                @if($info->readonly) readonly @endif
                @if($info->required) required @endif >@if(isset($queryObj) && $queryObj->{$field->Field} != '' ){{ $queryObj->{$field->Field} }}@endif</textarea>
    </div>
</div>