
<ul class="small-block-grid-4 large-block-grid-7">
  <!-- Monday -->
  <li>
    <label for="repeat-monday">
      <div>Mon</div>
      <div class="switch">
        {!! Form::checkbox('repeat_days[]', 'monday', old('repeat_days[]') ?: (!empty($scheduled_action) ? in_array('monday', $scheduled_action->repeat_days) : ''), [ 'id' => 'repeat-monday' ]) !!}
        <label for="repeat-monday"></label>
      </div>
    </label>
    @if($errors->first('repeat_days[]'))<small class="error">{{ $errors->first('repeat_days[]') }}</small>@endif
  </li>
  <!-- Tuesday -->
  <li>
    <label for="repeat-tuesday">
      <div>Tue</div>
      <div class="switch">
        {!! Form::checkbox('repeat_days[]', 'tuesday', old('repeat_days[]') ?: (!empty($scheduled_action) ? in_array('tuesday', $scheduled_action->repeat_days) : ''), [ 'id' => 'repeat-tuesday' ]) !!}
        <label for="repeat-tuesday"></label>
      </div>
    </label>
    @if($errors->first('repeat_days[]'))<small class="error">{{ $errors->first('repeat_days[]') }}</small>@endif
  </li>
  <!-- Wednesday -->
  <li>
    <label for="repeat-wednesday">
      <div>Wed</div>
      <div class="switch">
        {!! Form::checkbox('repeat_days[]', 'wednesday', old('repeat_days[]') ?: (!empty($scheduled_action) ? in_array('wednesday', $scheduled_action->repeat_days) : ''), [ 'id' => 'repeat-wednesday' ]) !!}
        <label for="repeat-wednesday"></label>
      </div>
    </label>
    @if($errors->first('repeat_days[]'))<small class="error">{{ $errors->first('repeat_days[]') }}</small>@endif
  </li>
  <!-- Thursday -->
  <li>
    <label for="repeat-thursday">
      <div>Thu</div>
      <div class="switch">
        {!! Form::checkbox('repeat_days[]', 'thursday', old('repeat_days[]') ?: (!empty($scheduled_action) ? in_array('thursday', $scheduled_action->repeat_days) : ''), [ 'id' => 'repeat-thursday' ]) !!}
        <label for="repeat-thursday"></label>
      </div>
    </label>
    @if($errors->first('repeat_days[]'))<small class="error">{{ $errors->first('repeat_days[]') }}</small>@endif
  </li>
  <!-- Friday -->
  <li>
    <label for="repeat-friday">
      <div>Fri</div>
      <div class="switch">
        {!! Form::checkbox('repeat_days[]', 'friday', old('repeat_days[]') ?: (!empty($scheduled_action) ? in_array('friday', $scheduled_action->repeat_days) : ''), [ 'id' => 'repeat-friday' ]) !!}
        <label for="repeat-friday"></label>
      </div>
    </label>
    @if($errors->first('repeat_days[]'))<small class="error">{{ $errors->first('repeat_days[]') }}</small>@endif
  </li>
  <!-- Saturday -->
  <li>
    <label for="repeat-saturday">
      <div>Sat</div>
      <div class="switch">
        {!! Form::checkbox('repeat_days[]', 'saturday', old('repeat_days[]') ?: (!empty($scheduled_action) ? in_array('saturday', $scheduled_action->repeat_days) : ''), [ 'id' => 'repeat-saturday' ]) !!}
        <label for="repeat-saturday"></label>
      </div>
    </label>
    @if($errors->first('repeat_days[]'))<small class="error">{{ $errors->first('repeat_days[]') }}</small>@endif
  </li>
  <!-- Sunday -->
  <li>
    <label for="repeat-sunday">
      <div>Sun</div>
      <div class="switch">
        {!! Form::checkbox('repeat_days[]', 'sunday', old('repeat_days[]') ?: (!empty($scheduled_action) ? in_array('sunday', $scheduled_action->repeat_days) : ''), [ 'id' => 'repeat-sunday' ]) !!}
        <label for="repeat-sunday"></label>
      </div>
    </label>
    @if($errors->first('repeat_days[]'))<small class="error">{{ $errors->first('repeat_days[]') }}</small>@endif
  </li>
</ul>
