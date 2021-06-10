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
        $data       = Employee::get();

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
            'department_id'
        ]);

        $validation = Validator::make($credentials,[
            'nif'           => 'required|max:9|unique:employees,nif',
            'nombre'        => 'required|min:3|max:100',
            'apellido1'     => 'required|min:3|max:100',
            'apellido2'     => 'required|min:3|max:100',
            'department_id' => 'required|numeric|exists:departments,id'
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
        $message    = ['message' => [__('Todos los elementos')]];
        $data       = $employee;

        $notify = true;

        $credentials = $request->only([
            'nif',
            'nombre',
            'apellido1',
            'apellido2',
            'department_id'
        ]);

        $validation = Validator::make($credentials,[
            'nif'           => 'required|max:9|unique:employees,nif,'.$employee->id,
            'nombre'        => 'required|min:3|max:100',
            'apellido1'     => 'required|min:3|max:100',
            'apellido2'     => 'required|min:3|max:100',
            'department_id' => 'required|numeric|exists:departments,id'
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
                        $message    = ['message' => [__('Elemento actualizado')]];
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
            'notify'        => $notify,
            'data'          => $data,
            'status'        => $status,
            'message'       => $message
        ],200);

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
        $employee->delete();
    }
}
