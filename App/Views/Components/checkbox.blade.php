<div class="form-group">
    <div class="col-sm-offset-3 col-sm-9">
        <div class="checkbox">
            <label for="{{ $field->Field }}">
                <input type="checkbox" value="1" @if($info->readonly) readonly @endif @if($info->required) required @endif
                id="{{ $field->Field }}" @if(isset($queryObj) && $queryObj->{$field->Field} == 1) checked @elseif($tableObj['action'] == 'insert') checked @endif name="{{ $field->Field }}" > {{ $info->display_name }}
            </label>
        </div>
    </div>
</div>