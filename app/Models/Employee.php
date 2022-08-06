<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = ['emp_no', 'birth_date', 'first_name', 'last_name', 'gender', 'hire_date', 'created_at'];

    /**
     * Set ticket_no when new ticket creating event fired
     */
    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {

            $model->emp_no = NumberSequence::getNext('emp');

        });
    }
}
