

@if(count($clients) > 0)
<table width="100%" class="client-list">
  <thead>
    <tr>
      <th>Name</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    @foreach($clients as $client)
    <tr>
      <td width="80%">
        <div>
          <b>{{ $client->company_name }}</b><br>
          {{ $client->name }}<br>
          <small><b>CREATED</b> {{ $client->created_at->timezone('America/Phoenix')->format('m-d-Y') }}</small>
        </div>
      </td>
      <td>
        <a href="{{ URL::route('clients.show', $client->id) }}" class="button tiny secondary">Details</a>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
@else
<div class="info">No clients found</div>
@endif
