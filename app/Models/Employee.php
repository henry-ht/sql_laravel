<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = [
        'nif',
        'nombre',
        'apellido1',
        'apellido2',
        'department_id',
        'zip',
        'ciudad',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
