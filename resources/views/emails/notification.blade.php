<body>
  <p>This is an automated email to let you know that there are upcoming actions on the following items.</p>

  @if( count($due) > 0 )
  <p>There are <b>{{ count($due) }}</b> maintenance actions due today!</p>

  @include('maintenance.log', [ 'maintenance_logs' => $due ])
  @endif

  @if( count($overdue) > 0 )
  <p>There are <b>{{ count($overdue) }}</b> maintenance actions OVERDUE!</p>

  @include('maintenance.log', [ 'maintenance_logs' => $overdue ])
  @endif
</body>
