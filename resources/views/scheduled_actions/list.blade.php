

@if(count($scheduled_actions) > 0)
<table width="100%" class="scheduled-actions-list">
  <thead>
    <tr>
      <th>Scheduled Action</th>
      <th>Type</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    @foreach($scheduled_actions as $action)
    <tr>
      <td width="80%">{{ $action->action }}</td>
      <td></td>
      <td>
        <a href="{{ URL::route('cars.scheduled_actions.edit', $action->id) }}" class="button tiny secondary">Edit</a>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
@else
<div class="info">No scheduled actions found</div>
@endif
