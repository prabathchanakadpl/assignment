@extends('layouts.app')

@section('title', 'Employees')

@section('content')
    <div class="card">
        <div class="card-header bg-dark text-white" style="width: 100%;">
            <div class="row">
                <div class="col-sm-10"><h3>All Employees</h3></div>
                <div class="col-sm-2">
                    <a href="{{route('employees.create')}}" class="btn btn-light shadow">Add New</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            @include('layouts.partials.messages')
            <br/>
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Emp No</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Date Of Birth</th>
                                <th>Gender</th>
                                <th>Hire Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @isset($employees)
                                @forelse($employees as $employee)
                                   <tr>
                                       <td>{{$employee->emp_no}}</td>
                                       <td>{{$employee->first_name}}</td>
                                       <td>{{$employee->last_name}}</td>
                                       <td>{{$employee->date_of_birth}}</td>
                                       <td>{{$employee->gender}}</td>
                                       <td>{{$employee->hire_date}}</td>
                                       <td>
                                           @include('layouts.partials.delete_form',  [ "form_id"=>"form_delete_".$employee->id, "action"=>route("employees.destroy",$employee)])
                                           <div class="btn-group">
                                               <a class="btn btn-light shadow"
                                                  href="{{route('employees.show',$employee)}}"
                                                title="View Employee">View</a>
                                               <a class="btn btn-warning text-dark shadow"
                                                  href="{{route('employees.edit',$employee)}}"
                                                  title="Edit Employee">Edit</a>
                                               <button id="btnDelete" class="btn btn-danger shadow"
                                                       type="submit"
                                                       form="form_delete_{{$employee->id}}"
                                                       title="Delete Employee With Related Records"> Delete
                                               </button>
                                           </div>
                                       </td>
                                   </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Employee Data Not Found</td>
                                    </tr>
                                @endforelse
                            @endisset
                        </tbody>
                    </table>
                </div>
                @if( $employees->hasPages() )
                    <div class="card-footer">
                        <div class="card-footer pb-0">
                            @include('layouts.admins.partials.pagination', ['items' => $employees])
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

