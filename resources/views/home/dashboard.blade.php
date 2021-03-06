@extends('layouts.default')

@section('content')
<div class="row">
  <div class="small-12 large-8 columns">
    <h1>Maintenance Log</h1>

    @include('maintenance.log', [ 'with_car' => true ])

    {!! $maintenance_logs->render() !!}
  </div>

  <div class="small-12 large-4 columns">
  </div>
</div>
@stop
