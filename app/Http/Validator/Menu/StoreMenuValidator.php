<?php

namespace App\Http\Validator\Menu;

use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Menu\StoreMenuRequest;

class StoreMenuValidator
{
  
  static public function rule(StoreMenuRequest $request) {  
  
        $validator = Validator::make($request->all(), [
            'menu_id' => 'required',
            'title' => 'required',             
            'path' => 'required',
            //'icon' => 'required',
            'sort' => 'required'            
        ]);
        
        return $validator;  
  
  }
    
}
