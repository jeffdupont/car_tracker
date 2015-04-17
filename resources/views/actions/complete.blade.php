@extends('layouts.default')

@section('breadcrumb')
<li class=""><a href="{{ URL::route('cars.index') }}">Cars</a></li>
<li class=""><a href="{{ URL::route('cars.show', $car->id) }}">{{ $car->display }}</a></li>
<li class="current"><a href="#">Complete Action</a></li>
@stop

@section('content')
<div class="row">
  <div class="small-12 columns">
    <h1>Complete Action</h1>
    <p>Complete a scheduled maintenance action on the car.</p>
  </div>
</div>

<div class="row">
  {!! Form::open([ 'route' => [ 'cars.actions.update', $log->id ], 'method' => 'PUT' ]) !!}

  <div class="small-12 large-8 columns">

    @include('actions.form', [ 'complete_form' => true ])

    <div class="row">
      <div class="small-12 columns">
        <a href="{{ URL::previous() }}" class="button secondary">Back</a>
        {!! Form::button('Complete', [ 'type' => 'submit', 'class' => 'button success pull-right' ]) !!}
      </div>
    </div>

  </div>

  {!! Form::close() !!}
</div>

@stop
