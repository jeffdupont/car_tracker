@extends('layouts.default')


@section('breadcrumb')
<li class="current"><a href="{{ URL::to('users') }}">Users</a></li>
@stop

@section('content')
<div class="row">
  <div class="small-12 large-8 columns">
    <a href="{{ URL::route('users.create') }}" class="button success pull-right tiny"><i class="fa fa-plus"></i> Add User</a>
    <h1>Users <small>{{ $users->total() }}</small></h1>

    @include('users.list')

    {!! $users->appends([ 'filter' => $filter ])->render() !!}
  </div>
</div>
@stop
