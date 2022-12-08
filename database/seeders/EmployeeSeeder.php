<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Employee;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // llamamos a nuestro factory q hicimos
        $max = 200;

        for ($i=0; $i < $max; $i++) { 
            Employee::factory()->create();
        }

        // forma 2
        // Employee::factory(200)->create();
    }
}
