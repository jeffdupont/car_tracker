@extends('layouts.default')


@section('content')
<div class="jumbotron clearfix">
  <div class="row">
    <div class="small-12 large-8 large-centered columns">
      <h1>Login</h1>

      {!! Form::open([ 'route' => 'session.store' ]) !!}

      <div class="row">
        <div class="small-12 columns">
          <label {{ ($errors->first('email')) ? 'class="error"' : '' }}>
            {!! Form::text('email', Input::old('email'), [ 'placeholder' => 'joe@example.com' ]) !!}
          </label>
          @if($errors->first('email'))<small class="error">{{ $errors->first('email') }}</small>@endif
        </div>
      </div>

      <div class="row">
        <div class="small-12 columns">
          <label {{ ($errors->first('password')) ? 'class="error"' : '' }}>
            {!! Form::password('password', [ 'placeholder' => 'Password' ]) !!}
          </label>
          @if($errors->first('password'))<small class="error">{{ $errors->first('password') }}</small>@endif
        </div>
      </div>

      <a href="{{ URL::to('password/remind') }}" class="pull-left">Forgot Password?</a>

      <div class="row">
        <div class="small-12 columns">
          {!! Form::button('Login', [ 'type' => 'submit', 'class' => 'button alert pull-right' ]) !!}
        </div>
      </div>
      {!! Form::close() !!}

    </div>
  </div>
</div>
@stop
