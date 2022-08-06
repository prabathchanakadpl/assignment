<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeCreateRequest;
use App\Http\Requests\EmployeeUpdateRequest;
use App\Models\Employee;
use App\Models\Title;
use App\Services\EmployeeService;
use App\Services\SalaryService;
use App\Services\TitleService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    public $titleService;
    public $salaryService;
    public $employeeService;

   public function __construct()
   {
       $this->titleService    = new TitleService();
       $this->salaryService   = new SalaryService();
       $this->employeeService = new EmployeeService();
   }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): View
    {
        $employees = $this->employeeService->getAll(15);
        return view('welcome', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(): View
    {
        return view('app.employees.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param EmployeeCreateRequest $request
     * @return RedirectResponse
     */
    public function store(EmployeeCreateRequest $request): RedirectResponse
    {
       try {
           DB::beginTransaction();
           $this->employeeService->store($request);
           DB::commit();
           return back()->with('success', 'Employee Successfully Inserted');

       } catch (\Throwable $exception) {
           DB::rollBack();
           //return back()->with('error_string',$exception->getMessage());
           return back()->with('error_string','Employee Insertion Failed!!!');
       }
    }

    /**
     * Display the specified resource.
     *
     * @param  Employee $empoloyee
     * @return Response
     */
    public function show(Employee $employee): View
    {
        $titles   = $this->titleService->findTitlesByEmpNo($employee->emp_no);
        $salaries = $this->salaryService->findSalariesByEmpNo($employee->emp_no);
        return view('app.employees.show',compact('employee','titles', 'salaries'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Employee $employee
     * @return View
     */
    public function edit(Employee $employee): View
    {
        $titles   = $this->titleService->findTitlesByEmpNo($employee->emp_no);
        $salaries = $this->salaryService->findSalariesByEmpNo($employee->emp_no);
        return view('app.employees.edit',compact('employee','titles', 'salaries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  Employee $employee
     * @return RedirectResponse
     */
    public function update(EmployeeUpdateRequest $request, Employee $employee): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $this->employeeService->update($request, $employee);
            DB::commit();
            return back()->with('success', 'Employee Successfully Updated');

        } catch (\Throwable $exception) {
            DB::rollBack();
            //return back()->with('error_string',$exception->getMessage());
            return back()->with('error_string','Employee Updating Failed!!!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Employee $employee
     * @return RedirectResponse
     */
    public function destroy(Employee $employee): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $this->employeeService->delete($employee);
            DB::commit();
            return back()->with('success', 'Employee Successfully Deleted');

        } catch (\Throwable $exception) {
            DB::rollBack();
            //return back()->with('error_string',$exception->getMessage());
            return back()->with('error_string','Employee Deletion Failed!!!');
        }
    }
}
