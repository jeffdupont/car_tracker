

@if(count($cars) > 0)
<table width="100%">
  <thead>
    <tr>
      <th></th>
      <th>Added to Inventory</th>
      <th>Last Maintenance</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    @foreach($cars as $car)
    <tr>
      <td>{{ $car->display() }}<br><a href="{{ URL::route('cars.qrcode', $car->id) }}" target="_blank"><i class="fa fa-qrcode"></i> QR Code</a></td>
      <td>{{ $car->created_at->format('m-d-Y') }}</td>
      <td>{{ ($car->last_maintenance) ? $car->last_maintenance->format('m-d-Y H:i:s') : 'N/A' }}</td>
      <td>
        <a href="{{ URL::route('cars.show', $car->id) }}" class="button tiny secondary">Details</a>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
@else
<div class="info">No cars found</div>
@endif
