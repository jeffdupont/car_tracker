

<div class="row">
  <div class="small-12 large-3 columns">
    <label for="first_name" class="right inline">Name</label>
  </div>
  <div class="small-12 large-4 columns {{ ($errors->first('first_name')) ? 'error' : '' }}">
    {!! Form::text('first_name', old('first_name') ?: (!empty($user) ? $user->first_name : ''), [ 'placeholder' => 'Joe' ]) !!}
    @if($errors->first('first_name'))<small class="error">{{ $errors->first('first_name') }}</small>@endif
  </div>
  <div class="small-12 large-5 columns {{ ($errors->first('last_name')) ? 'error' : '' }}">
    {!! Form::text('last_name', old('last_name') ?: (!empty($user) ? $user->last_name : ''), [ 'placeholder' => 'Smith' ]) !!}
    @if($errors->first('last_name'))<small class="error">{{ $errors->first('last_name') }}</small>@endif
  </div>
</div>

<div class="row">
  <div class="small-12 large-3 columns">
    <label for="email" class="right inline">Display Name</label>
  </div>
  <div class="small-12 large-9 columns {{ ($errors->first('display_name')) ? 'error' : '' }}">
    {!! Form::text('display_name', old('display_name') ?: (!empty($user) ? $user->display_name : ''), [ 'placeholder' => 'Joe Smith' ]) !!}
    @if($errors->first('display_name'))<small class="error">{{ $errors->first('display_name') }}</small>@endif
  </div>
</div>

<div class="row">
  <div class="small-12 large-3 columns">
    <label for="email" class="right inline">Email</label>
  </div>
  <div class="small-12 large-9 columns {{ ($errors->first('email')) ? 'error' : '' }}">
    {!! Form::email('email', old('email') ?: (!empty($user) ? $user->email : ''), [ 'placeholder' => 'joe@example.com' ]) !!}
    @if($errors->first('email'))<small class="error">{{ $errors->first('email') }}</small>@endif
  </div>
</div>

<hr>

<div class="row">
  <div class="small-12 large-3 columns">
    <label for="password" class="right inline">Password</label>
  </div>
  <div class="small-12 large-9 columns {{ ($errors->first('password')) ? 'error' : '' }}">
    {!! Form::password('password') !!}
    @if($errors->first('password'))<small class="error">{{ $errors->first('password') }}</small>@endif
  </div>
</div>

<div class="row">
  <div class="small-12 large-3 columns">
    <label for="password" class="right inline">Verify Password</label>
  </div>
  <div class="small-12 large-9 columns {{ ($errors->first('verify')) ? 'error' : '' }}">
    {!! Form::password('verify') !!}
    @if($errors->first('verify'))<small class="error">{{ $errors->first('verify') }}</small>@endif
  </div>
</div>

<hr>

<div class="row">
  <div class="small-12 large-3 columns">
    <label for="" class="right inline">Options</label>
  </div>
  <div class="small-12 large-2 columns {{ ($errors->first('is_admin')) ? 'error' : '' }}">
    <label for="is_notified" class="right inline">Send Email Notifications
      <div class="switch">
        {!! Form::checkbox('is_notified', 1, old('is_notified') ?: (!empty($user) ? $user->is_notified : ''), [ 'id' => 'is_notified' ]) !!}
        <label for="is_notified">Send Email Notifications</label>
      </div>
    </label>
    @if($errors->first('is_admin'))<small class="error">{{ $errors->first('is_admin') }}</small>@endif
  </div>
  <div class="small-12 large-2 columns {{ ($errors->first('is_admin')) ? 'error' : '' }}">
    <label for="is_admin" class="right inline">Is Admin
      <div class="switch">
        {!! Form::checkbox('is_admin', 1, old('is_admin') ?: (!empty($user) ? $user->is_admin : ''), [ 'id' => 'is_admin' ]) !!}
        <label for="is_admin">Is Admin</label>
      </div>
    </label>
    @if($errors->first('is_admin'))<small class="error">{{ $errors->first('is_admin') }}</small>@endif
  </div>
  <div class="small-12 large-2 columns {{ ($errors->first('status')) ? 'error' : '' }} end">
    <label for="status" class="right inline">Is Active
      <div class="switch">
        {!! Form::checkbox('status', 1, old('status') ?: (!empty($user) ? $user->status : ''), [ 'id' => 'status' ]) !!}
        <label for="status">Is Active</label>
      </div>
    </label>
    @if($errors->first('status'))<small class="error">{{ $errors->first('status') }}</small>@endif
  </div>
</div>
