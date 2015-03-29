@extends('layouts.default')


@section('breadcrumb')
<li class=""><a href="{{ URL::to('cars') }}">Cars</a></li>
<li class="current"><a href="#">{{ $car->display }}</a></li>
@stop

@section('content')
<div class="row">
  <div class="small-12 columns">
    <div class="pull-left car-image-main">
      @include('cars.image')
    </div>
    <div>
      <a href="{{ URL::route('cars.qrcode', $car->id) }}" target="_blank" class="pull-right"><i class="fa fa-qrcode"></i> QR Code</a>
      <h1>{{ $car->display }}</h1>
      <dl>
        <dt>VIN:</dt>
        <dd>{{ $car->vin }}</dd>

        <dt>Mileage:</dt>
        <dd>{{ $car->mileage }}</dd>
      </dl>
      @if( $car->status != App\Models\CarStatus::ACTIVE )
      <div>
        <span class="label alert">{{ $car->get_status() }}</span>
      </div>
      @endif
      <a href="{{ URL::route('cars.edit', $car->id) }}" class="button tiny secondary">Edit</a>
    </div>
  </div>
</div>

<div class="row">
  <div class="small-12 medium-6 large-6 columns">
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

  <div class="small-12 medium-6 large-6 columns">
    <h2>Maintenance Log</h2>
    <a href="{{ URL::route('cars.actions.create', $car->id) }}" class="button tiny secondary">Log Action</a>
    <a href="{{ URL::route('cars.scheduled_actions', $car->id) }}" class="button tiny secondary pull-right">Schedule Reminders</a>

    @include('maintenance.log', [ 'maintenance_logs' => $car->maintenance_logs ])
  </div>
</div>
@stop
