

@section('script')
@parent
  <script>
  $(document).ready(function() {

    $(':input[name=client_id]').on('change', function() {
      if( $(this).val() !== '0' && $('#create-client').is(':visible') ) {
        $('#create-client').slideUp(null, function() {
          toggle_button( $('#create-client-button') );
        });
      }
    });
    $('#create-client-button').on('click', function() {
      var self = this;
      $('#create-client').slideToggle(null, function() {
        toggle_button( self );
      });
    });

    @if( ! (Input::old('client_id') == '0' || $errors->first('first_name') || $errors->first('last_name') || $errors->first('email')) )
    $('#create-client').hide();
    @endif

    toggle_button( $('#create-client-button') );
  });

  function toggle_button( button ) {
    if( $('#create-client').is(':visible') ) {
      $(':input[name=client_id]').val('0');
      $(button).empty().append('<i class="fa fa-minus"></i>');
    } else {
      $(button).empty().append('<i class="fa fa-plus"></i>');
    }
  }
  </script>
@stop

<div class="row">
  <div class="small-12 large-3 columns">
    <label for="client_id" class="right inline">Client</label>
  </div>
  <div class="small-12 large-9 columns {{ ($errors->first('client_id')) ? 'error' : '' }}">
    <div class="row collapse">
      <div class="small-10 columns">
        {{ Form::select('client_id', array_merge([ '' => 'Select Client', 0 => 'New Client' ], $clients), Input::old('client_id') ?: (!empty($car) ? $car->client_id : '')) }}
      </div>
      <div class="small-2 columns">
        <a href="#" id="create-client-button" data-show="create-client" class="button postfix flat"><i class="fa fa-plus"></i></a>
      </div>
    </div>
    @if($errors->first('client_id'))<small class="error">{{ $errors->first('client_id') }}</small>@endif
  </div>
</div>

<div id="create-client" class="panel">
@include('clients.form')
</div>

<div class="row">
  <div class="small-12 large-3 columns">
    <label for="make" class="right inline">Make</label>
  </div>
  <div class="small-12 large-9 columns {{ ($errors->first('make')) ? 'error' : '' }}">
    {{ Form::text('make', Input::old('make') ?: (!empty($car) ? $car->make : ''), [ 'placeholder' => 'Mitsubishi' ]) }}
    @if($errors->first('make'))<small class="error">{{ $errors->first('make') }}</small>@endif
  </div>
</div>

<div class="row">
  <div class="small-12 large-3 columns">
    <label for="model" class="right inline">Model</label>
  </div>
  <div class="small-12 large-9 columns {{ ($errors->first('model')) ? 'error' : '' }}">
    {{ Form::text('model', Input::old('model') ?: (!empty($car) ? $car->model : ''), [ 'placeholder' => 'Evolution IX' ]) }}
    @if($errors->first('model'))<small class="error">{{ $errors->first('model') }}</small>@endif
  </div>
</div>

<div class="row">
  <div class="small-12 large-3 columns">
    <label for="year" class="right inline">Year</label>
  </div>
  <div class="small-12 large-9 columns {{ ($errors->first('year')) ? 'error' : '' }}">
    {{ Form::number('year', Input::old('year') ?: (!empty($car) ? $car->year : ''), [ 'placeholder' => '2006' ]) }}
    @if($errors->first('year'))<small class="error">{{ $errors->first('year') }}</small>@endif
  </div>
</div>

<div class="row">
  <div class="small-12 large-3 columns">
    <label for="vin" class="right inline">VIN #</label>
  </div>
  <div class="small-12 large-9 columns {{ ($errors->first('vin')) ? 'error' : '' }}">
    {{ Form::text('vin', Input::old('vin') ?: (!empty($car) ? $car->vin : '')) }}
    @if($errors->first('vin'))<small class="error">{{ $errors->first('vin') }}</small>@endif
  </div>
</div>

<div class="row">
  <div class="small-12 large-3 columns">
    <label for="mileage" class="right inline">Mileage</label>
  </div>
  <div class="small-12 large-9 columns {{ ($errors->first('mileage')) ? 'error' : '' }}">
    {{ Form::number('mileage', Input::old('mileage') ?: (!empty($car) ? $car->mileage : ''), [ 'min' => 0 ]) }}
    @if($errors->first('mileage'))<small class="error">{{ $errors->first('mileage') }}</small>@endif
  </div>
</div>

<hr>

@if( ! empty($car) )
<div class="row">
  <div class="small-12 large-3 columns">
    <label for="" class="right inline">Active</label>
  </div>
  <div class="small-12 large-1 columns {{ ($errors->first('do_crawl')) ? 'error' : '' }} end">
    <label for="status" class="right inline">
      <div class="switch">
        {{ Form::checkbox('status', 1, Input::old('status') ? Input::old('status') : $car->status, [ 'id' => 'status' ]) }}
        <label for="status">Status</label>
      </div>
    </label>
    @if($errors->first('status'))<small class="error">{{ $errors->first('status') }}</small>@endif
  </div>
</div>

<hr>
@endif
