<?php

namespace App\Services;

use App\Models\Employee;

class EmployeeService
{
    public function getAll($perPageCount)
    {
        return Employee::orderBy('created_at', 'desc')->paginate($perPageCount);
    }
}
