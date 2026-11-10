<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Examen aaa</title>
  </head>
  <body>
    
    <h1>Vehículos</h1>
    <table class="table">
      <thead>
        <tr>
          <th>Placa</th>
          <th>Marca</th>
          <th>Modelo</th>
          <th>Tipo</th>
          <th>Color</th>
          <th>Capacidad</th>
          <th>Tarifa Diaria</th>
          <th>Estado</th>
        </tr>
      </thead>
      <tbody>
        @foreach($vehiculos as $vehiculo)
          <tr>
            <td>{{ $vehiculo->plate_number }}</td>
            <td>{{ $vehiculo->brand }}</td>
            <td>{{ $vehiculo->model }}</td>
            <td>{{ $vehiculo->vehicle_type }}</td>
            <td>{{ $vehiculo->color }}</td>
            <td>{{ $vehiculo->capacity }}</td>
            <td>${{ number_format($vehiculo->daily_rate, 2) }}</td>
            <td>{{ $vehiculo->status }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </body>
</html>