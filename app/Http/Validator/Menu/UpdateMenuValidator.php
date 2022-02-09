<?php

namespace App\Http\Validator\Menu;

use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Menu\UpdateMenuRequest;

class UpdateMenuValidator
{
  
  static public function rule(UpdateMenuRequest $request) {  
  
        $validator = Validator::make($request->all(), [
            'title' => 'required',             
            'path' => 'required',
            //'icon' => 'required',
            'sort' => 'required'
        ]);
        
        return $validator;
  
  }
    
}
