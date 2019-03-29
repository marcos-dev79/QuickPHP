<div class="form-group">
    <label for="{{ $field->Field }}" class="col-sm-3 control-label">{{ $info->display_name }}</label>
    <div class="col-sm-9">
        <input type="password" class="form-control {{ $info->class }}" id="{{ $field->Field }}" name="{{ $field->Field }}" placeholder=""
                @if($info->readonly) readonly @endif
                @if($info->required) required @endif >
                <p class="help-block">Leave empty for no changes.</p>
    </div>
</div>