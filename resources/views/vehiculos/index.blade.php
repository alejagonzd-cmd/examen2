
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instituto de Transporte</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5 mb-5">

    <h1 class="text-center mb-4">
        Vehiculos Registrados
    </h1>

    <!-- ALERTAS DE ÉXITO -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}

            <button type="button" class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="Cerrar"></button>
        </div>
    @endif

    <!-- ALERTAS DE ERRORES -->
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Se encontraron los siguientes errores:</strong>

            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

            <button type="button" class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="Cerrar"></button>
        </div>
    @endif

    <!-- BOTÓN PARA REGISTRAR -->
    <div class="d-flex justify-content-end mb-3">
        <button type="button" class="btn btn-primary"
                data-bs-toggle="modal"
                data-bs-target="#modalCrear">
            + Registrar Vehículo
        </button>
    </div>

    <!-- TABLA DE VEHÍCULOS -->
    <div class="card shadow-sm">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover align-middle">

                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Placa</th>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th>Tipo</th>
                            <th>Color</th>
                            <th>Capacidad</th>
                            <th>Tarifa diaria</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @if($vehiculos->count() > 0)

                            @foreach($vehiculos as $vehiculo)
                                <tr>
                                    <td>{{ $vehiculo->id }}</td>
                                    <td>{{ $vehiculo->plate_number }}</td>
                                    <td>{{ $vehiculo->brand }}</td>
                                    <td>{{ $vehiculo->model }}</td>
                                    <td>{{ $vehiculo->vehicle_type }}</td>
                                    <td>{{ $vehiculo->color }}</td>
                                    <td>{{ $vehiculo->capacity }}</td>
                                    <td>
                                        L. {{ number_format($vehiculo->daily_rate, 2) }}
                                    </td>

                                    <td>
                                        @if($vehiculo->status == 'Disponible')
                                            <span class="badge bg-success">
                                                {{ $vehiculo->status }}
                                            </span>
                                        @else
                                            <span class="badge bg-secondary">
                                                {{ $vehiculo->status }}
                                            </span>
                                        @endif
                                    </td>

                                    <td>
                                        <div class="d-flex gap-2">

                                            <button type="button"
                                                    class="btn btn-warning btn-sm"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalEditar{{ $vehiculo->id }}">
                                                Editar
                                            </button>

                                            <button type="button"
                                                    class="btn btn-danger btn-sm"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalEliminar{{ $vehiculo->id }}">
                                                Eliminar
                                            </button>

                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                        @else
                            <tr>
                                <td colspan="10" class="text-center text-muted">
                                    No hay vehículos registrados.
                                </td>
                            </tr>
                        @endif
                    </tbody>

                </table>
            </div>
        </div>
    </div>

</div>

<!-- MODAL PARA CREAR VEHÍCULO -->
<div class="modal fade" id="modalCrear" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <form action="{{ route('vehiculos.store') }}" method="POST" novalidate>
                @csrf

                <input type="hidden" name="formulario" value="crear">

                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Registrar Vehículo</h5>
                    <button type="button" class="btn-close btn-close-white"
                            data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label">Placa</label>
                            <input type="text" name="plate_number"
                                   class="form-control"
                                   value="{{ old('plate_number') }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Marca</label>
                            <input type="text" name="brand"
                                   class="form-control"
                                   value="{{ old('brand') }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Modelo</label>
                            <input type="text" name="model"
                                   class="form-control"
                                   value="{{ old('model') }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Tipo de vehículo</label>
                            <input type="text" name="vehicle_type"
                                   class="form-control"
                                   value="{{ old('vehicle_type') }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Color</label>
                            <input type="text" name="color"
                                   class="form-control"
                                   value="{{ old('color') }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Capacidad</label>
                            <input type="text" name="capacity"
                                   class="form-control"
                                   value="{{ old('capacity') }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Tarifa diaria (L.)</label>
                            <input type="text" name="daily_rate"
                                   class="form-control"
                                   value="{{ old('daily_rate') }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Estado</label>
                            <select name="status" class="form-select">
                                <option value="">Seleccione un estado</option>
                                <option value="Disponible"
                                    {{ old('status', 'Disponible') == 'Disponible' ? 'selected' : '' }}>
                                    Disponible
                                </option>
                                <option value="Ocupado"
                                    {{ old('status') == 'Ocupado' ? 'selected' : '' }}>
                                    Ocupado
                                </option>
                                <option value="Mantenimiento"
                                    {{ old('status') == 'Mantenimiento' ? 'selected' : '' }}>
                                    Mantenimiento
                                </option>
                            </select>
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">
                        Cancelar
                    </button>

                    <button type="submit" class="btn btn-primary">
                        Guardar Vehículo
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

<!-- MODALES PARA EDITAR Y ELIMINAR -->
@foreach($vehiculos as $vehiculo)

    <!-- MODAL EDITAR -->
    <div class="modal fade"
         id="modalEditar{{ $vehiculo->id }}"
         tabindex="-1">

        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <form action="{{ route('vehiculos.update', $vehiculo->id) }}"
                      method="POST" novalidate>

                    @csrf
                    @method('PUT')

                    <input type="hidden" name="formulario" value="editar">
                    <input type="hidden" name="vehiculo_id" value="{{ $vehiculo->id }}">

                    <div class="modal-header bg-warning">
                        <h5 class="modal-title">
                            Editar Vehículo #{{ $vehiculo->id }}
                        </h5>

                        <button type="button" class="btn-close"
                                data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <div class="row g-3">

                            <div class="col-md-6">
                                <label class="form-label">Placa</label>
                                <input type="text" name="plate_number"
                                       class="form-control"
                                       value="{{ old('vehiculo_id') == $vehiculo->id ? old('plate_number') : $vehiculo->plate_number }}">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Marca</label>
                                <input type="text" name="brand"
                                       class="form-control"
                                       value="{{ old('vehiculo_id') == $vehiculo->id ? old('brand') : $vehiculo->brand }}">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Modelo</label>
                                <input type="text" name="model"
                                       class="form-control"
                                       value="{{ old('vehiculo_id') == $vehiculo->id ? old('model') : $vehiculo->model }}">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Tipo de vehículo</label>
                                <input type="text" name="vehicle_type"
                                       class="form-control"
                                       value="{{ old('vehiculo_id') == $vehiculo->id ? old('vehicle_type') : $vehiculo->vehicle_type }}">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Color</label>
                                <input type="text" name="color"
                                       class="form-control"
                                       value="{{ old('vehiculo_id') == $vehiculo->id ? old('color') : $vehiculo->color }}">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Capacidad</label>
                                <input type="text" name="capacity"
                                       class="form-control"
                                       value="{{ old('vehiculo_id') == $vehiculo->id ? old('capacity') : $vehiculo->capacity }}">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Tarifa diaria (L.)</label>
                                <input type="text" name="daily_rate"
                                       class="form-control"
                                       value="{{ old('vehiculo_id') == $vehiculo->id ? old('daily_rate') : $vehiculo->daily_rate }}">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Estado</label>

                                @php
                                    $estado = old('vehiculo_id') == $vehiculo->id
                                        ? old('status')
                                        : $vehiculo->status;
                                @endphp

                                <select name="status" class="form-select">
                                    <option value="">Seleccione un estado</option>

                                    <option value="Disponible"
                                        {{ $estado == 'Disponible' ? 'selected' : '' }}>
                                        Disponible
                                    </option>

                                    <option value="Ocupado"
                                        {{ $estado == 'Ocupado' ? 'selected' : '' }}>
                                        Ocupado
                                    </option>

                                    <option value="Mantenimiento"
                                        {{ $estado == 'Mantenimiento' ? 'selected' : '' }}>
                                        Mantenimiento
                                    </option>
                                </select>
                            </div>

                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal">
                            Cancelar
                        </button>

                        <button type="submit" class="btn btn-warning">
                            Actualizar Vehículo
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <!-- MODAL ELIMINAR -->
    <div class="modal fade"
         id="modalEliminar{{ $vehiculo->id }}"
         tabindex="-1">

        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">
                        Confirmar eliminación
                    </h5>

                    <button type="button"
                            class="btn-close btn-close-white"
                            data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    ¿Está seguro de que desea eliminar el vehículo
                    <strong>{{ $vehiculo->plate_number }}</strong>?
                    Esta acción no se puede deshacer.
                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">
                        Cancelar
                    </button>

                    <form action="{{ route('vehiculos.destroy', $vehiculo->id) }}"
                          method="POST">

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger">
                            Sí, eliminar
                        </button>

                    </form>
                </div>

            </div>
        </div>
    </div>

@endforeach

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- ABRIR EL MODAL CORRESPONDIENTE SI HAY ERRORES -->
@if($errors->any())
<script>
    document.addEventListener('DOMContentLoaded', function () {

        const formulario = @json(old('formulario'));
        const vehiculoId = @json(old('vehiculo_id'));

        let modalId = 'modalCrear';

        if (formulario === 'editar' && vehiculoId) {
            modalId = 'modalEditar' + vehiculoId;
        }

        const modalElemento = document.getElementById(modalId);

        if (modalElemento) {
            const modal = new bootstrap.Modal(modalElemento);
            modal.show();
        }
    });
</script>
@endif

</body>
</html>
