@extends('layouts.default')


@section('breadcrumb')
<li class=""><a href="{{ URL::to('cars') }}">Cars</a></li>
<li class="current"><a href="#">{{ $car->display() }}</a></li>
@stop

@section('content')
<div class="row">
  <div class="small-12 columns">
    <img src="//placehold.it/250x250" class="pull-left car-image-main">
    <h1>{{ $car->display() }}</h1>
    <dl>
      <dt>VIN:</dt>
      <dd>{{ $car->vin }}</dd>

      <dt>Mileage:</dt>
      <dd>{{ $car->mileage }}</dd>
    </dl>
    @if( $car->status != CarStatus::ACTIVE )
    <div>
      <span class="label alert">{{ $car->get_status() }}</span>
    </div>
    @endif
    <a href="{{ URL::route('cars.edit', $car->id) }}" class="button tiny secondary">Edit</a>
  </div>
</div>

<div class="row">
  <div class="small-12 large-6 columns">
    <h2>Client Details</h2>
    <dl>
      <dt>Name</dt>
      <dd>{{ $car->client->name }}</dd>

      @if( ! empty($car->client->company_name) )
      <dt>Company</dt>
      <dd>{{ $car->client->company_name }}</dd>
      @endif

      @if( ! empty($car->client->address) )
      <dt>Address</dt>
      <dd>
        <address>
          {{ $car->client->address }}<br/>
          {{ $car->client->city }} {{ $car->client->state }}, {{ $car->client->zip }}
        </address>
      </dd>
      @endif

      <dt>Email</dt>
      <dd>{{ $car->client->email }}</dd>

      <dt>Phone</dt>
      <dd>{{ $car->client->phone_format() }}</dd>

      <dt>Last Updated</dt>
      <dd>{{ $car->client->updated_at->timezone('America/Phoenix')->format('l, F dS, Y h:i A') }}</dd>
    </dl>

    <a href="{{ URL::route('clients.edit', $car->client->id) }}" class="button tiny secondary">Edit</a>
  </div>

  <div class="small-12 large-6 columns">
    <h2>Maintenance Log</h2>
    @if(count($car->maintenance_logs) > 0)
    <ul>
      @foreach($car->maintenance_logs as $log)
      <li><b>{{ $log->action }}</b> <span>{{ $log->created_at->timezone('America/Phoenix')->format('l, F dS, Y h:i A') }}</span></li>
      @endforeach
    </ul>
    @endif
  </div>
</div>
@stop
