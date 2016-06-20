<input type="hidden" name="MAX_FILE_SIZE" value="300000" />
<div class="form-group">
    <label for="{{ $field->Field }}" class="col-sm-2 control-label">{{ $info->display_name }}</label>
    <div class="col-sm-10">
        <input type="file" class="form-control {{ $info->class }}"
                id="{{ $field->Field }}" name="{{ $field->Field }}" placeholder=""
                @if($info->readonly) readonly @endif
                @if($info->required) required @endif >
        <p class="help-block">{{ $info->upload_msg }}. Máx de 300Kb.</p>
    </div>
</div>