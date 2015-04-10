

@if(count($maintenance_logs) > 0)
<table width="100%" class="maintenance-logs">
  @foreach($maintenance_logs as $log)
  <tr class="log-item">
    <td>
      @if( $log->status() == "warning" )
      <span class="label warning">DUE TODAY</span>
      @elseif( $log->status() == "danger" )
      <span class="label danger">OVERDUE!!!</span>
      @endif

      @if( ! empty($with_car) )
      <h6>{{ $log->car->display }} <a href="{{ URL::route('cars.show', $log->car->id) }}"><i class="fa fa-car"></i></a> - <b>{{ $log->car->client->name }}</b> <a href="{{ URL::route('clients.show', $log->car->client->id) }}"><i class="fa fa-user"></i></a></h6>
      @endif
      <b>{{ $log->action }}</b><br/>
      @if( $log->is_completed )
      <small><b>Completed On:</b> {{ $log->completed_at->timezone('America/Phoenix')->format('l, F dS, Y h:i A') }} by <b>{{ $log->user->name }}</b></small>
      @else
      <small><b>Scheduled For:</b> {{ $log->scheduled_at->format('l, F dS, Y') }}</small>
      @endif
    </td>
  </tr>
  @endforeach
</table>
@else
<div class="info">No maintenance notifications found</div>
@endif
