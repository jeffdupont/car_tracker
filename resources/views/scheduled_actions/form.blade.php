

<h5>Select Schedule Type</h5>
<div class="row">
  <div class="small-12 large-3 columns">
    <label for="action" class="right inline">Action</label>
  </div>
  <div class="small-12 large-9 columns {{ ($errors->first('action')) ? 'error' : '' }}">
    {!! Form::text('action', old('action') ?: (!empty($scheduled_action) ? $scheduled_action->action : ''), [ 'placeholder' => 'Start Car' ]) !!}
    @if($errors->first('action'))<small class="error">{{ $errors->first('action') }}</small>@endif
  </div>
</div>

<div class="row">
  <div class="small-12 large-3 columns">
    <label for="type" class="right inline">Type</label>
  </div>
  <div class="small-12 large-9 columns {{ ($errors->first('type')) ? 'error' : '' }}">
    {!! Form::select('type', [
      '' => 'Choose Type',
      'daily' => 'Daily',
      'weekly' => 'Weekly',
      'biweekly' => 'Bi-weekly',
      'monthly' => 'Monthly',
      'quarterly' => 'Quarterly',
      'yearly' => 'Yearly' ], old('type') ?: (!empty($scheduled_action) ? $scheduled_action->type : '')) !!}
    @if($errors->first('type'))<small class="error">{{ $errors->first('type') }}</small>@endif
  </div>
</div>


<div id="daily-options" class="type-option {{ (old('type') == 'daily') ? 'show' : ''}}">
  <h5>Daily Options</h5>
  <div class="row">
    <div class="small-12 large-3 columns">
      <label for="" class="right inline">Repeat On</label>
    </div>
    <div class="small-12 large-2 columns {{ ($errors->first('repeat')) ? 'error' : '' }} ">
      <label for="repeat-week_day">
        <div>Weekdays</div>
        <div class="switch">
          {!! Form::radio('repeat', 'week_day', old('repeat') ?: (!empty($scheduled_action) ? $scheduled_action->repeat : ''), [ 'id' => 'repeat-week_day' ]) !!}
          <label for="repeat-week_day">Weekdays</label>
        </div>
      </label>
      @if($errors->first('repeat'))<small class="error">{{ $errors->first('repeat') }}</small>@endif
    </div>
    <div class="small-12 large-2 columns {{ ($errors->first('repeat')) ? 'error' : '' }} end">
      <label for="repeat-every_day">
        <div>Everyday</div>
        <div class="switch">
          {!! Form::radio('repeat', 'every_day', old('repeat') ?: (!empty($scheduled_action) ? $scheduled_action->repeat : ''), [ 'id' => 'repeat-every_day' ]) !!}
          <label for="repeat-every_day">Everyday</label>
        </div>
      </label>
      @if($errors->first('repeat'))<small class="error">{{ $errors->first('repeat') }}</small>@endif
    </div>
  </div>
</div>

<div id="weekly-options" class="type-option {{ (old('type') == 'weekly') ? 'show' : ''}}">
  <h5>Weekly Options</h5>
  <div class="row">
    <div class="small-12 large-3 columns">
      <label for="" class="right inline">Repeat On</label>
    </div>
    <div class="small-12 large-9 columns">
      <ul class="small-block-grid-4 large-block-grid-7">
        <!-- Monday -->
        <li>
          <label for="repeat-monday">
            <div>Mon</div>
            <div class="switch">
              {!! Form::checkbox('repeat[]', 'monday', old('repeat[]') ?: (!empty($scheduled_action) ? $scheduled_action->repeat : ''), [ 'id' => 'repeat-monday' ]) !!}
              <label for="repeat-monday"></label>
            </div>
          </label>
          @if($errors->first('repeat'))<small class="error">{{ $errors->first('repeat') }}</small>@endif
        </li>
        <!-- Tuesday -->
        <li>
          <label for="repeat-tuesday">
            <div>Tue</div>
            <div class="switch">
              {!! Form::checkbox('repeat[]', 'tuesday', old('repeat[]') ?: (!empty($scheduled_action) ? $scheduled_action->repeat : ''), [ 'id' => 'repeat-tuesday' ]) !!}
              <label for="repeat-tuesday"></label>
            </div>
          </label>
          @if($errors->first('repeat'))<small class="error">{{ $errors->first('repeat') }}</small>@endif
        </li>
        <!-- Wednesday -->
        <li>
          <label for="repeat-wednesday">
            <div>Wed</div>
            <div class="switch">
              {!! Form::checkbox('repeat[]', 'wednesday', old('repeat[]') ?: (!empty($scheduled_action) ? $scheduled_action->repeat : ''), [ 'id' => 'repeat-wednesday' ]) !!}
              <label for="repeat-wednesday"></label>
            </div>
          </label>
          @if($errors->first('repeat'))<small class="error">{{ $errors->first('repeat') }}</small>@endif
        </li>
        <!-- Thursday -->
        <li>
          <label for="repeat-thursday">
            <div>Thu</div>
            <div class="switch">
              {!! Form::checkbox('repeat[]', 'thursday', old('repeat[]') ?: (!empty($scheduled_action) ? $scheduled_action->repeat : ''), [ 'id' => 'repeat-thursday' ]) !!}
              <label for="repeat-thursday"></label>
            </div>
          </label>
          @if($errors->first('repeat'))<small class="error">{{ $errors->first('repeat') }}</small>@endif
        </li>
        <!-- Friday -->
        <li>
          <label for="repeat-friday">
            <div>Fri</div>
            <div class="switch">
              {!! Form::checkbox('repeat[]', 'friday', old('repeat[]') ?: (!empty($scheduled_action) ? $scheduled_action->repeat : ''), [ 'id' => 'repeat-friday' ]) !!}
              <label for="repeat-friday"></label>
            </div>
          </label>
          @if($errors->first('repeat'))<small class="error">{{ $errors->first('repeat') }}</small>@endif
        </li>
        <!-- Saturday -->
        <li>
          <label for="repeat-saturday">
            <div>Sat</div>
            <div class="switch">
              {!! Form::checkbox('repeat[]', 'saturday', old('repeat[]') ?: (!empty($scheduled_action) ? $scheduled_action->repeat : ''), [ 'id' => 'repeat-saturday' ]) !!}
              <label for="repeat-saturday"></label>
            </div>
          </label>
          @if($errors->first('repeat'))<small class="error">{{ $errors->first('repeat') }}</small>@endif
        </li>
        <!-- Sunday -->
        <li>
          <label for="repeat-sunday">
            <div>Sun</div>
            <div class="switch">
              {!! Form::checkbox('repeat[]', 'sunday', old('repeat[]') ?: (!empty($scheduled_action) ? $scheduled_action->repeat : ''), [ 'id' => 'repeat-sunday' ]) !!}
              <label for="repeat-sunday"></label>
            </div>
          </label>
          @if($errors->first('repeat'))<small class="error">{{ $errors->first('repeat') }}</small>@endif
        </li>
      </ul>
    </div>
  </div>
</div>

<div id="monthly-options" class="type-option {{ (old('type') == 'monthly') ? 'show' : ''}}">
  <h5>Monthly Options</h5>
  <div class="row">
    <div class="small-12 large-3 columns">
      <label for="day" class="right inline">Day</label>
    </div>
    <div class="small-12 large-9 columns {{ ($errors->first('day')) ? 'error' : '' }}">
      {!! Form::select('day', array_combine(range(1, 31), range(1, 31)), old('day') ?: (!empty($scheduled_action) ? $scheduled_action->day : '')) !!}
      @if($errors->first('day'))<small class="error">{{ $errors->first('day') }}</small>@endif
    </div>
  </div>
</div>

<div id="biweekly-options" class="type-option {{ (old('type') == 'biweekly') ? 'show' : ''}}">
  <h5>Bi-weekly Options</h5>
  <div class="row">
    <div class="small-12 large-3 columns">
      <label for="start_date" class="right inline">Start From</label>
    </div>
    <div class="small-12 large-9 columns {{ ($errors->first('start_date')) ? 'error' : '' }}">
      {!! Form::text('start_date', old('start_date') ?: (!empty($scheduled_action) ? $scheduled_action->start_date : ''), [ 'placeholder' => \Carbon\Carbon::now()->format('Y-m-d'), 'class' => 'datepicker' ]) !!}
      @if($errors->first('start_date'))<small class="error">{{ $errors->first('start_date') }}</small>@endif
    </div>
  </div>
</div>

<div id="quarterly-options" class="type-option {{ (old('type') == 'quarterly') ? 'show' : ''}}">
  <h5>Quarterly Options</h5>
  <div class="row">
    <div class="small-12 large-3 columns">
      <label for="start_date" class="right inline">Start From</label>
    </div>
    <div class="small-12 large-9 columns {{ ($errors->first('start_date')) ? 'error' : '' }}">
      {!! Form::text('start_date', old('start_date') ?: (!empty($scheduled_action) ? $scheduled_action->start_date : ''), [ 'placeholder' => \Carbon\Carbon::now()->format('Y-m-d'), 'class' => 'datepicker' ]) !!}
      @if($errors->first('start_date'))<small class="error">{{ $errors->first('start_date') }}</small>@endif
    </div>
  </div>
</div>

<div id="yearly-options" class="type-option {{ (old('type') == 'yearly') ? 'show' : ''}}">
  <h5>Yearly Options</h5>
  <div class="row">
    <div class="small-12 large-3 columns">
      <label for="start_date" class="right inline">Start From</label>
    </div>
    <div class="small-12 large-9 columns {{ ($errors->first('start_date')) ? 'error' : '' }}">
      {!! Form::text('start_date', old('start_date') ?: (!empty($scheduled_action) ? $scheduled_action->start_date : ''), [ 'placeholder' => \Carbon\Carbon::now()->format('Y-m-d'), 'class' => 'datepicker' ]) !!}
      @if($errors->first('start_date'))<small class="error">{{ $errors->first('start_date') }}</small>@endif
    </div>
  </div>
</div>

<h5>Mileage</h5>
<div class="row">
  <div class="small-12 large-3 columns">
    <label for="details" class="right inline">Details</label>
  </div>
  <div class="small-12 large-9 columns {{ ($errors->first('details')) ? 'error' : '' }}">
    {!! Form::textarea('details', old('details') ?: (!empty($scheduled_action) ? $scheduled_action->details : ''), [ 'placeholder' => 'Additional information' ]) !!}
    @if($errors->first('details'))<small class="error">{{ $errors->first('details') }}</small>@endif
  </div>
</div>

<hr/>

{!! Form::hidden('timezone') !!}

@section('script')
@parent
<script src="/dist/jstimezone/jstz.min.js"></script>
<script>
$(document).ready(function()
{
  var timezone = jstz.determine();
  $(':input[name=timezone]').val(timezone.name());

  $('.type-option').hide();

  if ( $(':input[name=type]').val() !== '' ) {
    $('#' + $(':input[name=type]').val() + '-options').show();
  }

  $(':input[name=type]').on('change', function()
  {
    $('.type-option').hide();
    $('#' + $(this).val() + '-options').show();
  });

});
</script>
@stop
