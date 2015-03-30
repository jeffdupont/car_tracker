

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

<hr>

<div id="daily-options" class="type-option {{ (old('type') == 'daily') ? 'show' : ''}}">
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

  <hr>
</div>

<div id="weekly-options" class="type-option {{ (old('type') == 'weekly') ? 'show' : ''}}">
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

  <hr>
</div>

<div id="monthly-options" class="type-option {{ (old('type') == 'monthly') ? 'show' : ''}}">
  <div class="row">
    <div class="small-12 large-3 columns">
      <label for="day" class="right inline">Day</label>
    </div>
    <div class="small-12 large-9 columns {{ ($errors->first('day')) ? 'error' : '' }}">
      {!! Form::select('day', range(1, 31), old('day') ?: (!empty($scheduled_action) ? $scheduled_action->day : '')) !!}
      @if($errors->first('day'))<small class="error">{{ $errors->first('day') }}</small>@endif
    </div>
  </div>

  <hr>
</div>

<div id="biweekly-options" class="type-option {{ (old('type') == 'biweekly') ? 'show' : ''}}">
  <div class="row">
    <div class="small-12 large-3 columns">
      <label for="start_date" class="right inline">Start From</label>
    </div>
    <div class="small-12 large-9 columns {{ ($errors->first('start_date')) ? 'error' : '' }}">
      {!! Form::text('start_date', old('start_date') ?: (!empty($scheduled_action) ? $scheduled_action->start_date : ''), [ 'placeholder' => \Carbon\Carbon::now()->format('Y-m-d'), 'class' => 'datepicker' ]) !!}
      @if($errors->first('start_date'))<small class="error">{{ $errors->first('start_date') }}</small>@endif
    </div>
  </div>

  <hr>
</div>

@section('script')
@parent
<script>
$(document).ready(function()
{
  $('.type-option').not('.show').hide();

  $(':input[name=type]').on('change', function()
  {
    $('.type-option').hide();
    $('#' + $(this).val() + '-options').show();
  });
});
</script>
@stop
