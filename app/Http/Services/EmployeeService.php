<?php

namespace App\Http\Services;

// nuestra clase
class EmployeeService

{

    // nuestras propiedades
    public $employeeTypeAData = [];
    public $employeeTypeBData = [];
    public $employeeTypeCData = [];

    // Employees where salary is less than 6k. Type A
    // Employees where salary is more than 6k and less than 10k. Type B
    // Employees where salary is more than  9k. Type C
    /**
     * Get Employee Type A data where salary less than 60k.
     */
    public function getEmployeeTypeA($employees)
    {
        $data = [];//donde se guardara la info

        // get employee where salary is less than 6k.
        // iteramos
        foreach ($employees as $employee) {
            // var_dump($employee);
            if ((int)$employee->salary < 6000) {
                $data['id'] = $employee->id;// asignamos el valores del array del foreach para ponerlos en el array de data en su propiedad
                $data['employee_id'] = $employee->employee_id;
                $data['employee_name'] = $employee->employee_name;
                $data['age'] = $employee->age;
                $data['joined'] = $employee->joining_date;
                $data['salary'] = $employee->salary;
                $data['bonus'] = $employee->bonus;
                $data['med_claims'] = $employee->employee_medical_claims;
                $data['allowences'] = $employee->allowences;
                $data['leave_payments'] = $employee->leave_payments;

                // la suma del salario, bono, gastos medicos, allowences, pagos
                $data['totalExpense'] = $employee->salary +
                    $employee->bonus +
                    $employee->employee_medical_claims +
                    $employee->allowences +
                    $employee->leave_payments;

                $this->getEmployeeTypeA[] = $data;//lo conseguido del foreas se lo ponemos a getEmployeeTypeA
            }

        }

        return $this->getEmployeeTypeA; //al final retornamos getEmployeeTypeA
    }

    /**
     * Get Employee Type B data where salary less than 100k and more than 60k.
     */
    public function getEmployeeTypeB($employees)
    {
        $data = [];

        // get employee where salary less than 10k and more than 6k.

        foreach ($employees as $employee) {
            if ((int)$employee->salary > 6000 && (int)$employee->salary < 10000) { //(int)$employee asi especificamo en tipo de dato
                $data['id'] = $employee->id;
                $data['employee_id'] = $employee->employee_id;
                $data['employee_name'] = $employee->employee_name;
                $data['age'] = $employee->age;
                $data['joined'] = $employee->joining_date;
                $data['salary'] = $employee->salary;
                $data['bonus'] = $employee->bonus;
                $data['med_claims'] = $employee->employee_medical_claims;
                $data['allowences'] = $employee->allowences;
                $data['leave_payments'] = $employee->leave_payments;

                $data['totalExpense'] = $employee->salary +
                    $employee->bonus +
                    $employee->employee_medical_claims +
                    $employee->allowences +
                    $employee->leave_payments;

                $this->getEmployeeTypeB[] = $data;
            }

        }

        return $this->getEmployeeTypeB;
    }

    /**
     * Get Employee Type C data where salary  more than 9k.
     */
    public function getEmployeeTypeC($employees)
    {
        $data = [];

        // get employee where salary  more than 100k.

        foreach ($employees as $employee) {
            if ((int)$employee->salary > 9000) {
                $data['id'] = $employee->id;
                $data['employee_id'] = $employee->employee_id;
                $data['employee_name'] = $employee->employee_name;
                $data['age'] = $employee->age;
                $data['joined'] = $employee->joining_date;
                $data['salary'] = $employee->salary;
                $data['bonus'] = $employee->bonus;
                $data['med_claims'] = $employee->employee_medical_claims;
                $data['allowences'] = $employee->allowences;
                $data['leave_payments'] = $employee->leave_payments;

                $data['totalExpense'] = $employee->salary +
                    $employee->bonus +
                    $employee->employee_medical_claims +
                    $employee->allowences +
                    $employee->leave_payments;

                $this->getEmployeeTypeC[] = $data;
            }

        }

        return $this->getEmployeeTypeC;
    }


}