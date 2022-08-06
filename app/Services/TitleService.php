<?php

namespace App\Services;

use App\Models\Title;

class TitleService
{
    public function findTitlesByEmpNo(string $emp_no)
    {
      return Title::where('emp_no',$emp_no)->get();
    }
}
