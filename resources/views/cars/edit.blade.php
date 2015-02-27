@extends('layouts.default')


@section('breadcrumb')
<li class=""><a href="{{ URL::to('cars') }}">Cars</a></li>
<li class="current"><a href="#">Edit</a></li>
@stop

@section('content')
<div class="row">
  <div class="small-12 columns">
    <h1>Edit Car</h1>
    <p>Update the car details</p>
  </div>
</div>

<div class="row">
  {!! Form::open([ 'route' => [ 'cars.update', $car->id ], 'method' => 'PUT' ]) !!}

  <div class="small-12 large-4 large-push-8  columns">
    @include('cars.image')
  </div>

  <div class="small-12 large-8 large-pull-4 columns">

    @include('cars.form')

    <div class="row">
      <div class="small-12 columns">
        <a href="{{ URL::previous() }}" class="button secondary">Back</a>
        {!! Form::button('Save', [ 'type' => 'submit', 'class' => 'button alert pull-right' ]) !!}
      </div>
    </div>

  </div>

  {!! Form::close() !!}
</div>
@stop
