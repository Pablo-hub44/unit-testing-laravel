<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    // protected $table = 'employees';

    protected $fillable = [
        'employee_id',
        'bonus',
        'joining_date',
        'salary',
        'bonus',
        'employee_medical_claims',
        'allowences',
        'leave_payments'
    ];
}
