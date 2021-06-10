<?php

namespace Database\Seeders;
use App\Models\Employee;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
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
                'nif'           => '32481596F',
                'nombre'        => 'Aarón',
                'apellido1'     => 'Rivero',
                'apellido2'     => 'Gómez',
                'department_id' => 1
            ),
            array(
                'nif'           => '5575632D',
                'nombre'        => 'Adela',
                'apellido1'     => 'Salas',
                'apellido2'     => 'Díaz',
                'department_id' => 2
            ),
            array(
                'nif'           => '6970642B',
                'nombre'        => 'Adolfo',
                'apellido1'     => 'Rubio',
                'apellido2'     => 'Flores',
                'department_id' => 3
            ),
            array(
                'nif'           => '77705545E',
                'nombre'        => 'Adrián',
                'apellido1'     => 'Suárez',
                'apellido2'     => NULL,
                'department_id' => 4
            ),
            array(
                'nif'           => '17087203C',
                'nombre'        => 'Marcos',
                'apellido1'     => 'Loyola',
                'apellido2'     => 'Méndez',
                'department_id' => 5
            ),
            array(
                'nif'           => '38382980M',
                'nombre'        => 'María',
                'apellido1'     => 'Santana',
                'apellido2'     => 'Moreno',
                'department_id' => 1
            ),
            array(
                'nif'           => '80576669X',
                'nombre'        => 'Pilar',
                'apellido1'     => 'Ruiz',
                'apellido2'     => NULL,
                'department_id' => 2
            ),
            array(
                'nif'           => '71651431Z',
                'nombre'        => 'Pepe',
                'apellido1'     => 'Ruiz',
                'apellido2'     => 'Santana',
                'department_id' => 3
            ),
            array(
                'nif'           => '56399183D',
                'nombre'        => 'Juan',
                'apellido1'     => 'Gómez',
                'apellido2'     => 'López',
                'department_id' => 2
            ),
            array(
                'nif'           => '46384486H',
                'nombre'        => 'Diego',
                'apellido1'     => 'Flores',
                'apellido2'     => 'Salas',
                'department_id' => 5
            ),
            array(
                'nif'           => '67389283A',
                'nombre'        => 'Marta',
                'apellido1'     => 'Herrera',
                'apellido2'     => 'Gil',
                'department_id' => 1
            ),
            array(
                'nif'           => '41234836R',
                'nombre'        => 'Irene',
                'apellido1'     => 'Salas',
                'apellido2'     => 'Flores',
                'department_id' => NULL
            ),
            array(
                'nif'           => '82635162B',
                'nombre'        => 'Juan Antonio',
                'apellido1'     => 'Sáez',
                'apellido2'     => 'Guerrero',
                'department_id' => NULL
            ),
        ];

        foreach ($datos as $key => $value) {
            Employee::create($value);
        }
    }
}
