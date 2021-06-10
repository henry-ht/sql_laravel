<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datos = [
            array(
                'nombre'        => 'Desarrollo',
                'presupuesto'   => 120000,
                'gastos'        => 6000,
            ),
            array(
                'nombre'        => 'Sistemas',
                'presupuesto'   => 150000,
                'gastos'        => 21000,
            ),
            array(
                'nombre'        => 'Recursos Humanos',
                'presupuesto'   => 280000,
                'gastos'        => 25000,
            ),
            array(
                'nombre'        => 'Contabilidad',
                'presupuesto'   => 110000,
                'gastos'        => 3000,
            ),
            array(
                'nombre'        => 'I+D',
                'presupuesto'   => 375000,
                'gastos'        => 380000,
            ),
            array(
                'nombre'        => 'Proyectos',
                'presupuesto'   => 0,
                'gastos'        => 0,
            ),
            array(
                'nombre'        => 'Publicidad',
                'presupuesto'   => 0,
                'gastos'        => 1000,
            ),
        ];
        foreach ($datos as $key => $value) {
            Department::create($value);
        }
    }
}
