@extends('layouts.default')


@section('breadcrumb')
<li class=""><a href="{{ URL::to('cars') }}">Cars</a></li>
<li class=""><a href="{{ URL::route('cars.show', $car->id) }}">{{ $car->display }}</a></li>
<li class=""><a href="{{ URL::route('cars.scheduled_actions', $car->id) }}">Scheduled Reminders</a></li>
<li class="current"><a href="#">Edit</a></li>
@stop

@section('content')
<div class="row">
  <div class="small-12 columns">
    <h1>Edit Scheduled Reminder</h1>
    <p>Modify the maintenance action reminder in the system</p>
  </div>
</div>

<div class="row">
  <div class="small-12 large-8 columns">

    <div class="row">
      <div class="small-12 columns">
        <h2>{{ $car->display }}</h2>
      </div>
    </div>

    {!! Form::open([ 'route' => [ 'cars.scheduled_actions.update', $scheduled_action->id ], 'method' => 'PUT' ]) !!}
    {!! Form::hidden('car_id', $car->id) !!}

    @include('scheduled_actions.form')

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
