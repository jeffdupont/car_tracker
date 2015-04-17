@extends('layouts.default')


@section('breadcrumb')
<li class=""><a href="{{ URL::to('users') }}">Users</a></li>
<li class="current"><a href="#">{{ $user->name }}</a></li>
@stop

@section('content')
<div class="row">
  <div class="small-12 columns">
    <h1>{{ $user->name }}</h1>
  </div>
</div>

<div class="row">
  <div class="small-12 large-4 columns">
    <h2>User Details</h2>
    <dl>
      <dt>Name</dt>
      <dd>{{ $user->name }}</dd>

      <dt>Email</dt>
      <dd>{{ $user->email }}</dd>

      <dt>Is Admin</dt>
      <dd>{!! $user->is_admin ? '<span class="label success">true</span>' : '<span class="label warning">false</span>' !!}</dd>

      <dt>Active</dt>
      <dd>{!! $user->status ? '<span class="label success">true</span>' : '<span class="label warning">false</span>' !!}</dd>

      <dt>Send Email Notifications</dt>
      <dd>{!! $user->is_notified ? '<span class="label success">true</span>' : '<span class="label warning">false</span>' !!}</dd>

      <dt>Last Updated</dt>
      <dd>{{ $user->updated_at->timezone('America/Phoenix')->format('l, F dS, Y h:i A') }}</dd>
    </dl>

    <a href="{{ URL::route('users.edit', $user->id) }}" class="button tiny secondary">Edit</a>
  </div>

  <div class="small-12 large-8 columns">
    <h2>Activity</h2>

  </div>
</div>
@stop
