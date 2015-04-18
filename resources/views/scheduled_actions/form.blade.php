

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
      ''          => 'Choose Type',
      'daily'     => 'Daily',
      'weekly'    => 'Weekly',
      'biweekly'  => 'Bi-weekly',
      'monthly'   => 'Monthly',
      'quarterly' => 'Quarterly',
      'yearly'    => 'Yearly'
    ], old('type') ?: (!empty($scheduled_action) ? $scheduled_action->type : '')) !!}
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
          {!! Form::radio('repeat', 'week_day', old('repeat') ?: (!empty($scheduled_action) ? ($scheduled_action->repeat == 'week_day') : false), [ 'id' => 'repeat-week_day' ]) !!}
          <label for="repeat-week_day">Weekdays</label>
        </div>
      </label>
      @if($errors->first('repeat'))<small class="error">{{ $errors->first('repeat') }}</small>@endif
    </div>
    <div class="small-12 large-2 columns {{ ($errors->first('repeat')) ? 'error' : '' }} end">
      <label for="repeat-every_day">
        <div>Everyday</div>
        <div class="switch">
          {!! Form::radio('repeat', 'every_day', old('repeat') ?: (!empty($scheduled_action) ? ($scheduled_action->repeat == 'every_day') : false), [ 'id' => 'repeat-every_day' ]) !!}
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
      @include('scheduled_actions.weekdays', [ 'type' => 'weekly' ])
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
      {!! Form::text('start_date', old('start_date') ?: (!empty($scheduled_action) ? $scheduled_action->start_date : ''), [ 'placeholder' => \Carbon\Carbon::now()->timezone('America/Phoenix')->format('Y-m-d'), 'class' => 'datepicker' ]) !!}
      @if($errors->first('start_date'))<small class="error">{{ $errors->first('start_date') }}</small>@endif
    </div>
  </div>
  <div class="row">
    <div class="small-12 large-3 columns">
      <label for="" class="right inline">Repeat On</label>
    </div>
    <div class="small-12 large-9 columns">
      @include('scheduled_actions.weekdays', [ 'type' => 'biweekly' ])
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
      {!! Form::select('day', array_combine(range(1, 31), range(1, 31)), old('day') ?: (!empty($scheduled_action) ? implode(',', $scheduled_action->day) : '')) !!}
      @if($errors->first('day'))<small class="error">{{ $errors->first('day') }}</small>@endif
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
      {!! Form::text('start_date', old('start_date') ?: (!empty($scheduled_action) ? $scheduled_action->start_date : ''), [ 'placeholder' => \Carbon\Carbon::now()->timezone('America/Phoenix')->format('Y-m-d'), 'class' => 'datepicker' ]) !!}
      @if($errors->first('start_date'))<small class="error">{{ $errors->first('start_date') }}</small>@endif
    </div>
  </div>
  <div class="row">
    <div class="small-12 large-3 columns">
      <label for="day" class="right inline">Day</label>
    </div>
    <div class="small-12 large-9 columns {{ ($errors->first('day')) ? 'error' : '' }}">
      {!! Form::select('day', array_combine(range(1, 31), range(1, 31)), old('day') ?: (!empty($scheduled_action) ? implode(',', $scheduled_action->day) : '')) !!}
      @if($errors->first('day'))<small class="error">{{ $errors->first('day') }}</small>@endif
    </div>
  </div>
</div>

<div id="yearly-options" class="type-option {{ (old('type') == 'yearly') ? 'show' : ''}}">
  <h5>Yearly Options</h5>
  <div class="row">
    <div class="small-12 large-3 columns">
      <label for="start_date" class="right inline">Repeat On</label>
    </div>
    <div class="small-12 large-9 columns {{ ($errors->first('start_date')) ? 'error' : '' }}">
      {!! Form::text('start_date', old('start_date') ?: (!empty($scheduled_action) ? $scheduled_action->start_date : ''), [ 'placeholder' => \Carbon\Carbon::now()->timezone('America/Phoenix')->format('Y-m-d'), 'class' => 'datepicker' ]) !!}
      @if($errors->first('start_date'))<small class="error">{{ $errors->first('start_date') }}</small>@endif
    </div>
  </div>
</div>

<h5>Additional Information</h5>
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

  // initialize properties
  init_options();

  // show the section from back button
  if ( $(':input[name=type]').val() !== '' ) {
    show_options($(':input[name=type]').val());
  }

  // handle dropdown type
  $(':input[name=type]').on('change', function()
  {
    init_options();
    show_options($(this).val());
  });

});

function init_options()
{
  $('.type-option').hide();
  $('.type-option :input').attr('disabled', 'disabled');
}

function show_options( section )
{
  $('#' + section + '-options').show();
  $('#' + section + '-options :input').removeAttr('disabled');
}
</script>
@stop
