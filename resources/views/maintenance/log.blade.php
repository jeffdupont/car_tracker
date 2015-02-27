

@if(count($maintenance_logs) > 0)
<table width="100%" class="maintenance-logs">
  @foreach($maintenance_logs as $log)
  <tr class="log-item">
    <td>
      @if( $with_car )
      <h6>{{ $log->car->display }} - <b>{{ $log->car->client->name }}</b></h6>
      @endif
      <b>{{ $log->action }}</b><br/> <small>{{ $log->created_at->timezone('America/Phoenix')->format('l, F dS, Y h:i A') }} by <b>{{ $log->user->name }}</b></small>
    </td>
  </tr>
  @endforeach
</table>
@else
<div class="info">No maintenance notifications found</div>
@endif
