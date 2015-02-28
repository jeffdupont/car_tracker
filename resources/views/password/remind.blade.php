@extends('layouts.default')

@section('content')
<div class="jumbotron clearfix">
  <div class="row">
    <div class="small-12 large-8 large-centered columns">
      <h1>Need to reset your password?</h1>

      {{ $errors->first('validation') }}

      {{ Form::open() }}

      <div class="row">
        <div class="small-12 columns">
          <label {{ ($errors->first('email')) ? 'class="error"' : '' }}>
            {{ Form::text('email', old('email'), [ 'placeholder' => 'joe@example.com' ]) }}
          </label>
          @if($errors->first('email'))<small class="error">{{ $errors->first('email') }}</small>@endif
        </div>
      </div>

      <div class="row">
        <div class="small-12 columns">
          {{ Form::button('Reset', [ 'type' => 'submit', 'class' => 'button alert pull-right' ]) }}
        </div>
      </div>
      {{ Form::close() }}
    </div>
  </div>
</div>
@stop
