<?php

namespace App\Services;

use App\Models\Salary;

class SalaryService
{
    public function findSalariesByEmpNo(string $emp_no)
    {
        return Salary::where('emp_no',$emp_no)->get();
    }
}
