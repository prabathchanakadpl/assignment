<?php

namespace App\Services;

use App\Http\Requests\EmployeeCreateRequest;
use App\Models\Employee;
use App\Models\Title;

class EmployeeService
{
    public function getAll($perPageCount)
    {
        return Employee::orderBy('created_at', 'desc')->paginate($perPageCount);
    }

    public function store(EmployeeCreateRequest $request)
    {
        $employee = new Employee();
        $employee->first_name = $request->input('first_name');
        $employee->last_name = $request->input('last_name');
        $employee->gender = $request->input('gender');
        $employee->date_of_birth = $request->input('date_of_birth');
        $employee->hire_date = $request->input('hire_date');

        $response = $employee->save();

        if($response){
            foreach($request->designations as $k => $designation){
                $title = new Title();
                $title->emp_no = $employee->emp_no;
                $title->name = $employee['title'];
                $title->from_date = $employee['from_date'];
                $title->to_date   = $employee['to_date'];
                $title->save();
            }

            foreach($request->salaries as $k => $salary){
                $salary = new Title();
                $salary->emp_no = $employee->emp_no;
                $salary->salary = $employee['salary'];
                $salary->from_date = $employee['from_date'];
                $salary->to_date   = $employee['to_date'];
                $salary->save();
            }
        }
    }
}
