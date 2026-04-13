<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\UserRole;

class Role extends Model 
{
    use HasFactory;
    
    public function users(){
        return $this->belongsToMany(User::class, 'user_roles');  //user_roles (pivot table) table name
    }
}
