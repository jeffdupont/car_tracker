

@if(count($users) > 0)
<table width="100%" class="user-list">
  <thead>
    <tr>
      <th>Name</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    @foreach($users as $user)
    <tr>
      <td width="80%">
        @if( $user->is_admin )
        <span class="label info pull-right"><i class="fa fa-key"></i> ADMIN</span>
        @endif
        @if( $user->is_notified )
        <span class="label info pull-right"><i class="fa fa-envelope"></i> NOTIFIED</span>
        @endif
        <div>
          <b>{{ $user->name }}</b><br>
          <small><b>CREATED</b> {{ $user->created_at->timezone('America/Phoenix')->format('m-d-Y') }}</small>
        </div>
      </td>
      <td>
        <a href="{{ URL::route('users.show', $user->id) }}" class="button tiny secondary">Details</a>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
@else
<div class="info">No users found</div>
@endif
