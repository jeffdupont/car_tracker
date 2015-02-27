@extends('layouts.default')


@section('content')
<div class="jumbotron clearfix">
  <div class="row">
    <div class="small-12 large-8 large-centered columns">
      <h1>Set Your New Password</h1>

      {{ $errors->first('validation') }}

      {{ Form::open() }}
      {{ Form::hidden('token', $token) }}

      <div class="row">
        <div class="small-12 large-3 columns">
          <label for="email" class="right inline">Email</label>
        </div>
        <div class="small-12 large-9 columns {{ ($errors->first('email')) ? 'error' : '' }}">
          {{ Form::email('email', Input::old('email'), [ 'placeholder' => 'joe@example.com' ]) }}
          @if($errors->first('email'))<small class="error">{{ $errors->first('email') }}</small>@endif
        </div>
      </div>

      <div class="row">
        <div class="small-12 large-3 columns">
          <label for="password" class="right inline">Password</label>
        </div>
        <div class="small-12 large-9 columns {{ ($errors->first('password')) ? 'error' : '' }}">
          {{ Form::password('password') }}
          @if($errors->first('password'))<small class="error">{{ $errors->first('password') }}</small>@endif
        </div>
      </div>

      <div class="row">
        <div class="small-12 large-3 columns">
          <label for="password_confirmation" class="right inline">Confirm Password</label>
        </div>
        <div class="small-12 large-9 columns {{ ($errors->first('password_confirmation')) ? 'error' : '' }}">
          {{ Form::password('password_confirmation') }}
          @if($errors->first('password_confirmation'))<small class="error">{{ $errors->first('password_confirmation') }}</small>@endif
        </div>
      </div>

      <div class="row">
        <div class="small-12 columns">
          {{ Form::button('Submit', [ 'type' => 'submit', 'class' => 'button alert pull-right' ]) }}
        </div>
      </div>
      {{ Form::close() }}
    </div>
  </div>
</div>
@stop
