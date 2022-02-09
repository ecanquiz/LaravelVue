<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Menu extends Model
{
    use HasFactory;
    
    protected $hidden = [ 'created_at', 'updated_at' ];
    
    protected $fillable = [ 'title', 'menu_id', 'path', 'icon', 'sort' ];    
    
    public function menus()
    {
        return $this->hasMany(Menu::class);
    }
    
    public function childrenMenus()
    {
        return $this->hasMany(Menu::class)->with('childrenMenus');
    }
    
}
