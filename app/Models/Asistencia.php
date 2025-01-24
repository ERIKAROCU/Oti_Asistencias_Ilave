<?php

// App\Models\Asistencia.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    use HasFactory;

    protected $fillable = [
        'empleado_id',
        'entrada',
        'salida',
    ];

    protected $casts = [
        'entrada' => 'datetime',
        'salida' => 'datetime',
    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class);
    }

    protected static function booted()
    {
        static::saving(function ($asistencia) {
            if ($asistencia->salida && $asistencia->salida < $asistencia->entrada) {
                throw new \Exception('La salida no puede ser antes de la entrada.');
            }
        });
    }

}
