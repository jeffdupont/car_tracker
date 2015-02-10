@extends('layouts.default')


@section('breadcrumb')
<li class=""><a href="{{ URL::route('cars.index') }}">Cars</a></li>
<li class=""><a href="{{ URL::route('cars.show', $car->id) }}">{{ $car->display() }}</a></li>
<li class="current"><a href="#">Create</a></li>
@stop

@section('content')
<div class="row">
  <div class="small-12 columns">
    <h1>Add Car</h1>
    <p>Add a new car to the selected client</p>
  </div>
</div>

<div class="row">
  {{ Form::open([ 'route' => 'cars.store' ]) }}

  <div class="small-12 large-8 columns">

    @include('cars.form')

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
