<?php

namespace App\Services;

use App\Http\Requests\EmployeeCreateRequest;
use App\Http\Requests\EmployeeUpdateRequest;
use App\Models\Employee;
use App\Models\Salary;
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
        $employee->first_name    = $request->input('first_name');
        $employee->last_name     = $request->input('last_name');
        $employee->gender        = $request->input('gender');
        $employee->date_of_birth = $request->input('birth_date');
        $employee->hire_date     = $request->input('hire_date');

        $response = $employee->save();

        if($response){
            foreach($request->designations as $k => $designation){
                $title = new Title();
                $title->emp_no    = $employee->emp_no;
                $title->title     = $designation['title'];
                $title->from_date = $designation['from_date'];
                $title->to_date   = $designation['to_date'];
                $title->save();
            }

            foreach($request->salaries as $k => $salary_data){
                $salary = new Salary();
                $salary->emp_no    = $employee->emp_no;
                $salary->salary    = $salary_data['salary'];
                $salary->from_date = $salary_data['from_date'];
                $salary->to_date   = $salary_data['to_date'];
                $salary->save();
            }
        }
    }

    public function update(EmployeeUpdateRequest $request, Employee $employee)
    {
        $employee->first_name    = $request->input('first_name');
        $employee->last_name     = $request->input('last_name');
        $employee->gender        = $request->input('gender');
        $employee->date_of_birth = $request->input('birth_date');
        $employee->hire_date     = $request->input('hire_date');

        $response = $employee->save();

        if($response){

            self::deleteTitles($employee);
            self::deleteSalaries($employee);

            foreach($request->designations as $k => $designation){
                $title = new Title();
                $title->emp_no    = $employee->emp_no;
                $title->title     = $designation['title'];
                $title->from_date = $designation['from_date'];
                $title->to_date   = $designation['to_date'];
                $title->save();
            }

            foreach($request->salaries as $k => $salary_data){
                $salary = new Salary();
                $salary->emp_no    = $employee->emp_no;
                $salary->salary    = $salary_data['salary'];
                $salary->from_date = $salary_data['from_date'];
                $salary->to_date   = $salary_data['to_date'];
                $salary->save();
            }
        }
    }

    public function delete(Employee $employee)
    {
        Title::where('emp_no', $employee->emp_no)->delete();
        Salary::where('emp_no', $employee->emp_no)->delete();
        $employee->delete();
    }

    public function deleteTitles(Employee $employee)
    {
        Title::where('emp_no', $employee->emp_no)->delete();
    }
    public function deleteSalaries(Employee $employee)
    {
        Salary::where('emp_no', $employee->emp_no)->delete();
    }
}
