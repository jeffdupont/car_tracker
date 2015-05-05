

@if(count($scheduled_actions) > 0)
<table width="100%" class="scheduled-actions-list">
  <thead>
    <tr>
      <th>Scheduled Action</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    @foreach($scheduled_actions as $action)
    <tr>
      <td>
        {{ $action->action }}<br/>
        <small>{{ $action->type }}</small>
      </td>
      <td class="text-right" nowrap="nowrap">
        <a href="{{ URL::route('cars.scheduled_actions.edit', $action->id) }}" class="button tiny secondary">Edit</a>
        <a href="{{ URL::route('cars.scheduled_actions.destroy', $action->id) }}" class="button tiny alert">Delete</a>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
@else
<div class="info">No scheduled actions found</div>
@endif
