

@if(count($cars) > 0)
<table width="100%" class="car-list">
  <thead>
    <tr>
      <th></th>
      <th>Last Maintenance</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    @foreach($cars as $car)
    <tr>
      <td width="80%">
        <div class="pull-left car-image thumbnail">
          <img src="{{ URL::route('cars.image', $car->id) }}">
        </div>
        <div>
          {{ $car->display }}<br>
          <small><b>CREATED</b> {{ $car->created_at->timezone('America/Phoenix')->format('m-d-Y') }}</small><br>
          <a href="{{ URL::route('cars.qrcode', $car->id) }}" target="_blank"><i class="fa fa-qrcode"></i> QR Code</a>
        </div>
      </td>
      <td>{!! ($car->last_maintenance) ? ($car->last_maintenance->timezone('America/Phoenix')->format('m-d-Y') . '<br><small>@ ' . $car->last_maintenance->timezone('America/Phoenix')->format('H:i:s A') . '</small>') : 'N/A' !!}</td>
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
