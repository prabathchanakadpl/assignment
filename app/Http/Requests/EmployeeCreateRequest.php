<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;

class EmployeeCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $dt = new Carbon();
        $before18Years = $dt->subYears(18)->format('Y-m-d');

        return [
            'first_name' => 'required|min:5',
            'last_name' => 'required|min:5',
            'gender' => 'required',
            'date_of_birth' => 'required|date|before:' . $before18Years,
            'hire_date' => 'required|date',
            'designations' => 'array|min:1',
            'salaries' => 'array|min:1',
        ];
    }
}
