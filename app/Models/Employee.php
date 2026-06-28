<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'employee_code',
        'name',
        'email',
        'phone',
        'department_id',
        'designation',
        'salary',
        'joining_date',
        'status',
    ];
    public function department()
{
    return $this->belongsTo(Department::class);
}
}

