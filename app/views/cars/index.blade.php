@extends('layouts.default')


@section('breadcrumb')
<li class="current"><a href="{{ URL::to('cars') }}">Cars</a></li>
@stop

@section('content')
<div class="row">
  <div class="small-12 large-8 columns">
    <a href="{{ URL::route('cars.create') }}" class="button success pull-right tiny"><i class="fa fa-plus"></i> Add Car</a>
    <h1>Cars <small>{{ $cars->getTotal() }}</small></h1>

    @include('cars.list')

    {{ $cars->appends([ 'filter' => $filter ])->links() }}
  </div>
</div>
@stop
