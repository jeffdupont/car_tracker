@extends('layouts.print')

@section('content')
<div class="row">
  <div class="small-6 columns">
    <img src="data:image/jpg;base64,{{ $qr_image_64 }}">
  </div>
  <div class="small-6 columns">
    <h2>Car Details</h2>
    <dl>
      <dt>Make</dt>
      <dd>{{ $car->make }}</dd>

      <dt>Model</dt>
      <dd>{{ $car->model }}</dd>

      <dt>Year</dt>
      <dd>{{ $car->year }}</dd>

      <dt>VIN #</dt>
      <dd>{{ $car->vin }}</dd>

      <dt>Added On</dt>
      <dd>{{ $car->created_at->timezone('America/Phoenix')->format('l, F dS, Y h:i A') }}</dd>
    </dl>
  </div>
</div>
@stop
