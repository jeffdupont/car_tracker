

@if(count($cars) > 0)
<table width="100%">
  <thead>
    <tr>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    @foreach($cars as $car)
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
<div class="info">No cars found</div>
@endif
