<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Validator;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $status     = 'success';
        $message    = ['message' => [__('Todos los elementos')]];
        $data       = Employee::with(['department'])->get();

        return response([
            'data'          => $data,
            'status'        => $status,
            'message'       => $message
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $status     = 'success';
        $message    = ['message' => [__('Todos los elementos')]];
        $data       = false;

        $credentials = $request->only([
            'nif',
            'nombre',
            'apellido1',
            'apellido2',
            'department_id',
            'ciudad',
            'zip'
        ]);

        $validation = Validator::make($credentials,[
            'nif'           => 'required|max:9|unique:employees,nif',
            'nombre'        => 'required|min:3|max:100',
            'apellido1'     => 'sometimes|required|min:3|max:100',
            'apellido2'     => 'sometimes|required|min:3|max:100',
            'department_id' => 'required|numeric|exists:departments,id',
            'ciudad'        => 'sometimes|required|min:3|max:100',
            'zip'           => 'sometimes|required|min:3|max:100',
        ]);

        if (!$validation->fails()) {
            $iOrC = Employee::firstOrCreate($credentials);

            $message    = ['message' => [__('Empleado creado')]];
            $status     = 'success';
            $data       = $iOrC;
        }else{
            $message    = $validation->messages();
            $status     = 'warning';
            $data       = false;

        }

        return response([
            'data'          => $data,
            'status'        => $status,
            'message'       => $message
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        $status     = 'success';
        $message    = ['message' => [__('Todos los elementos')]];
        $data       = $employee;

        return response([
            'data'          => $data,
            'status'        => $status,
            'message'       => $message
        ],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        $status     = 'success';
        $message    = ['message' => [__('Actualizado')]];
        $data       = true;

        $credentials = $request->only([
            'nif',
            'nombre',
            'apellido1',
            'apellido2',
            'department_id',
            'ciudad',
            'zip'
        ]);

        $validation = Validator::make($credentials,[
            'nif'           => 'sometimes|required|max:9|unique:employees,nif,'.$employee->id,
            'nombre'        => 'sometimes|required|min:3|max:100',
            'apellido1'     => 'sometimes|required|min:3|max:100',
            'apellido2'     => 'sometimes|required|min:3|max:100',
            'department_id' => 'sometimes|required|numeric|exists:departments,id',
            'ciudad'        => 'sometimes|required|min:3|max:100',
            'zip'           => 'sometimes|required|min:3|max:100',
        ]);

        if (!$validation->fails()) {

            foreach ($credentials as $key => $value) {
                if ($credentials[$key] == $employee[$key]) {
                    unset($credentials[$key]);
                }
            }

            if (count($credentials)) {
                $okUpdate = $employee->fill($credentials)->save();

                    if ($okUpdate) {
                        $message    = ['message' => [__('Actualizado')]];
                        $status     = 'success';
                        $data       = $employee;
                    } else {
                        $message    = ['message' => [__('Vaya, algo salió mal en nuestros servidores.')]];
                        $status     = 'warning';
                        $data       = false;
                    }

            } else {
                $message    = ['message' => [__('Nada nuevo para actualizar')]];
                $status     = 'success';
                $data       = false;
            }

        }else{
            $message    = $validation->messages();
            $status     = 'warning';
            $data       = false;
        }

        return response([
            'data'          => $data,
            'status'        => $status,
            'message'       => $message
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $status     = 'success';
        $message    = ['message' => [__('Elemento eliminado')]];
        $data       = true;

        $employee->delete();

        return response([
            'data'          => $data,
            'status'        => $status,
            'message'       => $message
        ],200);
    }
}
