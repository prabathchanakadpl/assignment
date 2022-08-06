@extends('layouts.app')

@section('title', 'Create Employee')

@section('content')
    <div class="card">
        <div class="card-header bg-dark text-white" style="width: 100%;">
            <div class="row">
                <div class="col-sm-10"><h3>Edit Employee - {{$employee->emp_no}}</h3></div>
                <div class="col-sm-2">
                    <a href="{{route('employees.index')}}" class="btn btn-light shadow">Go Back</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            @include('layouts.partials.messages')
            <br/>
            <div class="card">
                <div class="card-body">
                    <form action="{{route('employees.update',$employee)}}" method="POST" id="employee_update_form">
                        @csrf
                        @method('PUT')
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>First Name</label>
                                            <input type="text" class="form-control @error('first_name') is-invalid @enderror"
                                                   placeholder="Enter First Name" name="first_name" id="first_name"
                                                   required="required" form="employee_update_form" value="{{$employee->first_name}}"/>
                                            <x-invalid_feedback field="first_name" />
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Last Name</label>
                                            <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                                                   placeholder="Enter Last Name" name="last_name" id="last_name"
                                                   required="required" form="employee_update_form" value="{{$employee->last_name}}"/>
                                            <x-invalid_feedback field="last_name" />
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label>Birth Date</label>
                                            <input type="text" class="datepicker form-control @error('birth_date') is-invalid @enderror"
                                                   placeholder="Enter Date of Birth" name="birth_date" id="birth_date"
                                                   required="required" form="employee_update_form"
                                                   value="{{$employee->date_of_birth}}" autocomplete="off"/>
                                            <x-invalid_feedback field="birth_date" />
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label>Hire Date</label>
                                            <input type="text" class="datepicker form-control @error('hire_date') is-invalid @enderror"
                                                   placeholder="Enter Hire Date" name="hire_date" id="hire_date"
                                                   required="required" form="employee_update_form"
                                                   value="{{$employee->hire_date}}" autocomplete="off"/>
                                            <x-invalid_feedback field="hire_date" />
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label>Gender</label>
                                            <div class="mt-2">
                                                <input type="radio" class="radio @error('gender') is-invalid @enderror"
                                                       name="gender" id="gender" required="required" value="Male"
                                                       {{$employee->gender === 'Male'?'checked':''}}
                                                       form="employee_update_form"/> Male
                                                <input type="radio" class="radio @error('gender') is-invalid @enderror"
                                                       name="gender" id="gender" required="required" value="Female"
                                                       {{$employee->gender === 'Female'?'checked':''}}
                                                       form="employee_update_form"/> Female
                                                <x-invalid_feedback field="gender" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-header">Designation</div>
                            <div class="card-body">
                                <div class="row mb-2">
                                    <div class="row mb-3">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Title</label>
                                                <input type="text" class="form-control" autocomplete="off"
                                                       placeholder="Enter Title" id="title"/>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>From Date</label>
                                                <input type="text" class="datepicker form-control" autocomplete="off"
                                                       placeholder="Enter From Date" id="title_from_date" />
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>To Date</label>
                                                <input type="text" class="datepicker form-control" autocomplete="off"
                                                       placeholder="Enter To Date" id="title_to_date"/>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <label>Action</label>
                                            <br/>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-dark text-white shadow" id="btn_title_add">Add</button>
                                                <button type="button" class="btn btn-light shadow" id="btn_title_clear" onclick="clearDesignationForm()">Clear</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row m-1">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr class="bg-dark text-white">
                                            <th>Title</th>
                                            <th>From Date</th>
                                            <th>To Date</th>
                                            <th>Remove</th>
                                        </tr>
                                        </thead>
                                        <tbody id="tbl_designation">
                                            @foreach($titles as $title)
                                                @php
                                                    $current_timestamp = \Illuminate\Support\Carbon::now()->toTimeString()
                                                @endphp
                                                <tr>
                                                    <td><input type="text" readonly="readonly" name="designations[{{$current_timestamp}}][title]" value="{{$title->title}}" class="form-control"/></td>
                                                    <td><input type="date" readonly="readonly" name="designations[{{$current_timestamp}}][from_date]" value="{{$title->from_date}}" class="form-control"/></td>
                                                    <td><input type="date" readonly="readonly" name="designations[{{$current_timestamp}}][to_date]" value="{{$title->to_date}}" class="form-control"/></td>
                                                    <td><button type="button" class="btn btn-danger" onclick="removeRow(this);">Remove</button></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-header">Salary</div>
                            <div class="card-body">
                                <div class="row mb-2">
                                    <div class="row mb-3">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Salary</label>
                                                <input type="number" class="form-control" autocomplete="off"
                                                       placeholder="Enter Salary" id="salary"/>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>From Date</label>
                                                <input type="text" class="datepicker form-control" autocomplete="off"
                                                       placeholder="Enter From Date" id="salary_from_date" />
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>To Date</label>
                                                <input type="text" class="datepicker form-control" autocomplete="off"
                                                       placeholder="Enter To Date" id="salary_to_date"/>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <label>Action</label>
                                            <br/>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-dark text-white shadow" id="btn_salary_add">Add</button>
                                                <button type="button" class="btn btn-light shadow" id="btn_salary_clear">Clear</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row m-1">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr class="bg-dark text-white">
                                            <th>Salary</th>
                                            <th>From Date</th>
                                            <th>To Date</th>
                                            <th>Remove</th>
                                        </tr>
                                        </thead>
                                        <tbody id="tbl_salary">
                                            @foreach($salaries as $salary)
                                                @php
                                                    $current_timestamp = \Illuminate\Support\Carbon::now()->toTimeString()
                                                @endphp
                                                <tr>
                                                    <td><input type="text" readonly="readonly" name="salaries[{{$current_timestamp}}][salary]" value="{{$salary->salary}}" class="form-control"/></td>
                                                    <td><input type="date" readonly="readonly" name="salaries[{{$current_timestamp}}][from_date]" value="{{$salary->from_date}}" class="form-control"/></td>
                                                    <td><input type="date" readonly="readonly" name="salaries[{{$current_timestamp}}][to_date]" value="{{$salary->to_date}}" class="form-control"/></td>
                                                    <td><button type="button" class="btn btn-danger" onclick="removeRow(this);">Remove</button></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="card-footer">
                    <button type="submit" form="employee_update_form" class="btn btn-dark text-white">Submit</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom_scripts')
    <script>

        $('#btn_title_add').click(function (){
            addToDesignationTable();
        });

        $('#btn_salary_add').click(function (){
            addToSalaryTable();
        });

        function addToDesignationTable(){
            let title = $('#title').val();
            let title_from_date = $('#title_from_date').val();
            let title_to_date = $('#title_to_date').val();

            if(title && title_from_date && title_to_date){
                let current_timestamp = new Date($.now()).getTime();
                let tr =`<tr>`;
                tr += `<td><input type="text" name="designations[${current_timestamp}][title]" value="${title}" class="form-control"/></td>`
                tr += `<td><input type="date" name="designations[${current_timestamp}][from_date]" value="${title_from_date}" class="form-control"/></td>`
                tr += `<td><input type="date" name="designations[${current_timestamp}][to_date]" value="${title_to_date}" class="form-control"/></td>`
                tr += `<td><button type="button" class="btn btn-danger" onclick="removeRow(this);">Remove</button></td>`
                $('#tbl_designation').append(tr);
                clearDesignationForm();
            }else{
                alert('Please fill Salary, From Date & To Date Before Going to Add Record to Salary Table!!!');
            }
        }

        function addToSalaryTable(){
            let salary = $('#salary').val();
            let salary_from_date = $('#salary_from_date').val();
            let salary_to_date = $('#salary_to_date').val();

            if(salary && salary_from_date && salary_to_date){
                let current_timestamp = new Date($.now()).getTime();
                let tr =`<tr>`;
                tr += `<td><input type="text" name="salaries[${current_timestamp}][salary]" value="${salary}" class="form-control"/></td>`
                tr += `<td><input type="date" name="salaries[${current_timestamp}][from_date]" value="${salary_from_date}" class="form-control"/></td>`
                tr += `<td><input type="date" name="salaries[${current_timestamp}][to_date]" value="${salary_to_date}" class="form-control"/></td>`
                tr += `<td><button type="button" class="btn btn-danger" onclick="removeRow(this);">Remove</button></td>`
                $('#tbl_salary').append(tr);
                clearSalaryForm();
            }else{
                alert('Please fill Salary, From Date & To Date Before Going to Add Record to Salary Table!!!');
            }
        }

        function removeRow(element){
            element.closest('tr').remove();
        }

        function clearDesignationForm(){
            $('#title').val('');
            $('#title_from_date').val('');
            $('#title_to_date').val('');
        }

        function clearSalaryForm(){
            $('#salary').val('');
            $('#salary_from_date').val('');
            $('#salary_to_date').val('');
        }
    </script>
@endsection

