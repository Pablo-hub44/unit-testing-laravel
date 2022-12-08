<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use App\Http\Controllers\EmployeeController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Employee;
use App\Http\Services\EmployeeService;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

// para crear un test 
// php artisan make:test EmployeeTest

class EmployeeTest extends TestCase
{
    use RefreshDatabase;//esto va a borrar la info de la db de testeo , yo creo - Confirmado
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_if_user_not_esta_logueado()
    {
        $returnedValues = (new EmployeeController)->home();//checamos la funcion de home lo que retorna 
        // $this->assertEmpty($returnedValues);//checa si esta vacia assertEmpty , con assert hay un buen de validaciones :O
    
        // otra forma de testear, como no le pasamos un user pa q autentique, regresa un array vacio
        $this->assertEquals([], $returnedValues);
        // $this->assertTrue(true);
    }




    /**
     * Checks for TIPO A data is returning from service function./ checa la info de TIPOA q es retornada de la funcion de EmployeeService
     */
    public function test_get_employee_type_a_not_empty()
    {
        // creamo info faker con muestro factory factory
        $employees = Employee::factory(200)->create([
            'joining_date' => now()->toDateString(),
        ]);
        // traemos nuestro EmployeeService llamamos a nuestra funcion getEmployeeTypeA y le pasamos los employees por parametro
        $response = (new EmployeeService)->getEmployeeTypeA($employees);
        // dd($response);
        // checamos que no sea vacio, osease si tiene informacion pasa
        $this->assertNotEmpty($response);
    }



     /**
     * Checks for type B data is returning from service function.
     */
    public function test_get_employee_type_b_not_empty()
    {
        $employees = Employee::factory(200)->create([
            'joining_date' => now()->toDateString(),
        ]);

        $response = (new EmployeeService)->getEmployeeTypeB($employees);

        $this->assertNotEmpty($response);
    }

    /**
     * Checks for type C data is returning from service function.
     */
    public function test_get_employee_type_c_not_empty()
    {
        $employees = Employee::factory(200)->create([
            'joining_date' => now()->toDateString(),
        ]);

        $response = (new EmployeeService)->getEmployeeTypeC($employees);

        $this->assertNotEmpty($response);
    }




    // checamos si el usuario logueado puede ir a home y si la data puesta es la misma que en la vista de home 
    public function test_if_user_logged_in_and_dashbaord_gets_employee_data()
    {
        // creamos un user. con el factory
        $user = User::factory()->create([
            'password' => Hash::make('12345678'),//le asignamos la contraseña,  ya q luego la encripta y seria dificil obtenerla
        ]);

        // Login the mismo usuario.
        $response = $this->post('login',[ //en la page de login
            'email' => $user->email,
            'password' => '12345678',
        ]);

        //If loggedin check., si ya esta logueado entonces estaria en la vista de home, checamos eso
        $response->assertRedirect('/home'); //checamos si redirigio con assertRedirect

        // agregamos emplyes a la bd
        $employees =  Employee::factory(200)->create([
            'joining_date' => now()->toDateString(),
        ]);

        // traemos nuestro emplyeeservice con cada funcion respoectiva pasandole los employes como parametro
        $employeeTypeAData = (new EmployeeService)->getEmployeeTypeA($employees);
        $employeeTypeBData = (new EmployeeService)->getEmployeeTypeB($employees);
        $employeeTypeCData = (new EmployeeService)->getEmployeeTypeC($employees);

        // ponemos los datos dentro de un arreglo asociativo, como lo hicimos en el employeecontroller
        $data = [
            'typeA' => $employeeTypeAData,
            'typeB' => $employeeTypeBData,
            'typeC' => $employeeTypeCData,
        ];
        // dd(array_keys($data));

        // Get data from dashboard., nos redirigimos a home
        $response = $this->get(route('home'));
        //dd($response['data']);
        // assert = asegurar , aseguramos que sean iguales assertEquals, el arraykeys de data con que esta en home
        $this->assertEquals(array_keys($data), array_keys($response['data']));

    }    



// como le pusimo test encomillado igual funciona como si le pusieramos en el nombre de la funcion
// pk sino no lo tomaria como test
// esta es para checar si la info mostrada de los empleados es correcta

/**
* @test
*/
    public function check_if_data_displayed_correctly_employee_dashboard()
    {
        // creamos un user. con el factory
        $user = User::factory()->create([
            'password' => Hash::make('12345678'),//le asignamos la contraseña,  ya q luego la encripta y seria dificil obtenerla
        ]);

        // Login the mismo usuario., login exitoso
        $response = $this->post('login',[ //en la page de login
            'email' => $user->email,
            'password' => '12345678',
        ]);

         //If loggedin check., aseguramos que halla redirigido a home
        $response->assertRedirect('/home');


        $employees =  Employee::factory(20)->create([
            'joining_date' => now()->toDateString(),
        ]);

        // los data de cada tipo
        $employeeTypeAData = (new EmployeeService)->getEmployeeTypeA($employees);
        $employeeTypeBData = (new EmployeeService)->getEmployeeTypeB($employees);
        $employeeTypeCData = (new EmployeeService)->getEmployeeTypeC($employees);

        // ponemos los tipos en un array
        $data = [
            'typeA' => $employeeTypeAData,
            'typeB' => $employeeTypeBData,
            'typeC' => $employeeTypeCData,
        ];

        $employeeTypeData = [];//es este array se guardara toda la info de los foreach de abajo

        // Get One emplyee from each type., este es de TIPO A, iteramos en cada empleado 
        foreach($employeeTypeAData as $employeeA)
        {
            // var_dump($employeeA['employee_name']);
            $employeeTypeData['type_a'] = $employeeA['employee_name'];//ponemos cada nombre en un subarray de nombre type_a dentro de employeeTypeData
            // osease todos los employename (que son un dato de array) los ponemos a la clave type_a dentro de employeeTypeData
            // update , solo consigue un empleyeename  se lo asigna a type_a
        }
        // TIPO B
        foreach($employeeTypeBData as $employeeB)
        {
            $employeeTypeData['type_b'] = $employeeB['employee_name'];
        }

        // TIPO C
        foreach($employeeTypeCData as $employeeC)
        {
            $employeeTypeData['type_c'] = $employeeC['employee_name'];
        }
        dd($employeeTypeData);
        // die();

        // Get data from dashboard.
        $response = $this->get(route('home')); //aca dentro esta &data
        // dd($response);
        // die();

        // aseguramos que seaverdadero con assertTrue, si el employee_name de la response tambien esta en el employeeTypeData
        $this->assertTrue(collect($response['data']['typeA'])->contains('employee_name', $employeeTypeData['type_a']));
        $this->assertTrue(collect($response['data']['typeB'])->contains('employee_name', $employeeTypeData['type_b']));
        $this->assertTrue(collect($response['data']['typeC'])->contains('employee_name', $employeeTypeData['type_c']));
    }







}

// para testear todos en uno , en consola
// vendor/bin/phpunit o php artisan test