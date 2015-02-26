@extends('layouts.default')

@section('breadcrumb')
<li class=""><a href="{{ URL::route('cars.index') }}">Cars</a></li>
<li class=""><a href="{{ URL::route('cars.show', $car->id) }}">{{ $car->display }}</a></li>
<li class="current"><a href="#">Log Action</a></li>
@stop

@section('content')
<div class="row">
  <div class="small-12 columns">
    <h1>Log Action</h1>
    <p>Log an action that is being performed on the car.</p>
  </div>
</div>

<div class="row">
  {{ Form::open([ 'route' => 'cars.actions.store' ]) }}
  {{ Form::hidden('car_id', $car->id) }}

  <div class="small-12 large-8 columns">

    @include('actions.form')

    <div class="row">
      <div class="small-12 columns">
        <a href="{{ URL::previous() }}" class="button secondary">Back</a>
        {{ Form::button('Save', [ 'type' => 'submit', 'class' => 'button alert pull-right' ]) }}
      </div>
    </div>

  </div>

  {{ Form::close() }}
</div>

@stop
