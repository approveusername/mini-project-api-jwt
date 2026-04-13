<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\UserRole;
 
class ManyToMany extends Controller
{
    public function index(){ 
        $user = User::find(1);
        // return $user->roles()->get(); or $user->roles is same
        /* [{"id":2,"role_name":"User","created_at":"2025-01-14T19:04:21.000000Z","updated_at":"2025-01-14T19:04:21.000000Z","pivot":{"user_id":1,"role_id":2}}] */
        // return $user->roles()->attach([1, 2, 4, 5]); //add role to specific
        // return $user->roles()->detach([1, 2, 4, 5, 3]); //remove role to specific
        return $user->roles()->sync([1, 2, 4, 5, 3]); //sync/update role to specific
    }

}
