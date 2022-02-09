<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;    
    
    protected $hidden = [ 'created_at', 'updated_at' ];

    protected $fillable = [ 'name', 'menu_ids', 'description' ];

    protected $casts = [
        'menu_ids' => 'array'
    ];

    /**
     * Get the users for the role.
     */
    public function users()
    {
        return $this->hasMany(\App\Models\User::class);
    }
}
