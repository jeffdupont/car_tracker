

@if(count($notifications) > 0)
<table width="100%">
  <thead>
    <tr>
      <th>Domain</th>
      <th></th>
      <th></th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    @foreach($notifications as $notification)
    <tr>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    @endforeach
  </tbody>
</table>
@else
<div class="info">No maintenance notifications found</div>
@endif
