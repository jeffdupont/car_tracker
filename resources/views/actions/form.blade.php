
<h5>Select Action</h5>
<div class="row">
  <div class="small-12 large-3 columns">
    <label for="action" class="right inline">Action</label>
  </div>
  <div class="small-12 large-9 columns {{ ($errors->first('action')) ? 'error' : '' }}">
    {{ Form::select('action', [ 'Start car', 'Maintenance', 'Test Drive' ], Input::old('action')) }}
    @if($errors->first('action'))<small class="error">{{ $errors->first('action') }}</small>@endif
  </div>
</div>

<div class="row">
  <div class="small-12 large-3 columns">
    <label for="description" class="right inline">Description</label>
  </div>
  <div class="small-12 large-9 columns {{ ($errors->first('description')) ? 'error' : '' }}">
    {{ Form::textarea('description', Input::old('description')) }}
    @if($errors->first('description'))<small class="error">{{ $errors->first('description') }}</small>@endif
  </div>
</div>

<h5>Mileage</h5>
<div class="row">
  <div class="small-12 large-3 columns">
    <label for="starting_mileage" class="right inline">Starting</label>
  </div>
  <div class="small-12 large-9 columns {{ ($errors->first('starting_mileage')) ? 'error' : '' }}">
    {{ Form::number('starting_mileage', $car->mileage, [ 'disabled' => 'disabled' ]) }}
    @if($errors->first('starting_mileage'))<small class="error">{{ $errors->first('starting_mileage') }}</small>@endif
  </div>
</div>

<div class="row">
  <div class="small-12 large-3 columns">
    <label for="ending_mileage" class="right inline">Ending</label>
  </div>
  <div class="small-12 large-9 columns {{ ($errors->first('ending_mileage')) ? 'error' : '' }}">
    {{ Form::number('ending_mileage', Input::old('ending_mileage'), [ 'placeholder' => $car->mileage, 'min' => $car->mileage ]) }}
    @if($errors->first('ending_mileage'))<small class="error">{{ $errors->first('ending_mileage') }}</small>@endif
  </div>
</div>
