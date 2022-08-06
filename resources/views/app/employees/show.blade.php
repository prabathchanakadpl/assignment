@extends('layouts.app')

@section('title', 'Create Employee')

@section('content')
    <div class="card">
        <div class="card-header bg-dark text-white" style="width: 100%;">
            <div class="row">
                <div class="col-sm-10"><h3>View Employee - {{$employee->first_name.' '.$employee->last_name.' ( '.$employee->emp_no.' )'}}</h3></div>
                <div class="col-sm-2">
                    <a href="{{route('employees.index')}}" class="btn btn-light shadow">Go Back</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="card mb-3">
                <div class="card-header">Employee Details</div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th>Emp No</th>
                            <td>{{$employee->emp_no}}</td>
                            <th>First Name</th>
                            <td>{{$employee->first_name}}</td>
                            <th>Last Name</th>
                            <td>{{$employee->last_name}}</td>
                        </tr>

                        <tr>
                            <th>Date Of Birth</th>
                            <td>{{$employee->date_of_birth}}</td>
                            <th>Hire Date</th>
                            <td>{{$employee->hire_date}}</td>
                            <th>Created At</th>
                            <td>{{$employee->created_at}}</td>
                        </tr>

                    </table>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header">Salary Details</div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                        <tr class="bg-dark text-white">
                            <th>Salary</th>
                            <th>From Date</th>
                            <th>To Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($salaries as $salary)
                            <tr>
                                <td>{{number_format($salary->salary,2)}}</td>
                                <td>{{$salary->from_date}}</td>
                                <td>{{$salary->to_date}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header">Designation Details</div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr class="bg-dark text-white">
                                <th>Title</th>
                                <th>From Date</th>
                                <th>To Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($titles as $title)
                                <tr>
                                    <td>{{$title->title}}</td>
                                    <td>{{$title->from_date}}</td>
                                    <td>{{$title->to_date}}</td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{route('employees.edit', $employee)}}" class="btn btn-warning text-dark" role="button">Edit</a>
        </div>
    </div>
@endsection

@section('custom_scripts')

@endsection

