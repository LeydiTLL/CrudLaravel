<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombres', 
        'apellidos', 
        'identificacion', 
        'direccion', 
        'telefono', 
        'ciudad_id', 
        'is_active'
    ];
    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeActivos($query)
    {
        return $query->where('is_active', true);
    }

    // Relación con Ciudad
    public function ciudad()
    {
        return $this->belongsTo(Ciudades::class);
    }

    // Definir la relación muchos a muchos con Cargo
    public function cargos()
    {
        return $this->belongsToMany(Cargos::class, 'empleado_cargo', 'empleado_id', 'cargo_id');
    }

}
