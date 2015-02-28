

<div class="row">
  <div class="small-12 large-3 columns">
    <label for="company_name" class="right inline">Company</label>
  </div>
  <div class="small-12 large-9 columns {{ ($errors->first('company_name')) ? 'error' : '' }}">
    {!! Form::text('company_name', old('company_name') ?: (!empty($client) ? $client->company_name : ''), [ 'placeholder' => 'Acme, Inc' ]) !!}
    @if($errors->first('company_name'))<small class="error">{{ $errors->first('company_name') }}</small>@endif
  </div>
</div>

<div class="row">
  <div class="small-12 large-3 columns">
    <label for="first_name" class="right inline">Name</label>
  </div>
  <div class="small-12 large-4 columns {{ ($errors->first('first_name')) ? 'error' : '' }}">
    {!! Form::text('first_name', old('first_name') ?: (!empty($client) ? $client->first_name : ''), [ 'placeholder' => 'Joe' ]) !!}
    @if($errors->first('first_name'))<small class="error">{{ $errors->first('first_name') }}</small>@endif
  </div>
  <div class="small-12 large-5 columns {{ ($errors->first('last_name')) ? 'error' : '' }}">
    {!! Form::text('last_name', old('last_name') ?: (!empty($client) ? $client->last_name : ''), [ 'placeholder' => 'Smith' ]) !!}
    @if($errors->first('last_name'))<small class="error">{{ $errors->first('last_name') }}</small>@endif
  </div>
</div>

<div class="row">
  <div class="small-12 large-3 columns">
    <label for="address" class="right inline">Address</label>
  </div>
  <div class="small-12 large-9 columns {{ ($errors->first('address')) ? 'error' : '' }}">
    {!! Form::text('address', old('address') ?: (!empty($client) ? $client->address : ''), [ 'placeholder' => '123 Main St' ]) !!}
    @if($errors->first('address'))<small class="error">{{ $errors->first('address') }}</small>@endif
  </div>
</div>
<div class="row">
  <div class="small-12 large-offset-3 large-4 columns {{ ($errors->first('city')) ? 'error' : '' }}">
    {!! Form::text('city', old('city') ?: (!empty($client) ? $client->city : ''), [ 'placeholder' => 'City' ]) !!}
    @if($errors->first('city'))<small class="error">{{ $errors->first('city') }}</small>@endif
  </div>
  <div class="small-12 large-2 columns {{ ($errors->first('state')) ? 'error' : '' }}">
    {!! Form::text('state', old('state') ?: (!empty($client) ? $client->state : ''), [ 'placeholder' => 'State' ]) !!}
    @if($errors->first('state'))<small class="error">{{ $errors->first('state') }}</small>@endif
  </div>
  <div class="small-12 large-3 columns {{ ($errors->first('zip')) ? 'error' : '' }}">
    {!! Form::text('zip', old('zip') ?: (!empty($client) ? $client->zip : ''), [ 'placeholder' => 'Zip' ]) !!}
    @if($errors->first('zip'))<small class="error">{{ $errors->first('zip') }}</small>@endif
  </div>
</div>

<div class="row">
  <div class="small-12 large-3 columns">
    <label for="email" class="right inline">Email</label>
  </div>
  <div class="small-12 large-9 columns {{ ($errors->first('email')) ? 'error' : '' }}">
    {!! Form::email('email', old('email') ?: (!empty($client) ? $client->email : ''), [ 'placeholder' => 'joe@example.com' ]) !!}
    @if($errors->first('email'))<small class="error">{{ $errors->first('email') }}</small>@endif
  </div>
</div>

<div class="row">
  <div class="small-12 large-3 columns">
    <label for="phone" class="right inline">Phone</label>
  </div>
  <div class="small-12 large-9 columns {{ ($errors->first('phone')) ? 'error' : '' }}">
    {!! Form::phone('phone', old('phone') ?: (!empty($client) ? $client->phone : ''), [ 'placeholder' => '602 555-1212', 'type' => 'tel', 'pattern' => '\d{3}\s?\d{3}[\-]?\d{4}' ]) !!}
    @if($errors->first('phone'))<small class="error">{{ $errors->first('phone') }}</small>@endif
  </div>
</div>
