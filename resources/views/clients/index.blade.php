@extends('layouts.default')


@section('breadcrumb')
<li class="current"><a href="{{ URL::to('clients') }}">Clients</a></li>
@stop

@section('content')
<div class="row">
  <div class="small-12 large-8 columns">
    <a href="{{ URL::route('clients.create') }}" class="button success pull-right tiny"><i class="fa fa-plus"></i> Add Client</a>
    <h1>Clients <small>{{ $clients->total() }}</small></h1>

    @include('clients.list')

    {!! $clients->appends([ 'filter' => $filter ])->render() !!}
  </div>
</div>
@stop
