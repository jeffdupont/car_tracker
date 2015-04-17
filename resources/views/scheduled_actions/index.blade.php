@extends('layouts.default')


@section('breadcrumb')
<li class=""><a href="{{ URL::to('cars') }}">Cars</a></li>
<li class=""><a href="{{ URL::route('cars.show', $car->id) }}">{{ $car->display }}</a></li>
<li class="current"><a href="#">Scheduled Reminders</a></li>
@stop

@section('content')
<div class="row">
  <div class="small-12 columns">
    <div class="pull-left car-image-main">
      @include('cars.image', [ 'show_form' => false ])
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
  <div class="small-12 columns">
    <a href="{{ URL::route('cars.scheduled_actions.create', [ 'car' => $car ]) }}" class="button success pull-right tiny"><i class="fa fa-plus"></i> Add Reminder</a>
    <h2>Scheduled Reminders</h2>

    @include('scheduled_actions.list', [ 'scheduled_actions' => $car->scheduled_actions ])

  </div>
</div>
@stop
