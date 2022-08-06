<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NumberSequence extends Model
{
    use HasFactory;
    protected $fillable = ['prefix', 'type', 'number', 'number_length', 'suffix'];

    public static function getLast($type)
    {
        $last_record = self::firstOrNew(['type' => $type ], ['prefix'=>$type.'/','number' => 0, 'number_length' => 6]);
        $last_record->number += 1;
        $last_record->save();
        return $last_record;
    }

    public static function getNext($type){
        $last = self::getLast($type);
        return $last->prefix . \Str::padLeft($last->number,$last->number_length,'0').$last->suffix;
    }
}
