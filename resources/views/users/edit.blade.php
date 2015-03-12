@extends('layouts.default')


@section('breadcrumb')
<li class=""><a href="{{ URL::to('users') }}">Users</a></li>
<li class="current"><a href="#">Create</a></li>
@stop

@section('content')
<div class="row">
  <div class="small-12 columns">
    <h1>Edit User</h1>
    <p>Make any needed changes to the user data below.</p>
  </div>
</div>

<div class="row">
  <div class="small-12 large-8 columns">

    {!! Form::open([ 'route' => [ 'users.update', $user->id ], 'method' => 'PUT' ]) !!}

    @include('users.form')

    <div class="row">
      <div class="small-12 columns">
        <a href="{{ URL::previous() }}" class="button secondary">Back</a>
        {!! Form::button('Save', [ 'type' => 'submit', 'class' => 'button alert pull-right' ]) !!}
      </div>
    </div>
    {!! Form::close() !!}

  </div>
</div>

@stop
