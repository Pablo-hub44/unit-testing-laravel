<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Http\Services\EmployeeService; //nuestro servie propio
use Exception;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('index');
    }


    // Dashboard page. la pagina de dashboard
    public function home()
    {
        // los envolvemos en un trycatch
        try {
            $data = [];//donde guardaremos la info

            // validamos si paso la autenticacion
            if (auth()->check()) {
                $employees = Employee::all();//traemos todos los empleados
                // dd($employees);
                // die();

                // validamos si es vacio 
                if (empty($employees->toArray())) {
                    return []; //retorne un array vacio
                }

                // Employees where salary is less than 6k. Type A
                $employeeTypeA = (new EmployeeService)->getEmployeeTypeA($employees);//le pasamos los employess al metodo getEmployeeTypeA

                // Employees where salary is more than 6k and less than 10k. Type B
                $employeeTypeB = (new EmployeeService)->getEmployeeTypeB($employees);

                // Employees where salary is more than  9k. Type C
                $employeeTypeC = (new EmployeeService)->getEmployeeTypeC($employees);

                // ponemos la info en un array q tendra todo
                $data = [
                    'typeA' => $employeeTypeA, //clave, valor casicasi
                    'typeB' => $employeeTypeB,
                    'typeC' => $employeeTypeC,
                ];
                // dd(array_keys($data)); // hace un array de las claves, jaja
                return view('home')->with('data', $data); //con with es asi, tambien se podia usar compact

            }

            return $data;

        }
        catch (Exception $e) {
            echo $e->getMessage();
        }

        return view('home');
    }







    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    //
    }
}
