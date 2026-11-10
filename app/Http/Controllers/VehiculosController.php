<?php

namespace App\Http\Controllers;

use App\Models\vehiculos;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class VehiculosController extends Controller
{
    public function index()
    {
        $vehiculos = vehiculos::orderBy('id', 'desc')->get();

        return view('vehiculos.index', compact('vehiculos'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate(
            $this->reglas(),
            $this->mensajes(),
            $this->atributos()
        );

        vehiculos::create($validated);

        return redirect()->route('vehiculos.index')
            ->with('success', 'Vehículo registrado correctamente.');
    }

    public function update(Request $request, $id)
    {
        $vehiculo = vehiculos::findOrFail($id);

        $reglas = $this->reglas();

        $reglas['plate_number'] = [
            'required',
            'string',
            'max:15',
            Rule::unique('vehiculos', 'plate_number')->ignore($vehiculo->id)
        ];

        $validated = $request->validate(
            $reglas,
            $this->mensajes(),
            $this->atributos()
        );

        $vehiculo->update($validated);

        return redirect()->route('vehiculos.index')
            ->with('success', 'Vehículo actualizado correctamente.');
    }

    public function destroy($id)
    {
        $vehiculo = vehiculos::findOrFail($id);

        $vehiculo->delete();

        return redirect()->route('vehiculos.index')
            ->with('success', 'Vehículo eliminado correctamente.');
    }

    private function reglas()
    {
        return [
            'plate_number' => 'required|string|max:15|unique:vehiculos  ,plate_number',
            'brand' => 'required|string|max:50',
            'model' => 'required|string|max:80',
            'vehicle_type' => 'required|string|max:50',
            'color' => 'required|string|max:30',
            'capacity' => 'required|integer|min:1',
            'daily_rate' => 'required|numeric|min:0|decimal:0,2|max:99999999.99',
            'status' => 'required|string|max:30'
        ];
    }

    private function mensajes()
    {
        return [
            'required' => 'El campo :attribute es obligatorio.',
            'string' => 'El campo :attribute debe contener texto.',
            'max.string' => 'El campo :attribute no puede superar :max caracteres.',
            'max.numeric' => 'El campo :attribute no puede superar :max.',
            'min' => 'El campo :attribute debe ser como mínimo :min.',
            'integer' => 'El campo :attribute debe ser un número entero.',
            'numeric' => 'El campo :attribute debe contener un número válido.',
            'decimal' => 'La tarifa diaria debe tener máximo 2 decimales.',
            'unique' => 'La placa ingresada ya está registrada.'
        ];
    }

    private function atributos()
    {
        return [
            'plate_number' => 'placa',
            'brand' => 'marca',
            'model' => 'modelo',
            'vehicle_type' => 'tipo de vehículo',
            'color' => 'color',
            'capacity' => 'capacidad',
            'daily_rate' => 'tarifa diaria',
            'status' => 'estado'
        ];
    }
}
