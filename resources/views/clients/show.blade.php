@extends('layouts.default')


@section('breadcrumb')
<li class=""><a href="{{ URL::to('clients') }}">Clients</a></li>
<li class="current"><a href="#">{{ $client->name }}</a></li>
@stop

@section('content')
<div class="row">
  <div class="small-12 columns">
    <h1>{{ $client->name }}</h1>
  </div>
</div>

<div class="row">
  <div class="small-12 large-4 columns">
    <h2>Client Details</h2>
    <dl>
      <dt>Name</dt>
      <dd>{{ $client->name }}</dd>

      @if( ! empty($client->company_name) )
      <dt>Company</dt>
      <dd>{{ $client->company_name }}</dd>
      @endif

      @if( ! empty($client->address) )
      <dt>Address</dt>
      <dd>
        <address>
          {{ $client->address }}<br/>
          {{ $client->city }} {{ $client->state }}, {{ $client->zip }}
        </address>
      </dd>
      @endif

      <dt>Email</dt>
      <dd>{{ $client->email }}</dd>

      <dt>Phone</dt>
      <dd>{{ $client->phone_format() }}</dd>

      <dt>Last Updated</dt>
      <dd>{{ $client->updated_at->timezone('America/Phoenix')->format('l, F dS, Y h:i A') }}</dd>
    </dl>

    <a href="{{ URL::route('clients.edit', $client->id) }}" class="button tiny secondary">Edit</a>
  </div>

  <div class="small-12 large-8 columns">
    <a href="{{ URL::route('cars.create') }}?client_id={{ $client->id }}" class="button success pull-right tiny"><i class="fa fa-plus"></i> Add Car</a>
    <h2>Cars</h2>
    @include('cars.list', [ 'cars' => $client->cars ])
  </div>
</div>
@stop
